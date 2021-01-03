import axios from 'axios'

const baseURL = {
    dev:'http://localhost/api/',
    pro:'https://api.ritaoa.com/'
}
const instance  = axios.create({
    baseURL: baseURL.dev,
    timeout: 60000

});
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

    export function get(url, params = {}){
        return new Promise((resolve,reject)=>{
            instance
            .get(url,{
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
    export function post(url,data){
        return new Promise((resolve,reject)=>{
            instance
            .post(url,data)
            .then((response)=>{
                return resolve(response)
            })
            .catch((err)=>{
                reject(err)
            })
        })
    }

