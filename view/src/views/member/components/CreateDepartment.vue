<template>
<span>
 <a-button type="dashed"
           @click="visible = true"
           :style="{ marginLeft: '12px' }">
   <template #icon><PlusOutlined/></template>
   创建部门
 </a-button>
  <a-modal
      @cancel="visible = false"
      :width="320"
      title="添加部门"
      :footer="null"
      :visible="visible">
      <a-form layout="vertical"
              ref="ruleForm"
              :model="form"
              @finish="onSubmit"
              :rules="rules">
        <a-form-item name="name">
          <a-input v-model:value="form.name" placeholder="请输入部门名称"/>
        </a-form-item>
        <a-form-item name="group_id">
         <a-select placeholder="请选择所属团队"
                   v-model:value="form.group_id">
            <a-select-option :value="item.group_id" v-for="item in groupList" :key="item.group_id">
              {{item.group_name}}
            </a-select-option>
          </a-select>
        </a-form-item>
        <div :style="{textAlign:'right'}">
          <a-button type="primary" html-type="submit">确认</a-button>
          <a-button @click="visible = false" class="ml">取消</a-button>
        </div>
      </a-form>
  </a-modal>
</span>
</template>

<script>
import {PlusOutlined} from '@ant-design/icons-vue'
import {getGroupList} from "@/api/group";
import axios from "@/plugins/axios";
import {notice} from "@/plugins/utils";

export default {
  name: "CreateDepartment",
  components: {
    PlusOutlined
  },
  data() {
    return {
      visible: false,
      groupList:getGroupList(),
      form:{name:'', group_id:''},
      rules:{
        name:[
            {required:true,message:'部门名称不能为空'},
            {max:20,message: '部门名称不能超过20个字符'}
           ],
        group_id: [{required:true,message:'请选择所属团队'}]
      }
    }
  },
  methods:{
    onSubmit(data){
      axios.post('member/create_department',data)
      .then((res)=>{
        notice(res.code,res.msg)
        if(res.code === 200){
          this.visible =false
          setTimeout(()=>{
            getGroupList(true)
          },1000)
        }
      })
    }
  }
}
</script>

<style scoped>

</style>