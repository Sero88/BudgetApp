<section>
    <h2>Budget Categories</h2>
    <div class="budget-cat-container">
        <div>
            <label for="budget_cat_1">Category Name</label> <br />
            <input id="budget_cat_1" name="budget_cat[]" value="<?=$budgetCategory->name?>">
        </div>

        <div>
            <label for="budget_cat_quantity_1">Budget Amount</label> <br />
            <input id="budget_cat_quantity_1" name="budget_cat_amount[]" value="<?=$budgetCategory->budget()?>">
        </div>

        <div>
            <label for="budget_cat_description_1">Description</label> <br />
            <textarea id="budget_cat_description_1" name="budget_cat_description[]"><?=$budgetCategory->description?></textarea>
        </div>
    </div>

    {{--<div class="budget-cat-container">
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

    </div>--}}
</section>
