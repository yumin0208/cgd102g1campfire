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
    <tr class="item_content" v-for="item in activity" :key="item">
        <td>{{item.activity_no}}</td>
        <td>{{item.area_no}}</td>
        <td>{{item.activity_name}}</td>
        <td>{{item.activity_subtitle}}</td>
        <td>{{item.activity_synopsis}}</td>
        <td>{{item.activity_info}}</td>
        <td>{{item.activity_pic}}</td>
        <td>{{item.activity_price}}</td>
        <td>{{item.activity_suitable_guest}}</td>
        <td>{{item.activity_note}}</td>
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
        chtName: '活動方案管理',
        title: '營區導覽',
        path:'/ActivityPlan',
        titles: [
            '活動編號',
            '地區編號',
            '活動名稱',
            '活動介紹副標題',
            '活動簡介',
            '活動介紹',
            '活動圖片',
            '活動價格',
            '活動適合族群',
            '活動注意事項',
            '詳細資訊',
        ],
        activity: [],
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
            this.activity = responseText;
            })
            .catch((err) => {
            this.activity = [];
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
