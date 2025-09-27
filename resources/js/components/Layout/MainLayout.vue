<script setup>
import FooterComponent from '../general/FooterComponent.vue';
import HeaderComponent from '../general/HeaderComponent.vue';




</script>
<template>

    <div class=" grid grid-rows-[50px_1fr_auto] h-screen">
        <HeaderComponent/>
            <slot></slot>
        <FooterComponent/>
    </div>
</template>

