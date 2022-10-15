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
        <button 
                class="btn_no" 
                type="button"
                @click="activeBtn = 'numberDate'" 
                :class="{btn_active:activeBtn === 'numberDate'}"
        >編號排序
        </button>
        <button 
                class="btn_new" 
                type="button"
                @click="activeBtn = 'timeDate'" 
                :class="{btn_active:activeBtn === 'timeDate'}"
        >最新報告
        </button>
    </div>
    <table>
        <tr class="table_title">
            <th v-for="item in titles" :key="item">{{item}}</th>
        </tr>
        <tr class="item_content" 
            v-for="item in filterData" 
            :key="item.discuss_no" 
            @click="goInfo(item)"
        >
            <td>{{item.discuss_no}}</td>
            <td>{{item.mem_no}}</td>
            <td>{{item.discuss_title}}</td>
            <td>{{item.discuss_content}}</td>
            <td>{{item.discuss_post_time}}</td>
            <td>{{item.discuss_status}}</td>
            <td>{{item.comment_count}}</td>
            <td>{{item.background_type}}</td>
        </tr>
    </table>
    </section>
    <Footer></Footer>
</template>

<script>
// 強制刷新，或跳轉頁面
import { useRouter } from "vue-router";

export default {
    name: 'Report',
    path:'/Report',
    data() {
        return {
            chtName: '營火報告管理',
            title: '營火報告',
            path:'/Report',
            titles: [
                '報告編號',
                '會員編號',
                '報告標題',
                '報告內容',
                '發佈時間',
                '報告狀態',
                '留言數量',
                '背景樣式',
            ],
            // 將報告資料塞進
            discuss: [],
            router:useRouter(),
            activeBtn:'timeDate',
            current: 1,
            paginate: 1000,
        };
    },
    computed: {
        paginateTotal() {
            //卡片長度 除以 一頁可顯示的數量，會有小數點所以要用Math無條件進位
            return Math.ceil(this.discuss.length / this.paginate)
        },
        filterData() {
            //一頁有幾筆數目，透過slice做計算，所以不能寫discussCard原始資料
            //array.slice((page_number - 1) * page_size, page_number * page_size);
            let arr = this.activeBtn == 'timeDate' ? this.timeDate : this.numberDate;
            return arr.slice((this.current - 1) * this.paginate , this.current * this.paginate);
        },
        numberDate() {
            //根據留言數做比較排序
            // console.log(this.discussCard.comment_count);
            return [...this.discuss].sort( function(a,b) {
                return a.discuss_no - b.discuss_no;
            });
        },
        timeDate() {
            return [...this.discuss].sort( function(a,b) {
                return Date.parse(b.discuss_post_time) - Date.parse(a.discuss_post_time);
                //將時間轉換成秒數
            });
        },
    },
    methods: {
        // 抓取報告資訊
        FetchAPIDiscuss(){
            fetch(process.env.VUE_APP_PHP_PATH + 'backDiscussCard.php').then((response) => {
                if(response){
                    this.fetchError = (response.status !== 200)
                    return response.json()
                }
            }).then(responseText => {
                this.discuss = responseText;
                console.log(this.discuss);
            }).catch((err) => {
                this.discuss = [];
            })
        },
        goInfo(e){
            console.log(e)
            sessionStorage.setItem("discuss", JSON.stringify(e) );
            let thus = this;
            thus.router.push({path:'/ReportInfo'});
        },
    },
    created() {
        this.FetchAPIDiscuss();
    },
}
</script>

<style lang="scss" scoped>
@import'@/assets/scss/style.scss';

.serch_bar{
    .btn_no , .btn_new{
        width: 100px;
    }
}
.btn_active{
    background: #0e685e;
    color: #ffff;
}
</style>
