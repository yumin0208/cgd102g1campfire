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
    <input type="text" placeholder="搜尋"/>
    <button>新增</button>
    <button>修改</button>
    <button>刪除</button>
  </div>
  <div class="table_roll">
    <table>
      <tr class="table_title">
        <th v-for="item in titles" :key="item">{{item}}</th>
      </tr>
      <tr class="item_content" v-for="item in tent_style" :key="item">
        <td>{{item.tent_style_no}}</td>
        <td>{{item.tent_style_people}}</td>
        <td>{{item.area_no}}</td>
        <td>{{item.tent_style_type}}</td>
        <td>{{item.tent_style_name}}</td>
        <td>{{item.tent_style_pic}}</td>
        <td>{{item.tent_style_info}}</td>
        <td>{{item.tent_style_price}}</td>
        <td>{{item.tent_qty}}</td>
        <td>{{item.tent_status}}</td>
        <td><button>更多</button></td>
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
    router:useRouter(),
    chtName: '營帳類型管理',
    title: '營區服務',
    path:'/TentType',
    titles: [
      '營帳類型編號',
      '營帳可住人數',
      '地區編號',
      '營帳種類',
      '營帳名稱',
      '營帳種類照片',
      '營帳類型介紹',
      '營帳價格',
      '營帳數量',
      '營帳狀態',
      '詳細資訊',
    ],
    tent_style: [],
  };
},
methods: {
  FetchAPIComment() {
    fetch(process.env.VUE_APP_PHP_PATH + 'backstation_serviceTent.php')
      .then((response) => {
        if (response) {
          this.fetchError = response.status !== 200;
          return response.json();
        }
      })
      .then((responseText) => {
        this.tent_style = responseText;
      })
      .catch((err) => {
        this.tent_style = [];
      });
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
