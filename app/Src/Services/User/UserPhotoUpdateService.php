<?php
declare(strict_types=1);

namespace App\Src\Services\User;

use App\Src\Dto\User\UserUpdateDto;
use App\Src\Repositories\Interfaces\UserRepositoryInterface;
use App\Src\Services\File\FileServiceInterface;
use App\Src\Services\User\Interfaces\UserPhotoUpdateServiceInterface;
use App\Src\Storages\LocalStorage;
use App\Src\ValueObjects\File\Direction\Upload;
use App\Src\ValueObjects\File\File;
use App\Src\ValueObjects\File\Image\Image;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPhotoUpdateService implements UserPhotoUpdateServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected FileServiceInterface $fileService
    ) {}

    /**
     * TODO - При оновленні аватара користувача старе зображення потрібно видалити
     * @throws Exception
     */
    public function upload(Request $userUpdateRequest): array
    {
        $direction = new Upload();
        $photo = $userUpdateRequest->file('photo');

        $image = new Image();
        $image->newFilename();
        $image->setExtension($photo->getClientOriginalExtension());
        $image->setSourcePath($photo->getRealPath());
        $image->setDestinationPath('/images/users');
        $image->setHeight(100);
        $image->setWidth(100);
        $image->setDirection($direction);

        /** @var File $file */
        $file = $this->fileService->upload($image, new LocalStorage());

       $this->updateUserImageInDb($file);

        return $file->toArray();
    }

    /**
     * @throws Exception
     */
    private function updateUserImageInDb(File $file): void
    {
        $userUpdateDto = new UserUpdateDto([
            'id' => Auth::id(),
            'image' => $file->getFullFilename()
        ]);

        $this->userRepository->update($userUpdateDto);
    }
}
