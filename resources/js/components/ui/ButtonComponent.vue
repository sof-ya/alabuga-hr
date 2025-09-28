<template>
    <button
    :class="{
        'active':!props.disabled,
        'disabled':props.disabled
    }"
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
        color: var(--white-500);
    }
    .active{
        background: var(--blue-500);
    }
    .disabled{
        background: var(--white-300);
    }


</style>