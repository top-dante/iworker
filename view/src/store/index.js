import { createStore } from 'vuex'

export default createStore({
  state: {
    token:undefined,
    group_id:undefined,
    uid:undefined
  },
  getters:{
    getToken(state){
      return state.token
    },
    getGroupId(state){
      return state.group_id
    },
    getUid(state){
      return state.uid
    }
  },
  mutations: {
    setToken(state,token){
      state.token = token
    },
    setGroupId(state,groupId){
      state.group_id = groupId
    },
    setUid(state,uid){
      state.uid = uid
    }
  },
  actions: {
  },
  modules: {
  }
})
