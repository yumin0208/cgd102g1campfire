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
      <th v-for="item in titles" :key="item">
        {{ item }}
      </th>
    </tr>
    <tr v-for="item in products" :key="item">
      <td>{{ item.product_no }}</td>
      <td>{{ item.product_type_no }}</td>
      <td>{{ item.product_name }}</td>
      <td>{{ item.product_price }}</td>
      <td>{{ item.product_pic }}</td>
      <td>{{ item.payment_status }}</td>
      <td>{{ item.product_update }}</td>
      <td>{{ item.product_qty }}</td>
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
name: "HomeView",
components: {
  Menu,
  Header,
  Footer,
},
beforeMount() {
  // 後端抓資料
  this.FetchAPIProduct();
},
data() {
  return {
    chtName: '商品資訊管理',
    title: '營火商城',
    path:'/ProductsInfo',
    titles: [
      "商品編號",
      "商品類別編號",
      "商品名稱",
      "商品價格",
      "商品圖片",
      "商品狀態",
      "商品上架日期",
      "數量",
    ],
    products: [],
  };
},
methods: {
  FetchAPIProduct() {
    fetch(`http://localhost/Group%20project/firefly_camp_php/product.php`)
      .then((response) => {
        if (response) {
          this.fetchError = response.status !== 200;
          return response.json();
        }
      })
      .then((responseText) => {
        this.products = responseText;
      })
      .catch((err) => {
        this.products = [];
      });
  },
},
};
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';

</style>