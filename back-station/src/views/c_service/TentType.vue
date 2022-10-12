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
      <th v-for="title in titles" :class="{title_list: titleList==i}">{{title.thName}}</th>
    </tr>
    <tr v-for="item,index in items" :class="{item_content: itemContent==i}">
      <td v-for="list in item.lists" :class="{list_content: listContent==i}">{{list.tdName}}</td>
    </tr>
    <tr v-for="item,index in items" :class="{item_content: itemContent==i}">
      <td v-for="list in item.lists" :class="{list_content: listContent==i}">{{list.tdName}}</td>
    </tr>
    <tr v-for="item,index in items" :class="{item_content: itemContent==i}">
      <td v-for="list in item.lists" :class="{list_content: listContent==i}">{{list.tdName}}</td>
    </tr>
    <tr v-for="item,index in items" :class="{item_content: itemContent==i}">
      <td v-for="list in item.lists" :class="{list_content: listContent==i}">{{list.tdName}}</td>
    </tr>
    <tr v-for="item,index in items" :class="{item_content: itemContent==i}">
      <td v-for="list in item.lists" :class="{list_content: listContent==i}">{{list.tdName}}</td>
    </tr>
    <tr v-for="item,index in items" :class="{item_content: itemContent==i}">
      <td v-for="list in item.lists" :class="{list_content: listContent==i}">{{list.tdName}}</td>
    </tr>
    <tr v-for="item,index in items" :class="{item_content: itemContent==i}">
      <td v-for="list in item.lists" :class="{list_content: listContent==i}">{{list.tdName}}</td>
    </tr>
    <tr v-for="item,index in items" :class="{item_content: itemContent==i}">
      <td v-for="list in item.lists" :class="{list_content: listContent==i}">{{list.tdName}}</td>
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
      chtName: '營帳類型管理',
      title:'營區服務',
      titles:[
        {
          thName:'營帳類型編號',
        },
        {
          thName:'營帳可住人數',
        },
        {
          thName:'地區編號',
        },
        {
          thName:'營帳種類',
        },
        {
          thName:'營帳名稱',
        },
        {
          thName:'營帳種類照片',
        },
        {
          thName:'營帳類型介紹',
        },
        {
          thName:'營帳價格',
        },
        {
          thName:'營帳數量',
        },
        {
          thName:'營帳狀態',
        },
      ],
      items:[       
        {
          lists:[
            {
              tdName:'test',
            },
            {
              tdName:'test',
            },
            {
              tdName:'test',
            },
            {
              tdName:'test',
            },
            {
              tdName:'test',
            },
            {
              tdName:'test',
            },
            {
              tdName:'test',
            },
            {
              tdName:'test',
            },
            {
              tdName:'test',
            },
            {
              tdName:'test',
            },
          ]
        },
      ]
    }
  },
}
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';

</style>