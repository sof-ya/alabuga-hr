<template>
    <LoginLayOut>
        <div class="px-4 flex flex-col gap-5">
            <h1 class=" text-center">Регистрация</h1>
            <InputComponent
            name="name"
            title="Имя"
            placeholder="Иван"
            required
            v-model="form.name"
            />
            <InputComponent
            name="family"
            title="Фамилия"
            placeholder="Иванов"
            required
            v-model="form.family"
            />
            <InputComponent
            name="tel"
            title="Контактный номер"
            placeholder="+7(000) 000-00-00"
            required
            v-model="form.tel"
            type="tel"
            />
            <InputComponent
            name="tel"
            title="Почта"
            placeholder="mail@mail.ru"
            v-model="form.email"
            type="email"
            />
            <span class="flex flex-row items-center"><span class="star">*</span>- обязательные поля для заполнения</span>
            <ButtonComponent
                text="Зарегистрироваться"
            />

                <CheckboxComponent
                    name="agree"
                    v-model="form.agree"
                    required
                >
                <span class="polisy"> Нажимая кнопку “Зарегистрироваться” я даю согласие на
                    Я согласен с <a href="#" class="link">обработку персональных данных</a> и 
                    <a href="#" class="link">соглашаюсь с политикой конфиденциальности</a>
                </span>
                
                </CheckboxComponent>
                
        </div>
    </LoginLayOut>
</template>

<script setup>
import { reactive } from 'vue';
import InputComponent from '../components/form/InputComponent.vue';
import ButtonComponent from '../components/ui/ButtonComponent.vue';
import CheckboxComponent from '../components/form/CheckboxComponent.vue';
import LoginLayOut from '../components/Layout/LoginLayOut.vue';

const form = reactive({
    name:'',
    family:'',
    tel:'',
    email:'',
    agree: false
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