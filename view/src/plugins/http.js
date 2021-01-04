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
/**
 * 请求拦截
 */
instance.interceptors.request.use(
    function(config) {
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
      // Do something with response data
      return response;
    },
    function(error) {
      // Do something with response error
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
