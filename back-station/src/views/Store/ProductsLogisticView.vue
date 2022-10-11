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
      <tr v-for="item in productsType" :key="item">
        <td>{{ item.product_type_no }}</td>
        <td>{{ item.product_type_name }}</td>
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

@import'@/assets/Scss/Page/table.scss';

</style>