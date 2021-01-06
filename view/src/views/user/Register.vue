<template>
  <div class="register-box">
    <h2 class="title">新用户注册 <span>简单工作，快乐生活！</span></h2>
    <a-form layout="vertical">
      <a-form-item>
        <a-input placeholder="用户名"
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
            placeholder="至少六位数，区分大小写">
          <template #prefix>
            <LockOutlined/>
          </template>
        </a-input-password>
      </a-form-item>
      <a-form-item>
        <a-input-password
            size="large"
            placeholder="确认密码">
          <template #prefix>
            <LockOutlined/>
          </template>
        </a-input-password>
      </a-form-item>
      <a-form-item help="暂不支持国外手机号码注册">
        <a-input
            size="large"
            placeholder="手机号码">
          <template #prefix>
            <MobileOutlined />
          </template>
        </a-input>
      </a-form-item>
      <a-form-item help="六位数短信验证码">
        <a-row :gutter="20">
          <a-col :span="16">
            <a-input size="large" placeholder="短信验证码">
              <template #prefix><VerifiedOutlined /></template>
            </a-input>
          </a-col>
          <a-col :span="8">
            <a-button block size="large">获取验证码</a-button>
          </a-col>
        </a-row>
      </a-form-item>
      <a-form-item :style="{marginTop:'24px'}">
        <a-button type="primary" size="large" :style="{width: '50%'}">注册</a-button>
        <router-link to="/user/login" :style="{float:'right',lineHeight:'40px'}">
          使用已有账号登录
        </router-link>
      </a-form-item>
    </a-form>
  </div>
</template>

<script>
import {
  UserOutlined,
  LockOutlined,
  MobileOutlined,
  VerifiedOutlined
} from '@ant-design/icons-vue'

export default {
  name: "Register",
  components: {
    UserOutlined,
    LockOutlined,
    MobileOutlined,
    VerifiedOutlined
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