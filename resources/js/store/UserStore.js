import { defineStore } from "pinia";
import { ref } from "vue";

export const useUserStore = defineStore('user',()=>{
    const user = ref(null)
    const token = ref(!!localStorage.getItem('auth_token'))
    const isAuthenticated = ref(!!localStorage.getItem('auth_token'))

    const setUser = (userData) =>{
        user.value = userData
    }
    const setToken = (authToken) =>{
        token.value = authToken
        isAuthenticated.value = true
        localStorage.setItem('auth_token', authToken)
    }
    const logout = () => {
        user.value = null
        token.value = null
        isAuthenticated.value = false
        localStorage.removeItem('auth_token')
    }
    return {
        user,
        token,
        isAuthenticated,
        setUser,
        setToken,
        logout
    }
})