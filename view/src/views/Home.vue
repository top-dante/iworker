<template>
  <div class="wrapper" :style="{paddingTop:'30px'}">

  </div>
</template>
<script>
  export default {
    name:'Home',
    data(){
      return {
        menus:[
          {title: '工作台', path: '/',icon:'DesktopOutlined'},
          {title: '任务管理', path: '/tasks',icon:'ScheduleOutlined'},
          {title: '项目管理', path: '/project',icon:'ProjectOutlined'},
          {title: '账务管理', path: '/finance',icon:'PropertySafetyOutlined'},
          {title: '产品库', path: '/products',icon:'GiftOutlined'},
          {title: '客户CRM', path: '/crm',icon:'ContactsOutlined'},
          {title: '团队成员', path: '/member',icon:'TeamOutlined'}
        ]
      }
    }
  }
</script>
