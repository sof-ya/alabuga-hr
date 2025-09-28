import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

export const useUserStore = defineStore('user', () => {
  const user = ref(null)
  const token = ref(localStorage.getItem('auth_token'))


  const isAuthenticated = computed(() => {
    if (!token.value) return false

    try {
      const payload = JSON.parse(atob(token.value.split('.')[1]))
      const isExpired = payload.exp * 1000 < Date.now()
      return !isExpired
    } catch {
      return false
    }
  })

  const setUser = (userData) => {
    user.value = userData
  }

  const setToken = (authToken) => {
    token.value = authToken
    localStorage.setItem('auth_token', authToken)
  }

  const logout = () => {
    user.value = null
    token.value = null
    localStorage.removeItem('auth_token')
  }

  const checkAuth = () => {
    if (!isAuthenticated.value) {
      logout()
    }
  }

  return {
    user,
    token,
    isAuthenticated,
    setUser,
    setToken,
    logout,
    checkAuth
  }
})