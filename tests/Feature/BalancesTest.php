<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BalancesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testExample()
    {

        $this->withoutExceptionHandling();

        //given a user is logged in
        $this->actingAs(factory('App\User')->create());

        //when user creates a new balance using /balances/create
        $this->post('/balances/', [
            'name' => 'test',
            'description' => 'test description',
            'amount' => 100,
            'budget_cat' => ['test'],
            'budget_cat_quantity' => [100,123],
            'budget_cat_description.*' => ['description'],
        ]);

        //there should be a new balance
        $this->assertDatabaseHas('balances', ['name'=>'test']);
    }
}
