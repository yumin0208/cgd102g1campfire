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
    <tr class="item_content" v-for="item in member" :key="item">
      <td>{{item.mem_no}}</td>
      <td>{{item.mem_id}}</td>
      <td>{{item.mem_psw}}</td>
      <td>{{item.mem_name}}</td>
      <td>{{item.mem_nick_name}}</td>
      <td>{{item.mem_email}}</td>
      <td>{{item.mem_city}}</td>
      <td>{{item.mem_addr}}</td>
      <td>{{item.mem_phone}}</td>
      <td>{{item.mem_pic}}</td>
      <td>{{item.mem_status}}</td>
      <td>{{item.register_date}}</td>
      <td><button>更多</button></td>
    </tr>
  </table>
  </div>
  
</section>
<Footer></Footer>
</template>

<script>

import Menu from "@/components/Menu.vue";
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";

export default {
name: 'HomeView',
components: {
  Menu,
  Header,
  Footer,
},
data() {
  return {
    chtName: '會員資訊管理',
    title: '會員中心',
    path:'/MemberInfo',
    titles: [
      '會員編號',
      '會員帳號',
      '會員密碼',
      '會員姓名',
      '會員暱稱',
      '會員信箱',
      '縣市',
      '詳細住址',
      '電話',
      '大頭照',
      '會員狀態',
      '註冊日期',
      '詳細資訊',
    ],
    member: [],
  };
},
methods: {
  FetchAPIComment() {
    fetch(process.env.VUE_APP_PHP_PATH + 'membermodify.php')
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
},
created() {
  this.FetchAPIComment();
  },
};
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';

</style>
