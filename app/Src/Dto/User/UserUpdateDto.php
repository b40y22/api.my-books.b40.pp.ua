<?php
declare(strict_types=1);

namespace App\Src\Dto\User;

use App\Src\Common\File;
use App\Src\Dto\AbstractDto;
use App\Src\Traits\FileNameGenerate;
use Illuminate\Http\UploadedFile;

class UserUpdateDto extends AbstractDto
{
    use FileNameGenerate;
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var string|mixed|null
     */
    protected ?string $name = null;

    /**
     * @var string|mixed|null
     */
    protected ?string $email = null;

    /**
     * @var File|null
     */
    protected ?File $image = null ;

    /**
     * @param array $user
     */
    public function __construct(array $user)
    {
        $this->id = (int) $user['id'];
        if (isset($user['name'])) {
            $this->name = $user['name'];
        }
        if (isset($user['email'])) {
            $this->email = $user['email'];
        }
        if (isset($user['image'])) {
            $File = new File();
            $File->extension = $user['image']->extension();
            $File->pathSource = $user['image']->getPathname();
            $File->filename = $this->generateFilename();
            $File->pathDestination = public_path('/images/users/' . $File->filename . '.' . $user['image']->extension());
            $this->image = $File;
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return File|null
     */
    public function getImage(): ?File
    {
        return $this->image;
    }
}
