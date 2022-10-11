<template>

<Main></Main>
<section class="page_section">

<header class="project_header">
  <div class="header_left">
    <p class="router_name">{{chtName}}</p>
  </div>
  <div class="header_right">
    <div class="breadcrumb">
      <p>{{title}} > {{chtName}}</p>
    </div>
  </div>
</header>

<div class="serch_bar">
  <input type="text" placeholder="搜尋">
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
      <tr v-for="item in productOrder" :key="item">
        <td>{{ item.product_order_no }}</td>
        <td>{{ item.mem_no }}</td>
        <td>{{ item.product_order_status }}</td>
        <td>{{ item.product_order_time }}</td>
        <td>{{ item.product_order_pickup_time }}</td>
        <td>{{ item.product_order_pickup_place }}</td>
        <td>{{ item.product_order_total }}</td>
      </tr>
    </table>

</section>

</template>
  
<script>
// @ is an alias to /src
import Main from '@/components/Main.vue';

export default {
name: 'HomeView',
components: {
  Main,
},
beforeMount() {
    // 後端抓資料
    this.FetchAPIProductOrder();
  },
data() {
  return {
    chtName: '商品付款管理',
    title:'營火商城',
    titles:[
        '商品訂單編號',
        '會員編號',
        '訂單狀態',
        '下單時間',
        '取貨時間',
        '配送地點',
        '總額',
    ],
    productOrder: [],
  };
},
methods: {
    FetchAPIProductOrder() {
      fetch(`http://localhost/Group%20project/firefly_camp_php/product.php`)
        .then((response) => {
          if (response) {
            this.fetchError = response.status !== 200;
            return response.json();
          }
        })
        .then((responseText) => {
          this.productOrder = responseText;
        })
        .catch((err) => {
          this.productOrder = [];
        });
    },
  },
}
</script>

<style lang="scss" scoped>

@import'@/assets/Scss/Page/table.scss';

</style>