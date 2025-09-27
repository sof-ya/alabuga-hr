import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from './router';
import App from './App.vue';

// Создание приложения
const app = createApp(App);

// Плагины
const pinia = createPinia();
app.use(pinia);
app.use(router);

// Монтирование
app.mount('#app');