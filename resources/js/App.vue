<template>
    <div id="app" class="min-h-screen bg-gray-50">
        <HeaderComponent/>
        
        <main class="container mx-auto px-4 py-8">
            <RouterView />
        </main>
        
        <FooterComponent/>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { RouterView } from 'vue-router';
import HeaderComponent from './components/general/HeaderComponent.vue';
import FooterComponent from './components/general/FooterComponent.vue';

onMounted(() => {
    console.log('Vue 3 App mounted with Composition API');
});
</script>