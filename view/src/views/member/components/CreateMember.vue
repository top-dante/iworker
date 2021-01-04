<template>
  <span>
    <a-button type="primary" @click="visible = true">
      <template #icon><PlusOutlined /></template>
      添加成员
    </a-button>
    <a-modal
      :width="450"
      title="添加新成员"
      :visible="visible"
      :footer="null"
      @cancel="visible = false"
    >
      <a-form :label-col="{ span: 4 }" :wrapper-col="{ span: 14 }">
        <a-form-item label="姓名">
          <a-input placeholder="请输入员工姓名"></a-input>
        </a-form-item>
        <a-form-item label="部门" :wrapper-col="{ span: 14 }">
          <a-select placeholder="请选择"></a-select>
        </a-form-item>
        <a-form-item label="手机" :wrapper-col="{ span: 14 }">
          <a-input placeholder="请输入"></a-input>
        </a-form-item>
        <a-form-item
          label="地址"
          help="请输入员工的居住地址"
          :wrapper-col="{ span: 20 }"
        >
          <a-input placeholder="居住地址"></a-input>
        </a-form-item>
        <a-form-item :wrapper-col="{ offset: 4, span: 20 }">
          <a-button type="primary" :loading="loading" @click="onSubmit">
            <template #icon><CheckOutlined /></template>
            确认
          </a-button>
          <a-button :style="{ marginLeft: '16px' }" @click="visible = false">
            取消
          </a-button>
        </a-form-item>
      </a-form>
    </a-modal>
  </span>
</template>
<script>
import { PlusOutlined, CheckOutlined } from "@ant-design/icons-vue";

export default {
  name: "createMember",
  components: {
    PlusOutlined,
    CheckOutlined,
  },
  data() {
    return {
      visible: false,
      loading: false,
      rules: {
        name: [{ required: true, message: "请输入员工姓名", trigger: "blur" }],
        department: [{ required: true, message: "请选择员工共所属部门" }],
        mobile: [
          { required: true, message: "请输入员工手机号码" },
          { leng: 11, message: "请输入正确的手机号码" },
          { type: "number", message: "请输入数字" },
        ],
        address: [{ required: true, message: "请输入员工的居住地址" }],
      },
    };
  },
  methods: {
    onSubmit() {
      this.loading = true;
      setTimeout(() => {
        this.loading = false;
      }, 5000);
    },
  },
};
</script>
<style scoped>
:deep(.ant-form-item) {
  margin-bottom: 16px;
}
</style>