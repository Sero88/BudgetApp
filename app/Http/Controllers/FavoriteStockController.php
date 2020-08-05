<?php

namespace App\Http\Controllers;

use App\FavoriteStock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class FavoriteStockController extends Controller
{

    public function webIndex(){
        return view( 'favorite-stocks.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $stocks = FavoriteStock::where('user_id', $user_id)->get();

        return json_encode($stocks);                
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FavoriteStock  $favoriteStock
     * @return \Illuminate\Http\Response
     */
    public function show(FavoriteStock $favoriteStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FavoriteStock  $favoriteStock
     * @return \Illuminate\Http\Response
     */
    public function edit(FavoriteStock $favoriteStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FavoriteStock  $favoriteStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FavoriteStock $favoriteStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FavoriteStock  $favoriteStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(FavoriteStock $favoriteStock)
    {
        //
    }

    public function getStock(){
        $content = Http::GET("https://cloud.iexapis.com/stable/tops?token=pk_e07e24a396204a49a73ee863c7c60e61&symbols=vti") ;
        return $content;
    }
}
