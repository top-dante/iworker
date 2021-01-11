import axios from "@/plugins/axios";


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

/**
 * 获取团队信息 写入 localStorage 缓存
 * @param reload 刷新 true 默认false
 * @returns {string|any}
 */
export function getGroupList(reload) {
    let group = localStorage.getItem('group')
    if (reload || !group) {
        axios.get('/member/get_group_list', {uid: this.getUid()})
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