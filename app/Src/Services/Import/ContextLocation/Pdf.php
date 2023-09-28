<?php
declare(strict_types=1);

namespace App\Src\Services\Import\ContextLocation;

use App\Events\Actions\PostBookCreateEvent;
use App\Models\Book;
use App\Src\Repositories\Eloquent\BookContextRepository;
use App\Src\Repositories\Interfaces\BookContextRepositoryInterface;
use App\Src\Traits\FileNameGenerate;
use App\Src\ValueObjects\Book\ReadBookInterface;
use Exception;
use Illuminate\Support\Facades\Log;
use Mpdf\Mpdf;

class Pdf extends AbstractStoreBook implements ContextLocationInterface
{
    use FileNameGenerate;

    protected BookContextRepositoryInterface $bookContextRepository;

    /**
     * @param ReadBookInterface $BookForStore
     * @param int $userId
     */
    public function __construct(
        protected ReadBookInterface $BookForStore,
        protected int $userId
    ) {
        $this->bookContextRepository = new BookContextRepository();
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        return $this->createPdf();
    }


    /**
     * @return bool
     */
    protected function createPdf(): bool
    {
       try {
            $mpdf = new Mpdf([
                'tempDir' => __DIR__ . '/tmp',
                'default_font_size' => 10,
                'mode' => 'utf-8',
                'format' => 'A4',
            ]);

            $mpdf->setFooter('{PAGENO}');
            $mpdf->SetHTMLFooter('<div style="text-align: center">- {PAGENO} -</div>');

            $allText = [];
            foreach ($this->BookForStore->getContext() as $page) {
                dump($page);
                $allText = array_merge($allText, $page);
            }
//dd($allText);
            foreach ($allText as $index => $line) {
                if ($index === 0) {
                    $mpdf->WriteHTML('<p style="align-content: center; font-size: 16px; font-style: oblique; vertical-align: center">'
                        . $this->BookForStore->getTitle()
                        . '</p><hr>'
                    );
                }
                $mpdf->WriteHTML($line);
            }

            $filename = $this->generateFilename();
            $path = public_path(sprintf("/books/%s.pdf", $filename));
            $mpdf->Output($path, 'F');

            $this->BookForStore->addToFiles(
                ['pdf' => $this->createPdfObject($filename)]
            );

            $BookInDatabase = $this->saveBookToDatabase();

            if (!$BookInDatabase) {
                throw new Exception('[Pdf:createPdf] can`t store book to database');
            }

            $this->postCreateBook($BookInDatabase);

        } catch (Exception $e) {
            Log::error('[Pdf:createPdf]', ['create and save PDF document is wrong']);

            return false;
        }

        return true;
    }

    /**
     * @return Book|null
     */
    private function saveBookToDatabase(): ?Book
    {
        return $this->basicStoreBook(
            $this->BookForStore,
            ['user_id' => $this->userId]
        );
    }

    /**
     * @param $Book
     * @return void
     */
    private function postCreateBook($Book): void
    {
        event(new PostBookCreateEvent($Book));
    }
}
