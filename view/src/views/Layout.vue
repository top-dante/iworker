<template>
    <a-layout :style="{minHeight:'100vh'}">
        <a-layout-sider
			:collapsedWidth="50"
			v-model:collapsed="collapsed">
            <Brand/>
            <Menu/>
        </a-layout-sider>
        <a-layout>
            <a-layout-header class="header">
                <div :style="{flex:1}">
                    <menu-unfold-outlined
                            v-if="collapsed"
                            class="trigger"
                            @click="() => (collapsed = !collapsed)"
                    />
                    <menu-fold-outlined v-else class="trigger" @click="() => (collapsed = !collapsed)" />
                </div>
                <TopRight/>
            </a-layout-header>
            <a-layout-content>
                <router-view/>
            </a-layout-content>
        </a-layout>
    </a-layout>
</template>
<script>
    import Menu from "../components/Menu";
    import Brand from "../components/Brand";
    import TopRight from '../components/TopRight'
    import {MenuUnfoldOutlined, MenuFoldOutlined,} from '@ant-design/icons-vue';
    export default {
        components:{
            Menu,
            Brand,
            MenuUnfoldOutlined,
            MenuFoldOutlined,
            TopRight
        },
        data(){
            return {
                collapsed: false,
            }
        }
    }
</script>
<style scoped>
    .header {
        background: #fff;
        height: 50px;
        line-height: 50px;
        box-shadow: 0 2px 8px #f0f1f2;
        position: relative;
        padding: 0 24px 0 0;
        display: flex;
    }
    .trigger {
        font-size: 18px;
        line-height: 50px;
        padding: 0 20px;
        cursor: pointer;
        transition: color 0.3s;
    }

    .trigger:hover {
        color: #1890ff;
    }

</style>
