<template>
    <MainLayout>
        <div class="flex flex-col gap-5 py-5 px-4">
            <h2>
                <IconComponent name="money"/> 
                На счету : {{ userData?.gold || 0 }} лаккоинов
            </h2>
            
            <div class="grid grid-cols-2 gap-2.5">
                <ButtonWithTwoStates
                    text="Магазин"
                    :state="activeTab === 'shop'"
                    @click="setActiveTab('shop')"
                />
                <ButtonWithTwoStates
                    text="Хранилище"
                    :state="activeTab === 'inventory'"
                    @click="setActiveTab('inventory')"
                />
            </div>

            <div v-if="siteState.loading" class="text-center py-4">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mx-auto"></div>
                <p class="mt-2 text-gray-500">Загрузка...</p>
            </div>

            <div v-if="siteState.sucsesMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ siteState.sucsesMessage }}
            </div>

            <div v-if="siteState.errorText" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ siteState.errorText }}
            </div>


            <div v-if="activeTab === 'shop' && !siteState.loading" class="grid grid-cols-2 gap-2.5">
                <ItemComponent
                    v-for="item in shopStore.shopItems.data"
                    :key="item.id"
                    :item="item"
                    :is-shop="true"
                    @purchase="handlePurchase"
                    @open-popup="showDetail(item.id, 'shop')"
                /> 
                
                <div v-if="shopStore.shopItems.length === 0" class="col-span-2 text-center py-8 text-gray-500">
                    <p>Товары в магазине отсутствуют</p>
                    <button
                        @click="loadShopData"
                        class="mt-2 bg-blue-500 text-white px-4 py-2 rounded"
                    >
                        Обновить
                    </button>
                </div> 

            </div>

            <div v-else-if="activeTab === 'inventory' && !siteState.loading" class="grid grid-cols-2 gap-2.5">
                
                <ItemComponent
                    v-for="item in shopStore.userInventory.data"
                    :key="item.id"
                    :item="item"
                    context="inventory"
                    @open-popup="showDetail(item.id, 'inventory')"
                />

                <div v-if="shopStore.userInventory.data.length === 0" class="col-span-2 text-center py-8 text-gray-500">
                    <p>Ваш инвентарь пуст</p>
                    <button
                        @click="loadInventoryData"
                        class="mt-2 bg-blue-500 text-white px-4 py-2 rounded"
                    >
                        Обновить
                    </button>
                </div> 
            </div>
        </div>
        
        <PopUpDownLayout
        v-if="popUpSate"
        @close-popup="popUpSate=false">
            <div class="">
                <h3 class="popup__title">{{ elemToShowInPopup.name }}</h3>
                <p v-if="elemToShowInPopup.description" class="popup__desc">{{ elemToShowInPopup.description }}</p>
                <div class="popup__img">
                        <img 
                            v-if="elemToShowInPopup.image" 
                            :src="elemToShowInPopup.image" 
                            :alt="elemToShowInPopup.name"
                            class="image__img"
                        >
                        <div v-else class="flex items-center justify-center h-full w-full">
                            Нет изображения
                        </div>
                </div>
                <div class="popup__footer">
                    <span class="popup__cost">Стоимость: {{ elemToShowInPopup.price }} лаккоинов</span>
                    <button class="popup__button">Купить артефакт {{ elemToShowInPopup.id }}</button>
                </div>
            </div>

        </PopUpDownLayout>

    </MainLayout>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue';
import { useUserStore } from '../store/UserStore';
import { useSiteState } from '../store/SiteState';
import MainLayout from '../components/Layout/MainLayout.vue';
import IconComponent from '../components/ui/IconComponent.vue';
import ItemComponent from '../components/pages/shopPage/ItemComponent.vue';
import ButtonWithTwoStates from '../components/ui/ButtonWithTwoStates.vue';
import { useShopStore } from '../store/ShopStore';
import PopUpDownLayout from '../components/Layout/PopUpDownLayout.vue'


const userStore = useUserStore()
const shopStore = useShopStore()
const siteState = useSiteState()
const popUpSate = ref(false)
const activeTab = ref('shop')
const elemToShowInPopup = ref([])
const userData = computed(() => {
    return userStore.user || {}
})


const loadShopData = async () => {
    console.log(' Загрузка данных магазина...')
    await shopStore.fetchShopItems()
}

const loadInventoryData = async () => {
    console.log(' Загрузка инвентаря...')
    await shopStore.fetchUserInventory()
}
const setActiveTab = (tab) => {
    activeTab.value = tab
    
    if (tab === 'shop') {
        loadShopData()
    } else {
        loadInventoryData()
    }
}


const handlePurchase = async (itemId) => {
    console.log(' Покупка товара:', itemId)
    const result = await shopStore.purchaseItem(itemId)
    
    if (result) {

        await loadShopData()
        await userStore.fetchUser() 
    }
}

onMounted(async () => {
    await userStore.fetchUser()
    await loadShopData()
})
const showDetail=(id, type)=>{
    console.log(type)
    if(type === 'shop'){
        elemToShowInPopup.value = shopStore.shopItems.data.find(item=>item.id == id)
    }else if(type === 'inventory'){
         elemToShowInPopup.value = shopStore.userInventory.data.find(item=>item.id == id)
    }

    popUpSate.value=true
}
</script>

<style scoped>
h2 {
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 16px;
    color: var(--yellow-600);
    display: flex;
    flex-direction: row;
    gap: 4px;
    align-items: center;
}
.popup__title{
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 20px;
    color: var(--white-950);
}
.popup__desc{
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 16px;
    color: var(--white-600);
}
.popup__cost{
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 16px;
    color: var(--blue-500);
}
.popup__img{
    width: full;
    aspect-ratio: 2/1;
        background: #d9d9d9;
    border-radius: 8px;
    overflow: hidden;
    img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

}
.popup__footer{
    display: grid;
    grid-template-columns: 1fr 170px;
    gap:20px ;
    align-items: center;

}
.popup__button{
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 16px;
    color: var(--white-500);
    background: var(--blue-500);
    border-radius: 1000px;
    padding: 12px 0;
}
</style>