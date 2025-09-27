<template>
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Лого -->
                <div class="flex-shrink-0">
                    <router-link to="/" class="text-xl font-bold text-indigo-600">
                        Laravel + Vue 3
                    </router-link>
                </div>
                
                <!-- Навигация -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <router-link 
                            v-for="item in navigation"
                            :key="item.name"
                            :to="item.path"
                            class="px-3 py-2 rounded-md text-sm font-medium transition-colors"
                            :class="[
                                $route.name === item.name 
                                    ? 'bg-indigo-100 text-indigo-700' 
                                    : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                            ]"
                        >
                            {{ item.name }}
                        </router-link>
                    </div>
                </div>
                
                <!-- Мобильное меню -->
                <div class="md:hidden">
                    <button 
                        @click="isMobileMenuOpen = !isMobileMenuOpen"
                        class="p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100"
                    >
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  :d="isMobileMenuOpen ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Мобильное меню (раскрывающееся) -->
            <div v-if="isMobileMenuOpen" class="md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <router-link 
                        v-for="item in navigation"
                        :key="item.name"
                        :to="item.path"
                        class="block px-3 py-2 rounded-md text-base font-medium transition-colors"
                        :class="[
                            $route.name === item.name 
                                ? 'bg-indigo-100 text-indigo-700' 
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                        ]"
                        @click="isMobileMenuOpen = false"
                    >
                        {{ item.name }}
                    </router-link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const isMobileMenuOpen = ref(false);

const navigation = [
    { name: 'Главная', path: '/', routeName: 'Home' },
    { name: 'О нас', path: '/about', routeName: 'About' }
];
</script>