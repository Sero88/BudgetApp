<?php

namespace App\Http\Controllers;

use App\FavoriteStock;
use Illuminate\Support\Facades\Auth;
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

        $client = new \GuzzleHttp\Client();

        $stockData = [];

        foreach($stocks as $stock){            
            $content = $client->get("https://cloud.iexapis.com/stable/stock/{$stock->symbol}/book/?token=".env('MIX_IEX_TOKEN')) ;
            $response = $content->getBody();
            $dataArray = json_decode($response);
            $stockData[] = $this->prepareStock($dataArray, $stock->id);
        }

        return $stockData;
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
        $this->authorize('update', $favoriteStock);

        $favoriteStock->delete();

        return json_encode('success');

    }

    public function getStock($symbol){

        $client = new \GuzzleHttp\Client();
        $content = $client->get("https://cloud.iexapis.com/stable/stock/$symbol/book/?token=".env('MIX_IEX_TOKEN'));
        $response = $content->getBody();
        $dataArray = json_decode($response);

        if(empty($dataArray)){
            return json_encode([ 'error' => 'Unable to find symbol!']);            
        }

        //get the stock data
        
        $symbol = $dataArray->quote->symbol;
        
        //save as a favorite
        $user_id = Auth::user()->id;        
        $newSymbol = FavoriteStock::create([
            'user_id'=>$user_id,
            'symbol'=>$symbol           
        ]);
        
        return json_encode($this->prepareStock($dataArray, $newSymbol->id));
    }

    //prepares stock date before returning
    private function prepareStock($dataArray, $id){
        return [
            'symbol'=>$dataArray->quote->symbol, 
            'price' => $dataArray->quote->latestPrice,
            'id' => $id,
            'change'=> $dataArray->quote->change
        ];
    }
}
