<?php
declare(strict_types=1);

namespace App\Services\Import\Parser\Sources;

use App\Services\Http\Crawler;
use App\ValueObjects\File\Direction\Download;
use App\ValueObjects\File\Image\Image;
use Crwlr\Crawler\Exceptions\UnknownLoaderKeyException;
use Crwlr\Crawler\Steps\Dom;
use Crwlr\Crawler\Steps\Html;
use Crwlr\Crawler\Steps\Loading\Http;
use Exception;

abstract class AbstractParser
{
    /**
     * @throws Exception
     */
    protected function extractBookIdFromLink(): int
    {
        preg_match('/(\d+){3,}/', $this->link, $matches);

        if (isset($matches[0])) {
            return (int) $matches[0];
        }

        throw new Exception('Can`t get book id');
    }

    /**
     * Метод в якому рядок вигляда "Мария Кардакова, Анча Баранова" перетворюється на массив авторів певного формата
     * @param string $authors
     * @return array
     */
    protected function explodeAuthors(string $authors): array
    {
        $result = [];
        $authorsArray = explode(',', $authors);
        foreach ($authorsArray as $rawAuthor) {
            $fullNameAuthor = explode(' ', $rawAuthor);
            $result[] = [
                'id' => 0,
                'new' => true,
                'firstname' => array_shift($fullNameAuthor),
                'lastname' => array_pop($fullNameAuthor),
            ];
        }

        return $result;
    }

    /**
     * @throws UnknownLoaderKeyException
     * @throws Exception
     */
    protected function getCurrentPageContext(string $url): array
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
     * @param string $imageLink
     * @return Image
     * @throws Exception
     */
    protected function createImageObjectForDownload(string $imageLink): Image
    {
        $direction = (new Download())->setDownloadLink($imageLink);

        return (new Image())
            ->newFilename()
            ->setExtension(
                pathinfo($direction->getDownloadLink(), PATHINFO_EXTENSION)
            )
            ->setSourcePath()
            ->setDestinationPath('/images/books')
            ->setWidth(200)
            ->setHeight(300)
            ->setDirection($direction);
    }
}
