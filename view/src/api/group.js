import axios from "@/plugins/axios";
import {getUserId} from "@/api/user";
import {notice} from "@/plugins/utils";


/**
 * 获取当前团队信息
 * @returns {*[]|any}
 */
export function getGroup()
{
    let group = localStorage.getItem('current_group')
    if (group) {
        return JSON.parse(group)
    } else {
        return []
    }
}
export function getGroupId(){
    return getGroup().group_id
}

/**
 * 获取团队信息 写入 localStorage 缓存
 * @param reload 刷新 true 默认false
 * @returns {string|any}
 */
export function getGroupList(reload) {
    let group = localStorage.getItem('group')
    if (reload || !group) {
        axios.get('member/get_group_list', {uid: getUserId()})
            .then((res) => {
                group = res.data
                localStorage.setItem('group', JSON.stringify(res.data))
                localStorage.setItem('current_group', JSON.stringify(res.data[0]))
            })
        return group;
    } else {
        return JSON.parse(group)
    }
}

/**
 * 根据groupId获取部门列表
 * @param reload
 * @returns {string|any}
 */
export function getDepartmentList(reload){
    let department = localStorage.getItem('department')
    if(reload || !department){
        let group = getGroup();
        axios.get('member/get_department_list',{group_id:group.group_id})
            .then((r)=>{
                department = r.data
                localStorage.setItem('department',JSON.stringify(r.data))
            }).catch((e)=>{
                notice(500,e.message)
        })
        return department;
    }
    return JSON.parse(department)
}