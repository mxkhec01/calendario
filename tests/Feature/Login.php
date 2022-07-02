<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;



class Login extends TestCase
{
   public function login_existing_user()
   {
       $user = User::Create(
           ['name' => 'Hugo Contreras',
               'email' => 'hugo@admin.com',
               'password' => bcrypt('secret')
           ]
       );

       $response = $this->post('/api/sanctum/token', [
           'email' => 'hugo@admin.com',
           'password' => 'secret',
           'device_name' => 'iphone',
       ]);

       $response->assertSuccessful();
       $this->assertNotEmpty($response->getContent());

       $this->assertDatabaseHas('personal_access_token',[
           'name' => 'iphone',
           'tokenable_type' => User::class,
           'tokenable_id' => $user->id,
       ]);
   }
}
