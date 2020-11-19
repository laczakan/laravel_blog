<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $view = $this->view('home.index');

        $view->assertSee('Andrzej Laczak');
    }

    public function testGetArticleCreateAsGuest()
    {
        $this->assertGuest();
        $response = $this->get('/articles/create');
        $response->assertStatus(302);
    }

    public function testGetArticleCreateAsUser()
    {
        $user = User::where('email', 'mariusz@laczak.com')->first();

        // login the user
        $this->actingAs($user);

        //check if user is logged in
        $this->assertAuthenticatedAs($user);


        $response = $this->get('/articles/create');
        $response->assertStatus(200);
    }

    public function testPostArticleCreateAsUser()
    {
        $user = User::where('email', 'mariusz@laczak.com')->first();

        // login the user
        $this->actingAs($user);

        //check if user is logged in
        $this->assertAuthenticatedAs($user);

        $response = $this->post('/articles', []);
//        $response->assertStatus(302);

//        $view = $this->view('articles.create');
        $response->assertRedirect("/articles");
        $response->assertSeeText('The title field is required.');
    }
}
