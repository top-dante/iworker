<template>
  <span>
    <a-button type="primary" @click="visible = true">
      <template #icon><PlusOutlined /></template>
      创建新项目
    </a-button>
    <a-modal
      :visible="visible"
      :width="320"
      title="创建新项目"
      :footer="null"
      @ok="handleOk"
      @cancel="close"
    >
      <a-form layout="vertical"
              ref="ruleForm"
              :model="form"
              @finish="handleOk"
              :rules="rules">
        <a-form-item help="请输入项目名称，少于120个字" name="title">
          <a-input
            :value="form.title"
            allowClear
            placeholder="项目名称"
          />
        </a-form-item>
        <a-form-item help="请选择业务员" name="bm">
          <a-select :style="{ width: '100%' }" placeholder="请选择">
            <template v-for="item in team" :key="item.id">
               <a-select-option :value="item.id">
                 {{item.username}}
                 <a-tag :color="item.department.color"
                        class="float-right border-circle">
                   {{item.department.name}}
                 </a-tag>
               </a-select-option>
            </template>

          </a-select>
        </a-form-item>
        <a-form-item help="选择项目开始时间，默认当前时间" name="create_time">
          <a-date-picker
            :value="initCreateTime"
            :style="{ minWidth: '100%' }"
            showTime
          />
        </a-form-item>
        <a-form-item help="请选择项目截止时间，默认一个星期" name="deadline">
          <a-date-picker
            :value="initHeadline"
            format="YYYY-MM-DD HH:00:00"
            :style="{ minWidth: '100%' }"
            showTime
          />
        </a-form-item>
        <div :style="{ marginTop: '20px' }">
          <a-button type="primary" html-type="submit" block size="large">
            <template #icon><CheckOutlined /></template>完成并创建
          </a-button>
        </div>
      </a-form>
    </a-modal>
  </span>
</template>

<script>
import { PlusOutlined, CheckOutlined } from "@ant-design/icons-vue";
import moment from "moment";
import {list} from "@/api/member";
import {getGroupId} from "@/api/group";

export default {
  name: "CreateProject",
  components: {
    PlusOutlined,
    CheckOutlined,
  },
  data() {
    return {
      visible: false,
      form: {
        title: "",
        create_time: "",
        deadline: "",
        bm:0,
      },
      rules:{
        title:[{required:true,message:'项目名称不能为空'},{max:120,message: '项目名称不建议超过120个字'}],
        bm:[{required:true,message:'请选择业务员'}],
        create_time: [{required:true,message:'开始时间不能为空'}],
        deadline: [{required:true,message:'截止时间不能为空'}]
      },
      initCreateTime: moment(),
      initHeadline: moment().days("+7"),
      team:[]
    };
  },
  created(){
    this.getMemberList()
  },
  methods: {
    async getMemberList(){
      this.team = this.team = this.$store.getters.team
      if(!this.team){
        let res = await list({group_id:getGroupId(),status:1})
        if(res.code === 200){
          this.$store.commit('team',res.data)
          this.team = res.data
        }
      }
    },
    handleOk() {

    },
    close() {
      this.visible = false;
    },
  },
};
</script>

<style scoped>
:deep(.ant-form-item:last-child) {
  margin-right: 0;
}
.divider {
  margin: 10px 0;
  height: 1px;
  width: 100%;
  border-bottom: 1px solid #f0f0f0;
}
</style>