<template>
  <section class="header_section">
    <nav class="project_nav">
      <div class="nav_left">
        <div class="nav_serch">
          <h2 class="header_title">{{ projectName }}</h2>
          <!-- <input type="text" placeholder="搜尋" /> -->
        </div>
      </div>
      <div class="nav_right">
        <div class="nav_account">
          <p class="account_text">您好！{{ emp_login.employee_name }}</p>
        </div>
        <div class="nav_logout">
          <a href="#" class="logout_btn" @click="logout">登出</a>
        </div>
      </div>
    </nav>
  </section>
</template>

<script>
import { useRouter } from "vue-router";
export default {
  data() {
    return {
      projectName: '營火叢後台系統管理',
      router:useRouter()
    };
  },
  methods:{
    getEmpData(){
      this.emp_login = JSON.parse(sessionStorage.getItem('emp_login'));
      this.employee_name = this.emp_login.employee_name;
    },
    logout(){
        let xhr = new XMLHttpRequest();
        xhr.open("POST",process.env.VUE_APP_PHP_PATH + 'logout.php',true);
        xhr.send(null);
        sessionStorage.removeItem("emp_login", JSON.stringify(this.session));
        alert("已登出");
        let thus = this;
        thus.router.push({path:'/'})
    },
  },
  created(){
    this.getEmpData()
    let checkLogin = sessionStorage.getItem('emp_login');
    if(checkLogin == null){
      alert("請先登入");
      let thus = this;
      thus.router.push({path:'/Login'})
    }
  },
};
</script>

<style lang="scss" scoped>
@import '@/assets/scss/Style.scss';


</style>
