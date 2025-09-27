<template>
  <router-link
    :to="to"
    class="nav-item"
    :class="{ 'nav-item--active': isActive }"
  >
    <IconComponent 
      :name="iconName" 
      :is-active="isActive" 
      :size="24"
    />
    <span class="nav-item__label">{{ label }}</span>
  </router-link>
</template>

<script setup>
import IconComponent from './IconComponent.vue';

defineProps({
  to: {
    type: String,
    required: true
  },
  iconName: {
    type: String,
    required: true
  },
  label: {
    type: String,
    required: true
  },
  isActive: {
    type: Boolean,
    default: false
  }
});
</script>

<style scoped>
.nav-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 8px 4px;
  text-decoration: none;
  color: #999999;
  transition: all 0.3s ease;
}

.nav-item--active {
 @apply text-mainColor
}

.nav-item__label {
  margin-top: 4px;
  font-size: 12px;
  font-weight: 500;
}

.nav-item:hover {
   @apply text-mainColor
}
</style>