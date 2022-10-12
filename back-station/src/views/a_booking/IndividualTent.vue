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
  <table>
    <tr class="table_title">
      <th v-for="item in titles" :key="item">{{item}}</th>
    </tr>
    <tr v-for="item in tent" :key="item">
      <td>{{item.tent_no}}</td>
      <td>{{item.tent_style_no}}</td>
      <td>{{item.area_no}}</td>
      <td>{{item.tent_status}}</td>
      <td>{{item.mem_no}}</td>
      <td>{{item.tent_date}}</td>
      <td>{{item.tent_year}}</td>
      <td><button>更多</button></td>
    </tr>
  </table>
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
    chtName: '個別營帳管理',
    title: '營區預訂',
    path:'/IndvidualTent',
    titles: [
      '個別營帳編號',
      '營帳類型編號',
      '地區編號',
      '營帳使用狀態',
      '會員編號',
      '建立日期',
      '使用年限',
    ],
    tent: [],
  };
},
methods: {
  FetchAPIComment() {
    fetch(``)
      .then((response) => {
        if (response) {
          this.fetchError = response.status !== 200;
          return response.json();
        }
      })
      .then((responseText) => {
        this.tent = responseText;
      })
      .catch((err) => {
        this.tent = [];
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
