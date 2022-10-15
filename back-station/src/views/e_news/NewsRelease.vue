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
    <!-- <input type="text" placeholder="搜尋"/> -->
    <button><router-link to="/NewsAdd">新增</router-link></button>
  </div>
  <div class="table_roll">
    <table>
    <tr class="table_title">
      <th v-for="item in titles" :key="item">{{item}}</th>
    </tr>
    <tr class="item_content"  v-for="item in news" :key="item" @click="goInfo(item)">
      <td>{{item.news_no}}</td>
      <td>{{item.news_title}}</td>
      <td>{{item.news_content}}</td>
      <td>{{item.news_pic}}</td>
      <td>{{item.news_post_time}}</td>
      <td>{{item.news_status}}</td>
    </tr>
  </table>
  </div>
</section>
<Footer></Footer>
</template>

<script>

import { useRouter } from "vue-router";

export default {
data() {
  return {
    chtName: '消息發布管理',
    title: '最新消息',
    path:'/NewsRelease',
    titles: [
      '最新消息編號',
      '最新消息標題',
      '最新消息內文',
      '最新消息圖片',
      '發布時間',
      '最新消息狀態'
    ],
    news: [],
    router:useRouter()
  };
},
methods: {
  FetchAPIComment() {
    fetch(process.env.VUE_APP_PHP_PATH + 'backstation_news.php')
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
  goInfo(e){
    console.log(e)
    sessionStorage.setItem("news", JSON.stringify(e) );
    let thus = this;
    thus.router.push({path:'/NewsInfo'});
  }
},
created() {
  this.FetchAPIComment();
  },
};
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';
button:hover{
  cursor: pointer;
}
</style>
