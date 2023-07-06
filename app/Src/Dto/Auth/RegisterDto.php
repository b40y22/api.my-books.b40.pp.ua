<?php

namespace App\Src\Dto\Auth;

use App\Src\Dto\AbstractDto;
use Illuminate\Support\Facades\Hash;

class RegisterDto extends AbstractDto
{
    /**
     * @var string
     */
    protected string $name;

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
        $this->name = $request['name'];
        $this->email = $request['email'];
        $this->password = Hash::make($request['password']);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
