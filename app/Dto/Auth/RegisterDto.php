<?php
declare(strict_types=1);

namespace App\Dto\Auth;

use App\Dto\AbstractDto;
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
}
