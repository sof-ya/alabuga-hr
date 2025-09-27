<script setup>
import FooterComponent from '../general/FooterComponent.vue';
import LkHeaderComponent from '../general/LkHeaderComponent.vue';




</script>
<template>

    <div class=" grid grid-rows-[50px_1fr_auto] h-screen">
        <LkHeaderComponent/>
            <slot></slot>
        <FooterComponent/>
    </div>
</template>

