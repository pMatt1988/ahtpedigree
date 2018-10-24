<?php

namespace Tests\Feature;

use App\Dog;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class DogTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/')->assertSee('This is a test');
    }
//
//    public function testLoggedInUserShouldBeAbleToCreateDogEntry(){
//
//    }

//TODO: This isn't working
    /**
     * Test whether or not a guest can create a dog entry.
     */
    public function testGuestShouldNotBeAbleToCreateDogEntry()
    {
        $this->withoutExceptionHandling();
        $this->post('/store', [
            'regname' => 'A Test Regname',
            'sire' => 'Papa',
            'dam' => 'Mama'
        ])->assertRedirect('/login');

        $this->assertDatabaseMissing('dogs', [
            'sire' => 'Papa'
        ]);
    }

    public function testAuthenticatedUserShouldBeAbleToCreateDogEntry()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->post('/store', [
            'regname' => 'A Test Regname',
            'sire' => 'Papa',
            'dam' => 'Mama'
        ])->assertRedirect('/');

        $this->assertDatabaseHas('dogs', [
            'sire' => 'Papa'
        ]);
    }

    public function testAuthenticatedUserShouldBeAbleToDeleteDogEntry()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $dog = factory(Dog::class)->create();

        $this->delete('/dog/' . $dog->id)->assertRedirect('/dog');
        $this->assertDatabaseMissing('dogs', [
            'id' => $dog->id
        ]);
    }

    public function testGuestShouldNotBeAbleToDeleteDogEntry()
    {
        $dog = factory(Dog::class)->create();

        $this->delete('/dog/' . $dog->id)
            ->assertRedirect('/login');
        $this->assertDatabaseHas('dogs', [
            'id' => $dog->id
        ]);
    }

    public function testGuestShouldBeAbleToViewDogEntryById()
    {
        $dog = factory(Dog::class)->create();
        $this->get('/dog/' . $dog->id)
            ->assertStatus(200)
            ->assertSee($dog->regname);
    }

    public function testAuthenticatedUserShouldBeAbleToEditDogEntry()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);


        $dog = factory(Dog::class)->create();
        $this->patch('/dog/' . $dog->id, [
            'regname' => 'TestDog'
        ])->assertRedirect("/dog/{$dog->id}");
        $this->assertDatabaseHas('dogs', ['regname' => 'TestDog']);
    }
}
