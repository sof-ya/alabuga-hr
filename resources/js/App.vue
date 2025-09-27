<template>
    <div id="app" class="min-h-screen bg-gray-50">
        <NavBar />
        
        <main class="container mx-auto px-4 py-8">
            <RouterView />
        </main>
        
        <Footer />
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { RouterView } from 'vue-router';
import NavBar from './components/Layout/NavBar.vue';
import Footer from './components/Layout/Footer.vue';

onMounted(() => {
    console.log('Vue 3 App mounted with Composition API');
});
</script>