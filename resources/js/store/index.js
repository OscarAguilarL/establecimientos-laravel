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
        establecimientos: [],
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
        AGREGAR_ESTABLECIMIENTOS(state, establecimientos) {
            state.establecimientos = establecimientos;
        },
    },
    getters: {
        obtenerEstableciento: (state) => state.establecimiento,
        obtenerImagenes: (state) => state.establecimiento.imagenes,
        obtenerEstablecientos: (state) => state.establecimientos,
    },
});

export default store;
