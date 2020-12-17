<template>
    <div class="wrapper">
        <Header title="待办事项" :bread-crumb="breadCrumb"/>
    </div>
</template>

<script>
    import Header from "../../components/Header";
    export default {
        name: "Index",
        components:{
            Header
        },
        data(){
            return {
                breadCrumb: ['任务管理','任务列表']
            }
        }
    }
</script>

<style scoped>

</style>