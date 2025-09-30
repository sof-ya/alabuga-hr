<template>
    <div class="wrapper" @click="handleBackdropClick">
        <div class="content" @click.stop>
            <button
            @click="closePopup"
             class="close">
                <IconComponent
                name="close"/>
            </button>
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
import IconComponent from '../ui/IconComponent.vue';
const emit = defineEmits('closePopup')
const closePopup =()=>{
    emit('closePopup')
}
const handleBackdropClick = (event) => {
    if (event.target.classList.contains('wrapper')) {
        closePopup();
    }
};

</script>

<style  scoped>
    .wrapper{
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 50;
        background: rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: flex-end;
    }
    .content{
        background: var(--white-500);
        border-radius: 16px 16px 0 0;
        padding: 16px;
        width:100%;
        min-height: 100px;
        max-height: 100vh;
        position: relative;
    }
    .close{
        width: 24px;
        height: 24px;
        position: absolute;
        top: 16px;
        right: 16px;
    }

</style>