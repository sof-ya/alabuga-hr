<template>
    <button
    :class="{
        'active':!props.disabled,
        'disabled':props.disabled,
        'blue':props.state,
        'white':!props.state
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
    },
    state:{
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
        
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }
    .blue {
        background: var(--blue-500);
        color: var(--white-500);
    }
    .white{
        color: var(--blue-500);
        background: var(--white-50);
        border: 1px solid var(--blue-500);
    }


</style>