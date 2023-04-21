/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import 'flowbite';
import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import {getElement} from "bootstrap/js/src/util";
app.component('example-component', ExampleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');

$( function() {

    $('.block').draggable({revert: true,zIndex: 100,revertDuration: 0,helper: "clone"});

    $( ".sortable" ).droppable({
        accept: ".block",
        over: function( event, ui )
        {
            $(this).addClass('hover');
        },
        out: function( event, ui )
        {
            $(this).removeClass('hover');
        },
        drop:function( event, ui)
        {
            let colom = $(this).data('block');
            if((colom!=2) && (colom!=3) && (colom!=4)) {
                $(this).prepend(ui.draggable);
                let id = $(this).children().attr('id');
                let colom_id = $(this).data('block');
                let id_vac = $(this).attr('id');
                url = url.replace(':id', id);
                url = url.replace(':colom_id', colom_id);
                url = url.replace(':id_vac', id_vac);
                window.location.href = url;
            } else {
                alert('Блок нельзя переместить в эту колонку');
            }
            $(this).removeClass('hover');
        }
    });
});
