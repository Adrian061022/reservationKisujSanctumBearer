<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    //}

    use RefreshDatabase;

    #[Test]
    public function user_can_register()
    {
      //Arrange
        $payload = [
    'name'=>'Adrián',
    'email'=> 'adrian@gmail.com',
    'password'=> 'Jelszo_2025',
    'password_confiramtion'=> 'Jelszo_2025'
    ];

      
      //Act

      $response = $this->postJson('/api/register', $payload);

      //Assert

      $response->assertStatus(201)->assertJsonStructure(['message', 'user']);
    $this->assertDatabaseHas('users',['email' => 'adrian@gmail.com' ]);
        
}

    #[Test]
    public function user_can_login_and_receive_token()
    {
      //Arrange
      $user = User::factory()->create([
        'email' => 'teszt@gmail.com',
        'password' => bycrypt('password')
      ]);
      
      $credentials = [
        'email' => 'teszt@gmail.com',
        'password' => 'password'
      ];

       $response = $this->postJson('/api/login', $credentials);

    $response->assertStatus(200)->assertJsonStructure(['access_token', 'token_type']);

      }

    //   #[Test]
    //   public function user_can_logout()
    //   {

    //   }
 }