import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import('../components/Home.vue'),
        meta: {
            title: 'Главная'
        }
    },
    {
        path: '/about',
        name: 'About',
        component: () => import('../components/About.vue'),
        meta: {
            title: 'О нас'
        }
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: () => import('../components/NotFound.vue'),
        meta: {
            title: 'Страница не найдена'
        }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass: 'border-indigo-500 text-gray-900',
    linkExactActiveClass: 'border-indigo-500 text-gray-900'
});

router.beforeEach((to, from, next) => {
    if (to.meta.title) {
        document.title = `${to.meta.title} | Laravel + Vue 3`;
    }
    next();
});

export default router;