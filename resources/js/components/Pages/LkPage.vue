<template>
    <LkLayout>
        LkPage
        <button @click="logOut">LogOut</button>
    </LkLayout>

</template>

<script setup>
import { ref } from 'vue';
import LkLayout from '../Layout/LkLayout.vue';
import { useUserStore } from '../../store/UserStore';
import { useRouter } from 'vue-router';
const loading = ref(false)
const userStore = useUserStore()
const router = useRouter()
const logOut = async () => {
    if (!confirm('Вы уверены, что хотите выйти?')) {
        return
    }

    loading.value = true

    try {

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content

        const response = await fetch('/api/auth/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                ...(csrfToken && { 'X-CSRF-TOKEN': csrfToken }),
                ...(userStore.token && { 'Authorization': `Bearer ${userStore.token}` })
            }
        })

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`)
        }

        userStore.logout()

        await router.push('/divorce')

    } catch (error) {
        console.error('Logout error:', error)

        userStore.logout()
        await router.push('/divorce')
    } finally {
        loading.value = false
    }
}

</script>