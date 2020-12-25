<template>
  <div class="wrapper" :style="{paddingTop:'30px'}">
      <a-row :gutter="24">
        <a-col :span="4" v-for="item in menus" :key="item.path" :style="{marginBottom:'24px'}">
          <a-card :bordered="false">
            {{item.title}}
            <svg width="24" height="24" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><g><g><rect fill-opacity="0.01" fill="#FFFFFF" x="0" y="0" width="48" height="48" stroke-width="4" stroke="none" fill-rule="evenodd"/><polygon stroke="#f0f0f0" stroke-width="4" fill="#1890ff" fill-rule="nonzero" stroke-linejoin="round" points="12 33 4 33 4 7 44 7 44 33 36 33"/><path d="M16,22 L16,26" stroke="#FFF" stroke-width="4" stroke-linecap="butt" stroke-linejoin="round" fill="none" fill-rule="evenodd"/><path d="M24,33 L24,39" stroke="#f0f0f0" stroke-width="4" stroke-linecap="butt" stroke-linejoin="round" fill="none" fill-rule="evenodd"/><path d="M24,18 L24,26" stroke="#FFF" stroke-width="4" stroke-linecap="butt" stroke-linejoin="round" fill="none" fill-rule="evenodd"/><path d="M32,14 L32,26" stroke="#FFF" stroke-width="4" stroke-linecap="butt" stroke-linejoin="round" fill="none" fill-rule="evenodd"/><path d="M12,41 L36,41" stroke="#f0f0f0" stroke-width="4" stroke-linecap="butt" stroke-linejoin="round" fill="none" fill-rule="evenodd"/></g></g></svg>
            <svg width="24" height="24" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><g><g><rect fill-opacity="0.01" fill="#FFFFFF" x="0" y="0" width="48" height="48" stroke-width="4" stroke="none" fill-rule="evenodd"/><polygon stroke="#333" stroke-width="4" fill="#2F88FF" fill-rule="nonzero" stroke-linejoin="round" points="12 33 4 33 4 7 44 7 44 33 36 33"/><path d="M16,22 L16,26" stroke="#FFF" stroke-width="4" stroke-linecap="butt" stroke-linejoin="round" fill="none" fill-rule="evenodd"/><path d="M24,33 L24,39" stroke="#333" stroke-width="4" stroke-linecap="butt" stroke-linejoin="round" fill="none" fill-rule="evenodd"/><path d="M24,18 L24,26" stroke="#FFF" stroke-width="4" stroke-linecap="butt" stroke-linejoin="round" fill="none" fill-rule="evenodd"/><path d="M32,14 L32,26" stroke="#FFF" stroke-width="4" stroke-linecap="butt" stroke-linejoin="round" fill="none" fill-rule="evenodd"/><path d="M12,41 L36,41" stroke="#333" stroke-width="4" stroke-linecap="butt" stroke-linejoin="round" fill="none" fill-rule="evenodd"/></g></g></svg>
          </a-card>
        </a-col>
      </a-row>
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
