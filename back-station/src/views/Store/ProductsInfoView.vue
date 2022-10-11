<template>
  <Main></Main>
  <section class="page_section">
    <header class="project_header">
      <div class="header_left">
        <p class="router_name">{{ chtName }}</p>
      </div>
      <div class="header_right">
        <div class="breadcrumb">
          <p>{{ title }} > {{ chtName }}</p>
        </div>
      </div>
    </header>

    <div class="search_bar">
      <input type="text" placeholder="搜尋" />
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
</template>
  
<script>
// @ is an alias to /src
import Main from "@/components/Main.vue";

export default {
  name: "HomeView",
  components: {
    Main,
  },
  beforeMount() {
    // 後端抓資料
    this.FetchAPIProduct();
  },
  data() {
    return {
      chtName: "商品資訊管理",
      title: "營火商城",
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
@import "@/assets/Scss/Page/table.scss";
</style>