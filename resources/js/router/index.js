import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import('../components/Pages/HomePage.vue'),
        meta: {
            title: 'Главная'
        }
    },
    {
        path: '/about',
        name: 'About',
        component: () => import('../components/Pages/AboutPage.vue'),
        meta: {
            title: 'О нас'
        }
    },
    {
        path: '/lk',
        name: 'userPage',
        component: () => import('../components/Pages/LkPage.vue'),
        meta: {
            title: 'userPage'
        }
    },
    {
        path: '/shop',
        name: 'shop',
        component: () => import('../components/Pages/ShopPage.vue'),
        meta: {
            title: 'shop'
        }
    },
    {
        path: '/warehouse',
        name: 'Хранилище',
        component: () => import('../components/Pages/WarehousePage.vue'),
        meta: {
            title: 'Хранилище'
        }
    },
    {
        path: '/competencies',
        name: 'Competencies',
        component: () => import('../components/Pages/CompetenciesPage.vue'),
        meta: {
            title: 'Компетенции'
        }
    },
    {
        path: '/missions',
        name: 'Missions',
        component: () => import('../components/Pages/MissionsPage.vue'),
        meta: {
            title: 'Миссии'
        }
    },
    {
        path: '/raiting',
        name: 'raiting',
        component: () => import('../components/Pages/RaitingPage.vue'),
        meta: {
            title: 'Рейтинг'
        }
    },
    {
        path: '/actionlog',
        name: 'actionlog',
        component: () => import('../components/Pages/LogPage.vue'),
        meta: {
            title: 'Журнал действия'
        }
    },
    {
        path: '/notifications',
        name: 'notifications',
        component: () => import('../components/Pages/NotificationPage.vue'),
        meta: {
            title: 'Журнал действия'
        }
    },
    {
        path: '/artifacts',
        name: 'artifacts',
        component: () => import('../components/Pages/ArtifactsPage.vue'),
        meta: {
            title: 'Журнал действия'
        }
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('../components/Pages/LoginPage.vue'),
        meta: {
            title: 'Форма входа'
        }
    },
    {
        path: '/registration',
        name: 'registration',
        component: () => import('../components/Pages/RegistrationPage.vue'),
        meta: {
            title: 'Регистрация'
        }
    },
    {
        path: '/divorce',
        name: 'divorce',
        component: () => import('../components/Pages/DevorcePage.vue'),
        meta: {
            title: 'Страница не найдена'
        }
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: () => import('../components/Pages/NotFound.vue'),
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