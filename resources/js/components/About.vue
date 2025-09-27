<template>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">О проекте</h1>
            
            <div class="prose prose-indigo max-w-none">
                <p class="text-lg text-gray-600 mb-6">
                    Это демонстрационное приложение, построенное на современном стеке технологий.
                </p>
                
                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <div v-for="(tech, index) in technologies" :key="index"
                         class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                        <h3 class="font-semibold text-lg mb-2">{{ tech.name }}</h3>
                        <p class="text-gray-600 text-sm">{{ tech.description }}</p>
                    </div>
                </div>
                
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <p class="text-yellow-700">
                        <strong>Composition API:</strong> Все компоненты используют современный подход Vue 3 Composition API.
                    </p>
                </div>
            </div>
            
            <div class="text-center mt-8">
                <RouterLink 
                    to="/"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    На главную
                </RouterLink>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { RouterLink } from 'vue-router';

const technologies = ref([
    {
        name: 'Vue 3',
        description: 'Composition API, Reactivity System'
    },
    {
        name: 'Pinia',
        description: 'State management для Vue'
    },
    {
        name: 'Vue Router',
        description: 'Маршрутизация для одностраничных приложений'
    },
    {
        name: 'Tailwind CSS',
        description: 'Utility-first CSS фреймворк'
    },
    {
        name: 'Laravel 12',
        description: 'PHP фреймворк для бэкенда'
    },
    {
        name: 'Vite',
        description: 'Сборщик для фронтенда'
    }
]);
</script>