<template>
    <div class="list">
        <a-row :gutter="20">
            <a-col :span="6" v-for="item in list" :key="item.id">
                <a-card hoverable>
                    <template #cover>
                        <img :src="item.cover" alt="">
                    </template>
                    <a-card-meta :title="item.title">
                        <template #description>
                            {{item.create_time}}
                            <a-avatar size="small"/>
                        </template>
                    </a-card-meta>
                </a-card>
            </a-col>
        </a-row>
    </div>
</template>

<script>
    export default {
        name: "ProjectList",
        data(){
            return {
                list:[]
            }
        },
        created(){
            this.getList()
        },
        methods:{
            async getList(){
                for (let i=0;i<16;i++){
                    this.list.push({id:i+1,
                        title:'项目名称'+i,
                        cover:'http://daily.pe666.cn/assets/cover/1590673460.jpg',
                        create_time:'2020-12-18',
                        team:''})
                }
            }
        }
    }
</script>

<style scoped>
    .list {
        margin-top: 20px;
    }
    .cover {
        background-color: #f0f0f0;
        height: 160px;
    }
    >>> .ant-card-hoverable:hover{
        cursor: default;
    }
    >>> .ant-card{
        margin-bottom: 20px;
    }
    >>> .ant-card-cover {
        height: 160px;
        overflow: hidden;
    }
</style>