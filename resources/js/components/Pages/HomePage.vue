<template>

        <LkLayout>
        homePage
        <div class="flex flex-col gap-2">
        <router-link
        v-for="link in links"
        :to="link.route">
        {{ link.name }}
        </router-link>
        </div>
    </LkLayout>
</template>

<script setup>

import LkLayout from '../Layout/LkLayout.vue';
const links =[
    {
        route:'/',
        name:'Home'
    },
    {
        route:'about',
        name:'about'
    },
    {
        route:'lk',
        name:'userPage'
    },
    {
        route:'warehouse',
        name:'warehouse'
    },
    {
        route:'login',
        name:'loginPage'
    },    
    {
        route:'notifications',
        name:'notifications'
    },    
    {
        route:'actionlog',
        name:'логи'
    },
]
</script>