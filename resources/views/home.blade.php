@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Transaction</div>
                <div class="card-body">
                    @if(session('message'))
                        <div>{{session('message')}}</div>
                    @endif
                    <form method="POST" action="/transactions">

                        <div>
                            <label for="#trans-amount">Amount</label><br>
                            <input id="trans-amount" type="number" name="amount" min="0.01" step="0.01" required>
                        </div>

                        <div>
                            <label for="type_id">Type</label><br>
                            <select id="type_id" name="type_id">
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach()
                            </select>
                        </div>

                        <div>
                            <label for="budget_cat_id">Category</label><br>
                            <select id="budget_cat_id" name="budget_cat_id">
                                @foreach($cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach()
                            </select>
                        </div>

                        <?php print_r($errors->all()); ?>

                        <button type="submit">Submit</button>
                        @csrf

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
