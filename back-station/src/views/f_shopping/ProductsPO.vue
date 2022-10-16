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
    <input type="text" placeholder="搜尋">
    <!-- <button>新增</button> -->
    <button>修改</button>
    <button>刪除</button>
  </div>  
  <div class="table_roll">
    <table>
      <tr class="table_title">
        <th v-for="item in titles" :key="item">
          {{ item }}
        </th>
      </tr>
      <tr class="item_content" v-for="item in productOrderList" :key="item">
        <td>{{ item.product_order_no }}</td>
        <td>{{ item.product_no }}</td>
        <td>{{ item.product_order_list_qty }}</td>
        <td>{{ item.product_order_list_price }}</td>
        <td><button>更多</button></td>
      </tr>
    </table>
  </div>
  
</section>
<Footer></Footer>
</template>
  
<script>
export default {
beforeMount() {
    // 後端抓資料
    this.FetchAPIProductOrderList();
  },
data() {
  return {
    productOrderList: [],
    chtName: '商品訂單管理',
    title: '營火商城',
    path:'/ProductsPO',
    titles:[
      '商品訂單編號',
      '商品編號',
      '商品數量',
      '商品價格',
      '詳細資訊',
    ],
  }
},
methods: {
    FetchAPIProductOrderList() {
      fetch(process.env.VUE_APP_PHP_PATH + 'product_order_list.php')
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

@import'@/assets/scss/style.scss';

</style>