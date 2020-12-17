<template>
    <section class="wrapper">
        <Header title="项目管理" :bread-crumb="['项目管理','项目列表']"/>
        <div class="wrapper-content">
            <CreateProject/>
            <CreateQuoted/>
            <ProjectList/>
        </div>
    </section>
</template>

<script>
    import CreateProject from "./components/CreateProject";
    import CreateQuoted from "./components/CreateQuoted";
    import Header from "../../components/Header";
    import ProjectList from "./components/ProjectList";

    export default {
        name: "Project",
        components:{
            CreateProject,CreateQuoted,Header, ProjectList
        }
    }
</script>

<style scoped>

</style>