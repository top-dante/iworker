<template>
    <a-menu theme="dark"
            @click="onClick"
            v-model:selectedKeys="current">
        <a-menu-item v-for="item in list" :key="item.path">
            <router-link :to="item.path">
                <component class="menu-icon" :is="item.icon" /><span>{{item.title}}</span>
            </router-link>
        </a-menu-item>
    </a-menu>
</template>

<script>
    import {
        DesktopOutlined,
        ProjectOutlined,
        PropertySafetyOutlined,
        TeamOutlined,
        ScheduleOutlined,
        ContactsOutlined,
        CheckCircleOutlined,
        GiftOutlined
    } from  '@ant-design/icons-vue'

    export default {
        name: "Menu",
        components:{
            DesktopOutlined,
            ProjectOutlined,
            PropertySafetyOutlined,
            TeamOutlined,
            ScheduleOutlined,
            ContactsOutlined,
            GiftOutlined,
            CheckCircleOutlined
        },
        data(){
            return {
                current:[],
                list: [
                    {title: '工作台', path: '/',icon:'DesktopOutlined'},
                    {title: '任务管理', path: '/tasks',icon:'CheckCircleOutlined'},
                    {title: '项目管理', path: '/project',icon:'ProjectOutlined'},
                    {title: '工作计划', path: '/plans',icon:'ScheduleOutlined'},
                    {title: '账务管理', path: '/finance',icon:'PropertySafetyOutlined'},
                    {title: '产品库', path: '/products',icon:'GiftOutlined'},
                    {title: '客户CRM', path: '/crm',icon:'ContactsOutlined'},
                    {title: '团队成员', path: '/member',icon:'TeamOutlined'}
                ]
            }
        },
        created(){
            //菜单刷新定位
            let keyPath = localStorage.getItem('menuKeyPath') || [];
            if (keyPath.length >0){
                this.current = JSON.parse(keyPath);
                this.$router.push(this.current[0])
            }
        },
        methods:{
            //菜单点击返回keyPath 用于刷新定位
            onClick({keyPath }){
                this.current = keyPath;
                localStorage.setItem('menuKeyPath',JSON.stringify(keyPath))
            }
        }
    }
</script>

<style scoped>
    .menu-icon {
        font-size: 16px;
        vertical-align: -3px;
    }
    .ant-menu >>> .ant-menu-item{
        padding-left: 28px;
    }
    .ant-menu-inline-collapsed {
        width: auto;
    }
    .ant-menu-inline-collapsed > .ant-menu-item{
        padding: 0 !important;
        text-align: center;
        width: 50px;
    }
</style>