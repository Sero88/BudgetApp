
@extends('layouts.home')
@section('title', 'New Transaction')

@section('content')
    
    <div class="card">
        <div class="card-header"><h2>Favorite Stocks</h2></div>
        
        <div id="favorite-stocks-container" class="card-body" data-homeStocks="true"></div>
    </div>
  
    @if( $errors->any())
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif

    <div id="new-transaction" class="card">
        <div class="card-header"><h2>New Transaction</h2></div>
        <div class="card-body">
        <form class="form-budget" method="POST" action="/transactions">
            @include('form')
            @csrf
            <button class="btn" type="submit">Make Transaction</button>
        </form>
        </div>
    </div>
        
@endsection
