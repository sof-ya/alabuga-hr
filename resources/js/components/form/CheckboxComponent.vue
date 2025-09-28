<template>
    <label class="cursor-pointer flex items-start gap-2">
        <input 
            type="checkbox" 
            :name="props.name" 
            v-model="isChecked"
            class="hidden"
            @change="$emit('update:modelValue', isChecked)"
        >
        <span 
            class="fake-checkbox"
            :class="{ 'fake-checkbox--checked': isChecked }"
        >
            <svg 
                v-if="isChecked" 
                width="10" 
                height="8" 
                viewBox="0 0 10 8" 
                fill="none"
                class="checkmark"
            >
                <path 
                    d="M1 4L3.5 6.5L9 1" 
                    stroke="white" 
                    stroke-width="2" 
                    stroke-linecap="round" 
                    stroke-linejoin="round"
                />
            </svg>
        </span>
        <span v-if="$slots.default" class="checkbox-label">
            <slot></slot>
        </span>
    </label>
</template>

<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
    name: {
        type: String,
        default: ''
    },
    modelValue: {
        type: Boolean,
        default: false
    }
})

const emit = defineEmits(['update:modelValue', 'change'])

const isChecked = ref(props.modelValue)

watch(() => props.modelValue, (newValue) => {
    isChecked.value = newValue
})

watch(isChecked, (newValue) => {
    emit('change', newValue)
})
</script>

<style scoped>
.fake-checkbox {
    border: 1px solid var(--blue-500);
    border-radius: 2px;
    width: 16px;
    height: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    background: white;
    flex-shrink: 0;
    margin-top: 6px;
}

.fake-checkbox--checked {
    background: var(--blue-500);
    border-color: var(--blue-500);
}

.checkbox-label {
    font-family: var(--font-family);
    font-size: 14px;
    color: var(--blue-500);
}

.hidden {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}
</style>