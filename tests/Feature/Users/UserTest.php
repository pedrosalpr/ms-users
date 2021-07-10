<?php

namespace Tests\Feature\Users;

use App\Entities\UserType;
use App\Enums\Config\Routes;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldReturnSpecificUser()
    {
        $user = User::factory()->create();
        $jsonStructure = [
            'name', 'cpf_cnpj', 'email', 'user_type'
        ];
        $this->getJson(Routes::USERS.'/'.$user->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure($jsonStructure);
    }

    public function testShouldReturnUserNotFound()
    {
        $id = 1;
        $this->getJson(Routes::USERS.'/'.$id)
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
