<template>
<PopUpDownLayout
    v-if="missionsState.companyPopUpState"
    @closePopup="missionsState.closeCompanyPopup">
            <div v-if="missionsState.popupLoader" class="text-center py-4">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mx-auto"></div>
                <p class="mt-2 text-gray-500">Загрузка...</p>
            </div>
<div v-else-if="missionsState.branchProgress" class="flex flex-col gap-4">
    <div class="flex flex-col gap-1">
        <h2 class="title">{{ missionsState.branchProgress.current_branch.name }}</h2>
        <p class="desc">{{ missionsState.branchProgress.current_branch.description }}</p>
    </div>
    <div class="">
        <h2 class="title">Требования к описанию:</h2>
        <div class=" grid grid-cols-4">
            <div class="flex flex-col">
                <h3 class="subtitle">Роль</h3>
                <span class="requirements">{{ missionsState.branchProgress.role.description || 'Без роли' }}</span>
            </div>
            <div class="flex flex-col">
                <h3 class="subtitle">Опыт</h3>
                <span class="requirements">{{ missionsState.branchProgress.experience || '0' }} HP</span>
            </div>
        </div>
    </div>
    
    <div class="flex flex-wrap gap-8">
        <div class="" v-if="false">
            <h3 class="subtitle">Компетенции</h3>
            <ul>
                <li>Название компетенции:</li>
                <li>Название компетенции:</li>
                <li>Название компетенции:</li>
            </ul>
        </div>
        <div class="" v-if="missionsState.branchProgress.branches.length">
            <h3 class="subtitle">Завершенные ветки</h3>
            <ul>
                <li 
                v-for="elem in missionsState.branchProgress.branches"
                :class="{
                    'text-green-600':elem.is_completed,
                    'text-red-600':!elem.is_completed,
                }"
                >{{ elem.branch_name}}: {{ elem.status_display }}</li>

            </ul>
        </div>
        <div class="" v-if="missionsState.branchProgress.missions.length">
            <h3 class="subtitle">Завершенные миссии</h3>
            <ul>
                <li 
                v-for="elem in missionsState.branchProgress.missions"
                :class="{
                    'text-green-600':elem.is_completed,
                    'text-red-600':!elem.is_completed,
                }"
                >{{ elem.name }}: {{elem.is_completed ? 'пройдена' : 'не пройдена' }}</li>
            </ul>
        </div>
    </div>

</div>
</PopUpDownLayout>
</template>

<script setup>
import { useMissionsStore } from '../../../store/MissionsStore';
import PopUpDownLayout from '../../Layout/PopUpDownLayout.vue';
const missionsState = useMissionsStore()

</script>
<style scoped>
.title{
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 20px;
    color: var(--white-950);
}
.subtitle{
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 16px;
    color: var(--blue-500);
}
.requirements{
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 10px;
    color: var(--green-500);
}
.desc{
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 13px;
    color: var(--white-600);
}
ul{
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-top: 6px;
    li{
        font-family: var(--font-family);
        font-weight: 400;
        font-size: 10px;
    }
}
</style>
