<template>
    <span>
      <span @click="visible = true"><PlusOutlined/> 创建团队</span>
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
import {create} from "@/api/group";
import {notice} from "@/plugins/utils";
import {getUserId} from "@/api/user";


export default {
  name: "CreateGroup",
  props:['reload'],
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
    async onSubmit() {
      if (!this.groupName) {
        return notice(403, '团队名称不能为空');
      }
      let params = {
        group_name: this.groupName,
        uid: getUserId()
      }
      let res = await create(params)
      notice(res.code, res.msg)
      if (res.code === 200) {
        this.visible = false
        this.groupName = '';
        this.reload(true)
      }
    }
  }
}
</script>

<style scoped>

</style>