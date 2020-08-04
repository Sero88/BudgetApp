

<div id="sub-budget-categories-container">
    <label for="sub-budget-category-selector">Sub Category</label> <br />
    <select id="sub-budget-category-selector" name="sub_budget_category_id">
        <option value="">None</option>
        @foreach($budgetCategory->subBudgetCategories as $subBudgetCategoryObject)
            @php
                $selected = $subBudgetCategoryObject->id == $subBudgetCategory->id ? ' selected' : '';
            @endphp
            <option value="{{$subBudgetCategoryObject->id}}"{{$selected}}>{{$subBudgetCategoryObject->name}}</option>
        @endforeach

    </select>
</div>

