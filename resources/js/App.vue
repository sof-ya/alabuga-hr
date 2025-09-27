<template>
    <div id="app" class="min-h-screen bg-gray-50 max-w-[640px] overflow-hidden mx-auto">
        
        <main class="container mx-auto ">
            <RouterView />
        </main>
        
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { RouterView } from 'vue-router';

onMounted(() => {
    console.log('Vue 3 App mounted with Composition API');
});
</script>