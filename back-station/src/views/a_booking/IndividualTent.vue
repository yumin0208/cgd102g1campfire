<template>
<section class="page_section">
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
      chtName: '個別營帳管理',
      title:'營區預訂',
      titles:[
        {
          thName:'test',
        },
        {
          thName:'test',
        },
        {
          thName:'test',
        },
        {
          thName:'test',
        },
        {
          thName:'test',
        },
        {
          thName:'test',
        },
        {
          thName:'test',
        },
        {
          thName:'test',
        },
        {
          thName:'test',
        },
        {
          thName:'test',
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