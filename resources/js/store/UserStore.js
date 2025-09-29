import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import { useSiteState } from './SiteState'
export const useUserStore = defineStore('user', () => {
  const user = ref(null)
  const token = ref(localStorage.getItem('auth_token'))
  const siteState = useSiteState()

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

  const fetchUser = async () => {
    if (user.value) {
      console.log('Данные пользователя уже в store:', user.value)
      return user.value
    }

    if (!token.value) {
      console.log('Токен отсутствует')
      return null
    }

    siteState.loadingTrue()

    try {
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
      
      console.log('Отправка запроса на /api/auth/me...')
      
      const response = await fetch('/api/auth/me', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          ...(csrfToken && { 'X-CSRF-TOKEN': csrfToken }),
          'Authorization': `Bearer ${token.value}`
        },
        credentials: 'include' 
      })

      const contentType = response.headers.get('content-type')
      if (!contentType || !contentType.includes('application/json')) {
        const text = await response.text()
        console.error('Сервер вернул не JSON:', text.substring(0, 200))
        throw new Error(`Сервер вернул HTML вместо JSON. Status: ${response.status}`)
      }

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
      }
      const userData = await response.json()
      

      user.value = userData
      
      console.log('Данные пользователя получены:', userData)
      return userData

    } catch (error) {
      console.error('Ошибка при получении данных пользователя:', error)
      
      if (error.message.includes('401')) {
        console.log('Токен невалиден, выполняем logout')
        logout()
      }
      
      return null
    } finally {
      siteState.loadingFalse()
    }
  }


  return {
    user,
    token,
    isAuthenticated,
    setUser,
    setToken,
    logout,
    checkAuth,
    fetchUser
  }
})