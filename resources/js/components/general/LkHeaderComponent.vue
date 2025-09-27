<script setup lang="ts">
    import { useRoute } from 'vue-router';
    import { computed } from 'vue';
    import IconComponent from '../ui/IconComponent.vue';
    const route = useRoute();
    const pageTitle = computed(() => {
    const path = route.path;
  
    switch (path) {
        case '/':
            return '';
        case '/notifications':
            return 'Уведомления';
        case '/log':
            return 'Журнал действий';
        case '/shop':
            return 'профиль';
        case '/lk':
            return 'Профиль';
        case '/actionlog':
            return 'Журнал действий';
        case '/raiting':
            return 'Рейтинг';
        default:
            return 'Страница';
        }
    });
    const showBackArrow = computed(() => {
        return pageTitle.value !== '' && route.path !== '/lk';
    });
</script>

<template>
    <div class="bg-mainColor rounded-b-xl text-white pb-3 px-4">
        <div class="flex items-center flex-row justify-between h-10">

            <router-link v-if="showBackArrow"
            to="lk">
                <IconComponent
                name="arrow"
                :size="15"/>
            </router-link>
            <div v-else class="w-4"></div>
            <h2 class=" font-bold text-2xl">{{ pageTitle }}</h2>
            
            

        </div>
    </div>
</template> 
