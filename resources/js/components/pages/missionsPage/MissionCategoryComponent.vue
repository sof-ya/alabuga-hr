<template>
    <div class="wrapper">
        <div class="header">
            <div class="flex items-center gap-2">
                <div class="h-7 w-7 rounded overflow-hidden bg-gray-300">

                </div>
                <h4>{{ props.title }}</h4>
            </div>
            <button @click="toggleActivity" class="h-6 w-6 ">
                <IconComponent
                name="check"
                :class="{'rotate-180' : activity}"/>
            </button>
        </div>
        <p class="description">{{ props.desc }}</p>
        <div class="progress">
            <div class="progress_persent" :style="`width: ${props.progress}%;`">{{ props.progress }}%</div>
        </div>

    </div>
</template>

<script setup>
import { ref } from 'vue';
import IconComponent from '../../ui/IconComponent.vue';

const activity = ref(false)
const props = defineProps({
    title:{
        type:String,
        required:true
    },
    desc:{
        type:String,
    },
    progress:{
        type:Number,
        default: 0
    }
})
const toggleActivity =()=>{
    activity.value=!activity.value
}
</script>

<style scoped>
    .wrapper{
        border-radius: 12px;
        background: var(--white-500);
        padding: 12px;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .header{
        display: grid;
        grid-template-columns: 1fr 24px;
        gap: 10px;
        h4{
            font-family: var(--font-family);
            font-weight: 700;
            font-size: 16px;
            color: var(--white-950);
        }
    }
    .description{
        font-family: var(--font-family);
        font-weight: 400;
        font-size: 13px;
        color: var(--white-950);
    }
    .progress{
        background: var(--white-50);
        width: 100%;
        height: 11px;
        border-radius: 80px;
    }
    .progress_persent{
        font-family: var(--font-family);
        font-weight: 400;
        font-size: 8px;
        color: var(--blue-700);
        background: var(--blue-400);
        border-radius: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

</style>