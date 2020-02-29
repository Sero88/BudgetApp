export default {
    async getSubCategories(budgetCategory) {

        try{
            const result = await axios(`/selector/budget-categories/${budgetCategory}/sub-budget-categories`);
            return result.data;
        } catch (e){
            console.error(e);
        }
    }
}
