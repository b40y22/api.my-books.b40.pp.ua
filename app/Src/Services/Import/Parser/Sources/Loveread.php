<?php
declare(strict_types=1);

namespace App\Src\Services\Import\Parser\Sources;

use App\Src\Common\Books\Builder\ReadBook;
use App\Src\Services\Http\Crawler;
use Crwlr\Crawler\Exceptions\UnknownLoaderKeyException;
use Crwlr\Crawler\Steps\Dom;
use Crwlr\Crawler\Steps\Html;
use Crwlr\Crawler\Steps\Loading\Http;
use Exception;

final class Loveread implements SourceInterface
{
    /**
     * Here MUST be all variants information about book
     * @var array|array[]
     */
    private array $needleData = [
        ['word' => 'Серия: ', 'string' => '', 'value' => ''],
        ['word' => 'Автор: ', 'string' => '', 'value' => ''],
        ['word' => 'Название: ', 'string' => '', 'value' => ''],
        ['word' => 'Издательство: ', 'string' => '', 'value' => ''],
        ['word' => 'Год: ', 'string' => '', 'value' => ''],
        ['word' => 'ISBN: ', 'string' => '', 'value' => ''],
        ['word' => 'Страниц: ', 'string' => '', 'value' => ''],
        ['word' => 'Перевод книги: ', 'string' => '', 'value' => ''],
        ['word' => 'Язык: ', 'string' => '', 'value' => ''],
    ];

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
     * @return ReadBook
     * @throws UnknownLoaderKeyException
     */
    public function handle(): ReadBook
    {
        $this->getBookInformation();
        $this->getBookContext();

        return $this->ReadBook;
    }

    /**
     * @return void
     * @throws UnknownLoaderKeyException
     * @throws Exception
     */
    private function getBookInformation(): void
    {
        // Book id
        $this->ReadBook->setBookIdOnLoveread((int) str_replace(env('LOVEREAD_HOST') . 'view_global.php?id=', '', $this->link));

        $crawler = new Crawler();
        $crawler
            ->input($this->link)
            ->addStep(Http::get())
            ->addStep(
                Html::root()
                    ->extract([
                        'imageLink' => Dom::cssSelector('img.margin-right_8')->attribute('src')->toAbsoluteUrl(),
                        'bookLink' => Dom::cssSelector('tr.td_center_color:nth-child(3) > td:nth-child(1) > p:nth-child(2) > a:nth-child(1)')->attribute('href')->toAbsoluteUrl(),
                        'bookData' => Dom::xPath('//tr[@class=\'td_center_color\']')
                    ])->addToResult()
            );

        foreach ($crawler->run() as $result) {
            $allInfo = $result->toArray()['bookData'][0];

            foreach ($this->needleData as $key => &$item) {
                $stringForSearch = $allInfo;
                if (mb_stripos($allInfo, $item['word']) !== false) {
                    $separated = str_ireplace($item['word'], '|', $stringForSearch);
                    $item['string'] = trim(explode('|', $separated)[1]);
                } else {
                    unset($this->needleData[$key]);
                }
            }

            uasort($this->needleData, function ($a, $b) {
                return strlen($a['string']) - strlen($b['string']);
            });

            $split = '';
            foreach ($this->needleData as &$itemForFill) {
                match ($itemForFill['word']) {
                    'Автор: ' => $this->ReadBook->setAuthors(
                        $this->explodeAuthors(trim(str_replace($split, '', $itemForFill['string'])))
                    ),
                    'Название: ' => $this->ReadBook->setTitle(trim(str_replace($split, '', $itemForFill['string']))),
                    'Год: ' => $this->ReadBook->setYear((int) trim(str_replace($split, '', $itemForFill['string']))),
                    default => ''
                };
                $split = $itemForFill['word'] . $itemForFill['string'];
            }

            $this->ReadBook->setImage($result->get('imageLink'));
            $this->ReadBook->setDescription($result->get('bookData')[1]);
            $this->ReadBook->setLinkToContext($result->get('bookLink'));
        }
    }

    /**
     * @param string $authors
     * @return array
     */
    private function explodeAuthors(string $authors): array
    {
        $result = [];
        $authorsArray = explode(',', $authors);
        foreach ($authorsArray as $rawAuthor) {
            $result[] = [
                'id' => 0,
                'new' => false,
                ''
            ];
        }

        return [];
    }

    /**
     * @return void
     * @throws UnknownLoaderKeyException
     */
    private function getBookContext(): void
    {
        $result = [];

        $this->ReadBook->setPages(
            $this->getMaxPageFromPagination($this->ReadBook->getLinkToContext())
        );

        for ($p = 1; $p <= $this->ReadBook->getPages(); $p++) {
            $result[] = $this->getCurrentPageContext(env('LOVEREAD_HOST') . 'read_book.php?id=' . $this->ReadBook->getBookIdOnLoveread() . '&p=' . $p);
        }

        $this->ReadBook->setContext($result);
    }

    /**
     * @param string $url
     * @return int
     * @throws UnknownLoaderKeyException
     * @throws Exception
     */
    protected function getMaxPageFromPagination(string $url): int
    {
        $crawler = new Crawler();
        $crawler
            ->input($url)
            ->addStep(Http::get())
            ->addStep(
                Html::first('.navigation')
                    ->extract([
                        'pages' => Dom::cssSelector('.navigation > a:nth-child(12)')
                    ])->addToResult()
            );

        foreach ($crawler->run() as $result) {
            return (int) $result->get('pages');
        }

        return 0;
    }

    /**
     * @param string $url
     * @return array
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
                Html::first('.MsoNormal')
                    ->extract([
                        'context' => Dom::xPath('//p[@class="MsoNormal"]')
                    ])->addToResult()
            );

        foreach ($crawler->run() as $pageContext) {
            return array_filter($pageContext->get('context'), function ($value) {
                return !empty($value);
            });
        }

        return [];
    }
}
