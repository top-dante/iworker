import { createRouter, createWebHashHistory } from 'vue-router'
import Layout from '../views/Layout.vue'

const routes = [
  {
    path: '',
    name: '',
    component: Layout,
    children:[
      {path:'/',name:'Home',component: ()=>import('../views/Home')},
      {path:'/tasks',name:'Tasks',component: ()=>import('../views/tasks/Index')},
      {path:'/project',name:'Project',component: ()=>import('../views/project/Index')},
      {path:'/plans',name:'Plus',component: ()=>import('../views/plans/Index')},
      {path:'/finance',name:'Finance',component: ()=>import('../views/finance/Index')},
      {path:'/products',name:'Products',component: ()=>import('../views/products/Index')},
      {path:'/crm',name:'Crm',component: ()=>import('../views/crm/Index')},
      {path:'/member',name:'Member',component: ()=>import('../views/member/Index')},
      {path:'/setting',name:'Setting',component: ()=>import('../views/setting/Index')}
    ]
  },
  {
    path:'/user',
    redirect:'/user/login',
    name:'User',
    component: ()=>import('../views/user/Index'),
    children: [
      { path:'login',name:'Login',component: ()=>import('../views/user/Login')},
      { path:'register',name:'Register',component: ()=>import('../views/user/Register')},
      { path:'recover',name:'Recover',component: ()=>import('../views/user/Recover')},
    ]
  },

];

const router = createRouter({
  history: createWebHashHistory(),
  routes
});

export default router
