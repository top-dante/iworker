import {request} from "@/plugins/request";

const apiUrl ={
    create:'member/create_member',
    update:'member/update',
    list:'member/index',
    get:'member/read',
    delete:'member/delete',
    rest:'member/rest'
}

//创建
export function create(data){
    return request.post(apiUrl.create,data)
}
//更新
export function update(data){
    return request.post(apiUrl.update,data)
}

//列表
export function list(params){
    return request.get(apiUrl.list,params)
}
//成员禁用
export function rest(params){
    return request.get(apiUrl.rest,params)
}
//读取成员信息
export function getMember(params){
    return request.get(apiUrl.get,params)
}
//删除成员
export function del(params){
    return request.get(apiUrl.delete,params)
}