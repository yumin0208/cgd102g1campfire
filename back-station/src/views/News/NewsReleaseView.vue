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
      <th v-for="title in titles" :class="{title_list: titleList==i}" :key="title">{{title.thName}}</th>
    </tr>
    <tr v-for="item in newsList" :class="{item_content: itemContent==i}" :key="item">
      <td :class="{list_content: listContent==i}">{{item.news_no}}</td>
      <td :class="{list_content: listContent==i}">{{item.news_title}}</td>
      <td :class="{list_content: listContent==i}">{{item.news_content}}</td>
      <td :class="{list_content: listContent==i}">{{item.news_pic}}</td>
      <td :class="{list_content: listContent==i}">{{item.news_post_time}}</td>
      <td :class="{list_content: listContent==i}">{{item.news_status}}</td>
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
      chtName: '消息發佈管理',
      title:'最新消息',
      titles:[
        {
            thName:'最新消息編號',
        },
        {
            thName:'最新消息標題',
        },
        {
            thName:'最新消息內文',
        },
        {
            thName:'最新消息圖片',
        },
        {
            thName:'發布時間',
        },
        {
            thName:'最新消息狀態',
        }
      ],
      newsList:[],
      status:'',
      
    }
  },
  // methods:{
  //   transNewsStatus(){
  //     console.log('new',this.newsList)
  //     if(this.newsList.new_status==1){
  //       this.status = "顯示"
  //     }else{
  //       this.status = "隱藏"
  //     }
  //   }
  // }
  // ,
  created(){
    fetch('http://localhost/phpLab/firefly_camping_php/backstation_news.php')
    .then((res)=>{
    // this.fetchError = (response.status !== 200)
    return res.json()
    })
    .then((newsContent)=>{
    console.log(newsContent)
    this.newsList=newsContent
    console.log(this.newsList)
    // if(this.newsList.new_status==1){
    //   this.status = "顯示"
    // }else{
    //   this.status = "隱藏"
    // }
    })
  },
  // mounted(){
  //   this.transNewsStatus();
  // }
}
</script>

<style lang="scss" scoped>

@import'@/assets/Scss/Page/table.scss';

</style>