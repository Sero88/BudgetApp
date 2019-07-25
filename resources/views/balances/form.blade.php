
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

    <section>
        <h2>Budget Categories</h2>
        <div class="budget-cat-container">
            <div>
                <label for="budget_cat_1">Category Name</label> <br />
                <input id="budget_cat_1" name="budget_cat[]" value="">
            </div>

            <div>
                <label for="budget_cat_quantity_1">Budget Amount</label> <br />
                <input id="budget_cat_quantity_1" name="budget_cat_amount[]" value="">
            </div>

            <div>
                <label for="budget_cat_description_1">Description</label> <br />
                <textarea id="budget_cat_description_1" name="budget_cat_description[]"></textarea>
            </div>
        </div>

        <div class="budget-cat-container">
            <div>
                <label for="budget_cat_2">Category Name</label> <br />
                <input id="budget_cat_2" name="budget_cat[]" value="">
            </div>

            <div>
                <label for="budget_cat_quantity_2">Budget Amount</label> <br />
                <input id="budget_cat_quantity_2" name="budget_cat_amount[]" value="">
            </div>

            <div>
                <label for="budget_cat_description_2">Description</label> <br />
                <textarea id="budget_cat_description_2" name="budget_cat_description[]"></textarea>
            </div>

        </div>
    </section>
    <?php print_r($errors->all()); ?>
    <input type="submit" value="Save">