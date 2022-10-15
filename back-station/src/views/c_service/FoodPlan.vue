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
            <tr class="item_content" v-for="item in food" :key="item">
                <td>{{item.food_no}}</td>
                <td>{{item.food_name}}</td>
                <td>{{item.food_price}}</td>
                <td>{{item.food_info}}</td>
                <td>{{item.food_pic}}</td>
                <td>{{item.food_status}}</td>
                <td><button>更多</button></td>
            </tr>
        </table>
    </div>
    
</section>
<Footer></Footer>
</template>

<script>

export default {
    data() {
        return {
        chtName: '食材方案管理',
        title: '營區服務',
        path:'/FoodPlan',
        titles: [
            '食材方案編號',
            '食材方案名稱',
            '食材價格',
            '食材介紹',
            '食材圖片',
            '食材狀態',
            '詳細資訊',
        ],
        food: [],
        };
    },
    methods: {
        FetchAPIComment() {
        fetch(process.env.VUE_APP_PHP_PATH + 'backstation_serviceFood.php')
            .then((response) => {
            if (response) {
                this.fetchError = response.status !== 200;
                return response.json();
            }
            })
            .then((responseText) => {
            this.food = responseText;
            })
            .catch((err) => {
            this.food = [];
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
