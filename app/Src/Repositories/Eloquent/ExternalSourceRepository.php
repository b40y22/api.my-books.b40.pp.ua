<?php

namespace App\Src\Repositories\Eloquent;

use App\Models\ExternalSource;
use App\Src\Dto\ExternalSource\ExternalSourceStoreDto;
use App\Src\Repositories\Interfaces\ExternalSourceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ExternalSourceRepository extends AbstractRepository implements ExternalSourceRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(ExternalSource::class);
    }

    /**
     * @param ExternalSourceStoreDto $externalSource
     * @return ExternalSource
     */
    public function store(ExternalSourceStoreDto $externalSource): ExternalSource
    {
        return $this->model::create([
            ...$externalSource->toArray(),
            'last_check_at' => null
        ]);
    }

    /**
     * @return Collection|null
     */
    public function listAll(): ?Collection
    {
        return $this->model::all();
    }

    /**
     * @return Collection|null
     */
    public function listOnlyActive(): ?Collection
    {
        return $this->model::where('active', 1)->get();
    }
}
