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
        <!-- <input type="text" placeholder="搜尋"/> -->
        <!-- <button>新增</button> -->
        <!-- <button>修改</button> -->
        <button>刪除</button>
    </div>
    <table>
        <tr class="table_title">
            <th v-for="item in titles" :key="item">{{item}}</th>
        </tr>
        <tr class="item_content" 
            v-for="item in discuss" 
            :key="item" 
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
        };
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

</style>
