@extends('layouts.app')

@section('title', 'Balances')

@section('content')
	@if(session('message'))
		<div>
			{{session('message')}}
			<hr>
		</div>
	@endif
    <?php
		//get first and last day of current month
		$first_day = date('Y-m-d H:i:s', strtotime('first day of '. date('F Y')));
		$last_day = date('Y-m-d H:i:s', strtotime( 'last day of' . date('F Y') . '23:59:59'));
    ?>
	@foreach($balances as $balance)
        <?php
        $month_total = $balance->transactions()->where([
            ['date_made', '>=', $first_day],
            ['date_made', '<=', $last_day]
        ])->sum('amount');

        $budget_total = $balance->budget_categories()->sum('budget');

        ?>
		<div class="transaction-block">
			<p><a href="/balances/{{$balance->id}}">{{$balance->name}}: ${{number_format($balance->amount, 2)}}</a></p>
			<div>
				<span class="<?= $month_total > $budget_total ? 'amount-over' : 'amount-under'?>">{{$month_total}}<span> / {{$budget_total}}
			</div>

			<div>
				<p><a href="/balances/{{$balance->id}}/edit">Edit</a></p>
				<div>
					<form method="post" action="/balances/{{$balance->id}}">
						@csrf
						@method('DELETE')
						<button type="submit">Delete</button>
					</form>
				</div>
			</div>

		</div>
		<hr>
	@endforeach
@endsection