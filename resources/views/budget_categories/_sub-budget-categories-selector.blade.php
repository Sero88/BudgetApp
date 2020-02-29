<select name="subBudgetCategoryID">
    @foreach($budgetCategory->subBudgetCategories as $subBudgetCategory)
        <option value="{{$subBudgetCategory->id}}">{{$subBudgetCategory->name}}</option>
    @endforeach
</select>
