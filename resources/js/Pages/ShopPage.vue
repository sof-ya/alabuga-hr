<template>
    <MainLayout>
        <div class="flex flex-col gap-5 py-5 px-4" >
            <h2><IconComponent
                name="money"/> На счету : {{ userData["gold"] }} лаккоинов</h2>
                <div class="grid grid-cols-2 gap-2.5">
                    <ButtonWithTwoStates
                    text="Магазин"
                    :state="tabState"
                    @click="toggleTabState"
                    />
                    <ButtonWithTwoStates
                    text="Хранилище"
                    :state="!tabState"
                    @click="toggleTabState"
                    />
                </div>
                <div v-if="tabState"
                class="grid grid-cols-2 gap-2.5">
                    <ItemComponent
                    />
                    <ItemComponent
                    />
                    <ItemComponent
                    />
                    <ItemComponent
                    />
                    <ItemComponent
                    />
                      <ItemComponent
                    />
                    <ItemComponent
                    />
                    <ItemComponent
                    />
                    <ItemComponent
                    />
                    <ItemComponent
                    />
                </div>
                <div v-else
                class="grid grid-cols-2 gap-2.5">
                    <ItemComponent
                    />
                    <ItemComponent
                    />
                </div>
        </div>
   

    </MainLayout>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue';
import { useUserStore } from '../store/UserStore';
import MainLayout from '../components/Layout/MainLayout.vue';
import IconComponent from '../components/ui/IconComponent.vue';
import ItemComponent from '../components/pages/shopPage/ItemComponent.vue';
import ButtonWithTwoStates from '../components/ui/ButtonWithTwoStates.vue';


const userStore = useUserStore()
const tabState = ref(false)
const userData = computed(()=>{
    return userStore.user || {}
})
onMounted(async () => {
    await userStore.fetchUser()
})
const toggleTabState =()=>{
    tabState.value=!tabState.value
}
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