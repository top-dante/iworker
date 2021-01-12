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
          <div :style="{ padding: '24px' }">
            <a-input-search placeholder="输入关键字搜索" />
          </div>
          <!--                    team-->
          <div class="team">
            <div class="title">
              部门管理
              <CreateDepartment/>
            </div>
            <a-menu
              mode="inline"
              @click="menuOnClick"
              v-model:openKeys="openKeys">
              <a-menu-item :key="0"><BulbOutlined />
                所有部门
              </a-menu-item>
              <template v-for="item in department">
                <template v-if="item.children">
                  <a-sub-menu :key="item.id" :title="item.name">
                      <a-menu-item v-for="vo in item.children" :key="vo.depart_id">
                        <BulbOutlined />{{vo.name}}
                      </a-menu-item>
                  </a-sub-menu>
                </template>
                <template v-else>
                  <a-menu-item :key="item.depart_id"><BulbOutlined />{{item.name}}</a-menu-item>
                </template>
              </template>
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
  TeamOutlined,BulbOutlined
} from "@ant-design/icons-vue";
import CreateMember from "./components/CreateMember";
import {getDepartmentList} from "@/api/group";
import CreateDepartment from "@/views/member/components/CreateDepartment";
export default {
  name: "Index",
  components: {
    CreateDepartment,
    Header,
    TeamOutlined,
    CreateMember,BulbOutlined
  },
  data() {
    return {
      openKeys: [0],
      department: []
    };
  },
  created(){
    this.openKeys = []
    this.department = getDepartmentList()
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
  padding-top: 4px;
  min-height: 420px;
}
.team .title {
  padding:4px 24px;
  color: rgba(0,0,0,.45);
}
.team-item {
  border-bottom: 1px solid #f0f0f0;
  padding: 20px 0;
}
.border {
  border: 1px solid #e8e8e8;
}
</style>