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
    <tr class="item_content" v-for="item in employee" :key="item">
        <td>{{item.employee_no}}</td>
        <td>{{item.employee_name}}</td>
        <td>{{item.employee_auth}}</td>
        <td>{{item.employee_sex}}</td>
        <td>{{item.employee_email}}</td>
        <td>{{item.employee_phone}}</td>
        <td>{{item.employee_status}}</td>
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
        chtName: '員工資訊管理',
        title: '員工專區',
        path:'/Employee',
        titles: [
            '員工編號',
            '員工姓名',
            '權限',
            '員工性別',
            '員工信箱',
            '員工電話',
            '員工狀態',
            '詳細資訊',
        ],
        employee: [],
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
            this.employee = responseText;
            })
            .catch((err) => {
            this.employee = [];
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
