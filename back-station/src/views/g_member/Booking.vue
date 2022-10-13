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
    <tr class="item_content" v-for="item in orders" :key="item">
        <td>{{item.order_no}}</td>
        <td>{{item.mem_id}}</td>
        <td>{{item.mem_name}}</td>
        <td>{{item.tent_no}}</td>
        <td>{{item.tent_style_no}}</td>
        <td>{{item.payment_methods}}</td>
        <td>{{item.payment_status}}</td>
        <td>{{item.order_total}}</td>
        <td>{{item.checkin_date}}</td>
        <td>{{item.checkout_date}}</td>
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
    chtName: '預訂訂單管理',
    title: '會員中心',
    path:'/Booking',
    titles: [
        '預訂號碼',
        '會員ID',
        '會員姓名',
        '營帳編號',
        '營帳類型編號',
        '付款方式',
        '付款狀態',
        '總金額',
        '入住日期',
        '退房日期',
        '詳細資訊',
    ],
    orders: [],
    };
},
methods: {
    FetchAPIComment() {
    fetch(process.env.VUE_APP_PHP_PATH + 'backstation_bookedOrders.php')
        .then((response) => {
        if (response) {
            this.fetchError = response.status !== 200;
            return response.json();
        }
        })
        .then((responseText) => {
        this.orders = responseText;
        })
        .catch((err) => {
        this.orders = [];
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
