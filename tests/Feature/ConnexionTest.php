<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConnexionTest extends TestCase
{
    /**
     * @description test if the site crash when right connexion credentials are sent
     *
     * @return void
     */
    public function test_right_login()
    {
        $response = $this->post('/login',['mail'=>'john.doe@gmail.com','password'=>'securepassword']);

        $response->assertStatus(200);
    }
    /**
     * @description test if the site crash when wrong connexion credentials are sent
     *
     * @return void
     */
    public function test_wrong_login()
    {
        $response = $this->post('/login',['mail'=>'wrong@email.com','password'=>'wrongpassword']);

        $response->assertStatus(200);
    }
    /**
     * @description test if the connexion works when the right credentials are sent
     *
     * @return void
     */
    public function test_right_login_view()
    {
        $response = $this->post('/login',['mail'=>'john.doe@gmail.com','password'=>'securepassword']);

        $response->assertSee('<span class="block text-sm text-white">John Doe</span>');
    }
    /**
     * @description test if the connexion show the right thing when the wrong credentials are sent
     *
     * @return void
     */
    public function test_wrong_login_view()
    {
        $response = $this->post('/login',['mail'=>'wrong@email.com','password'=>'wrongpassword']);

        $response->assertSee('<h1 class="font-bold text-3xl text-white-900">Wrong password !</h1>');
    }
}
