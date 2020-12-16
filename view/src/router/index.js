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
      {path:'/finance',name:'Finance',component: ()=>import('../views/finance/Index')},
      {path:'/products',name:'Products',component: ()=>import('../views/products/Index')},
      {path:'/crm',name:'Crm',component: ()=>import('../views/crm/Index')},
      {path:'/member',name:'Member',component: ()=>import('../views/member/Index')},
    ]
  }
];

const router = createRouter({
  history: createWebHashHistory(),
  routes
});

export default router
