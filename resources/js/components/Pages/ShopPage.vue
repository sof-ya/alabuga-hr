<template>
    <MainLayout>
        <div class="flex flex-col gap-5 py-5 px-4" >
            <h2><IconComponent
                name="money"/> На счету : {{ userData["gold"] }} лаккоинов</h2>
                <div class="grid grid-cols-2 gap-2.5">
                    <button>магазин</button> <button>Хранилище</button>
                    <ButtonComponent
                    text="Магазин"
                    />
                    <ButtonComponentWhite
                    text="Хранилище"/>
                </div>
                <div class="grid grid-cols-2">
                    <div class="">item1</div>
                    <div class="">item1</div>
                </div>
        </div>
   

    </MainLayout>
</template>

<script setup>
import { computed, onMounted } from 'vue';
import { useUserStore } from '../../store/UserStore';
import MainLayout from '../Layout/MainLayout.vue';
import IconComponent from '../ui/IconComponent.vue';
import ButtonComponent from '../ui/ButtonComponent.vue';
import ButtonComponentWhite from '../ui/ButtonComponentWhite.vue';
const userStore = useUserStore()

const userData = computed(()=>{
    return userStore.user || {}
})
onMounted(async () => {
    await userStore.fetchUser()
})
</script>

<style  scoped>
h2{
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 16px;
    color: var(--yellow-600);
    display: flex;
    flex-direction: row;
    gap: 4px;
    align-items: center;
}

</style>