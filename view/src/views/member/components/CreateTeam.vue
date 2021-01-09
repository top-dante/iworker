<template>
    <span>
      <a-button type="dashed"
                @click="visible = true">
        <template #icon><PlusOutlined/></template>
        创建团队</a-button>
      <a-modal :visible="visible"
               title="创建团队"
               :width="400"
               @cancel="visible=false">
            <a-input placeholder="请输入团队名称"/>
      </a-modal>
    </span>
</template>

<script>
import {PlusOutlined} from '@ant-design/icons-vue'

export default {
  name: "CreateTeam",
  components: {
    PlusOutlined
  },
  data() {
    return {
      visible: false
    }
  }
}
</script>

<style scoped>

</style>