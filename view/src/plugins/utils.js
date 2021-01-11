import {message} from 'ant-design-vue'

/**
 * 全局消息提醒
 * @param code
 * @param msg
 */
export function notice(code, msg) {
    switch (code) {
        case 500:
            message.error(msg);
            break;
        case 200:
            message.success(msg);
            break;
        default:
            message.warn(msg)
    }
}
/**
 * 生成随机数
 * @param len
 * @returns {string}
 */
export function random(len) {
    const chars = 'abcdefghilmnopqrstwuxyz1234567890';
    let maxPos = chars.length;
    if (!len) {
        len = 16
    }
    let hash = '';
    for (let i = 0; i < len; i++) {
        hash += chars.charAt(Math.floor(Math.random() * maxPos));
    }
    return hash
}