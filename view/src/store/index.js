import { createStore } from 'vuex'

export default createStore({
  state: {
    token:undefined,
    group_id:undefined,
    uid:undefined,
    team:[]
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
    },
    team(state){
      if(state.list){
        return  state.list
      }else {
        let team = localStorage.getItem('team')
        if(team){
          return JSON.parse(team)
        }
      }
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
    },
    team(state,data){
      state.list = data
      localStorage.setItem('team',JSON.stringify(data))
    }
  },
  actions: {
  },
  modules: {
  }
})
