import "./bootstrap";

import { createApp } from "vue";
import App from "./App.vue";
import router from "./route";
import VueSession from "vue-session";
import { createStore } from "vuex";


const app = createApp(App);
app.use(router);
app.mount("#app");
