<template>
  <div class="top-right">
    <div class="item">
      <a-dropdown :trigger="['click']"
                  :overlayStyle="{width: '280px'}"
                  placement="bottomCenter">
        <a-tooltip title="消息通知">
          <div class="line-full" @click="getNoticeList">
            <a-badge dot>
              <BellOutlined/>
            </a-badge>
          </div>
        </a-tooltip>
        <template #overlay>
          <a-menu>
            <a-menu-item class="title">
              消息提醒 <span class="text-danger">(99+)</span>
            </a-menu-item>
            <a-menu-divider/>
            <a-menu-item v-for="item in noticeList" :key="item.id">
              {{ item.title }}
              <div class="text-gray text-sm">{{ item.username }} | {{ item.create_time }}</div>
            </a-menu-item>
            <a-menu-divider/>
            <a-menu-item class="footer">
              查看全部未读消息
            </a-menu-item>

          </a-menu>
        </template>
      </a-dropdown>
    </div>
    <div class="item">
      <a-dropdown placement="bottomRight">
        <div class="line-full">
          {{ currentGroup.group_name }}
          <DownOutlined/>
        </div>
        <template #overlay>
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
              <PlusOutlined/>
              创建团队
            </a-menu-item>
          </a-menu>
        </template>
      </a-dropdown>
    </div>
    <div class="item">
      <a-dropdown>
        <div class="line-full" :style="{verticalAlign:'middle'}">
          <a-avatar :size="28" :src="userInfo.avatar"/>
          <span :style="{margin:'0 8px'}">{{ userInfo.username }}</span>
          <span class="ellipsis"></span>
        </div>
        <template #overlay>
          <a-menu>
            <a-menu-item>
              <HomeOutlined/>
              我的主页
            </a-menu-item>
            <a-menu-item>
              <SettingOutlined/>
              个人设置
            </a-menu-item>
            <a-menu-divider/>
            <a-menu-item>
              <router-link to="/setting">
                <MenuOutlined/>
                全局设置
              </router-link>
            </a-menu-item>
            <a-menu-item>
              <ShareAltOutlined/>
              邀请同事
            </a-menu-item>
            <a-menu-divider/>
            <a-menu-item @click="logout">
              <LogoutOutlined/>
              安全退出
            </a-menu-item>
          </a-menu>
        </template>
      </a-dropdown>
    </div>
  </div>
</template>

<script>
import {
  BellOutlined,
  HomeOutlined,
  SettingOutlined,
  MenuOutlined,
  ShareAltOutlined,
  LogoutOutlined,
  DownOutlined,
  PlusOutlined
} from '@ant-design/icons-vue'
import {notification} from 'ant-design-vue'
import {getUserInfo} from "@/api/user";
import {list} from "@/api/group";
import {notice} from "@/plugins/utils";

export default {
  name: "TopRight",
  components: {
    BellOutlined,
    HomeOutlined,
    SettingOutlined,
    MenuOutlined,
    ShareAltOutlined,
    LogoutOutlined,
    DownOutlined,
    PlusOutlined
  },
  data() {
    return {
      noticeList: [],
      group:[],
      userInfo: getUserInfo(),
      currentGroup: []
    }
  },
  created() {
    this.getGroupList()
  },
  methods: {
    async getGroupList(){
      this.group = JSON.parse(localStorage.getItem('group'))
      if(!this.group){
        let res  = await list()
        if(res.code === 200){
          this.group = res.data
          this.currentGroup = res.data[0]
          localStorage.setItem('group_id',res.data.[0].group_id)
          localStorage.setItem('group',JSON.stringify(res.data))
        }else {
          notice(res.code,res.msg)
        }
      }
      this.currentGroup = this.group[0]
    },
    //获取消息列表
    getNoticeList() {
      if (this.noticeList.length === 0) {
        for (let i = 1; i < 7; i++) {
          this.noticeList.push({
            id: i, title: '华旌翠羽笼黄道，赫奕照晨晖',
            username: '卓峰民',
            create_time: '2020-10-18 22:08:26'
          })
        }
      }
    },
    onGroupItem({key}) {
      if (key === 'none' || key === 'create') {
        return false;
      }
      this.currentGroup = this.group[key]
      localStorage.setItem('current_group', JSON.stringify(this.currentGroup))
    },
    /**
     * 退出登录
     */
    logout() {
      try {
        this.clearUserData()
        notification.success({
          message: '您已安全退出登录!',
          description: '已将您的登录信息清除，正在为您跳转登录页面！'
        })
        setTimeout(() => {
          this.$router.push('/user/login')
        }, 3000)
      } catch (e) {
        console.log(e)
      }
    },
    clearUserData() {
      sessionStorage.removeItem('token')
      localStorage.removeItem('token')
      sessionStorage.removeItem('user')
      localStorage.removeItem('user')
    }
  }
}
</script>

<style scoped>
.top-right {
  display: flex;
  float: right;
  justify-content: flex-end;
  align-items: flex-end;
}

.top-right > .item {
  height: 50px;
  line-height: 50px;
  margin-left: 32px;
}

.top-right > .item:hover {
  color: #1890ff;
  transition-duration: .4s;
  cursor: pointer;
}

.line-full {
  line-height: 50px;
}

.drop-plus {
  display: inline-block;
  height: 24px;
  line-height: 24px;
  text-align: center;
  width: 24px;
  border-radius: 24px;
  color: #fff;
  background: linear-gradient(135deg, #1890ff, #096dd9, #1890ff);
}

.drop-plus:hover {
  background: linear-gradient(135deg, #40a9ff, #096dd9);
  transition-duration: .4s;
}

>>> .title.ant-dropdown-menu-item:hover,
>>> .title.ant-dropdown-menu-item:focus {
  background-color: #fff;
  cursor: default;
}

>>> .footer.ant-dropdown-menu-item {
  text-align: center;
}

>>> .footer.ant-dropdown-menu-item:hover {
  background-color: #fff;
  color: #1890ff;
}

.dropdown-menu-title {
  border-bottom: 1px solid #f0f0f0;
  margin-bottom: 4px;
}

.dropdown-menu-title:hover {
  background-color: #fff;
  cursor: default;
}
</style>