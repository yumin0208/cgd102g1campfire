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
      <tr v-for="item in productOrderList" :key="item">
        <td>{{ item.product_order_no }}</td>
        <td>{{ item.product_no }}</td>
        <td>{{ item.product_order_list_qty }}</td>
        <td>{{ item.product_order_list_price }}</td>
        
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
    this.FetchAPIProductOrderList();
  },
data() {
  return {
    productOrderList: [],
    chtName: '商品訂單管理',
    title:'營火商城',
    titles:[
      '商品訂單編號',
      '商品編號',
      '商品數量',
      '商品價格',
    ],
  }
},
methods: {
    FetchAPIProductOrderList() {
      fetch(`http://localhost/Group%20project/firefly_camp_php/product_order_list.php`)
        .then((response) => {
          if (response) {
            this.fetchError = response.status !== 200;
            return response.json();
          }
        })
        .then((responseText) => {
          this.productOrderList = responseText;
        })
        .catch((err) => {
          this.productOrderList = [];
        });
    },
  },
}
</script>

<style lang="scss" scoped>

@import'@/assets/Scss/Page/table.scss';

</style>