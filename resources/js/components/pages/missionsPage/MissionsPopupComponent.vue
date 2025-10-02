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
                    <h2 
                    class="title cursor-pointer" 
                    @click="submitTaks"
                    >
                    {{ missionsState.branchProgress.current_branch.name }}  {{ missionsState.branchProgress.current_branch.id }}
                </h2>
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
    <PopUpDownLayout
    v-if="sendingPopUpState"
    @closePopup="sendingPopUpState= !sendingPopUpState">
    <form 
    @submit.prevent="submitMission"
    class="min-h-[60vh] flex flex-col gap-4">
        <div class="">
            <h2 class="title">{{ missionsState.branchProgress.current_branch.name }}</h2>
            <p class="desc">{{ missionsState.branchProgress.current_branch.description }}</p>
        </div>
        <div class="flex flex-col gap-2">
            <textarea
                v-model="formData.description"
                placeholder="Ваш ответ на задание"
            ></textarea>
        </div>
        <div>
            <div class="flex items-center gap-4">
                <input
                    type="file"
                    id="file"
                    ref="fileInput"
                    @change="handleFileUpload"
                    class="hidden"
                    accept=".pdf,.doc,.docx,.txt,.zip,.rar,.jpg,.jpeg,.png"
                >
                <button
                    type="button"
                    @click="triggerFileInput"
                    class="filebutton"
                >
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_34_3488)">
                            <path d="M24.0005 18.9L24.0005 5.1C24.0125 3.76103 23.4928 2.472 22.5554 1.51584C21.618 0.559682 20.3395 0.0145151 19.0005 -2.18566e-07L16.0005 -3.497e-07C15.7353 -3.61293e-07 15.481 0.105356 15.2934 0.292893C15.1059 0.480429 15.0005 0.734783 15.0005 1C15.0005 1.26522 15.1059 1.51957 15.2934 1.70711C15.481 1.89464 15.7353 2 16.0005 2L19.0005 2C19.8091 2.01421 20.5791 2.34856 21.1415 2.92971C21.7039 3.51087 22.0128 4.29137 22.0005 5.1L22.0005 18.9C22.0128 19.7086 21.7039 20.4891 21.1415 21.0703C20.5791 21.6514 19.8091 21.9858 19.0005 22L5.00053 22C4.19192 21.9858 3.42197 21.6514 2.85956 21.0703C2.29716 20.4891 1.98822 19.7086 2.00053 18.9L2.00053 5.1C1.98822 4.29136 2.29716 3.51086 2.85956 2.92971C3.42197 2.34856 4.19192 2.01421 5.00053 2L8.00053 2C8.26575 2 8.5201 1.89464 8.70764 1.70711C8.89517 1.51957 9.00053 1.26522 9.00053 0.999999C9.00053 0.734783 8.89517 0.480429 8.70764 0.292893C8.5201 0.105356 8.26575 -6.87798e-07 8.00053 -6.99391e-07L5.00053 -8.30525e-07C3.66158 0.0145143 2.3831 0.559681 1.44569 1.51584C0.508274 2.472 -0.011471 3.76103 0.000528113 5.1L0.000527509 18.9C-0.0114717 20.239 0.508273 21.528 1.44569 22.4842C2.3831 23.4403 3.66158 23.9855 5.00053 24L19.0005 24C20.3395 23.9855 21.618 23.4403 22.5554 22.4842C23.4928 21.528 24.0125 20.239 24.0005 18.9Z" fill="#999999" />
                            <path d="M12.0008 3C11.7356 3 11.4812 3.10536 11.2937 3.29289C11.1062 3.48043 11.0008 3.73478 11.0008 4L11.0308 17.188L6.70781 12.865C6.61557 12.7695 6.50522 12.6933 6.38322 12.6409C6.26121 12.5885 6.12999 12.5609 5.99721 12.5597C5.86444 12.5586 5.73276 12.5839 5.60986 12.6342C5.48696 12.6845 5.37531 12.7587 5.28142 12.8526C5.18753 12.9465 5.11327 13.0581 5.06299 13.181C5.01271 13.3039 4.98741 13.4356 4.98856 13.5684C4.98972 13.7012 5.0173 13.8324 5.06971 13.9544C5.12212 14.0764 5.1983 14.1868 5.29381 14.279L9.87981 18.865C10.4424 19.4274 11.2053 19.7434 12.0008 19.7434C12.7963 19.7434 13.5592 19.4274 14.1218 18.865L18.7078 14.281C18.89 14.0924 18.9908 13.8398 18.9885 13.5776C18.9862 13.3154 18.881 13.0646 18.6956 12.8792C18.5102 12.6938 18.2594 12.5886 17.9972 12.5863C17.735 12.584 17.4824 12.6848 17.2938 12.867L13.0308 17.129L13.0008 4C13.0008 3.73478 12.8955 3.48043 12.7079 3.29289C12.5204 3.10536 12.266 3 12.0008 3Z" fill="#999999" />
                        </g>
                        <defs>
                            <clipPath id="clip0_34_3488">
                            <rect width="24" height="24" fill="white" transform="translate(24) rotate(90)" />
                            </clipPath>
                        </defs>
                        </svg>
                <span v-if="formData.file" class="text-sm text-gray-600">
                    {{ formData.file.name }}
                </span>
                <span v-else class="text-sm text-gray-500">
                    Файл не выбран
                </span>
                </button>

                </div>
            </div>
            <button 
            class="submitButton" 
            type="submit">
            Отправить на проверку
        </button>

    </form>
    </PopUpDownLayout>
</template>

<script setup>
import { ref } from 'vue';
import { useMissionsStore } from '../../../store/MissionsStore';
import PopUpDownLayout from '../../Layout/PopUpDownLayout.vue';
import { useSiteState } from '../../../store/SiteState';
import { useUserStore } from '../../../store/UserStore';

const userStore = useUserStore()
const toastStore = useSiteState()
const missionsState = useMissionsStore()
const sendingPopUpState = ref(false)
const fileInput = ref(null);
const triggerFileInput = () => {
    fileInput.value?.click();
};
const submitTaks =()=>{
    missionsState.closeCompanyPopup
    sendingPopUpState.value=true
}
const formData = ref({
    description: '',
    file: null
});
const handleFileUpload = (event) => {
    const file = event.target.files[0];
    if (file) {

        formData.value.file = file;
    }
};
const submitMission = async () => {
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        const missionId = missionsState.branchProgress.current_branch.id;

        const submitFormData = new FormData(); 
        submitFormData.append('text', formData.value.description.trim());
        
        if (formData.value.file) {
            submitFormData.append('file', formData.value.file);
        }

        const response = await fetch(`/api/missions/${missionId}/result`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                ...(csrfToken && { 'X-CSRF-TOKEN': csrfToken }),
                'Authorization': `Bearer ${userStore.token}`,
            },
            body: submitFormData
        });

        console.log('Статус ответа отправки задания:', response.status);

        if (!response.ok) {
            const errorData = await response.json().catch(() => ({}));
            throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        
        missionsState.closeCompanyPopup()
        sendingPopUpState.value = false
        toastStore.sucsesMessage = 'Задание отправлено на проверку'

        console.log('Результат миссии отправлен:', data);

    } catch (error) {
        console.error('Ошибка при отправке задания:', error);
        // Можно добавить обработку ошибок для пользователя
        toastStore.errorMessage = 'Ошибка при отправке задания'
    }
};

</script>
<style scoped>
.submitButton{
    border-radius: 1000px;
    padding: 12px 20px;
    width: 100%;
    height: 43px;
    color: var(--white-500);
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 16px;
    background: var(--blue-500);
    display: flex;
    align-items: center;
    justify-content: center;
}
.submitButton:disabled{
    background: var(--white-300);
}
.filebutton{
    border-radius: 12px;
    width: 100%;
    height: 140px;
    background: var(--white-100);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
textarea{
    resize: none;
    border-radius: 16px ;
    padding: 16px;
    background: var(--white-500);
    border: 1px solid var(--blue-600); 
    width: 100%;
    height: 230px;
}
textarea:placeholder{
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 16px;
    color: var(--white-400);
    border: 1px solid var(--blue-600);
    border-radius: 12px;
}
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
