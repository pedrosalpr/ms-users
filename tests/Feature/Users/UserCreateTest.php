<?php

namespace Tests\Feature;

use App\Entities\UserType;
use App\Enums\Config\Routes;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserCreateTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldCreateAUserSucessfully()
    {
        $data = [
            'name' => 'Leandro Pedrosa',
            'cpf_cnpj' => '012.154.221-13',
            'email' => 'pedrosalpr@gmail.com',
            'password' => 'pass',
            'user_type' => (string) UserType::common()
        ];
        $response = $this->postJson(Routes::USERS, $data);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function testShouldNotCreateUserIfUserExistsWithSameCpf()
    {
        $user = User::factory()->create([
            'cpf_cnpj' => '012.154.221-13',
        ]);
        $data = [
            'name' => 'Leandro Pedrosa',
            'cpf_cnpj' => '012.154.221-13',
            'email' => 'pedrosalpr@hotmail.com',
            'password' => 'pass',
            'user_type' => UserType::common()
        ];
        $response = $this->postJson(Routes::USERS, $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testShouldNotCreateUserIfUserExistsWithSameEmail()
    {
        $user = User::factory()->create([
            'email' => 'pedrosalpr@hotmail.com',
        ]);
        $data = [
            'name' => 'Leandro Pedrosa',
            'cpf_cnpj' => '012.154.221-13',
            'email' => 'pedrosalpr@hotmail.com',
            'password' => 'pass',
            'user_type' => UserType::common()
        ];
        $response = $this->postJson(Routes::USERS, $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
