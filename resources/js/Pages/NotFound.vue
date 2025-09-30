<template>
    <div class="max-w-md mx-auto text-center">
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="text-6xl mb-4">😕</div>
            <h1 class="text-2xl font-bold text-gray-900 mb-4">Страница не найдена</h1>
            <p class="text-gray-600 mb-6">
                Запрашиваемая страница не существует.
            </p>
            <RouterLink 
                to="/"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors"
            >
                Вернуться на главную
            </RouterLink>
        </div>
    </div>
</template>

<script setup>
import { RouterLink } from 'vue-router';
</script>