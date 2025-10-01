<template>
    <div class="wrapper">
        <div class="header">
            <div class="flex items-center gap-2">
                <div class="h-7 w-7 rounded overflow-hidden bg-gray-300">

                </div>
                <h4>{{ props.title }}</h4>
            </div>
            <button @click="()=>toggleActivity(props.id)" class="h-6 w-6 ">
                <IconComponent
                name="check"
                :class="{'rotate-180' : activity}"/>
            </button>
        </div>
        <p class="description">{{ props.desc }}</p>
        <div class="progress">
            <div class="progress_persent" :style="`width: ${props.progress}%; min-width: 20px;`">{{ props.progress }}%</div>
        </div>
        <div class="flex flex-row justify-end pt-5">
            <button class="button" @click="()=>missionsState.getBranchProgress(props.dataId)">Подробнее о категории</button>
        </div>
    </div>
    <div class="data" v-if="activity">
            <div v-if="siteState.loading" class="text-center py-4">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mx-auto"></div>
                <p class="mt-2 text-gray-500">Загрузка...</p>
            </div>
        <div class=" data__item" v-for="data in arrayData">
            <h3 class="data__title">{{ data.name }}</h3>
            <p class="data__desc">{{ data.description || 'Описание отсутствует' }}</p>
                <div class="data__footer">
                    <div class="data__gold">
                        <IconComponent
                        name="money"/>
                         <span>+{{ data.reward_gold }} лакоинов</span>
                    </div>
                    <div class="data__exp">
                        <IconComponent
                        name="exp"/>
                        <span>+{{ data.reward_experience }} HP</span>
                        
                    </div>
                    
                </div>
        </div>

    </div>
</template>

<script setup>
import { ref } from 'vue';
import IconComponent from '../../ui/IconComponent.vue';
import { useMissionsStore } from '../../../store/MissionsStore';
import { useSiteState } from '../../../store/SiteState';
const missionsState = useMissionsStore()
const siteState =useSiteState()
const emit =defineEmits(['showInfo'])
const activity = ref(false)
const arrayData=ref([])
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
    },
    dataType:{
        type:String,
        default:'all'
    },
    dataId:{
        type:Number,
        required:true
    }
})
const toggleActivity = async()=>{
    activity.value=!activity.value
    if(arrayData.value.length == 0){
        await missionsState.getMissionBranche(props.dataId)
        arrayData.value = missionsState.missionBranchData.data
    }

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
    .button{
        font-family: var(--font-family);
        font-weight: 400;
        font-size: 13px;
        color: var(--blue-600);
        background: var(--white-500);
        border-radius: 12px;
        border: 1px solid var(--blue-600);
        border-radius: 1000px;
        padding: 4px 8px;
    }
    .data{
        background: var(--white-500);
        border-radius: 12px;
        padding: 8px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .data__item{
        background: var(--white-50);
        border-radius: 12px;
        padding: 12px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .data__title{
        font-family: var(--font-family);
        font-weight: 700;
        font-size: 16px;
        color: var(--white-950);
    }
    .data__desc{
        font-family: var(--font-family);
        font-weight: 400;
        font-size: 13px;
        color: var(--white-950);
    }
    .data__footer{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
    }
    .data__exp,
    .data__gold{
        display: grid;
        grid-template-columns:16px  1fr ;
        gap:4px;
        svg{
            width: 100%;
            height: 100%;
        }
    }
    .data__exp{
        font-family: var(--font-family);
        font-weight: 400;
        font-size: 10px;
        color: var(--blue-700);
    }
    .data__gold{
        font-family: var(--font-family);
        font-weight: 400;
        font-size: 10px;
        color: var(--yellow-600);
    }
</style>