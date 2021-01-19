<template>
  <div class="department">
    <div class="title">
      部门管理
      <CreateDepartment :callback="callback"/>
    </div>
    <a-menu @click="menuOnClick" mode="inline" :style="{borderRight:'none'}">
      <a-menu-item :key="0"><BulbOutlined />所有部门</a-menu-item>
      <template v-for="item in department">
        <template v-if="item.children">
          <a-sub-menu :key="item.id">
            <template #title><span><MenuOutlined/></span>{{item.name}}</template>
            <a-menu-item :key="item.depart_id"><BulbOutlined />{{item.name}}</a-menu-item>
            <a-menu-item v-for="vo in item.children" :key="vo.depart_id">
              <BulbOutlined />{{vo.name}}
              <a-dropdown placement="bottomCenter">
                      <span class="dropdown-icon">
                       <span class="ellipsis"></span>
                      </span>
                <template #overlay>
                  <a-menu>
                    <a-menu-item @click="onUpdate(vo)">编辑</a-menu-item>
                    <a-menu-item @click="delDepartment(vo)">删除</a-menu-item>
                  </a-menu>
                </template>
              </a-dropdown>
            </a-menu-item>
          </a-sub-menu>
        </template>
        <template v-else>
          <a-menu-item :key="item.depart_id">
            <BulbOutlined />{{item.name}}
            <a-dropdown placement="bottomCenter">
                      <span class="dropdown-icon">
                       <span class="ellipsis"></span>
                      </span>
              <template #overlay>
                <a-menu>
                  <a-menu-item @click="onUpdate(item)">编辑</a-menu-item>
                  <a-menu-item @click="delDepartment(item)">
                      删除
                   </a-menu-item>
                </a-menu>
              </template>
            </a-dropdown>
          </a-menu-item>
        </template>
      </template>
    </a-menu>
<!-- //编辑部门modal-->
    <a-modal :visible="visible"
             @cancel="visible = false"
             :width="320"
             :footer="null"
             title="部门编辑">
        <a-form layout="vertical">
          <a-form-item><a-input v-model:value="form.name"/></a-form-item>
          <a-form-item>
            <a-select v-model:value="form.pid">
              <a-select-option :key="0">一级部门</a-select-option>
              <a-select-option v-for="item in department"
                               :key="item.depart_id"
                               :value="item.depart_id">
                  {{item.name}}
              </a-select-option>
            </a-select>
          </a-form-item>
          <div :style="{textAlign:'right'}">
            <a-button type="primary" @click="updateDepartment">确认</a-button>
            <a-button @click="visible = false" class="ml">取消</a-button>
          </div>
        </a-form>
    </a-modal>
  </div>
</template>

<script>
import {BulbOutlined,MenuOutlined} from '@ant-design/icons-vue'
import CreateDepartment from "@/views/member/components/CreateDepartment";
import {list,del,update} from '@/api/department'
import {notice} from "@/plugins/utils";

export default {
  name: "Department",
  components:{
    BulbOutlined,
    CreateDepartment,
    MenuOutlined
  },
  data(){
    return {
      department:[],
      current:0,
      visible:false,
      form:{depart_id:'',name:'',pid:0,group_id:'',status:1},
    }
  },
  computed:{
    groupId(){
      return this.$store.getters.getGroupId
    }
  },
  watch:{
    groupId(){
      this.getDepartmentList()
    }
  },
  created(){
   this.getDepartmentList()
  },
  methods: {
    menuOnClick({ key}) {
      this.current = key
    },
    async getDepartmentList(){
      let res = await list()
      if(res.code === 200){
        this.department = res.data
        localStorage.setItem('department',JSON.stringify(res.data))
      }
    },
    callback(){
      this.department = this.getDepartmentList()
    },
    delDepartment(item){
      const _this = this
      this.$confirm({
        title: '部门删除确认',
        content:'您将删除-['+item.name+']-部门，此操作不可逆，请谨慎操作！',
        okText:'确认',
        okType:'danger',
        cancelText:'取消',
        async onOk() {
          let res = await del({depart_id: item.depart_id})
          if(res.code === 200){
            await _this.getDepartmentList()
            _this.$destroyAll()
          }
          notice(res.code,res.msg)
        }
      });
    },
    onUpdate(item){
      this.form = item
      this.visible = true
    },
    async updateDepartment(){
      let res = await update(this.form);
      if(res.code === 200){
        setTimeout(()=>{
          this.getDepartmentList()
          this.visible = false
        },2000)
      }
      notice(res.code,res.msg)
    }
  }
}
</script>

<style scoped>
.department{
  min-height: 420px;
  padding-bottom: 30px;
}
.department .title {
  padding:12px 24px;
  color: rgba(0,0,0,.45);
  margin-bottom: 4px;
  border-bottom: 1px solid #f0f0f0;
}
.dropdown-icon {
  float: right;
  transform: scale(0.7);
}
</style>