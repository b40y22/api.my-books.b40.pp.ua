<?php
declare(strict_types=1);

namespace App\Src\Services\Import\Parser\Sources;

use App\Src\Common\Books\Builder\BuilderBookInterface;
use App\Src\Common\Books\Builder\ReadBook;
use App\Src\Services\Http\Crawler;
use Crwlr\Crawler\Exceptions\UnknownLoaderKeyException;
use Crwlr\Crawler\Loader\Http\Exceptions\LoadingException;
use Crwlr\Crawler\Steps\Dom;
use Crwlr\Crawler\Steps\Html;
use Crwlr\Crawler\Steps\Loading\Http;
use Exception;

class LovereadInfo implements SourceInterface
{
    private array $linkComponents;

    /**
     * @var ReadBook
     */
    private ReadBook $ReadBook;

    /**
     * @param string $link
     */
    public function __construct(
        protected string $link,
    ) {
        $this->ReadBook = new ReadBook();
    }

    /**
     * @throws Exception
     */
    public function handle(): BuilderBookInterface
    {
        if (!$this->link) {
            throw new Exception('Link can`t be empty');
        }
        $this->getBookInformation();
        $this->getBookContext();

        return $this->ReadBook;
    }

    /**
     * @throws Exception
     */
    private function getBookInformation()
    {
        // Book id
        $this->ReadBook->setBookId($this->extractBookIdFromLink());

        try {
            $crawler = new Crawler();
            $crawler
                ->input($this->link)
                ->addStep(Http::get()->stopOnErrorResponse())
                ->addStep(
                    Html::root()
                        ->extract([
                            'imageLink' => Dom::cssSelector('.fullstory-poster > img:nth-child(1)')->attribute('src')->toAbsoluteUrl(),
                            'description' => Dom::cssSelector('#fullstory-content > div:nth-child(2)')->text(),
                            'titleAndAuthor' => Dom::cssSelector('#fullstory > h1:nth-child(1)')->text()
                        ])->addToResult()
                );

            foreach ($crawler->run() as $result) {
                $allInfo = $result->toArray();
                $titleAndAuthorExplode = explode('-', $allInfo['titleAndAuthor']);

                $this->ReadBook->setTitle(trim($titleAndAuthorExplode[0]));
                $this->ReadBook->setAuthors(
                    $this->explodeAuthors(trim($titleAndAuthorExplode[1]))
                ); // TODO: тут тонке місце - авторів може трапитись більше. Але не знайшов на сайті приклада

                if ($allInfo['imageLink']) {
                    $this->ReadBook->setImage($allInfo['imageLink']);
                }
                if ($allInfo['description']) {
                    $this->ReadBook->setDescription($allInfo['description']);
                }
            }
        } catch (Exception $e) {
            throw new LoadingException($e->getMessage());
        }
    }

    /**
     * Метод в якому рядок вигляда "Мария Кардакова, Анча Баранова" перетворюється на массив авторів певного формата
     * @param string $authors
     * @return array
     */
    private function explodeAuthors(string $authors): array
    {
        $result = [];
        $authorsArray = explode(',', $authors);
        foreach ($authorsArray as $rawAuthor) {
            $fullNameAuthor = explode(' ', $rawAuthor);
            $result[] = [
                'id' => 0,
                'new' => true,
                'firstname' => $fullNameAuthor[0],
                'lastname' => $fullNameAuthor[1],
            ];
        }

        return $result;
    }

    /**
     * @throws Exception
     */
    private function extractBookIdFromLink(): int
    {
        preg_match('/(\d+){4,}/', $this->link, $matches);

        if (isset($matches[0])) {
            return (int) $matches[0];
        }

        throw new Exception('Can`t get book id');
    }

    /**
     * @throws UnknownLoaderKeyException
     */
    private function getBookContext()
    {
        $result = [];

        $this->ReadBook->setPages(
            $this->getMaxPageFromPagination()
        );

        $this->linkComponents = parse_url($this->link);
        $this->linkComponents['pathComponents'] = explode('/', $this->linkComponents['path']);

        for ($pageNumber = 1; $pageNumber <= $this->ReadBook->getPages(); $pageNumber++) {
            if ($pageNumber === 1) {
                $result[] = $this->getCurrentPageContext($this->link);
                continue;
            }
            $result[] = $this->getCurrentPageContext($this->linkMaker($pageNumber));
        }

        $this->ReadBook->setContext($result);
    }

    /**
     * @throws UnknownLoaderKeyException
     * @throws Exception
     */
    private function getMaxPageFromPagination(): int
    {
        $crawler = new Crawler();
        $crawler
            ->input($this->link)
            ->addStep(Http::get())
            ->addStep(
                Html::root()
                    ->extract([
                        'pages' => Dom::cssSelector('div.storenumber:nth-child(1) > div:nth-child(2) > div:nth-child(2) > a:nth-child(5)')
                    ])->addToResult()
            );

        foreach ($crawler->run() as $result) {
            return (int) $result->get('pages');
        }

        return 0;
    }

    /**
     * @throws UnknownLoaderKeyException
     * @throws Exception
     */
    private function getCurrentPageContext(string $url): array
    {
        $crawler = new Crawler();
        $crawler
            ->input($url)
            ->addStep(Http::get())
            ->addStep(
                Html::root()
                    ->extract([
                        'context' => Dom::cssSelector('#texts')->html()
                    ])->addToResult()
            );

        foreach ($crawler->run() as $pageContext) {
            return $pageContext->toArray();
        }

        return [];
    }

    /**
     * Метод створює новий формат посилання.
     * Було https://loveread.info/books/nauchnaya-fantastika/199403-velikii-i-uzhasnyi-si-evgenii-adgurovich-kapba.html
     * Стало https://loveread.info/books/nauchnaya-fantastika/page-2-199403-velikii-i-uzhasnyi-si-evgenii-adgurovich-kapba.html
     * @param int $pageNumber
     * @return string
     */
    private function linkMaker(int $pageNumber): string
    {
        return
            $this->linkComponents['scheme']
            . '://' . $this->linkComponents['host']
            . '/' . $this->linkComponents['pathComponents'][1]
            . '/' .$this->linkComponents['pathComponents'][2]
            . '/page-' . $pageNumber . '-'
            . $this->linkComponents['pathComponents'][3];
    }
}
