<template>
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">
                Добро пожаловать!
            </h1>
            
            <!-- Счетчик -->
            <div class="mb-8 p-6 bg-gray-50 rounded-lg">
                <div class="text-center mb-4">
                    <p class="text-6xl font-bold text-indigo-600">{{ count }}</p>
                    <p class="text-sm text-gray-600 mt-2">Текущее значение</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="text-center p-3 bg-blue-50 rounded">
                        <p class="text-2xl font-semibold text-blue-600">{{ doubleCount }}</p>
                        <p class="text-xs text-blue-500">Удвоенное</p>
                    </div>
                    <div class="text-center p-3 bg-green-50 rounded">
                        <p class="text-lg font-semibold text-green-600">
                            {{ isEven ? 'Чётное' : 'Нечётное' }}
                        </p>
                        <p class="text-xs text-green-500">Чётность</p>
                    </div>
                </div>
                
                <!-- Кнопки управления -->
                <div class="flex flex-wrap gap-2 justify-center">
                    <button 
                        @click="decrement"
                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors"
                    >
                        -1
                    </button>
                    
                    <button 
                        @click="increment"
                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors"
                    >
                        +1
                    </button>
                    
                    <button 
                        @click="reset"
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition-colors"
                    >
                        Сбросить
                    </button>
                    
                    <button 
                        @click="setRandom"
                        class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 transition-colors"
                    >
                        Случайное
                    </button>
                </div>
            </div>
            
            <!-- Навигация -->
            <div class="text-center">
                <RouterLink 
                    to="/about"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors"
                >
                    Узнать больше о проекте
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </RouterLink>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { RouterLink } from 'vue-router';
import { useCounterStore } from '../store/counter';


const counterStore =useCounterStore();

// Используем хранилище
const { count, doubleCount, isEven } = storeToRefs(counterStore);
const { increment, decrement, reset, setValue } = counterStore;

// Дополнительные функции
const setRandom = () => {
    setValue(Math.floor(Math.random() * 100));
};
</script>