<template>
<span>
  <span @click="visible = true" class="link float-right">
    <PlusCircleOutlined /> 添加部门
  </span>
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
        <a-form-item name="pid">
         <a-select placeholder="请选择所属团队"
                   v-model:value="form.pid">
           <a-select-option :value="0">一级部门</a-select-option>
            <a-select-option
                :value="item.depart_id"
                v-for="item in department"
                :key="item.depart_id">
              {{item.name}}
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
import {PlusCircleOutlined} from '@ant-design/icons-vue'
import {getDepartmentList,getGroupId} from "@/api/group";
import {request} from "@/plugins/request";
import {notice} from "@/plugins/utils";

export default {
  name: "CreateDepartment",
  props:['callback'],
  components: {
    PlusCircleOutlined
  },
  data() {
    return {
      visible: false,
      department:[],
      form:{name:'', pid:0,group_id:getGroupId()},
      rules:{
        name:[
            {required:true,message:'部门名称不能为空'},
            {max:20,message: '部门名称不能超过20个字符'}
           ],
        pid: [{required:true,message:'请选择上级部门'}]
      }
    }
  },
  created(){
    this.department = getDepartmentList()
  },
  methods:{
    onSubmit(data){
      data.group_id = getGroupId()
      request.post('member/create_department',data)
      .then((res)=>{
        notice(res.code,res.msg)
        if(res.code === 200){
          this.callback()
          this.visible =false
          setTimeout(()=>{
            getDepartmentList(true)
          },1000)
        }
      })
    }
  }
}
</script>

<style scoped>

</style>