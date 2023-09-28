<?php
declare(strict_types=1);

namespace App\Src\Services\Import\Parser\Sources;

use App\Src\Services\Http\Crawler;
use App\Src\Traits\ExternalSourceTrait;
use App\Src\ValueObjects\Book\ReadBookInterface;
use App\Src\ValueObjects\Book\ReadBook;
use Crwlr\Crawler\Exceptions\UnknownLoaderKeyException;
use Crwlr\Crawler\Steps\Dom;
use Crwlr\Crawler\Steps\Html;
use Crwlr\Crawler\Steps\Loading\Http;
use Exception;
use Illuminate\Support\Facades\Log;

final class ReadukrainianbooksCom extends AbstractParser  implements SourceInterface
{
    use ExternalSourceTrait;

    // https://readukrainianbooks.com/

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
    public function handle(): ReadBookInterface
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
    private function getBookInformation(): void
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
                            'author' => Dom::cssSelector('.short-list > li:nth-child(2) > a:nth-child(2)')->text(),
                            'imageLink' => Dom::cssSelector('.fimg > img:nth-child(1)')->attribute('data-src')->toAbsoluteUrl(),
                            'titleRaw' => Dom::cssSelector('.short-title')->text(),
                            'description' => Dom::cssSelector('.shortstory-text > p:nth-child(1)')->text()
                        ])->addToResult()
                );

            foreach ($crawler->run() as $result) {
                $allInfo = $result->toArray();

                $titleAndAuthorExplode = explode('-', $allInfo['titleRaw']);
                $titleAndAuthorExplode = explode(',', $titleAndAuthorExplode[1]);

                $this->ReadBook->setTitle(trim(str_replace('"', '', $titleAndAuthorExplode[0])));
                $this->ReadBook->setAuthors(
                    $this->explodeAuthors($allInfo['author'])
                ); // TODO: тут тонке місце - авторів може трапитись більше. Але не знайшов на сайті приклада

                if ($allInfo['imageLink']) {
                    $this->ReadBook->setFiles(
                        ['image' => $this->createImageObjectForDownload($allInfo['imageLink'])]
                    );
                }
                if ($allInfo['description']) {
                    $this->ReadBook->setDescription($allInfo['description']);
                }
            }
        } catch (Exception $e) {
            $this->disableExternalSourceByUrl($this->link);

            Log::error('ReadukrainianbooksCom', [$e->getCode() => $e->getMessage()]);
        }
    }

    /**
     * TODO - необхідно привести до одного стандарта контекст книжок які парсю. PDF тут не працює
     * @throws UnknownLoaderKeyException
     */
    private function getBookContext(): void
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
            ->addStep(Http::get()->stopOnErrorResponse())
            ->addStep(
                Html::first('.navigation')
                ->extract([
                    'pages' => Dom::cssSelector('a')->last()
                ])
            );

        foreach ($crawler->run() as $result) {
            return (int) $result->get('pages');
        }

        return 0;
    }

    /**
     * Метод створює новий формат посилання.
     * Було https://readukrainianbooks.com/6069-pan-tadeush-adam-mickevich.html
     * Стало https://readukrainianbooks.com/page-2-6069-pan-tadeush-adam-mickevich.html
     * @param int $pageNumber
     * @return string
     */
    private function linkMaker(int $pageNumber): string
    {
        return
            $this->linkComponents['scheme']
            . '://' . $this->linkComponents['host']
            . '/page-' . $pageNumber . '-'
            . $this->linkComponents['pathComponents'][1];
    }
}
