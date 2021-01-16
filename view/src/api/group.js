import {request} from "@/plugins/request";

/**
 * 获取当前团队信息
 * @returns {*[]|any}
 */
export function getGroup() {
    let group = localStorage.getItem('current_group')
    if (group) {
        return JSON.parse(group)
    } else {
        return []
    }
}

/**
 * 获取groupId
 * @returns {string|[{message: string, required}]|*}
 */
export function getGroupId() {
    return getGroup().group_id
}

//团队列表
export function list() {
    return request.get('member/get_group_list',
        {uid: request.uid()})
}
//创建团队
export function create(data){
    return request.post('member/create_group',data)
}
//更新团队信息
export function update(data){
    return request.post('member/update_group',data)
}
//删除团队
export function del(groupId){
    return request.get('member/delete_group',{group_id:groupId})
}


/**
 * 根据groupId获取部门列表
 * @returns {string|any}
 */
export function departmentList() {
    return request.get('member/get_department_list',
        {group_id: request.groupId()})
}

export function delDepartment(id) {
    return request.get('member/del_department',
        {depart_id: id})
}