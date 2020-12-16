<template>
    <section class="wrapper">
        <div class="wrapper-header">
            <a-breadcrumb>
                <a-breadcrumb-item><router-link to="/">工作台</router-link></a-breadcrumb-item>
                <a-breadcrumb-item>项目管理</a-breadcrumb-item>
                <a-breadcrumb-item>项目列表</a-breadcrumb-item>
            </a-breadcrumb>
            <div class="wrapper-header-title">项目管理</div>
        </div>
        <div class="wrapper-content">
            <CreateProject/>
            <CreateQuoted/>
        </div>

    </section>
</template>

<script>
    import CreateProject from "./components/CreateProject";
    import CreateQuoted from "./components/CreateQuoted";
    export default {
        name: "Project",
        components:{
            CreateProject,CreateQuoted
        }
    }
</script>

<style scoped>

</style>