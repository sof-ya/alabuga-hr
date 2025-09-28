<template>
    <LoginLayOut>
        <form @submit.prevent="handleLogin" class="h-full w-full flex items-center justify-center">
            <div class="px-4 flex flex-col gap-5 w-full">
                <h1 class=" text-center">Авторизация</h1>
                <div v-if="errorMessage" class="error-message">
                    {{ errorMessage }}
                </div>
                <InputComponent
                name="email"
                title="Email"
                placeholder="email@email.ru"
                required
                v-model="form.email"
                type="email"
                />
                <InputComponent
                name="password"
                title="Пароль"
                placeholder="*********"
                type="password"
                required
                v-model="form.password"/>
                <span class="flex flex-row items-center"><span class="star">*</span>- обязательные поля для заполнения</span>
                <ButtonComponent
                    text="Войти"
                    :disabled="loading"
                    :loading="loading"
                />
            </div>
        </form>
    </LoginLayOut>
</template>

<script setup>
import { reactive, ref } from 'vue';
import InputComponent from '../form/InputComponent.vue';
import ButtonComponent from '../ui/ButtonComponent.vue';
import LoginLayOut from '../Layout/LoginLayOut.vue';
import { useRouter } from 'vue-router';
import { useUserStore } from '../../store/UserStore';
const router = useRouter()
const userStore = useUserStore()

const form = reactive({
    email:'test@example.com',
    password:'password'

})
const loading = ref(false)
const errorMessage = ref('')
const errors = reactive({
    email: '',
    password: ''
})
const validateForm = () => {
    let isValid = true
    errors.email = ''
    errors.password = ''

    if (!form.email) {
        errors.email = 'Email обязателен для заполнения'
        isValid = false
    } else if (!/\S+@\S+\.\S+/.test(form.email)) {
        errors.email = 'Введите корректный email'
        isValid = false
    }

    if (!form.password) {
        errors.password = 'Пароль обязателен для заполнения'
        isValid = false
    } else if (form.password.length < 6) {
        errors.password = 'Пароль должен содержать минимум 6 символов'
        isValid = false
    }

    return isValid
}
const getCSRFToken = () => {
    const token = document.querySelector('meta[name="csrf-token"]')
    return token ? token.getAttribute('content') : ''
}

const handleLogin = async () => {
    if (!validateForm()) {
        return
    }

    loading.value = true
    errorMessage.value = ''

    try {
        const response = await fetch('/api/auth/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCSRFToken()
            },
            body: JSON.stringify({
                email: form.email,
                password: form.password
            })
        })

        const data = await response.json()

        if (!response.ok) {
            throw new Error(data.message || `HTTP error! status: ${response.status}`)
        }

        // Успешный ответ
        const { user, token } = data

        // Сохраняем данные в Pinia store
        userStore.setUser(user)
        userStore.setToken(token)

        // Перенаправляем на главную страницу
        await router.push('/')

    } catch (error) {
        console.error('Login error:', error)
        errorMessage.value = error.message || 'Произошла ошибка при входе. Попробуйте позже.'
    } finally {
        loading.value = false
    }
}

</script>

<style scoped>
h1{
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 39px;
    color: var(--white-950);
}
span{
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 13px;
    color: var(--blue-500);
}
.star{
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 16px;
    color: var(--red-500);
    padding-left: 2px;
}
.polisy{
    font-size: 10px;
}
.polisy a{
    color: var(--blue-300);
}

</style>