import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';

require('./bootstrap');

window.Vue = require('vue');
window.Vue.use(VueRouter);
window.Vue.use(Vuex);


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
const store = new Vuex.Store({
    state: {
        markers: [],
        loading: true
    },
    actions: {
        loadData({commit}) {
            var app = this;
            axios.post('/api/getpoints')
                .then(function (resp) {
                    commit('updateMarkers', resp.data)
                    commit('changeLoadingState', false)
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load points");
                });
        }
    },
    mutations: {
        updateMarkers(state, markers) {
            state.markers = markers
        },
        changeLoadingState(state, loading) {
            state.loading = loading
        }
    }
});


window.onload = function () {
    const app = new Vue({
        router,
        store
    }).$mount('#app');
};