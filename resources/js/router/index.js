import Vue from "vue";
import VueRouter from "vue-router";
import InicioEstablecimientos from "../components/InicioEstablecimientos";
import MostrarEstablecimiento from "../components/MostrarEstablecimiento";

const routes = [
    {
        path: "/",
        component: InicioEstablecimientos,
    },
    {
        path: "/establecimiento/:id",
        name: "establecimiento",
        component: MostrarEstablecimiento,
        params: true,
    },
];

const router = new VueRouter({
    routes,
});

Vue.use(VueRouter);

export default router;