import { createRouter, createWebHistory } from 'vue-router';

import NotFound from '@/views/NotFound.vue';
import Home from '@/components/Notes/Home.vue';

const routes=[
    {
        path: '/',
        name: 'note.index',
        component: () => import("../components/Notes/Home.vue")
    },
    {
        path: "/:catchAll(.*)",
        component: () => import("../views/NotFound.vue")
    },
];


const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

export default router;
