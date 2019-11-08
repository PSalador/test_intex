import Vue from 'vue';
import VueRouter from 'vue-router';

require('./bootstrap');

window.Vue = require('vue');
window.Vue.use(VueRouter);

require('./plugins/uikit');
require('./plugins/leaflet');


import MapComponent from './components/MapComponent.vue';
import AddMarkerComponent from './components/AddMarkerComponent.vue';


const routes = [
    {
        path: '/',
        components: {
            mapComponent: MapComponent
        },
        name: 'map'
    },
    {path: '/marker/add', component: AddMarkerComponent, name: 'addMarker'},
];

const router = new VueRouter({ routes });

window.onload = function () {
    const app = new Vue({
        router
    }).$mount('#app');
};