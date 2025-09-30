import { defineStore } from "pinia";
import { ref } from "vue";
import { useSiteState } from "./SiteState";
import { useUserStore } from "./UserStore";

export const useShopStore = defineStore("shop", () => {
    const shopItems = ref([]);
    const userInventory = ref([]);
    const siteState = useSiteState();
    const userStore = useUserStore();

    const fetchShopItems = async () => {
        if (!userStore.isAuthenticated) {
            console.log("Пользователь не авторизован");
            return null;
        }

        siteState.loadingTrue();

        try {
            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]'
            )?.content;

            console.log(" Загрузка товаров магазина...");

            const response = await fetch("/api/store", {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    ...(csrfToken && { "X-CSRF-TOKEN": csrfToken }),
                    Authorization: `Bearer ${userStore.token}`,
                },
                credentials: "include",
            });

            console.log("Статус ответа магазина:", response.status);

            const contentType = response.headers.get("content-type");
            if (!contentType || !contentType.includes("application/json")) {
                const text = await response.text();
                console.error(
                    " Сервер магазина вернул не JSON:",
                    text.substring(0, 200)
                );
                throw new Error(
                    `Сервер вернул HTML вместо JSON. Status: ${response.status}`
                );
            }

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            shopItems.value = data.items || data.products || data;

            console.log(" Товары магазина получены:", data);
            return data;
        } catch (error) {
            console.error(" Ошибка при получении товаров магазина:", error);

            if (error.message.includes("401")) {
                console.log(" Токен невалиден");
            }

            return null;
        } finally {
            siteState.loadingFalse();
        }
    };

    const purchaseItem = async (itemId) => {
        if (!userStore.isAuthenticated) {
            console.log("Пользователь не авторизован");
            return null;
        }

        siteState.loadingTrue();

        try {
            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]'
            )?.content;

            const response = await fetch("/api/store/purchase", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    ...(csrfToken && { "X-CSRF-TOKEN": csrfToken }),
                    Authorization: `Bearer ${userStore.token}`,
                },
                body: JSON.stringify({ item_id: itemId }),
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            if (data.user) {
                userStore.setUser(data.user);
            }

            if (data.message) {
                siteState.sucsesMessage = data.message;
            }

            return data;
        } catch (error) {
            console.error("Ошибка при покупке товара:", error);

            if (error.message.includes("422")) {
                siteState.errorText = "Недостаточно лаккоинов";
            } else {
                siteState.errorText = "Ошибка при покупке товара";
            }

            return null;
        } finally {
            siteState.loadingFalse();
        }
    };
    const fetchUserInventory = async () => {
        if (!userStore.isAuthenticated) {
            console.log("Пользователь не авторизован");
            return null;
        }

        siteState.loadingTrue();

        try {
            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]'
            )?.content;

            console.log(" Загрузка инвентаря пользователя...");

            const response = await fetch("/api/store?in_storage=1", {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    ...(csrfToken && { "X-CSRF-TOKEN": csrfToken }),
                    Authorization: `Bearer ${userStore.token}`,
                },
            });

            console.log("Статус ответа инвентаря:", response.status);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            userInventory.value = data.items || data.products || data;

            console.log(" Инвентарь пользователя получен:", data);
            return data;
        } catch (error) {
            console.error(" Ошибка при получении инвентаря:", error);
            return null;
        } finally {
            siteState.loadingFalse();
        }
    };

    return {
        shopItems,
        userInventory,
        fetchShopItems,
        purchaseItem,
        fetchUserInventory,
    };
});
