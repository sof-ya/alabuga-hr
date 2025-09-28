<template>

        <LkLayout>
        homePage
        <button
        @click="callToast">CallToast</button>
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

import { useSiteState } from '../../store/SiteState';
import LkLayout from '../Layout/LkLayout.vue';
const siteState = useSiteState()
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
    {
        route:'registration',
        name:'регистрация'
    },
        {
        route:'divorce',
        name:'Разводная страница'
    },
]
const callToast =()=>{
    siteState.sucsesMessage='Изменения профиля успешно сохранены'
}
</script>