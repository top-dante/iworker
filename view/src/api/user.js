import {request} from "@/plugins/request";
import {notice} from "@/plugins/utils";
import router from "@/router";


/**
 * 用户登录
 * @param data
 * @param remember
 */
export function login(data,remember){
    request.post('account/login',data)
        .then((r)=>{
            notice(r.code,r.msg)
            if(r.code === 200){
                if(remember){
                    localStorage.setItem('token',r.data.token)
                    localStorage.setItem('user',JSON.stringify(r.data))
                    localStorage.setItem('uid',r.data.uid)
                }else {
                    sessionStorage.setItem('token',r.data.token)
                    sessionStorage.setItem('user',JSON.stringify(r.data))
                    sessionStorage.setItem('uid',r.data.uid)
                }
                setTimeout(()=>{
                    router.push('/')
                },3000)
            }
        }).catch((err)=>{
            notice(500,err)
    })
}

/**
 * 用户注册
 */
export function register(data){
    request.post('account/register',data)
        .then((res)=>{
            notice(res.code,res.msg)
            if(res.code === 200){
                router.push('/user/login')
            }
        }).catch((e)=>{
            notice(500,e)
    })
}
/**
 * 获取用户信息
 * @returns {null|any}
 */
export function getUserInfo(){
    let user = localStorage.getItem('user')
        || sessionStorage.getItem('user')
    if (!user) {
        return null
    } else {
        return JSON.parse(user)
    }
}

/**
 * 获取用户uid
 * @returns {*}
 */
export function getUserId(){
   let userInfo = getUserInfo()
    return userInfo.uid
}