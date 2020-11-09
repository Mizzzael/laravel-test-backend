require("./bootstrap");
import Vue from "vue";
import VueRouter from "vue-router";

//Component Root
import App from "../src/App.vue";

// Rotas
import routes from "./routes";

//imports
import "../../node_modules/font-awesome/css/font-awesome.min.css";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes
});

new Vue({
    render: h => h(App),
    router
}).$mount("#app");
