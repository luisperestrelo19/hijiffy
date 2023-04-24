import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            component: () => import("./pages/Login.vue"),
        },
        {
            path: "/question",
            component: () => import("./pages/Question.vue"),
        },
        {
            path: "/logout",
        },
    ],
});
router.beforeEach((to, from, next) => {
    if (to.path !== "/" && !isAuthenticated()) {
        return next({ path: "/" });
    }
    return next();
});

function isAuthenticated() {
    return Boolean(localStorage.getItem("APP_SESSION_TOKEN"));
}

export default router;
