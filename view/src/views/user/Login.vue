<template>
  <div class="register-box">
    <h2 class="title">用户登录 <span>简单工作，快乐生活！</span></h2>
    <a-form
        :model="form"
        ref="ruleForm"
        :rules="rules"
        @finish="onLogin"
        layout="vertical">
      <a-form-item name="username">
        <a-input placeholder="用户名/手机/邮箱"
                 v-model:value="form.username"
                 :style="{width:'100%'}"
                 size="large">
          <template #prefix>
            <UserOutlined/>
          </template>
        </a-input>
      </a-form-item>
      <a-form-item name="password">
        <a-input-password
            size="large"
            v-model:value="form.password"
            placeholder="密码">
          <template #prefix>
            <LockOutlined/>
          </template>
        </a-input-password>
      </a-form-item>
      <a-form-item>
        <a-checkbox v-model:checked="remember">自动登录</a-checkbox>
        <router-link to="/user/recover" :style="{float:'right'}">忘记密码</router-link>
      </a-form-item>
      <a-form-item>
        <a-button type="primary"
                  size="large"
                  html-type="submit"
                  :loading="loading"
                  block>确定</a-button>
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
import {apiPost} from "@/plugins/http";

export default {
  name: "Login",
  components: {
    UserOutlined,
    LockOutlined,
    WechatOutlined,
    QqOutlined,
    DingdingOutlined
  },
  data(){
    return {
      form:{username:'',password:''},
      rules:{
        username:[{required:true,message:'账户不能为空'}],
        password: [
          {required:true,message:'密码不能为空'},
          {min:6,max:20,message: '密码为6-20位字符'}
        ]
      },
      remember:false,
      loading:false
    }
  },
  methods:{
    onLogin(values){
      this.loading = true
      apiPost('account/login',values)
          .then((res)=>{
            if(res.code === 200){
              this.$message.success(res.msg)
              if(this.remember){
                localStorage.setItem('token',res.data.token)
                localStorage.setItem('user',JSON.stringify(res.data))
              }else {
                sessionStorage.setItem('token',res.data.token)
                sessionStorage.setItem('user',JSON.stringify(res.data))
              }
              this.toHome()
            }else {
              this.$message.warn(res.msg)
            }
          })
          .catch((err)=>{
            this.$message.error(err)
          })
      setTimeout(()=>{
        this.loading = false
      },5000)
    },
    toHome(){
      setTimeout(()=>{
        this.$router.push({path:'/'})
      },3000)
    }
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