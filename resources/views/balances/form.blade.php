
    @csrf
    <h2>Balance Information</h2>
    <div>
        <label for="name">Name:</label> <br />
        <input id="name" type="text" name="name" value="{{$balance->name}}">
    </div>

    <div>
        <label for="description">Description:</label><br />
        <textarea id="description" name="description">{{$balance->description}}</textarea>
    </div>

    <div>
        <label for="amount">Amount: </label> <br />
        <input id="amount" type="number" name="amount" min="0.01" step="0.01" value="{{$balance->amount}}" required>
    </div>

    <?php print_r($errors->all()); ?>