<template>
  <div class="wrapper">
    <Header title="全局设置" :bread-crumb="['全局设置','设置中心']"/>
  </div>
</template>

<script>
import Header from "@/components/Header";
export default {
  name: "Index",
  components:{
    Header
  },
  created(){
    localStorage.setItem('menuKeyPath',JSON.stringify(['/setting']))
  }
}
</script>

<style scoped>

</style>