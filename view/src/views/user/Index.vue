<template>
  <a-layout :style="{minHeight:'100vh'}">
    <a-layout-header class="header"></a-layout-header>
    <a-layout-content>
      <router-view/>
    </a-layout-content>
    <a-layout-footer style="text-align: center">
      <div class="links">
        <a href="javascript:;">帮助</a>
        <a href="javascript:;">隐私</a>
        <a href="javascript:;">条款</a>
      </div>
      Copyright ©2021 RitaCRM
      <a-divider type="vertical"/>
      ICP备案：xxxxxxxx
      <a-divider type="vertical"/>
      公安网备：xxxxx
    </a-layout-footer>
  </a-layout>
</template>

<script>
export default {
  name: "Index"
}
</script>

<style scoped>
.header {
  background-color: rgba(255, 255, 255, .8);
  height: 50px;
  line-height: 50px;
  backdrop-filter: blur(8px);
  border-bottom: 1px solid #f0f0f0;
}
.links {
  margin-bottom: 12px;
}
.links>a {
  color: rgba(0,0,0,.55);
  margin: 0 15px;
}
</style>