<template>
    <a-table :columns="columns"
             :row-selection="{
                selectedRowKeys: selectedRowKeys,
                onChange: onSelectChange }"
             row-key="id"
             :pagination="false"
             :data-source="list">
<!--date-->
        <template #date="{record}">
           {{record.create_time}} ~ {{record.deadline}}
        </template>
<!--status-->
        <template #status="{ record }">
            <template v-if="record.status === 0">
                <a-tag color="red">待处理</a-tag>
            </template>
            <template v-else-if="record.status === 1">
                <a-tag color="blue">进行中</a-tag>
            </template>
            <template v-else-if="record.status === 2">
                <a-tag color="green">已完成</a-tag>
            </template>
        </template>
<!--action-->
        <template #actions>
            <a-button size="small" type="primary" :style="{marginRight:'8px'}">
                <template #icon><ProfileOutlined/></template>详情
            </a-button>
            <a-dropdown>
                <a-button size="small">更多<DownOutlined :style="{fontSize:'12px'}"/></a-button>
                <template #overlay>
                    <a-menu>
                        <a-menu-item><PlusSquareOutlined/>添加任务</a-menu-item>
                        <a-menu-item><FileSyncOutlined/>进度修改</a-menu-item>
                        <a-menu-item><BarsOutlined/>报价清单</a-menu-item>
                        <a-menu-divider/>
                        <a-menu-item><FormOutlined/>编辑</a-menu-item>
                        <a-menu-item><DeleteOutlined/>删除</a-menu-item>
                    </a-menu>
                </template>
            </a-dropdown>
        </template>
    </a-table>
</template>

<script>
    import {
        ProfileOutlined,
        FileSyncOutlined,
        PlusSquareOutlined,
        DownOutlined,
        FormOutlined,
        DeleteOutlined,
        BarsOutlined
    } from '@ant-design/icons-vue'
    export default {
        name: "ProjectList",
        components:{
            ProfileOutlined,
            FileSyncOutlined,
            PlusSquareOutlined,
            DownOutlined,
            FormOutlined,
            DeleteOutlined,
            BarsOutlined,
        },
        setup(){
            const columns=[
                {title:'项目名称',key:'title',dataIndex:'title'},
                {title:'参与成员',slots:{customRender:'team'},width:'240px'},
                {title:'时间',slots:{customRender:'date'} ,width:'200px'},
                {title:'状态',dateIndex:'status',slots: {customRender: 'status'},width: '100px'},
                {title:'管理',slots: {customRender: 'actions'},width:'200px'}
            ];
            return {
                columns
            }
        },
        data(){
            return {
                list:[],
                selectedRowKeys:[]
            }
        },
        created(){
            this.getProjectList()
        },
        methods:{
            async getProjectList(){
                for (let i=0;i<16;i++){
                    this.list.push({
                        id:i+1,
                        title:'项目名称'+i,
                        create_time:'2020-12-18',
                        deadline:'2020-12-26',
                        status:Math.ceil(i%2),
                        team:''})
                }
            },
            onSelectChange(selectedRowKeys){
               this.selectedRowKeys = selectedRowKeys
            }
        }
    }
</script>

<style scoped>
</style>