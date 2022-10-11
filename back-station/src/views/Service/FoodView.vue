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
import Main from '@/components/Main.vue';

export default {
    name: 'HomeView',
    components: {
    Main,
    },
    data() {
    return {
        chtName: '食材方案管理',
        title:'營區服務',
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

@import'@/assets/Scss/Page/table.scss';

</style>