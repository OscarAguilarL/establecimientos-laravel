import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);
Vue.config.devtools = true;

const store = new Vuex.Store({
    state: {
        cafes: [],
        restaurantes: [],
        hoteles: [],
        establecimiento: {},
    },
    mutations: {
        AGREGAR_CAFES(state, cafes) {
            state.cafes = cafes;
        },
        AGREGAR_RESTAURANTES(state, restaurante) {
            state.restaurantes = restaurante;
        },
        AGREGAR_HOTELES(state, hotel) {
            state.hoteles = hotel;
        },
        AGREGAR_ESTABLECIMIENTO(state, establecimiento) {
            state.establecimiento = establecimiento;
        },
    },
    getters: {
        obtenerEstableciento: (state) => state.establecimiento,
    },
});

export default store;
