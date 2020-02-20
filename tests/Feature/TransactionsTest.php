<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionsTest extends TestCase
{
    //use RefreshDatabase;

    /** @test */
    public function user_can_make_transaction()
    {



        $this->withoutExceptionHandling();
        //$user = $this->actingAs( factory('App\User')->create());
        $user = $this->actingAs( \App\User::get()->where('id', '=', 1)->first());

        //\App\User::get()->where('id', '=', 1)->first()

        $attributes = [
            'amount' => 999.01,
            'type_id' => 1,
            'budget_cat_id' => 1,
            'owner_id' => 1,
            'description' => 'testing database transaction',
            'date_made' => '2020-02-15',
            'payment_type_id' => 1
        ];

       /* $response = $this->call('GET', '/transactions', [], ['access_key' => config('app.access_key')] );

        $response->assertStatus(200);*/

        $this->call('POST','/transactions',$attributes, ['access_key' => config('app.access_key')] );

        unset($attributes['date_made']); //because store creates its own date
        //unset($attributes['description']); //bug? not matching for some reason



        $this->assertDatabaseHas('transactions', $attributes);
    }
}
