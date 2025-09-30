<template>
    <div class="item">
        <div class="image" @click="emit('openPopup')">
            <img 
                v-if="item.image" 
                :src="item.image" 
                :alt="item.name"
                class="image__img"
            >
            <div v-else class="image__placeholder">
                Нет изображения
            </div>
        </div>
        <h3>{{ item.name }}</h3>
        <div class="grid grid-cols-2 items-center">
            <span class="cost">{{ formattedPrice }} лаккоинов</span>
            <button 
                @click="handlePurchase"
                :disabled="!item.is_active || item.in_purchases"
                :class="{ 'button--disabled': !item.is_active || item.in_purchases }"
            >
                {{ buttonText }}
            </button>
        </div>
        
        <div v-if="showAdditionalInfo" class="additional-info">
            <span v-if="item.in_purchases" class="purchased">Уже куплено</span>
            <span v-if="!item.is_active" class="inactive">Недоступно</span>
            <span v-if="item.items_count !== undefined" class="count">Осталось: {{ item.items_count }}</span>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    item: {
        type: Object,
        required: true,
        default: () => ({
            id: 0,
            name: 'Название товара',
            description: null,
            price: 0,
            image: null,
            items_count: 0,
            created_at: null,
            updated_at: null,
            in_purchases: false,
            is_active: true
        })
    },
    context: {
        type: String,
        default: 'shop', // 'shop' или 'inventory'
        validator: (value) => ['shop', 'inventory'].includes(value)
    }
})

const emit = defineEmits(['purchase','openPopup'])

const formattedPrice = computed(() => {
    return new Intl.NumberFormat('ru-RU').format(props.item.price)
})

const buttonText = computed(() => {
    if (props.context === 'inventory') {
        return 'Использовать'
    }
    
    if (props.item.in_purchases) {
        return 'Куплено'
    }
    
    if (!props.item.is_active) {
        return 'Недоступно'
    }
    
    return 'Купить'
})

const showAdditionalInfo = computed(() => {
    return props.item.in_purchases || !props.item.is_active || props.item.items_count !== undefined
})

const handlePurchase = () => {
    if (props.item.in_purchases || !props.item.is_active) {
        return
    }
    
    emit('purchase', props.item.id)
}
</script>

<style scoped>
.item {
    border-radius: 12px;
    padding: 8px;
    width: 100%;
    background: var(--white-500);
    border: 1px solid var(--white-200);
    transition: all 0.3s ease;
}

.item:hover {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.image {
    width: 100%;
    aspect-ratio: 2/1;
    background: #d9d9d9;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 8px;
}

.image__img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image__placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white-400);
    font-family: var(--font-family);
    font-size: 12px;
}

h3 {
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 16px;
    color: var(--white-950);
    margin-bottom: 4px;
    line-height: 1.2;
}

.description {
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 13px;
    color: var(--white-600);
    margin-bottom: 8px;
    line-height: 1.3;
}

.cost {
    font-family: var(--font-family);
    font-weight: 600;
    font-size: 14px;
    color: var(--blue-500);
}

button {
    border-radius: 1000px;
    padding: 6px 12px;
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 13px;
    color: var(--white-500);
    background: var(--blue-500);
    width: fit-content;
    margin-left: auto;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

button:hover:not(.button--disabled) {
    background: var(--blue-600);
    transform: scale(1.05);
}

.button--disabled {
    background: var(--white-400);
    color: var(--white-300);
    cursor: not-allowed;
    transform: none;
}

.button--disabled:hover {
    background: var(--white-400);
    transform: none;
}

.additional-info {
    margin-top: 6px;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.purchased {
    font-family: var(--font-family);
    font-size: 11px;
    color: var(--green-500);
    font-weight: 600;
}

.inactive {
    font-family: var(--font-family);
    font-size: 11px;
    color: var(--red-500);
    font-weight: 600;
}

.count {
    font-family: var(--font-family);
    font-size: 11px;
    color: var(--white-600);
}
</style>