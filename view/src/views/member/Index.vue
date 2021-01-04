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
              <a-sub-menu v-for="item in team" :key="item.id">
                <template #title>
                  <a-avatar :src="item.avatar" class="border" />
                  {{ item.name }}</template
                >

                <a-menu-item v-for="vo in item.children" :key="vo.id">
                  <SisternodeOutlined /> {{ vo.title }}
                </a-menu-item>
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
            <a-button type="dashed">
              <template #icon><PlusOutlined /></template>
              创建团队
            </a-button>
            <a-button type="dashed" :style="{ marginLeft: '12px' }">
              <template #icon><PlusOutlined /></template>
              创建部门
            </a-button>
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
  PlusOutlined,
  TeamOutlined,
  SisternodeOutlined,
} from "@ant-design/icons-vue";
import CreateMember from "./components/CreateMember";
export default {
  name: "Index",
  components: {
    Header,
    PlusOutlined,
    TeamOutlined,
    SisternodeOutlined,
    CreateMember,
  },
  data() {
    return {
      openKeys: [1],
      team: [
        {
          id: 1,
          name: "普洱市简瑞科技有限公司",
          avatar: "http://static.jworker.pe666.cn/assets/brand/jr_logo.jpg",
          children: [
            { id: 1, title: "行政部" },
            { id: 2, title: "设计部" },
            { id: 3, title: "销售部" },
            { id: 4, title: "工程部" },
          ],
        },
        {
          id: 2,
          name: "普洱万维广告有限公司",
          avatar: "http://static.jworker.pe666.cn/assets/brand/ww_logo.jpg",
          children: [
            { id: 5, title: "行政部" },
            { id: 6, title: "设计部" },
            { id: 8, title: "销售部" },
            { id: 12, title: "工程部" },
          ],
        },
      ],
    };
  },
  created() {
    this.getGroupList();
  },
  methods: {
    async getGroupList() {},
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