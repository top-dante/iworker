<template>
    <div class="pagination">
        <a-pagination
                show-size-changer
                v-model:current="current"
                v-model:pageSize="pageSize"
                :total="total"
                :show-total="total => `共 ${total} 条记录`"
                @showSizeChange="onShowSizeChange"
        >
            <template #itemRender="{type, originalElement }">
                <a-button v-if="type === 'prev'">上一页</a-button>
                <a-button v-else-if="type === 'next'">下一页</a-button>
                <renderVNode v-else :vnode="originalElement"></renderVNode>
            </template>
        </a-pagination>
    </div>

</template>

<script>
    function renderVNode(_, { attrs: { vnode } }) {
        return vnode;
    }
    export default {
        name: "Pagination",
        props:{
            total:{
                type:Number,
                default:0
            }
        },
        components: {
            renderVNode,
        },
        data(){
            return {
                current:1,
                pageSize: 20,
            }
        },
        methods:{
            onShowSizeChange(current, pageSize) {
                console.log(current, pageSize);
            }
        }
    }
</script>

<style scoped>
    .pagination {
        padding: 30px 0;
        text-align: center;
    }
</style>