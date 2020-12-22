<template>
    <section class="wrapper">
        <Header title="项目管理" :bread-crumb="['项目管理','项目列表']"/>
        <div class="wrapper-content">
            <div class="toolbar">
                <div class="toolbar-item">
                    <CreateProject/>
                    <a-button :style="{marginLeft:'12px'}">
                        <template #icon><ExportOutlined /></template>
                        导出
                    </a-button>
                </div>
                <div class="toolbar-end">
                    <a-radio-group
                            v-model:value="status"
                            button-style="solid">
                        <a-radio-button :value="item.status"
                                        v-for="item in projectStatus"
                                        :key="item.status">
                            {{item.title}}
                        </a-radio-button>
                    </a-radio-group>
                    <a-select :style="{width: '120px',marginLeft: '12px'}"
                              placeholder="选择业务员">
                        <a-select-option value="jack">
                            全部业务员
                        </a-select-option>
                        <a-select-option value="lucy">
                            待处理
                        </a-select-option>
                        <a-select-option value="disabled" disabled>
                            进行中
                        </a-select-option>
                        <a-select-option value="Yiminghe">
                            已完成
                        </a-select-option>
                    </a-select>
                    <a-input-search
                            placeholder="请输入关键字查询"
                            :style="{width:'200px',margin:'0 12px'}"/>
                    <a-radio-group button-style="solid"
                                   @change="changeList"
                                   v-model:value="listType">
                        <a-radio-button value="card">
                            <AppstoreOutlined/>
                        </a-radio-button>
                        <a-radio-button value="list">
                            <BarsOutlined/>
                        </a-radio-button>
                    </a-radio-group>
                </div>
            </div>
            <component :is="isComponent"/>
            <Pagination/>
        </div>
    </section>
</template>

<script>
    import CreateProject from "./components/CreateProject";
    import Header from "../../components/Header";
    import ProjectCard from "./components/ProjectCard";
    import ProjectList from "./components/ProjectList";
    import Pagination from "../../components/Pagination";
    import {
        ExportOutlined,
        BarsOutlined,
        AppstoreOutlined
    } from '@ant-design/icons-vue'


    export default {
        name: "Project",
        components:{
            CreateProject,
            ProjectList,
            Header,
            ProjectCard,
            ExportOutlined,
            BarsOutlined,
            AppstoreOutlined,
            Pagination
        },
        data(){
            return {
                projectStatus:[
                    {status:0,title:'全部'},
                    {status:1,title:'待处理'},
                    {status:2,title:'进行中'},
                    {status:3,title:'已完成'}
                ],
                status:0,
                listType:'list',
                isComponent:'ProjectList'
            }
        },
        methods:{
            changeList({target}){
               if(target.value === 'card'){
                   this.isComponent = 'ProjectCard'
               } else {
                   this.isComponent = 'ProjectList'
               }
            }
        }
    }
</script>

<style scoped>

</style>