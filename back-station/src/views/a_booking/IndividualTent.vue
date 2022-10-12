<template>
<Menu></Menu>
<Header></Header>
<section class="page_section">
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
    <tr v-for="item in orders" :key="item">
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
    orders: [],
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
        this.orders = responseText;
      })
      .catch((err) => {
        this.orders = [];
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
