import { createRouter, createWebHashHistory } from 'vue-router'
import Layout from '../views/Layout.vue'

const routes = [
  {
    path: '',
    name: '',
    component: Layout,
    children:[
      {path:'/',name:'Home',components: ()=>import('../views/Home')},
      {path:'/tasks',name:'Tasks',components: ()=>import('../views/tasks/Index')},
      {path:'/project',name:'Project',components: ()=>import('../views/project/Index')},
      {path:'/finance',name:'Finance',components: ()=>import('../views/finance/Index')},
      {path:'/products',name:'Products',components: ()=>import('../views/products/Index')},
      {path:'/crm',name:'Crm',components: ()=>import('../views/crm/Index')},
      {path:'/member',name:'Member',components: ()=>import('../views/member/Index')},
    ]
  }
];

const router = createRouter({
  history: createWebHashHistory(),
  routes
});

export default router
