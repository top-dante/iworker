<template>
  <div class="wrapper">
    <Header title="成员管理" :bread-crumb="['团队管理', '成员列表']"/>
    <div class="wrapper-content">
      <a-layout :style="{ minHeight: '280px' }">
        <a-layout-sider
            theme="light"
            :width="280"
            :style="{ borderRadius: '2px' }">
          <div :style="{ padding: '16px' }">
            <a-input-search placeholder="输入成员关键字搜索"/>
          </div>
          <Department/>
        </a-layout-sider>

        <a-layout-content :style="{ paddingLeft: '24px' }">
          <a-card :bordered="false">
            <template #title>
              <TeamOutlined/>
              成员列表
            </template>
            <template #extra>
              <CreateMember/>
            </template>
            <a-table :columns="columns"
                     size="middle"
                     :pagination="false"
                     :row-selection="{ selectedRowKeys: selectKey, onChange: '' }"
                     :data-source="list" row-key="id">
              <template #username="{record}">
                <a-avatar><template #icon><UserOutlined/></template></a-avatar>
                {{record.username}}
               <a-tag>{{record.mobile}}</a-tag>
              </template>
              <template #department="{ record }">
                <a-tag>{{record.department.name}}</a-tag>
              </template>
            </a-table>
          </a-card>
        </a-layout-content>
      </a-layout>
    </div>
  </div>
</template>

<script>
import Header from "../../components/Header";
import {TeamOutlined,UserOutlined} from "@ant-design/icons-vue";
import CreateMember from "./components/CreateMember";
import Department from "@/views/member/components/Department";
import {list} from "@/api/member";

export default {
  name: "Index",
  components: {
    Department,
    Header,
    TeamOutlined,
    CreateMember,
    UserOutlined
  },
  setup(){
    return {
      columns:[
        {title:'姓名',slots: {customRender: 'username'},key:'username'},
        {title:'部门',slots:{customRender:'department'},width:200},
        {title:'添加时间',dataIndex:'create_time',width:'200px'},
        {title:'管理',width:200}
      ]
    }
  },
  data() {
    return {
      list: [],
      group_id:localStorage.getItem('group_id')||'',
      selectKey:[]
    };
  },
  computed:{
    groupId(){
      return this.$store.getters.getGroupId
    }
  },
  watch:{
    groupId(){
      this.group_id = this.$store.getters.getGroupId
      this.getList()
    }
  },
  created() {
    this.getList()
  },
  methods: {
    async getList() {
      let params = {
        group_id: this.group_id,
        page: 1,
        page_size: 15,
        depart_id: 0
      }
      let res = await list(params);
      if (res.code === 200) {
        this.list = res.data.data
      }
    }
  }
};
</script>

<style scoped>
.team {

}
</style>