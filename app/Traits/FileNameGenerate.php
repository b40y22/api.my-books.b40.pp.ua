<?php
declare(strict_types=1);

namespace App\Traits;

use Carbon\Carbon;

trait FileNameGenerate
{
    /**
     * @return string
     */
    public function generateFilename(): string
    {
        return md5(Carbon::now()->format('U.u'));
    }
}
