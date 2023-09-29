<?php
declare(strict_types=1);

namespace App\Dto\User;

use App\Dto\AbstractDto;
use App\Traits\FileNameGenerate;

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
     * @var string|null
     */
    readonly public ?string $image;

    /**
     * @param array $user
     */
    public function __construct(array $user)
    {
        if (isset($user['id'])) {
            $this->id = (int) $user['id'];
        }
        if (isset($user['name'])) {
            $this->name = $user['name'];
        }
        if (isset($user['email'])) {
            $this->email = $user['email'];
        }
        if (isset($user['image'])) {
            $this->image = $user['image'];
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

    public function setId(int $userId): void
    {
        $this->id = $userId;
    }

    /**
     * @return array
     */
    public function toArrayNotNullFields(): array
    {
        $properties = get_object_vars($this);

        $filteredProperties = [];

        foreach ($properties as $key => $value) {
            if ($value !== null) {
                $filteredProperties[$key] = $value;
            }
        }

        return $filteredProperties;
    }
}
