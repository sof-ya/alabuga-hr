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
]

</script>

<style lang="scss" scoped>


</style>