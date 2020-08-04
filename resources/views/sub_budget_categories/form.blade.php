<section>
    <h2>Budget Subcategories</h2>
    <div class="budget-cat-container">
        <div>
            <label for="name">Category Name</label> <br />
            <input id="name" name="name" value="<?=$subBudgetCategory->name?>">
        </div>

        <div>
            <label for="budget">Budget Amount</label> <br />
            <input id="budget" name="budget" value="<?=$subBudgetCategory->budget?>">
        </div>

        <div>
            <label for="description">Description</label> <br />
            <textarea id="description" name="description"><?=$subBudgetCategory->description?></textarea>
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
