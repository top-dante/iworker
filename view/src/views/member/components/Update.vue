<template>
  <a-modal
      :width="450"
      title="编辑成员信息"
      :visible="visible"
      :footer="null"
      @cancel="visible  = false"
  >
    <a-form :label-col="{ span: 4 }"
            :model="member"
            ref="ruleForm"
            :rules="rules"
            @finish="onSubmit"
            :wrapper-col="{ span: 14 }">
      <a-form-item label="姓名" name="username">
        <a-input v-model:value="member.username" placeholder="请输入员工姓名"></a-input>
      </a-form-item>
      <a-form-item label="部门" :wrapper-col="{ span: 14 }" name="depart_id">
        <a-select placeholder="请选择" v-model:value="member.depart_id">
          <template v-for="item in department">
            <template v-if="item.children">
              <a-select-opt-group :key="item.depart_id" :label="item.name">
                <a-select-option v-for="vo in item.children"
                                 :value="vo.depart_id"
                                 :key="vo.depart_id">
                  {{ vo.name }}
                </a-select-option>
              </a-select-opt-group>
            </template>
            <template v-else>
              <a-select-option :value="item.depart_id" :key="item.depart_id">
                {{ item.name }}
              </a-select-option>
            </template>
          </template>
        </a-select>
      </a-form-item>
      <a-form-item label="手机" name="mobile" :wrapper-col="{ span: 14 }">
        <a-input v-model:value="member.mobile" type="number" placeholder="请输入"></a-input>
      </a-form-item>
      <a-form-item
          label="地址"
          help="请输入员工的居住地址"
          name="address"
          :wrapper-col="{ span: 20 }"
      >
        <a-input v-model:value="member.address" placeholder="居住地址"></a-input>
      </a-form-item>
      <a-form-item :wrapper-col="{ offset: 4, span: 20 }">
        <a-button type="primary" :loading="loading" html-type="submit">确认</a-button>
        <a-button :style="{ marginLeft: '16px' }" @click="visible = false">取消</a-button>
      </a-form-item>
    </a-form>
  </a-modal>
</template>
<script>
import {update} from "@/api/member";
import {notice} from "@/plugins/utils";

export default {
  name: "UpdateMember",
  props: ['memberInfo', 'status', 'editorAction'],
  data() {
    return {
      visible: false,
      loading: false,
      member: {
        username: '',
        depart_id: '',
        mobile: '',
        address: ''
      },
      rules: {
        username: [{required: true, message: "请输入员工姓名", trigger: "blur"}],
        depart_id: [
          {required: true, type: 'number', message: "请选择员工共所属部门"}
        ],
        mobile: [
          {required: true, message: "请输入员工手机号码"},
          {len: 11, message: "请输入正确的手机号码"}
        ],
        address: [{required: true, message: "请输入员工的居住地址"}],
      },
      department: []
    };
  },
  created() {
    let depart = localStorage.getItem('department')
    if (depart) {
      this.department = JSON.parse(depart)
    }
  },
  watch: {
    status() {
      this.visible = this.status
    },
    visible() {
      if (!this.status) {
        this.member = {
          username: '',
          depart_id: '',
          mobile: '',
          address: ''
        }
      }
      if (!this.visible) {
        this.editorAction({}, false)
      }
    },
    memberInfo() {
      this.member = this.memberInfo
    }
  },
  methods: {
    onSubmit(data) {
      this.loading = true;
      this.createMember(data)
      setTimeout(() => {
        this.loading = false;
      }, 5000);
    },
    async createMember(data) {
      data.group_id = localStorage.getItem('group_id')
      data.id = this.memberInfo.id
      let res = await update(data)
      if (res.code === 200) {
        this.visible = false
      }
      notice(res.code, res.msg)
    }
  },
};
</script>
<style scoped>
:deep(.ant-form-item) {
  margin-bottom: 16px;
}
</style>