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
            <tr class="item_content" v-for="item in equip" :key="item">
                <td>{{item.equip_no}}</td>
                <td>{{item.equip_name}}</td>
                <td>{{item.equip_price}}</td>
                <td>{{item.equip_pic}}</td>
                <td>{{item.equip_info}}</td>
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
        chtName: '裝備方案管理',
        title: '營區服務',
        path:'/EquipmentPlan',
        titles: [
            '裝備編號',
            '裝備名稱',
            '裝備價格',
            '裝備圖片',
            '裝備介紹',
            '詳細資訊',
        ],
        equip: [],
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
            this.equip = responseText;
            })
            .catch((err) => {
            this.equip = [];
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
