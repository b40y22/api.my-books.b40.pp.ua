<?php

namespace App\Repositories\Interfaces;

use App\Dto\ExternalSource\ExternalSourceStoreDto;
use App\Models\ExternalSource;
use Illuminate\Database\Eloquent\Collection;

interface ExternalSourceRepositoryInterface
{
    /**
     * @param ExternalSourceStoreDto $externalSource
     * @return ExternalSource
     */
    public function store(ExternalSourceStoreDto $externalSource): ExternalSource;

    /**
     * @return Collection|null
     */
    public function listAll(): ?Collection;

    /**
     * @return Collection|null
     */
    public function listOnlyActive(): ?Collection;

    /**
     * @param string $className
     * @return ExternalSource|null
     */
    public function getExternalSourceByClassName(string $className): ?ExternalSource;
}
