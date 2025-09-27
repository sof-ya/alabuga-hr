<template>
    <div class=" grid grid-cols-6 footer">
        <NavigationItem
        v-for="item in navigationItems"
        :key="item.name"
        :to="item.to"
        :icon-name="item.iconName"
        :label="item.label"
        :is-active="isActive(item.to)"
        />
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import NavigationItem from '../ui/NavigationItem.vue';


const route = useRoute();

const navigationItems = computed(() => [
  { to: '/', iconName: 'home', label: 'Домой' },
  { to: '/missions', iconName: 'missions', label: 'Миссии' },
  { to: '/artifacts', iconName: 'artifacts', label: 'Артефакты' },
  { to: '/raiting', iconName: 'rating', label: 'Рейтинг' },
  { to: '/competencies', iconName: 'competencies', label: 'Компетенции' },
  { to: '/shop', iconName: 'shop', label: 'Магазин' }
]);

const isActive = (path) => {
  return route.path === path || route.path.startsWith(path + '/');
};
</script>

<style scoped>
.footer{
    box-shadow: 0 0 12px 0 rgba(0, 0, 0, 0.16);
    background: var(--white-500);
}

</style>