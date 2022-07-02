<?php

namespace Tests\Unit;

use App\Models\User;
//use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;


class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function login_existing_user()
    {




            $user = User::create(
                ['name' => 'Hugo Contreras',
                    'email' => 'hugo@admin.com',
                    'password' => Hash::make('secret')
                ]
            );


        $response = $this->post('/api/login', [
            'email' => 'hugo@admin.com',
            'password' => 'secret',
            'device_name' => 'iphone',
        ]);

        $response->assertSuccessful();
        $this->assertNotEmpty($response->getContent());

        $this->assertDatabaseHas('personal_access_tokens',[
            'name' => 'iphone',
            'tokenable_type' => User::class,
            'tokenable_id' => $user->id,
        ]);


    }
}
