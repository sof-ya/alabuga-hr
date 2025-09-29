<template>
    <button
    :class="{
        'active':!props.disabled,
        'disabled':props.disabled
    }"
    class="flex items-center justify-center"
    :disabled="props.disabled"
    @click="handleClick"
    >
        {{ props.text }}
    </button>
</template>

<script setup>
const props = defineProps({
    text:{
        type:String,
        default:'Текст кнопки'
    },
    disabled:{
        type:Boolean,
        default:false
    }
})
const emit = defineEmits(['click'])

const handleClick = (event) => {
    if (!props.disabled) {
        emit('click', event)
    }
}

</script>

<style scoped>
    button{
        border-radius: 1000px;
        padding: 12px 20px;
        height: 43px;
        font-family: var(--font-family);
        font-weight: 700;
        font-size: 16px;
        color: var(--blue-500);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        background: var(--white-50);
    }
    .active{
        background: var(--white-50);
    }
    .disabled{
        background: var(--white-300);
    }


</style>