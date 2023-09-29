<?php

namespace App\Services\User\Interfaces;

use Illuminate\Http\Request;

interface UserPhotoUpdateServiceInterface
{
    /**
     * @param Request $userUpdateRequest
     * @return array
     */
    public function upload(Request $userUpdateRequest): array;
}
