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
                <tr class="item_content" v-for="item in discussChallenge" :key="item.report_no">
                    <td>{{item.report_no}}</td>
                    <td>{{item.comment_no}}</td>
                    <td>{{item.discuss_no}}</td>
                    <td>{{item.mem_no}}</td>
                    <td>{{item.report_content}}</td>
                    <td>{{item.report_time}}</td>
                    <td>{{item.report_result}}</td>
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
            chtName: '檢舉管理',
            title: '營火報告',
            path:'/Challenge',
            titles: [
                '檢舉編號',
                '留言編號',
                '會員編號',
                '報告編號',
                '檢舉內容',
                '檢舉時間',
                '處理結果',
                '詳細資訊',
            ],
            discussChallenge: [],
        };
    },
    methods: {
        // 抓取報告資訊
        FetchAPIChallenge(){
            fetch(process.env.VUE_APP_PHP_PATH + 'backDiscussReport.php').then((response) => {
                if(response){
                    this.fetchError = (response.status !== 200)
                    //json(): 返回 Promise，resolves 是 JSON 物件
                    return response.json()
                }
            }).then(responseText => {
                this.discussChallenge = responseText;
                console.log(this.discussChallenge);
            }).catch((err) => {
                this.discussChallenge = []
                // this.discussCard = true
            })
        },
    },
    created() {
        this.FetchAPIChallenge();
    },
};
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';

</style>
