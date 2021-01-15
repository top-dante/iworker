import {request} from "@/plugins/request";

const apiUrl ={
    list:'department/index',
    create:'department/create',
    update:'department/update',
    read:'department/read',
    delete:'department/delete'
}

/**
 * 创建
 * @param data
 * @returns {*}
 */
export function create(data){
    return request.post(apiUrl.create,data)
}
//更新
export function update(data){
    return request.post(apiUrl.update,data)
}

//列表
export function list(){
    return request.get(apiUrl.list,{group_id:request.groupId()})
}
//读取成员信息
export function getMember(params){
    return request.get(apiUrl.read,params)
}
//删除成员
export function del(params){
    return request.get(apiUrl.delete,params)
}