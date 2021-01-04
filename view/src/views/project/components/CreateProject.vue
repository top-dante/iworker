<template>
  <span>
    <a-button type="primary" @click="visible = true">
      <template #icon><PlusOutlined /></template>
      创建新项目
    </a-button>
    <a-modal
      :visible="visible"
      :width="350"
      title="创建新项目"
      :footer="null"
      @ok="handleOk"
      @cancel="close"
    >
      <a-form layout="vertical">
        <a-form-item help="请输入项目名称，少于120个字">
          <a-input
            :value="form.title"
            maxLength="120"
            allowClear
            required
            placeholder="项目名称"
          />
        </a-form-item>
        <a-form-item help="请选择业务员">
          <a-select :style="{ width: '100%' }" placeholder="请选择">
            <a-select-option value="jack"> Jack </a-select-option>
            <a-select-option value="lucy"> Lucy </a-select-option>
            <a-select-option value="disabled" disabled>
              Disabled
            </a-select-option>
            <a-select-option value="Yiminghe"> yiminghe </a-select-option>
          </a-select>
        </a-form-item>
        <a-form-item help="选择项目开始时间，默认当前时间">
          <a-date-picker
            :value="initCreateTime"
            :style="{ minWidth: '100%' }"
            showTime
          />
        </a-form-item>
        <a-form-item help="请选择项目截止时间，默认一个星期">
          <a-date-picker
            :value="initHeadline"
            format="YYYY-MM-DD HH:00:00"
            :style="{ minWidth: '100%' }"
            showTime
          />
        </a-form-item>
        <div :style="{ marginTop: '20px' }">
          <a-button type="primary" block size="large">
            <template #icon><CheckOutlined /></template>完成并创建
          </a-button>
        </div>
      </a-form>
    </a-modal>
  </span>
</template>

<script>
import { PlusOutlined, CheckOutlined } from "@ant-design/icons-vue";
import { apiPost } from "@/plugins/http";
import moment from "moment";

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
        bm: "",
        status: 1,
      },
      initCreateTime: moment(),
      initHeadline: moment().days("+7"),
    };
  },
  methods: {
    handleOk() {
      if (!this.form.title) return this.$message.warn("项目名称不能为空");

      if (this.form.title.length > 120)
        return this.$message.warn("项目名称不能超过120个字，请精简名称");
      apiPost("project/create_project.html", this.form);
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