<template>
    <span>
      <a-button type="dashed"
                @click="visible = true">
        <template #icon><PlusOutlined/></template>
        创建团队</a-button>
      <a-modal :visible="visible"
               title="创建团队"
               :width="400"
               @ok="onSubmit"
               @cancel="visible=false">
            <a-input placeholder="请输入团队名称" v-model:value="groupName"/>
      </a-modal>
    </span>
</template>

<script>
import {PlusOutlined} from '@ant-design/icons-vue'
import axios from "@/plugins/axios";
import {notice} from "@/plugins/utils";
import  {getUserId} from '@/api/user'


export default {
  name: "CreateTeam",
  components: {
    PlusOutlined
  },
  data() {
    return {
      visible: false,
      groupName:''
    }
  },
  methods:{
    onSubmit(){
      if(!this.groupName){
        return notice(403,'团队名称不能为空');
      }
      let params = {
        group_name:this.groupName,
        uid:getUserId()
      }
      axios.post('member/create_group',params)
        .then((res)=>{
          notice(res.code,res.msg)
          if(res.code === 200){
            this.visible = false
            this.groupName = ''
          }
        })
    }
  }
}
</script>

<style scoped>

</style>