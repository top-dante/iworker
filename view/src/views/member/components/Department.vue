<template>
  <div class="department">
    <div class="title">
      部门管理
      <CreateDepartment :callback="callback"/>
    </div>
    <a-menu @click="menuOnClick" :style="{borderRight:'none'}">
      <a-menu-item :key="0"><BulbOutlined />所有部门</a-menu-item>
      <template v-for="item in department">
        <template v-if="item.children">
          <a-sub-menu :key="item.id" :title="item.name">
            <a-menu-item v-for="vo in item.children" :key="vo.depart_id">
              <BulbOutlined />{{vo.name}}
            </a-menu-item>
          </a-sub-menu>
        </template>
        <template v-else>
          <a-menu-item :key="item.depart_id"><BulbOutlined />{{item.name}}
            <a-dropdown placement="bottomCenter">
                      <span class="dropdown-icon">
                       <span class="ellipsis"></span>
                      </span>
              <template #overlay>
                <a-menu>
                  <a-menu-item>编辑</a-menu-item>
                  <a-menu-item>删除</a-menu-item>
                </a-menu>
              </template>
            </a-dropdown>
          </a-menu-item>
        </template>
      </template>
    </a-menu>
  </div>
</template>

<script>
import {BulbOutlined} from '@ant-design/icons-vue'
import {getDepartmentList} from "@/api/group";
import CreateDepartment from "@/views/member/components/CreateDepartment";

export default {
  name: "Department",
  components:{
    BulbOutlined,
    CreateDepartment
  },
  data(){
    return {
      department:[]
    }
  },
  created(){
    this.department = getDepartmentList()
  },
  methods: {
    menuOnClick({ item, key, keyPath }) {
      console.log({ item, key, keyPath });
    },
    callback(){
      this.department = getDepartmentList(true)
    }
  }
}
</script>

<style scoped>
.department{
  border-top: 1px solid #f0f0f0;
  padding-top: 4px;
  min-height: 420px;
  padding-bottom: 30px;
}
.department .title {
  padding:8px 16px;
  color: rgba(0,0,0,.45);
  margin-bottom: 4px;
}
.dropdown-icon {
  float: right;
  transform: scale(0.7);
}
</style>