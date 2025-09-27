<template>
    <div id="app" class="min-h-screen bg-gray-50 max-w-[640px] overflow-hidden mx-auto relative">
        
        <main class="container mx-auto ">
            <RouterView />
        </main>
            <ToastComponent/>
    </div>

</template>

<script setup>
import { onMounted } from 'vue';
import { RouterView } from 'vue-router';
import ToastComponent from './components/general/ToastComponent.vue';

onMounted(() => {
    console.log('Vue 3 App mounted with Composition API');
});
</script>