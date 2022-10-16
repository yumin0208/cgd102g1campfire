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
  <!-- <div class="serch_bar"> -->
    <!-- <input type="text" placeholder="搜尋"/> -->
    <!-- <button>新增</button> -->
    <!-- <router-link to="./productEdit.vue"><button>修改</button></router-link>
    <button>刪除</button> -->
  <!-- </div> -->
  <div class="table_roll">
    <table>
      <tr class="table_title">
        <th v-for="item in titles" :key="item">
          {{ item }}
        </th>
      </tr>
      <tr class="item_content" v-for="item in products" :key="item" @click="goInfo(item)">
        <td>{{ item.product_no }}</td>
        <td>{{ item.product_type_no }}</td>
        <td>{{ item.product_name }}</td>
        <td>{{ item.product_price }}</td>
        <td>{{ item.product_pic }}</td>
        <td>{{ item.payment_status }}</td>
        <td>{{ item.product_update }}</td>
        <td>{{ item.product_qty }}</td>
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
      '詳細資訊',
    ],
    products: [],
    router:useRouter()
  };
},
methods: {
  FetchAPIProduct() {
    fetch(process.env.VUE_APP_PHP_PATH +'product.php')
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
  goInfo(e){
    console.log(e)
    sessionStorage.setItem("Products", JSON.stringify(e) );
    let thus = this;
    thus.router.push({path:'/ProductEdit'});
  }
},

};
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';

</style>