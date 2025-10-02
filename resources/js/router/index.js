import { createRouter, createWebHistory } from 'vue-router';
import { useUserStore } from '../store/UserStore';


const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import('../Pages/HomePage.vue'),
        meta: {
            title: 'Главная',
            requiresAuth: true
        }
    },
    {
        path: '/about',
        name: 'About',
        component: () => import('../Pages/AboutPage.vue'),
        meta: {
            title: 'О нас',
            requiresAuth: true
        }
    },
    {
        path: '/lk',
        name: 'userPage',
        component: () => import('../Pages/LkPage.vue'),
        meta: {
            title: 'Личный кабинет',
            requiresAuth: true
        }
    },
    {
        path: '/shop',
        name: 'shop',
        component: () => import('../Pages/ShopPage.vue'),
        meta: {
            title: 'Магазин',
            requiresAuth: true
        }
    },
    {
        path: '/warehouse',
        name: 'warehouse',
        component: () => import('../Pages/WarehousePage.vue'),
        meta: {
            title: 'Хранилище',
            requiresAuth: true
        }
    },
    {
        path: '/competencies',
        name: 'Competencies',
        component: () => import('../Pages/CompetenciesPage.vue'),
        meta: {
            title: 'Компетенции',
            requiresAuth: true
        }
    },
    {
        path: '/missions',
        name: 'Missions',
        component: () => import('../Pages/MissionsPage.vue'),
        meta: {
            title: 'Миссии',
            requiresAuth: true
        }
    },
    {
        path: '/raiting',
        name: 'raiting',
        component: () => import('../Pages/RaitingPage.vue'),
        meta: {
            title: 'Рейтинг',
            requiresAuth: true
        }
    },
    {
        path: '/actionlog',
        name: 'actionlog',
        component: () => import('../Pages/LogPage.vue'),
        meta: {
            title: 'Журнал действий',
            requiresAuth: true
        }
    },
    {
        path: '/notifications',
        name: 'notifications',
        component: () => import('../Pages/NotificationPage.vue'),
        meta: {
            title: 'Уведомления',
            requiresAuth: true
        }
    },
    {
        path: '/artifacts',
        name: 'artifacts',
        component: () => import('../Pages/ArtifactsPage.vue'),
        meta: {
            title: 'Артефакты',
            requiresAuth: true
        }
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('../Pages/LoginPage.vue'),
        meta: {
            title: 'Форма входа',
            requiresGuest: true 
        }
    },
    {
        path: '/registration',
        name: 'registration',
        component: () => import('../Pages/RegistrationPage.vue'),
        meta: {
            title: 'Регистрация',
            requiresGuest: true
        }
    },
    {
        path: '/divorce',
        name: 'divorce',
        component: () => import('../Pages/DevorcePage.vue'),
        meta: {
            title: 'Разводная страница'
        }
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: () => import('../Pages/NotFound.vue'),
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
    const userStore = useUserStore()
    const isAuthenticated = userStore.isAuthenticated
    if (to.meta.title) {
        document.title = `${to.meta.title} | Laravel + Vue 3`
    }

    if (to.meta.requiresAuth && !isAuthenticated) {
        next('/login')
        return
    }

    if (to.meta.requiresGuest && isAuthenticated) {
        next('/')
        return
    }

    next()
})

export default router