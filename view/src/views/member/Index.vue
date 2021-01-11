<template>
  <div class="wrapper">
    <Header title="团队管理" :bread-crumb="['团队管理', '团队列表']" />
    <div class="wrapper-content">
      <a-layout :style="{ minHeight: '280px' }">
        <a-layout-sider
          theme="light"
          :width="280"
          :style="{ borderRadius: '2px' }"
        >
          <div :style="{ padding: '24px 16px' }">
            <a-input-search placeholder="输入关键字搜索" />
          </div>
          <!--                    team-->
          <div class="team">
            <a-menu
              mode="inline"
              @click="menuOnClick"
              v-model:openKeys="openKeys"
            >
              <a-sub-menu v-for="item in team" :key="item.group_id">
                <template #title>{{ item.group_name }}</template>
                <template v-if="item.department">
                <a-menu-item v-for="vo in item.department" :key="vo.depart_id">
                  <SisternodeOutlined /> {{ vo.name }}
                </a-menu-item>
                </template>
              </a-sub-menu>
            </a-menu>
          </div>
          <!--                    bar-->
          <div
            :style="{
              padding: '20px 0 30px',
              textAlign: 'center',
              marginTop: '20px',
              borderTop: '1px solid #f0f0f0',
            }"
          >
            <CreateTeam/>
            <CreateDepartment/>
          </div>
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
import {
  TeamOutlined,
  SisternodeOutlined,
} from "@ant-design/icons-vue";
import CreateMember from "./components/CreateMember";
import CreateTeam from "@/views/member/components/CreateTeam";
import {getGroupList} from "@/api/group";
import CreateDepartment from "@/views/member/components/CreateDepartment";
export default {
  name: "Index",
  components: {
    CreateDepartment,
    Header,
    TeamOutlined,
    SisternodeOutlined,
    CreateMember,
    CreateTeam
  },
  data() {
    return {
      openKeys: [0],
      team: getGroupList()
    };
  },
  created(){
    this.openKeys = [this.team[0].group_id]
  },
  methods: {
    menuOnClick({ item, key, keyPath }) {
      console.log({ item, key, keyPath });
    },
  },
};
</script>

<style scoped>
.team {
  border-top: 1px solid #f0f0f0;
  padding-top: 20px;
  min-height: 420px;
}
.team-item {
  border-bottom: 1px solid #f0f0f0;
  padding: 20px 0;
}
.border {
  border: 1px solid #e8e8e8;
}
</style>