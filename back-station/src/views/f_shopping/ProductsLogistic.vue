<template>

<section class="page_section">
  <div class="breadcrum">
    <div class="breadcrum_left">
      <p class="router_name">{{ chtName }}</p>
    </div>
    <div class="breadcrum_right">
      <div class="breadcrumb_text">
        <p class="breadcrumb_text_title">{{ title }}</p>
        <p>{{ chtName }}</p>
      </div>
    </div>
  </div>
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
      <tr v-for="item in productsType" :key="item">
        <td>{{ item.product_type_no }}</td>
        <td>{{ item.product_type_name }}</td>
      </tr>
  </table>
</section>
</template>
  
<script>
// @ is an alias to /src


export default {
name: 'HomeView',
components: {

},
data() {
  return {
    productsType: [],
    chtName: '商品類別管理',
    title:'營火商城',
    titles:[
      '商品類別編號',
      '商品類別名稱',
    ],
  }
},
}
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';

</style>