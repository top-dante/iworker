import {createStore} from 'vuex'

export default createStore({
    state:{
        gid:undefined
    },
    getters:{
        gid(state){
            return state.gid
        }
    },
    mutations:{
        gid(state,gid){
            state.gid = gid
        }
    }
})