export const elements = {
    getElements() {
        return {
            budgetCategoryField: document.getElementById('budget_cat_id'),
            categoriesContainer: document.querySelector('.categories-container'),
            mainCategoriesContainer: document.querySelector('.main-categories'),
            selectedSubCategory: document.getElementById('selected-sub-category'),
            dynamicElementNames:{
                subBudgetCategoriesContainerId: 'sub-budget-categories-container',
                loader:'loader'
            }
        }
    },
};

export const loader = {
    addLoader(parentElement, position){
        //make sure the position is valid
        const validPositions = ['beforebegin', 'afterbegin', 'beforeend', 'afterend'];
        const isValidPosition = validPositions.find( (element) => element == position);

        if(!isValidPosition){
            console.error(`"${position}" is not a valid loader position`);
            return false;
        }

        //create a loader id and loader html
        const loaderId = `loader-${Date.now()}`;
        const loader = `<div id="${loaderId}" class="loader-element"></div>`;

        //add loader to parent using position
        parentElement.insertAdjacentHTML(position, loader);

        return loaderId;
    },

    removeLoader(id){
        const loader = document.getElementById(id);

        try{
            loader.remove();
        } catch(e){
            console.error(e);
        }
    }

}






