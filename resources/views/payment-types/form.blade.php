@if(session('message'))
    <div>{{session('message')}}</div>
@endif


<div>
    <label for="name">Name</label><br>
    <input id="name" type="text" name="name" value="{{ $paymentType->name }}" required>
</div>

<div>
    <label for="description">Description</label><br>
    <textarea name="description">{{$paymentType->description}}</textarea>
</div>
