<template>
  <div class="register-box">
    <h2 class="title">新用户注册 <span>简单工作，快乐生活！</span></h2>
    <a-form layout="vertical"
            name="custom-validation"
            ref="ruleForm"
            :model="form"
            :rules="rules"
            @finish="handleFinish"
    >
      <a-form-item name="username">
        <a-input placeholder="用户名"
                 v-model:value="form.username"
                 :style="{width:'100%'}"
                 autocomplete="off"
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
            autocomplete="off"
            placeholder="至少六位数，区分大小写">
          <template #prefix>
            <LockOutlined/>
          </template>
        </a-input-password>
      </a-form-item>
      <a-form-item name="check_pass">
        <a-input-password
            size="large"
            autocomplete="off"
            v-model:value="form.check_pass"
            placeholder="确认密码">
          <template #prefix>
            <LockOutlined/>
          </template>
        </a-input-password>
      </a-form-item>
      <a-form-item help="暂不支持国外手机号码注册" name="mobile">
        <a-input
            size="large"
            v-model:value="form.mobile"
            placeholder="手机号码">
          <template #prefix>
            <MobileOutlined/>
          </template>
        </a-input>
      </a-form-item>

      <a-row :gutter="20">
        <a-col :span="14">
          <a-form-item help="六位数短信验证码" name="verify_code">
            <a-input size="large"
                     v-model:value="form.verify_code"
                     placeholder="短信验证码">
              <template #prefix>
                <VerifiedOutlined/>
              </template>
            </a-input>
          </a-form-item>
        </a-col>
        <a-col :span="10">
          <a-button block
                    :disabled="disabled"
                    @click="countdown"
                    size="large">
            {{text}}
          </a-button>
        </a-col>
      </a-row>

      <a-form-item :style="{marginTop:'24px'}">
        <a-button type="primary"
                  size="large"
                  :loading="loading"
                  html-type="submit"
                  :style="{width: '50%'}">注册
        </a-button>
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
import {apiPost} from "@/plugins/http";

export default {
  name: "Register",
  components: {
    UserOutlined,
    LockOutlined,
    MobileOutlined,
    VerifiedOutlined
  },
  data() {
    let validatePass = async (rule, value) => {
      if (value === '') {
        return Promise.reject('请输入密码');
      } else if (value.length < 6 || value.length > 20) {
        return Promise.reject('密码长度大于6小于20为字符')
      } else {
        if (this.form.check_pass !== '') {
          this.$refs.ruleForm.validateField('checkPass');
        }
        return Promise.resolve();
      }
    };
    let validatePass2 = async (rule, value) => {
      if (value === '') {
        return Promise.reject('请再次输入密码');
      } else if (value !== this.form.password) {
        return Promise.reject("两次密码输入不一致");
      } else {
        return Promise.resolve();
      }
    };
    return {
      form: {username: '', password: '', check_pass: '', mobile: '', verify_code: ''},
      rules: {
        username: [
          {required: true, message: '用户名不能为空！', trigger: 'blur'},
          {min: 1, max: 20, message: '用户名长度1-20个字符', trigger: 'blur'}
        ],
        password: [
          {required: true, message: '密码不能为空', trigger: 'blur'},
          {min: 6, max: 20, message: '密码长度为6-20个字符', trigger: 'blur'},
          {validator: validatePass, trigger: 'change'}
        ],
        check_pass: [
          {required: true, message: '确认密码不能为空', trigger: 'blur'},
          {min: 6, max: 20, message: '密码长度为6-20个字符', trigger: 'blur'},
          {validator: validatePass2, trigger: 'change'}
        ],
        mobile: [
          {required: true, message: '手机号码不能为空', trigger: 'blur'},
          {len: 11, message: '手机号码为11位数字', trigger: 'blur'},
        ],
        verify_code: [
          {required: true, message: '请输入验证码', trigger: 'blur'},
          {len: 6, message: '验证码为6位数，请正确输入'}
        ]
      },
      loading: false,
      text:'获取验证码',
      times:60,
      countDownLoading:false,
      disabled:false
    }
  },
  methods: {
    handleFinish(value) {
      this.loading = true
      apiPost('account/register', value)
          .then((res) => {
            if(res.code === 200){
              this.$message.success(res.msg)
              setTimeout(()=>{
                this.router.push('/user/login')
              },3000)
            }
          })
          .catch((err) => {
            this.$message.error(err)
          })
      setTimeout(() => {
        this.loading = false
      }, 5000)
    },
    countdown(){
      let t = 59,time = 59
      this.countDownLoading = true
      if(time === t){
        let count = setInterval(()=>{
          if(time === 0){
            time = t
            this.text = '获取验证码'
            this.disabled = false
            clearInterval(count);
          }else {
            this.text = time+'s后重新获取'
            this.disabled = true
            time--
          }
        },1000)
      }
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

.user-login-other {
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

.title:hover {
  transition: all .4s;
  color: rgb(0, 0, 0);
}

.title > span {
  font-size: 14px;
  font-weight: 400;
  color: rgba(0, 0, 0, .55);
  margin-left: 10px
}
</style>