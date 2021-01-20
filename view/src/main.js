import {createApp} from 'vue'
import Antd from 'ant-design-vue'
import App from './App.vue'
import router from './router'
import 'ant-design-vue/dist/antd.css'
import '@/assets/common.css'
import store from './store'

const documentTitle = 'RitaCRM-简单工作，快乐生活！';
const whiteRouter = ['/user/login', '/user/register', '/user/recover'];
/**
 * 登录判断
 */
router.beforeEach((to, from, next) => {
    document.title = documentTitle
    let token = sessionStorage.getItem('token') || localStorage.getItem('token')
    if (token) {
        next()
    } else {
        if (whiteRouter.indexOf(to.path) !== -1) {
            next()
        } else {
            next('/user/login')
        }
    }
})

const app = createApp(App)
app.use(store);
app.use(Antd);
app.use(router);
app.mount('#app');