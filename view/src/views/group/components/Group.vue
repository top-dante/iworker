<template>
  <a-dropdown placement="bottomRight">
    <div class="line-full">
      <template v-if="group">
        {{ current.group_name }}<DownOutlined/>
      </template>
      <template v-else>
        <Create :reload="getGroupList"/>
      </template>
    </div>
    <template #overlay v-if="group">
      <a-menu @click="onGroupItem">
        <template v-if="group.length>0">
          <a-menu-item v-for="(item,index) in group" :key="index">
            {{ item.group_name }}
          </a-menu-item>
        </template>
        <template v-else>
          <div class="padding text-sm text-gray">暂无团队，请新建</div>
        </template>
        <a-menu-divider/>
        <a-menu-item class="text-center" key="create">
          <Create :reload="getGroupList"/>
        </a-menu-item>
      </a-menu>
    </template>
  </a-dropdown>
</template>

<script>
import {DownOutlined} from '@ant-design/icons-vue'
import {list} from "@/api/group";
import {notice} from "@/plugins/utils";
import Create from "@/views/group/components/Create";

export default {
  name: "Group",
  components: {
    DownOutlined,
    Create
  },
  data(){
    return {
      group:[],
      current:[]
    }
  },
  created(){
    this.getGroupList()
  },
  methods:{
    async getGroupList(reload){
      this.group = JSON.parse(localStorage.getItem('group'))
      if(!this.group || reload){
        let res  = await list()
        if(res.code === 200){
          this.group = res.data
          this.current = res.data[0]
          this.$store.commit('setGroupId',res.data[0].group_id)
          localStorage.setItem('group_id',res.data.[0].group_id)
          localStorage.setItem('group',JSON.stringify(res.data))
        }else {
          notice(res.code,res.msg)
        }
      }
      let current = localStorage.getItem('current_group')
      if(current){
        this.current = JSON.parse(current)
      }else {
        this.current = this.group[0]
      }

    },
    onGroupItem({key}) {
      if (key === 'none' || key === 'create') {
        return false;
      }
      this.current = this.group[key]
      localStorage.setItem('current_group', JSON.stringify(this.current))
      localStorage.setItem('group_id',this.current.group_id)
      this.$store.commit('setGroupId',this.current.group_id)
    },
  }
}
</script>

<style scoped>

</style>