@extends('layouts.app')
<div>
    @section('title', 'Annual Report')
</div>


@section('content')
@if($availableYears->isNotEmpty())
    <label for="report-year-selector">Select a year</label>
    <select id="report-year-selector" name="report-year">
        <option selected disabled></option>
        @foreach($availableYears as $object)
           <option value="{{$object->year}}">{{$object->year}}</option>
        @endforeach
    </select>
@else
    <p>No budget history data has been produced, yet. Check again next month.</p>
@endif
<div id="annual-report-container"></div>
@endsection
