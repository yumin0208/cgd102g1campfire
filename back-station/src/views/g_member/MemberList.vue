<template>
<Menu></Menu>
<Header></Header>
<section class="page_section">
  <div class="breadcrum">
    <div class="breadcrum_left">
        <p class="router_name">{{chtName}}</p>
    </div>
    <div class="breadcrum_right">
        <div class="breadcrumb_text">
            <p class="breadcrumb_text_title">{{title}}</p>
            <router-link class="breadcrumb_text_chtname" :to="path">{{chtName}}</router-link>
        </div>
    </div>
  </div>
  <div class="serch_bar">
    <!-- <input type="text" placeholder="搜尋"/> -->
  </div>
  <div class="table_roll">
    <table>
    <tr class="table_title">
      <th v-for="item in titles" :key="item">{{item}}</th>
    </tr>
    <tr class="item_content" v-for="item in member" :key="item" @click="goInfo(item)">
      <td>{{item.mem_no}}</td>
      <td>{{item.mem_id}}</td>
      <td>{{item.mem_name}}</td>
      <td>{{item.mem_nick_name}}</td>
      <td>{{item.mem_email}}</td>
      <td>{{item.mem_city}}</td>
      <td>{{item.mem_addr}}</td>
      <td>{{item.mem_phone}}</td>
      <td>{{item.mem_pic}}</td>
      <td>{{item.mem_status}}</td>
      <td>{{item.register_date}}</td>
    </tr>
  </table>
  </div>
  
</section>
<Footer></Footer>
</template>

<script>
import { useRouter } from "vue-router";

export default {
data() {
  return {
    chtName: '會員資訊管理',
    title: '會員中心',
    path:'/MemberInfo',
    titles: [
      '會員編號',
      '會員帳號',
      '會員姓名',
      '會員暱稱',
      '會員信箱',
      '縣市',
      '詳細住址',
      '電話',
      '頭像',
      '會員狀態',
      '註冊日期',
    ],
    member: [],
    router:useRouter()
  };
},
methods: {
  FetchAPIComment() {
    fetch(process.env.VUE_APP_PHP_PATH + 'backstation_member.php')
      .then((response) => {
        if (response) {
          this.fetchError = response.status !== 200;
          return response.json();
        }
      })
      .then((responseText) => {
        this.member = responseText;
      })
      .catch((err) => {
        this.member = [];
      });
  },
  goInfo(e){
    console.log(e)
    sessionStorage.setItem("member", JSON.stringify(e) );
    let thus = this;
    thus.router.push({path:'/MemberInfo'});
  },
    getEmpData(){
            this.emp_login = JSON.parse(sessionStorage.getItem('emp_login'));
            this.employee_name = this.emp_login.employee_name;
        }
    },
    created() {
        this.getEmpData();
        let checkLogin = sessionStorage.getItem('emp_login');
        if(checkLogin == null){
            alert("請先登入");
            let thus = this;
            thus.router.push({path:'/Login'})
        }else{
            if(this.emp_login.employee_auth != 1){
                console.log(this.emp_login.employee_auth)
                alert("權限不足")
                let thus = this;
                thus.router.push({path:'/home'})
            }else{
                this.FetchAPIComment();
            }
        }
    },
};
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';

</style>
