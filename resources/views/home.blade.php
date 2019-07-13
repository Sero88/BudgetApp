@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Transaction</div>
                <div class="card-body">
                    <form method="POST" action="/transactions">

                        <input type="number" name="amount">

                        <button type="submit">Submit</button>
                        @csrf

                    </form>

                    @foreach($cats as $cat)
                        {{ $cat['name'] }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
