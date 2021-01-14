<template>
    <router-link to="/" class="brand">
      <img class="logo" src="../assets/brand/brand_blue.svg">
      <span class="title">Rita</span>
      <span class="tag">CRM</span>
    </router-link>
</template>

<script>
    export default {
        name: "Brand"
    }
</script>

<style scoped>
    .brand {
      height:50px;
      padding: 0 28px;
      line-height: 50px;
      margin-bottom: 10px;
      display: block;
      vertical-align: middle;
      overflow: hidden;
    }
    .brand .logo {
      width: 32px;
      vertical-align: -6px;
    }
    .title {
      color: rgba(255,255,255,.85);
      font-size: 24px;
    }
    .tag {
      display: inline-block;
      padding: 2px 6px;
      height: 20px;
      line-height: 16px;
      margin-left: 4px;
      background: linear-gradient(45deg,#000c17,#000000);
      border-radius: 40px 40px 40px 0;
      font-size: 12px;
      vertical-align: 2px;
      color: rgba(255,255,255,.25);
    }
    /*菜单收起状态*/
    .ant-layout-sider-collapsed .brand {
      padding:7px 0;
      text-align: center;
    }
    .ant-layout-sider-collapsed .brand>span {
      display: none;
      opacity: 0;
    }
    .brand:hover{
      background-color: #000c17;
      transition-duration: .4s;
    }
</style>