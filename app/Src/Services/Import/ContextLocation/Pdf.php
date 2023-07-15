<?php
declare(strict_types=1);

namespace App\Src\Services\Import\ContextLocation;

use App\Src\Common\Books\Builder\ReadBook;
use App\Src\Traits\FileNameGenerate;
use Barryvdh\DomPDF\Facade\Pdf as BPDF;

class Pdf implements ContextLocationInterface
{
    use FileNameGenerate;

    /**
     * @param ReadBook $ReadBook
     */
    public function __construct(
        protected ReadBook $ReadBook
    ) {}

    /**
     * @return bool
     */
    public function handle(): bool
    {
//        $pdf = BPDF::loadView('pdf.book.first-page', [
//            'title' => $this->ReadBook->getTitle(),
//            'authors' => $this->ReadBook->getAuthors(),
//            'cover' => $this->ReadBook->getImage(),
//            'year' => $this->ReadBook->getYear(),
//        ]);

        $allContext = [];
//        $pdf = App::make('dompdf.wrapper');
        foreach ($this->ReadBook->getContext() as $context) {
            $allContext[] = $context;
        }
        dump($this->ReadBook);
//        dd($allContext);
        $pdf = BPDF::loadView('pdf.book.page', ['context' => $allContext]);
        $pdf->save(public_path('/books/' . $this->generateFilename() . '.pdf'));

        return false;
    }
}
