<script setup lang="ts">
    import { useRoute } from 'vue-router';
import IconComponent from '../ui/IconComponent.vue';
import { computed } from 'vue';
    const route = useRoute();
    const pageTitle = computed(() => {
  const path = route.path;
  
  switch (path) {
    case '/missions':
      return 'Миссии';
    case '/competencies':
      return 'Компетенции';
    case '/shop':
      return 'Магазин';
    case '/warehouse':
      return 'Хранилище';
    case '/':
      return 'Главная';
    case '/artifacts':
      return 'Артефакты';
    case '/raiting':
      return 'Рейтинг';
    default:
      return 'Страница';
  }
});
</script>

<template>
    <div class="bg-mainColor rounded-b-xl text-white pb-3 px-4">
        <div class="flex items-center flex-row justify-between h-10">
            <h2 class=" font-bold text-2xl">{{ pageTitle }}</h2>
            <div class="flex flex-row gap-2 items-center">
                <IconComponent
                name="dongle"
                :is-active="false"
                :size='24'/>
                <router-link
                to="lk">
                <div class="bg-white rounded-full h-7 w-7"></div>
                </router-link>
                
            </div>
        </div>
    </div>
</template> 
