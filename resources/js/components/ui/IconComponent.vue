<template>
  <svg 
    :class="iconClass" 
    :width="size" 
    :height="size"
  >
    <use :xlink:href="`#icon-${name}`" />
  </svg>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  name: {
    type: String,
    required: true,
    validator: (value) => ['exp','check','close','arrow','home', 'missions', 'artifacts', 'rating', 'competencies', 'shop', 'dongle','money'].includes(value)
  },
  isActive: {
    type: Boolean,
    default: false
  },
  size: {
    type: [Number, String],
    default: 24
  }
});

const iconClass = computed(() => ({
  'icon': true,
  'icon--active': props.isActive
}));
</script>

<style scoped>
.icon {
  fill: #999999;
  transition: fill 0.3s ease;
}

.icon--active {
  @apply fill-mainColor
}
</style>