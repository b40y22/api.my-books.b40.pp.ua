<?php

namespace App\Src\Dto\Auth;

use App\Src\Dto\AbstractDto;

class LoginDto extends AbstractDto
{
    /**
     * @var string
     */
    protected string $email;

    /**
     * @var string
     */
    protected string $password;

    /**
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->email = $request['email'];
        $this->password = $request['password'];
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
