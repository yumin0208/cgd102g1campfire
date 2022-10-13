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
    <tr class="item_content" v-for="item in reserve" :key="item">
        <td>{{item.reserve_no}}</td>
        <td>{{item.tent_style_no}}</td>
        <td>{{item.reserve_date}}</td>
        <td>{{item.tent_left}}</td>
        <td>{{item.tent_stock}}</td>
        <td>{{item.reserve_status}}</td>
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
        chtName: '預約狀態管理',
        title: '營區預訂',
        path: '/Reservation',
        titles: [
            '預約編號',
            '營帳類型編號',
            '日期',
            '已預訂帳數',
            '原有帳數',
            '預約狀態編號',
            '詳細資訊',
        ],
        reserve: [],
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
            this.reserve = responseText;
            })
            .catch((err) => {
            this.reserve = [];
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
