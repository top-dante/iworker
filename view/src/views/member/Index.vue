<template>
  <div class="wrapper">
    <Header title="成员管理" :bread-crumb="['团队管理', '成员列表']"/>
    <div class="wrapper-content">
      <a-layout :style="{ minHeight: '280px' }">
        <!--//sider-->
        <a-layout-sider theme="light" :width="240" :style="{ borderRadius: '2px' }">
          <Department :param-back="paramBack"/>
        </a-layout-sider>
        <!--content-->
        <a-layout-content :style="{ paddingLeft: '24px' }">
          <a-card :bordered="false">
            <template #title>
              <TeamOutlined/>
              成员列表
            </template>
            <div class="toolbar">
              <div class="toolbar-item">
                <CreateMember/>
              </div>
              <div class="toolbar-item text-right">
                <a-input-search :style="{width:'260px'}"
                                placeholder="请输入成员关键字搜索"
                                @search="getList"
                                v-model:value="params.key"/>
              </div>
            </div>
            <a-table :columns="columns"
                     size="middle"
                     :pagination="false"
                     :row-selection="{ selectedRowKeys: selectKey, onChange: selectRowKey }"
                     :data-source="list" row-key="id">
              <template #username="{record}">
                <a-tooltip title="点击查看成员详情" placement="right">
                <span class="cursor-pointer">
                  <a-avatar :style="{backgroundColor:'#1890ff'}">
                    {{ record.username.slice(0, 1) }}
                  </a-avatar>
                  <span class="ml-xs">{{ record.username }}</span>
                </span>
                </a-tooltip>
              </template>
              <template #department="{ record }">
                <a-tag :color="record.department.color">{{ record.department.name }}</a-tag>
              </template>
              <template #actions="{record}">
                <a-tooltip title="编辑">
                  <span class="action-item"
                        @click="editorAction(record,true)">
                    <FormOutlined/>
                  </span>
                </a-tooltip>
                <a-tooltip title="禁用">
                  <span class="action-item" @click="stopMember(record)">
                    <template v-if="record.status"><StopOutlined/></template>
                    <template v-else><CheckCircleOutlined/></template>
                  </span>
                </a-tooltip>
                <a-tooltip title="删除">
                  <span class="action-item" @click="delMember(record)"><DeleteOutlined/></span>
                </a-tooltip>
              </template>
            </a-table>
          </a-card>
        </a-layout-content>
      </a-layout>
    </div>
    <Update :member-info="memberInfo" :status="editorStatus" :editor-action="editorAction"/>
  </div>
</template>

<script>
import Header from "../../components/Header";
import {
  TeamOutlined,
  StopOutlined,
  FormOutlined,
  DeleteOutlined,
  ExclamationCircleOutlined,
  CheckCircleOutlined
} from "@ant-design/icons-vue";
import CreateMember from "./components/CreateMember";
import Department from "@/views/member/components/Department";
import {createVNode} from 'vue'
import {list, rest, del} from "@/api/member";
import Update from "@/views/member/components/Update";
import {notice} from "@/plugins/utils";

export default {
  name: "Index",
  components: {
    Department,
    Header,
    TeamOutlined,
    CreateMember,
    StopOutlined,
    FormOutlined,
    DeleteOutlined,
    Update,
    CheckCircleOutlined
  },
  setup() {
    return {
      columns: [
        {title: '姓名', slots: {customRender: 'username'}, key: 'username'},
        {title: '手机', dataIndex: 'mobile', key: 'mobile', width: 120},
        {title: '部门', slots: {customRender: 'department'}, width: 120},
        {title: '添加时间', dataIndex: 'create_time', width: '200px'},
        {title: '管理', slots: {customRender: 'actions'}, width: 120}
      ]
    }
  },
  data() {
    return {
      list: [],
      selectKey: [],
      params: {
        key: '',
        page_size: 15,
        page: 1,
        depart_id: 0,
        group_id: localStorage.getItem('group_id'),
        status: 1,
        order: 'asc',
        order_by: 'id'
      },
      memberInfo: {},
      editorStatus: false,
      siderWidth:200
    };
  },
  computed: {
    groupId() {
      return this.$store.getters.getGroupId
    }
  },
  created() {
    this.getList()
  },
  watch: {
    groupId() {
      this.params.group_id = this.$store.getters.getGroupId
      this.getList()
    },
    editorStatus() {
      console.log(this.editorStatus)
    }
  },
  methods: {
    async getList() {
      let res = await list(this.params);
      if (res.code === 200) {
        this.list = res.data.data
      }
    },
    selectRowKey(selectedRowKeys) {
      this.selectKey = selectedRowKeys
    },
    editorAction(info, visible) {
      this.memberInfo = info
      this.editorStatus = visible;
    },
    stopMember(item) {
      this.$confirm({
        title: '用户禁用确认',
        content: '您将禁用成员【' + item.username + '】,请确认！',
        okText: '确认',
        okType: 'danger',
        icon: createVNode(ExclamationCircleOutlined),
        cancelText: '取消',
        onOk: async () => {
          item.status ? item.status = 0 : item.status = 1
          let res = await rest({id: item.id, status: item.status})
          if (res.code === 200) {
            await this.getList()
          }
          notice(res.code, res.msg)
        }
      })
    },
    delMember(item) {
      this.$confirm({
        title: '用户删除确认',
        content: '您将伤处成员【' + item.username + '】,此操作不可逆，请谨慎操作！',
        okText: '确认',
        okType: 'danger',
        icon: createVNode(ExclamationCircleOutlined),
        cancelText: '取消',
        onOk: async () => {
          let res = await del({id: item.id})
          if (res.code === 200) {
            await this.getList()
          }
          notice(res.code, res.msg)
        }
      })
    },
    paramBack(param){
      this.params.depart_id = param.depart_id
      this.params.status = param.status
      this.params.order = param.sort
      this.getList()
    }
  }
};
</script>