<template>
    <a-button :style="{marginLeft:'12px'}">
        <template #icon><PlusOutlined/></template>
        新建报价
    </a-button>
</template>

<script>

    import {PlusOutlined} from '@ant-design/icons-vue'
    export default {
        name: "CreateQuoted",
        components:{
            PlusOutlined
        }
    }
</script>

<style scoped>

</style>