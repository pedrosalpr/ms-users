<?php

declare(strict_types=1);

namespace App\Entities;

use App\Exceptions\EntityException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

class User implements Arrayable
{
    private $name;
    private $email;
    private $cpfCnpj;
    private $password;
    private $userType;
    private $createdAt;
    private $updatedAt;

    public static function fromArray(array $data)
    {
        // $userType = Arr::get($data, 'user_type');
        // if (!in_array($userType, UserType::types())) {
        //     throw EntityException::invalidParameterType(
        //         'user_type',
        //         UserType::class,
        //         gettype($userType)
        //     );
        // }

        $user = new self();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->cpfCnpj = $data['cpf_cnpj'];
        $user->password = $data['password'];
        $user->userType = $data['user_type'];
        $user->createdAt = $data['created_at'] ?? null;
        $user->updatedAt = $data['updated_at'] ?? null;

        return $user;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'cpf_cnpj' => $this->cpfCnpj,
            'password' => $this->password,
            'user_type' => $this->userType,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }
}
