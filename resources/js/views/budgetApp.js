export default {
    async getSubCategories(budgetCategory, subBudgetCategory) {
        subBudgetCategory = subBudgetCategory ? subBudgetCategory : '';
        try{
            const result = await axios(`/html/budget-categories/${budgetCategory}/sub-budget-categories/${subBudgetCategory}`);
            return result.data;
        } catch (e){
            console.error('axios', e);
        }
    }
}
