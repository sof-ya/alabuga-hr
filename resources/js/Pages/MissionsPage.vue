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
                <MissionCategoryComponent
                title="Название категории"
                desc="Описание ветки спокойно адаптируется по высоте в зависимости от количества текста"
                :progress="20"
                @show-info="showCategoryInfo('categoryId')"
                />
            </div>
            <div 
            v-if="activeTab === 'active'"
            class="">
                active
            </div>
            <div 
            v-if="activeTab === 'completed'"
            class="">
                completed
            </div>
<PopUpDownLayout
v-if="popUpState"
@close-popup="popUpState = false"
>
poupupData
</PopUpDownLayout>
        </div>
        
    </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import MainLayout from '../components/Layout/MainLayout.vue';
import ButtonWithTwoStates from '../components/ui/ButtonWithTwoStates.vue'
import MissionCategoryComponent from '../components/pages/missionsPage/MissionCategoryComponent.vue';
import PopUpDownLayout from '../components/Layout/PopUpDownLayout.vue'
const activeTab=ref('all')
const popUpState = ref(false)
const toggleTabs = (type)=>{
    activeTab.value = type
}
const showCategoryInfo = (id)=>{
    popUpState.value=true
    console.log(id)
}
</script>

<style lang="scss" scoped>


</style>