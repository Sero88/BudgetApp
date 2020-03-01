<div id="sub-budget-categories-container">
    <label for="sub-budget-category-selector">Sub Category</label> <br />
    <select id="sub-budget-category-selector" name="subBudgetCategoryId">
        @foreach($budgetCategory->subBudgetCategories as $subBudgetCategory)
            <option value="{{$subBudgetCategory->id}}">{{$subBudgetCategory->name}}</option>
        @endforeach
    </select>
</div>

