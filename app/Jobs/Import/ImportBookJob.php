<?php
declare(strict_types=1);

namespace App\Jobs\Import;

use App\Src\Dto\Import\ImportBookDto;
use App\Src\Services\Import\Parser\ImportServiceInterface;
use App\Src\Traits\HttpTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportBookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, HttpTrait;

    /**
     * @param ImportServiceInterface $importService
     * @param ImportBookDto $bookDto
     */
    public function __construct(
        private readonly ImportServiceInterface $importService,
        private readonly ImportBookDto $bookDto,
    ) {}

    /**
     * @return void
     */
    public function handle(): void
    {
        $this->importService->importBook($this->bookDto);
    }
}
