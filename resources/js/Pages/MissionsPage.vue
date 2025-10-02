<template>
    <MainLayout>
        <div class="pt-5 px-4 flex flex-col gap-2.5">
            <div class="flex flex-row gap-2">
                    <ButtonWithTwoStates
                    text="Все"
                    :state="activeTab === 'all'"
                    class="!w-fit"
                    @click="()=>toggleTabs('all')"
                    />
                    <ButtonWithTwoStates
                    text="Активные"
                    :state="activeTab === 'active'"
                    class="!w-fit"
                    @click="()=>toggleTabs('active')"
                    />
                    <ButtonWithTwoStates
                    text="Завершённые"
                    class="!w-fit"
                    :state="activeTab === 'completed'"
                    @click="()=>toggleTabs('completed')"/>
            </div>
            <div v-if="activeTab === 'all'" 
            class="flex flex-col gap-2.5">
            <div v-if="siteState.loading" class="text-center py-4">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mx-auto"></div>
                <p class="mt-2 text-gray-500">Загрузка...</p>
            </div>
                <MissionCategoryComponent
                    v-for="mission in missionsState.allMissions.data"
                    :title="mission.name"
                    :desc="mission.description || 'Описание отсутствует'"
                    :progress="mission.progress || 0"
                    :dataId="mission.id"
                    @show-info="showCategoryInfo(mission.id)"
                />

            </div>
            <div 
            v-if="activeTab === 'active'"
            class="flex flex-col gap-2.5">
                <div v-if="siteState.loading" class="text-center py-4">
                    <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mx-auto"></div>
                    <p class="mt-2 text-gray-500">Загрузка...</p>
                </div>
                <MissionCategoryComponent
                    v-for="mission in missionsState.activeMissions.data"
                    :title="mission.name"
                    :desc="mission.description || 'Описание отсутствует'"
                    :progress="mission.progress || 0"
                    :dataId="mission.id"
                    dataType="active"
                    @show-info="showCategoryInfo(mission.id)"
                />
            </div>
            <div 
            v-if="activeTab === 'completed'"
            class="flex flex-col gap-2.5">
                 <div v-if="siteState.loading" class="text-center py-4">
                    <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mx-auto"></div>
                    <p class="mt-2 text-gray-500">Загрузка...</p>
                </div>
                
                <template v-if="missionsState.passedMissions">
                    <MissionCategoryComponent 
                        v-for="mission in missionsState.passedMissions.data"
                        :title="mission.name"
                        :desc="mission.description || 'Описание отсутствует'"
                        :progress="mission.progress || 0"
                        dataType="completed"
                        :dataId="mission.id"
                        @show-info="showCategoryInfo(mission.id)"
                    /> 
                </template>
                <template v-else>
                    <h2 class="mt-2 text-gray-500 text-center" >Завершённых миссий нет</h2>
                </template>
            </div>

            <MissionsPopupComponent/>
        </div>
        
    </MainLayout>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import MainLayout from '../components/Layout/MainLayout.vue';
import ButtonWithTwoStates from '../components/ui/ButtonWithTwoStates.vue'

import MissionCategoryComponent from '../components/pages/missionsPage/MissionCategoryComponent.vue'
import { useMissionsStore } from '../store/MissionsStore';
import { useSiteState } from '../store/SiteState';
import MissionsPopupComponent from '../components/pages/missionsPage/MissionsPopupComponent.vue';
const activeTab=ref('all')
const popUpState = ref(false)
const missionsState = useMissionsStore()
const siteState = useSiteState()
const toggleTabs = (type)=>{
    activeTab.value = type
    if(type === 'active'){
        activeMissions()
    }else if(type === 'completed'){
        passedMissions()
    }
}
const showCategoryInfo = (id)=>{
    popUpState.value=true
    console.log(id)
}
const activeMissions = async ()=>{
    await missionsState.fetchActiveMissions()
}
const allMissions = async ()=>{
    await missionsState.fetchAllMissions()
}
const passedMissions = async ()=>{
    await missionsState.fetchPassedMissions()
}
onMounted(async ()=>{
    await allMissions()
})
</script>

<style lang="scss" scoped>


</style>