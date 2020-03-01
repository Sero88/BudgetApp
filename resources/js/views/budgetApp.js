export default {
    async getSubCategories(budgetCategory) {

        try{
            const result = await axios(`html/budget-categories/${budgetCategory}/sub-budget-categories`);
            return result.data;
        } catch (e){
            console.error(e);
        }
    }
}
