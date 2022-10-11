<template>

<Main></Main>
<section class="page_section">

    <header class="project_header">
    <div class="header_left">
        <p class="router_name">{{chtName}}</p>
    </div>
    <div class="header_right">
        <div class="breadcrumb">
        <p>{{title}} > {{chtName}} > {{detailsName}}</p>
        </div>
    </div>
    </header>

    <table>
        <div class="table_left">
            <td>
                <tr v-for="left_title in left_titles" :class="{left_title_list: left_titleList==i}">{{left_title.thName}}</tr>
            </td>
            <td v-for="left_item,index in left_items" :class="{left_item_content: left_itemContent==i}">
                <tr v-for="left_list in left_item.lists" :class="{left_list_content: left_listContent==i}">{{left_list.tdName}}</tr>
            </td>
        </div>

        <div class="tavle_right">
            <td>
                <tr v-for="right_title in right_titles" :class="{right_title_list: right_titleList==i}">{{right_title.thName}}</tr>
            </td>
            <td v-for="right_item,index in right_items" :class="{right_item_content: right_itemContent==i}">
                <tr v-for="right_list in right_item.lists" :class="{right_list_content: right_listContent==i}">{{right_list.tdName}}</tr>
            </td>
        </div>
    </table>
    <div class="btn">
        <button>確認</button>
        <button>返回</button>
    </div>

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
            chtName: '營區預訂管理',
            title:'營區預訂',
            detailsName:'預訂明細',
            left_titles:[
                {
                    thName:'訂單編號：',
                },
                {
                    thName:'營帳編號：',
                },
                {
                    thName:'會員編號：',
                },
                {
                    thName:'會員姓名：',
                },
                {
                    thName:'營帳類型：',
                },
                {
                    thName:'活動選擇：',
                },
                {
                    thName:'食材選擇：',
                },
                {
                    thName:'裝備選擇：',
                },
                {
                    thName:'預訂地區：',
                },
            ],
            left_items:[       
                {
                    left_lists:[
                        {
                            tdName:'11111111',
                        },
                        {
                            tdName:'1111',
                        },
                        {
                            tdName:'11111111',
                        },
                        {
                            tdName:'王先生',
                        },
                        {
                            tdName:'豪華六人',
                        },
                        {
                            tdName:'Ａ方案',
                        },
                        {
                            tdName:'Ｂ方案',
                        },
                        {
                            tdName:'無',
                        },
                        {
                            tdName:'冰雪奇緣',
                        },
                    ]
                },
            ],
            right_titles:[
                {
                    thName:'付款方式：',
                },
                {
                    thName:'付款時間：',
                },
                {
                    thName:'帳號後五碼：',
                },
                {
                    thName:'訂單總金額：',
                },
                {
                    thName:'下單時間：',
                },
                {
                    thName:'入住日期：',
                },
                {
                    thName:'退房日期：',
                },
                {
                    thName:'狀態：',
                },
            ],
            right_items:[       
                {
                    left_lists:[
                        {
                            tdName:'11111111',
                        },
                        {
                            tdName:'1111',
                        },
                        {
                            tdName:'11111111',
                        },
                        {
                            tdName:'王先生',
                        },
                        {
                            tdName:'豪華六人',
                        },
                        {
                            tdName:'Ａ方案',
                        },
                        {
                            tdName:'Ｂ方案',
                        },
                        {
                            tdName:'無',
                        },
                        {
                            tdName:'冰雪奇緣',
                        },
                    ]
                },
            ],
        }
    },
}
</script>

<style lang="scss" scoped>

    @import'@/assets/Scss/Page/details.scss';
    
</style>
