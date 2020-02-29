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
import {elements} from './views/base';
import budgetApp from './views/budgetApp';


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

    //get the subcategories for the current selected category
    getSubCategories();

    //add listener to budget categories select
    app.elements.budgetCategoryField.addEventListener('change', getSubCategories);
});


async function getSubCategories(){
    const subBudgetCategoriesSelector = await budgetApp.getSubCategories(app.elements.budgetCategoryField.value);
    console.dir(subBudgetCategoriesSelector);
    app.elements.categoriesContainer.insertAdjacentHTML('beforeend', subBudgetCategoriesSelector);
}


