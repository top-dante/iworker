import axios from 'axios'

const baseURL = {
    dev:'http://localhost/api/',
    pro:'https://api.ritaoa.com/'
}
const config = {
  baseURL: baseURL.dev,
  timeout: 60000,
  headers:{
    post:{'Content-Type':'application/x-www-form-urlencoded'}
  }
}
const instance  = axios.create(config);

export function getToken(){
    return localStorage.getItem('token') ||
        sessionStorage.getItem('token') || null
}
/**
 * 请求拦截
 */
instance.interceptors.request.use(
    function(config) {
        config.headers.common.Authorization = getToken()
      // Do something before request is sent
      return config;
    },
    function(error) {
      // Do something with request error
      return Promise.reject(error);
    }
  );

/**
 * 回调拦截
 */
instance.interceptors.response.use(
    function(response) {
      return response.data;
    },
    function(error) {
      return Promise.reject(error);
    }
  );

export function apiGet(url, params = {}){
    return new Promise((resolve,reject)=>{
        instance.get(url,{
            params:params
        })
        .then((response)=>{
            resolve(response)
        })
        .catch((err)=>{
            reject(err)
        })
    })
}
export function apiPost(url,data){
    return new Promise((resolve,reject)=>{
        instance.post(url,data)
        .then((response)=>{
            return resolve(response)
        })
        .catch((err)=>{
            reject(err)
        })
    })
}

