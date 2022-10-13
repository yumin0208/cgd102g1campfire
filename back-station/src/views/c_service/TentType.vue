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
  <div class="table_roll">
    <table>
      <tr class="table_title">
        <th v-for="item in titles" :key="item">{{item}}</th>
      </tr>
      <tr class="item_content" v-for="item in tent_style" :key="item">
        <td>{{item.tent_style_no}}</td>
        <td>{{item.tent_style_people}}</td>
        <td>{{item.area_no}}</td>
        <td>{{item.tent_style_type}}</td>
        <td>{{item.tent_style_name}}</td>
        <td>{{item.tent_style_pic}}</td>
        <td>{{item.tent_style_info}}</td>
        <td>{{item.tent_style_price}}</td>
        <td>{{item.tent_qty}}</td>
        <td>{{item.tent_status}}</td>
        <td><button>更多</button></td>
      </tr>
    </table>
  </div>
  
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
    chtName: '營帳類型管理',
    title: '營區服務',
    path:'/TentType',
    titles: [
      '營帳類型編號',
      '營帳可住人數',
      '地區編號',
      '營帳種類',
      '營帳名稱',
      '營帳種類照片',
      '營帳類型介紹',
      '營帳價格',
      '營帳數量',
      '營帳狀態',
      '詳細資訊',
    ],
    tent_style: [],
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
        this.tent_style = responseText;
      })
      .catch((err) => {
        this.tent_style = [];
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
