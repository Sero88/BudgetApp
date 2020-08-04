@extends('layouts.app')

@section('title', 'New Transaction')

@section('content')
    @if( $errors->any())
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif
        <form method="POST" action="/transactions">
            @include('form')
            @csrf
<<<<<<< HEAD
            <button type="submit" class="button">SAVE</button>
        </form>
=======
            <button type="submit">Make Transaction</button>
        </form>


>>>>>>> master
@endsection
