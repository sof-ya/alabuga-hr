<template>
    <LoginLayOut>
        <div class="px-4 flex flex-col gap-5">
            <h1 class=" text-center">Авторизация</h1>
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
            />
        </div>
    </LoginLayOut>
</template>

<script setup>
import { reactive } from 'vue';
import InputComponent from '../form/InputComponent.vue';
import ButtonComponent from '../ui/ButtonComponent.vue';
import LoginLayOut from '../Layout/LoginLayOut.vue';

const form = reactive({
    email:'',
    password:''

})




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