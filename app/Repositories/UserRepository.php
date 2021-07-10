<?php

namespace App\Repositories;

use App\Models\User;
use App\Entities\User as UserEntity;
use App\Enums\Config\CacheKey;
use Illuminate\Support\Facades\Cache;

class UserRepository
{
    private $seconds = 60 * 10;

    //{"name":"Picanha Dourada","cpf_cnpj":"05.621.823/0001-58","email":"picanhadourada@gmail.com","password":"picanha","user_type":2}

    public function findById(int $id): User
    {
        return Cache::remember(CacheKey::getKeyCacheUserById($id), $this->seconds, function () use ($id) {
            return User::findOrFail($id);
        });
    }

    public function store(array $data): User
    {
        $userEntity = UserEntity::fromArray($data);
        return User::create($userEntity->toArray());
    }
}
