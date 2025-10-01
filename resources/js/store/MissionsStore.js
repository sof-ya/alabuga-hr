import { ref } from "vue"
import { useSiteState } from "./SiteState";
import { useUserStore } from "./UserStore";
import { defineStore } from "pinia";

export const useMissionsStore = defineStore('missions',()=>{
    const allMissions = ref([]);
    const activeMissions = ref([]);
    const completedMissions = ref([]);
    const siteState = useSiteState();
    const userStore = useUserStore();
    const missionBranchData = ref([])
    const fetchAllMissions = async ()=>{
        if (!userStore.isAuthenticated) {
            console.log("Пользователь не авторизован");
            return null;
        }
        siteState.loadingTrue();
        try {
            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]'
            )?.content;

            console.log(" Загрузка Всех миссий...");

            const response = await fetch("/api/branches", {
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

            console.log("Статус ответа :", response.status);

            const contentType = response.headers.get("content-type");
            if (!contentType || !contentType.includes("application/json")) {
                const text = await response.text();
                console.error(
                    " Сервер  вернул не JSON:",
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
            allMissions.value = data.items || data.products || data;

            console.log(" Элементы получены:", data);
            return data;
        } catch (error) {
            console.error(" Ошибка при получении всех миссий:", error);

            if (error.message.includes("401")) {
                console.log(" Токен невалиден");
            }

            return null;
        } finally {
            siteState.loadingFalse();
        }
    }
    const fetchActiveMissions = async ()=>{
        if (!userStore.isAuthenticated) {
            console.log("Пользователь не авторизован");
            return null;
        }
        siteState.loadingTrue();
        try {
            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]'
            )?.content;

            console.log(" Загрузка активных миссий...");

            const response = await fetch("/api/branches?onlyCompleted=0", {
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

            console.log("Статус ответа :", response.status);

            const contentType = response.headers.get("content-type");
            if (!contentType || !contentType.includes("application/json")) {
                const text = await response.text();
                console.error(
                    " Сервер  вернул не JSON:",
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
            activeMissions.value = data.items || data.products || data;

            console.log(" Элементы получены:", data);
            return data;
        } catch (error) {
            console.error(" Ошибка при получении активных миссий:", error);

            if (error.message.includes("401")) {
                console.log(" Токен невалиден");
            }

            return null;
        } finally {
            siteState.loadingFalse();
        }
    }
    const fetchPassedMissions = async ()=>{
        if (!userStore.isAuthenticated) {
            console.log("Пользователь не авторизован");
            return null;
        }
        siteState.loadingTrue();
        try {
            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]'
            )?.content;

            console.log(" Загрузка выполненных миссий...");

            const response = await fetch("/api/branches?onlyCompleted=1", {
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

            console.log("Статус ответа :", response.status);

            const contentType = response.headers.get("content-type");
            if (!contentType || !contentType.includes("application/json")) {
                const text = await response.text();
                console.error(
                    " Сервер  вернул не JSON:",
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
            completedMissions.value = data.items || data.products || data;

            console.log(" Элементы получены:", data);
            return data;
        } catch (error) {
            console.error(" Ошибка при получении выполненных миссий:", error);

            if (error.message.includes("401")) {
                console.log(" Токен невалиден");
            }

            return null;
        } finally {
            siteState.loadingFalse();
        }
    }
    const getMissionBranche = async (id) => {
        if (!userStore.isAuthenticated) {
            console.log("Пользователь не авторизован");
            return null;
        }
        siteState.loadingTrue();
        try {
            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]'
            )?.content;

            console.log(" Загрузка списока миссий ветки ...");

            const response = await fetch(`/api/branches/${id}/missions`, {
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

            console.log("Статус ответа :", response.status);

            const contentType = response.headers.get("content-type");
            if (!contentType || !contentType.includes("application/json")) {
                const text = await response.text();
                console.error(
                    " Сервер  вернул не JSON:",
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
            missionBranchData.value = data;

            console.log(" Элементы списока миссий ветки:", data);
            return data;
        } catch (error) {
            console.error(" Ошибка при получении список миссий ветки:", error);

            if (error.message.includes("401")) {
                console.log(" Токен невалиден");
            }

            return null;
        } finally {
            siteState.loadingFalse();
        }
        
    }

    return{
        allMissions,
        activeMissions,
        completedMissions,
        missionBranchData,
        fetchActiveMissions,
        fetchAllMissions,
        fetchPassedMissions,
        getMissionBranche
    }
})