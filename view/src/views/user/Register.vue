<template>
  <div class="register-box">
    <h2 class="title">用户登录 <span>简单工作，快乐生活！</span></h2>
    <a-form layout="vertical">
      <a-form-item>
        <a-input placeholder="用户名/手机/邮箱"
                 :style="{width:'100%'}"
                 size="large">
          <template #prefix>
            <UserOutlined/>
          </template>
        </a-input>
      </a-form-item>
      <a-form-item>
        <a-input-password
            size="large"
            placeholder="用户名/手机/邮箱">
          <template #prefix>
            <LockOutlined/>
          </template>
        </a-input-password>
      </a-form-item>
      <a-form-item>
        <a-checkbox>自动登录</a-checkbox>
        <router-link to="/user/recover" :style="{float:'right'}">忘记密码</router-link>
      </a-form-item>
      <a-form-item>
        <a-button type="primary" size="large" block>确定</a-button>
      </a-form-item>
      <a-form-item>
        <span :style="{marginRight:'12px'}">其他登录方式</span>
        <a href="javascript:;" class="user-login-other">
          <a-avatar size="small">
            <template #icon>
              <WechatOutlined/>
            </template>
          </a-avatar>
        </a>
        <a href="javascript:;" class="user-login-other">
          <a-avatar size="small" :style="{margin:'0 12px'}">
            <template #icon>
              <QqOutlined/>
            </template>
          </a-avatar>
        </a>
        <a href="javascript:;" class="user-login-other">
          <a-avatar size="small">
            <template #icon>
              <DingdingOutlined/>
            </template>
          </a-avatar>
        </a>
        <router-link to="/user/register" :style="{float:'right'}">新用户注册</router-link>
      </a-form-item>
    </a-form>
  </div>
</template>

<script>
import {
  UserOutlined,
  LockOutlined,
  WechatOutlined,
  QqOutlined,
  DingdingOutlined
} from '@ant-design/icons-vue'

export default {
  name: "Register",
  components: {
    UserOutlined,
    LockOutlined,
    WechatOutlined,
    QqOutlined,
    DingdingOutlined
  }
}
</script>

<style scoped>
.register-box {
  width: 360px;
  margin: 80px auto 0;
  backdrop-filter: blur(8px);
}
.user-login-other{
  vertical-align: 2px;
}
.user-login-other > .ant-avatar:hover {
  background-color: #1890ff;
  transition: all .4s;
  color: #fff;
}

.title {
  font-size: 26px;
  margin-bottom: 28px;
  font-weight: 700;
  color: rgba(0, 0, 0, .85);

}
.title:hover{
  transition: all .4s;
  color: rgb(0,0,0);
}
.title>span {
  font-size: 14px;
  font-weight: 400;
  color: rgba(0,0,0,.55);
  margin-left: 10px
}
</style>