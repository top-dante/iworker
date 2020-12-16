<template>
    <span>
        <a-button type="primary">
            <template #icon><PlusOutlined/></template>
            添加项目
        </a-button>
    </span>
</template>

<script>
    import {PlusOutlined} from '@ant-design/icons-vue'
    export default {
        name: "CreateProject",
        components:{
            PlusOutlined
        }
    }
</script>

<style scoped>

</style>