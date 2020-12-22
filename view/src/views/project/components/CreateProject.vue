<template>
    <span>
        <a-button type="primary" @click="visible=true">
            <template #icon><PlusOutlined/></template>
            添加项目
        </a-button>
        <a-modal :visible="visible"
                 :width="360"
                 title="快速添加项目"
                 @ok="handleOk"
                 @cancel="close">
            <a-input placeholder="请输入项目名称"/>
        </a-modal>
    </span>
</template>

<script>
    import {PlusOutlined} from '@ant-design/icons-vue'
    export default {
        name: "CreateProject",
        components:{
            PlusOutlined
        },
        data(){
            return {
                visible:false
            }
        },
        methods:{
            handleOk(){

            },
            close(){
                this.visible = false
            }
        }
    }
</script>

<style scoped>

</style>