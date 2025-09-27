import { defineStore } from 'pinia'

export const useSiteState = defineStore('siteStates', {
  state: () => ({
    sidebarState: true,
    errorText: '' ,
    sucsesMessage: '' ,
    userList: null ,
    loading:false
  }),
  getters: {
    getSidebarState: (state) => state.sidebarState,
    getErrorText: (state) => state.errorText,
    getsucsesMessage: (state) => state.sucsesMessage
  },
  actions: {
    loadingFalse() {
      this.loading = false
    },
    loadingTrue() {
      this.loading = true
    },
    toggleSidebarState() {
      this.sidebarState = !this.sidebarState
    },
    cleanTextError() {
      this.errorText = ''
    },
    cleanSucsessText() {
      this.sucsesMessage = ''
    },
    setUserList(data) {
      this.userList = data
    },
    deleteUserById(id) {
      this.userList = this.userList.filter(user => user.id !== id)
    },
    cleanMessages(){
      this.errorText = ''
      this.sucsesMessage =''
    }
    },
  })