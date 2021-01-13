<template>
  <div class="wrapper">
    <Header title="团队管理" :bread-crumb="['团队管理', '团队列表']" />
    <div class="wrapper-content">
      <a-layout :style="{ minHeight: '280px' }">
        <a-layout-sider
          theme="light"
          :width="280"
          :style="{ borderRadius: '2px' }">
          <div :style="{ padding: '16px' }">
            <a-input-search placeholder="输入成员关键字搜索" />
          </div>
          <Department/>
        </a-layout-sider>

        <a-layout-content :style="{ paddingLeft: '24px' }">
          <a-card :bordered="false">
            <template #title>
              <TeamOutlined />
              成员列表
            </template>
            <template #extra>
              <CreateMember />
            </template>
            成员列表
          </a-card>
        </a-layout-content>
      </a-layout>
    </div>
  </div>
</template>

<script>
import Header from "../../components/Header";
import {TeamOutlined} from "@ant-design/icons-vue";
import CreateMember from "./components/CreateMember";
import Department from "@/views/member/components/Department";
export default {
  name: "Index",
  components: {
    Department,
    Header,
    TeamOutlined,
    CreateMember,
  },
  data() {
    return {

    };
  },
  created(){
    this.openKeys = []
  },
};
</script>

<style scoped>
.team {

}
</style>