<template>
    <a-layout :style="{minHeight:'100vh'}">
        <a-layout-header class="header">
        </a-layout-header>
        <a-layout-content class="container">
           <router-view/>
        </a-layout-content>
    </a-layout>
</template>
<script>
    export default {
        data(){
            return {
                collapsed: false,
            }
        }
    }
</script>
<style scoped>
    .header {
        height: 48px;
        line-height: 48px;
        box-shadow: 0 2px 8px #f0f1f2;
        position: relative;
        padding: 0 50px;
    }
    .container {
        padding: 0 100px;
        min-height: 280px;
    }
</style>
