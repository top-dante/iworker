import {request} from "@/plugins/request";
import {notice} from "@/plugins/utils";


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

/**
 * 获取团队信息
 * @returns {string|any}
 */
export function getGroupList() {
   return request.get('member/get_group_list', {uid: request.uid()})
}

/**
 * 根据groupId获取部门列表
 * @returns {string|any}
 */
export function getDepartmentList() {
    return request.get('member/get_department_list', {group_id: request.groupId()})
        .then((r) => {
            return r.data
        }).catch((e) => {
            notice(500, e.message)
        })
}

export function delDepartment(id) {
    request.get('member/del_department', {
        depart_id: id
    }).then((res) => {
        console.log(res)
    })
}