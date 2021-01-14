import axios from 'axios'
import qs from 'qs'
import {notice} from "@/plugins/utils";

const baseURL = {
    dev: 'http://localhost/api/',
    pro: 'https://api.ritaoa.com/'
}
const config = {
    baseURL: baseURL.dev,
    timeout: 60000,
    headers: {
        post: {'Content-Type': 'application/x-www-form-urlencoded'}
    }
}
const instance = axios.create(config);

function getToken() {
    return localStorage.getItem('token') ||
        sessionStorage.getItem('token') || null
}

/**
 * 请求拦截
 */
instance.interceptors.request.use(
    function (config) {
        config.headers.common.Authorization = getToken()
        return config;
    },
    function (error) {
        return Promise.reject(error);
    }
);

/**
 * 回调拦截
 */
instance.interceptors.response.use(
    function (response) {
        if (response.data.code === 40001 || response.data.code === 40003) {
            return notice(500, response.data.msg)
        }
        return response.data;
    },
    function (error) {
        notice(500, error.message)
        return Promise.reject(error);
    }
);

//接口调用封装 常用用户参数获取
export const request = {
    uid() {
        return localStorage.getItem('uid') ||
            sessionStorage.getItem('uid')
    },
    groupId() {
        return localStorage.getItem('group_id')
    },
    get(url, data) {
        return instance.get(url, {params: data})
    },
    post(url, data) {
        return instance.post(url, qs.stringify(data))
    }
}