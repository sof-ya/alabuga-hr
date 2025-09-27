<template>
    <div class="flex flex-row gap-1 ">
        header
        <router-link
        v-for="link in links"
        :to="link.route">
        {{ link.name }}
        </router-link>
    </div>
</template>

<script setup>
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
        route:'shop',
        name:'shop'
    },
    {
        route:'warehouse',
        name:'warehouse'
    },
    {
        route:'competencies',
        name:'competencies'
    },
    {
        route:'competencies',
        name:'competencies'
    },
    {
        route:'missions',
        name:'missions'
    },    
    {
        route:'raiting',
        name:'Raiting'
    },
    {
        route:'login',
        name:'loginPage'
    },    
    {
        route:'notifications',
        name:'notifications'
    },
]

</script>

<style lang="scss" scoped>


</style>