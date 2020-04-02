/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



require('./bootstrap');

//window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
/*
const app = new Vue({
    el: '#app',
});
*/

import $ from 'jquery';
window.$ = window.jQuery = $;
import 'jquery-ui/ui/widgets/datepicker.js';
import {elements, loader} from "./modules/base";
import budgetApp from "./modules/budgetApp";
import report from "./modules/reports";


var app = {};
$(document).ready(function(){
    const dateFormat = 'yy-mm-dd';

    //datepicker fields
    $('.datepicker-after-today').datepicker({
        minDate:'+1D',
        dateFormat: dateFormat
    });

    $('.datepicker').datepicker({dateFormat: dateFormat});

    //delete buttons confirmation
    $('.delete-button').click(function(e){
        if( !confirm('Are you sure you want to delete?') ){
            e.preventDefault();
            return;
        }
    });

    $('.delete-button-cat').click(function(e){
        if( !confirm('Deleting Budget Category will remove associated recurring and regular transactions. Proceed?') ){
            e.preventDefault();
            return;
        }
    });

});

window.addEventListener('load', () => {
    //get elements
    app.elements = elements.getElements();

    //add listener to budget categories select
    if(app.elements.budgetCategoryField){
        //get the subcategories for the current selected category
        //getSubCategories();
        //app.elements.budgetCategoryField.addEventListener('change', getSubCategories);

        displayFetchedData(
            app.elements.mainCategoriesContainer,
            app.elements.dynamicElementNames.subBudgetCategoriesContainerId,
            async () =>{
                const data = await budgetApp.getSubCategories(app.elements.budgetCategoryField.value, app.elements.selectedSubCategory.value);
                return data;
            }
        );

        app.elements.budgetCategoryField.addEventListener('change', () => {
            displayFetchedData(
                app.elements.mainCategoriesContainer,
                app.elements.dynamicElementNames.subBudgetCategoriesContainerId,
                async () =>{
                    const data = await budgetApp.getSubCategories(app.elements.budgetCategoryField.value, app.elements.selectedSubCategory.value);
                    return data;
                }
            );
        });
    }



    //add listener to year selector
    if(app.elements.reportYearSelector){
        app.elements.reportYearSelector.addEventListener('change', () => {
            displayFetchedData(
                app.elements.reportAnnualContainerId,
                app.elements.dynamicElementNames.annualWrapperId,
                async () => {
                    const data = await report.getAnnualReport(app.elements.reportYearSelector.value);
                    return data;
                }
            );
        });

        if(app.elements.reportYearSelector.value){
            displayFetchedData(
                app.elements.reportAnnualContainerId,
                app.elements.dynamicElementNames.annualWrapperId,
                async () => {
                    const data = await report.getAnnualReport(app.elements.reportYearSelector.value);
                    return data;
                }
            );
        }
    }


    //add listener to month clicked
    if(app.elements.reportAnnualContainerId){
        app.elements.reportAnnualContainerId.addEventListener('click', (e) => {
            const clickedMonth = e.target.closest('.month-link');
            const month = clickedMonth.dataset.month;
            const year = clickedMonth.dataset.year;


            console.log(clickedMonth.parentNode);

            displayFetchedData(
                clickedMonth.parentNode,
                report.getMonthlyID(year, month),
                async () => {
                    const data = await report.getMonthlyReport(year, month);
                    return data;
                }
            );
        });

       /* if(app.elements.reportYearSelector.value){
            displayFetchedData(
                app.elements.reportAnnualContainerId,
                app.elements.dynamicElementNames.annualWrapperId,
                async () => {
                    const data = await report.getAnnualReport(app.elements.reportYearSelector.value);
                    return data;
                }
            );
        }*/
    }


});

async function displayFetchedData(parentContainer, containerId, dataFetch ){
    //remove any subcategories that currently exist
    const displayContainerElement = document.getElementById(containerId);
    if(displayContainerElement){
        displayContainerElement.remove();
    }

    //show the loader
    const loaderId = loader.addLoader(parentContainer, 'beforeend');

    //get the new category
    const dataContainer = await dataFetch();

    console.log(dataContainer);
    parentContainer.insertAdjacentHTML('beforeend', dataContainer);

    //remove the loader if it exists
    if(loaderId){
        loader.removeLoader(loaderId);
    }

}
