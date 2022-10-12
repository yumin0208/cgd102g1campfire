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
      <th v-for="item in titles" :key="item">{{item}}</th>
    </tr>
    <tr v-for="item in news" :key="item">
      <td>{{item.news_no}}</td>
      <td>{{item.news_title}}</td>
      <td>{{item.news_content}}</td>
      <td>{{item.news_pic}}</td>
      <td>{{item.news_post_time}}</td>
      <td>{{item.news_status}}</td>
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
    chtName: '消息發布管理',
    title: '最新消息',
    path:'/NewsRelease',
    titles: [
      '最新消息編號',
      '最新消息主標題',
      '最新消息內文',
      '最新消息圖片',
      '發布時間',
      '最新消息狀態',
    ],
    news: [],
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
        this.news = responseText;
      })
      .catch((err) => {
        this.news = [];
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
