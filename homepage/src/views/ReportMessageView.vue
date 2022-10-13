<template>
    <MainHeader/>
    <!-- banner -->
    <div class="banner" >
        <img src="@/assets/images/main/banner_report.png" alt="banner">
    </div>
    <!-- 報告留言 -->
    <section class="wrap_report_message">
        <div class="message_container">
            <div class="title_main">
                <h2>報告留言</h2>
            </div>
            <!-- 返回報告 -->
            <router-link class="Report_link_path" to="/Report">
                <div class="back_Report_page">
                    <img class="back_Report_icon" src="@/assets/images/booking/booking_arrow_prev.png" alt="">
                    <span>返回報告</span>
                </div>
            </router-link>
            <!-- 明信片留言 -->
            <ReportDiscuss v-if="commentCount.length>0" :discuss="commentCount[0]"/>

            <!-- 會員個人留言欄 -->
            <div class="message_member_container">
                <form class="message_personal">
                    <textarea 
                            class="personal_write" 
                            type="text" maxlength="300" 
                            v-model="comment_content" 
                            placeholder="請寫入留言(300字以內)"
                    >
                    </textarea>
                    <button 
                            class="btn_confirm" 
                            @click="DiscussComment" 
                            type="button"
                    >留言
                    </button>
                </form>
            </div>

            <!-- 其他會員留言區 -->
            <div class="other_message_wrap">
                <div class="row_other_member" v-for="item in commentDate" :key="item.comment_no">
                    <div class="col_other_data">
                        <div class="member_pic">
                            <img :src="require(`@/assets/images/report/report_avatar_${item.mem_pic}.png`)" alt="avatar">
                        </div>
                        <h4 class="member_name">{{item.mem_nick_name}}</h4>
                    </div>
                    <!-- 發佈時間 檢舉 -->
                    <div class="col_other_message">
                        <div class="other_message_content">
                            <p class="other_write">{{item.comment_content}}</p>
                            <div class="message_time_inform">
                                <!-- 檢舉icon -->
                                <div 
                                    class="inform_icon" 
                                    @click="isShowGo"
                                >
                                    <img src="@/assets/images/report/report_icon_caution.png" alt="caution">
                                </div>
                                <p class="message_time">{{formatDate(item.comment_date)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 檢舉燈箱 -->
            <div class="report_lightbox">
                <div 
                    to="body" 
                    class="modal_mask" 
                    :style="modalStyle" 
                >
                    <div class="modal_container" @click.self="toggleModal">
                        <div class="modal_body">
                            <p>檢舉原因</p>
                            <form>
                                <textarea 
                                        class="inform_txt" 
                                        type="text" 
                                        maxlength="150"
                                        v-model="report_content"
                                        placeholder="請輸入內文(150字以內)"
                                ></textarea>
                                <button 
                                    class="btn_confirm" 
                                    type="button"
                                    @click="reportComment(item.comment_no)"
                                >
                                送出
                                </button>
                            </form>
                            <span class="btn_closure">
                                <img src="@/assets/images/main/main_icon_closure.png" alt="closure" @click.self="toggleModal">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <MainFooter/>
    <!-- 接收報告頁面的discuss_no，在methods寫fetch function，把discuss_no post 到後端hpp，再把function塞進 beforeMounted， -->
</template>

<script>
import ReportDiscuss from '../components/ReportDiscuss.vue';
import { useRouter } from "vue-router";

export default {
    name: "ReportMessage",
    components: {
        ReportDiscuss,
    },
    data() {
        return {
            discussId: 0,
            commentCount: [],
            // commentCount: [ [{報告內容}] , [{留言1},{留言2}] ],
            router:useRouter(),
            isShow: false,
            memNo: null,
        }
    },
    computed: {
        commentDate() {
            return [...this.commentCount[1]].sort( function(a,b) {
                return Date.parse(b.comment_date) - Date.parse(a.comment_date);
                //將時間轉換成秒數
            });
        },
        //燈箱
        modalStyle() {
            return {
                'display': this.isShow ? '' : 'none'
                //燈箱不隱藏 : 隱藏
            };
        }
    },
    //new FormData().append('變數名稱', 值)
    methods: {
        //讓滾輪維持在上
        scrollToTop(){
            window.scrollTo(0,0)
        },
        //拿到會員資料
        getMemData(){
            let member = JSON.parse(sessionStorage.getItem('member'));
            this.memNo = member.mem_no;
            // console.log(this.member)  
        },
        //把資料庫撈出來的時間，在做轉換喧染
        formatDate(date) {
            const myDate = new Date(date); 
            return `${myDate.getFullYear()}-${myDate.getMonth() + 1}-${myDate.getDate()}` 
        },
        //抓報告id，連結報告資料
        FetchAPIComment(){
            // let discuss_no = location.search.slice(1).split('=')[1];
            //透過 vue router取得query的值
            //discussId = 條件判斷 ? 運算式A : 運算式B
            this.discussId = this.$route.query && this.$route.query.discuss_no ? this.$route.query.discuss_no : null
            //使用fetch 需加判斷式，抓不到php資料 網頁也可以出現
            if(!this.discussId) return
            fetch(process.env.VUE_APP_PHP_PATH + `discussComment.php?discuss_no=${this.discussId}`
            ).then((response) => {
                if(response){
                    this.fetchError = (response.status !== 200)
                    //json(): 返回 Promise，resolves 是 JSON 物件
                    return response.json()
                }
            }).then(responseText => {
                this.commentCount = responseText;
            }).catch((err) => {
                this.commentCount = []
            })
        },
        //確認有無登入，判斷檢舉
        isShowGo(){
            let checkLogin = sessionStorage.getItem('member');
            if(checkLogin == null){
                // alert("請先登入");
                this.login = true
            }else{
                this.isShow = true;
            }
        },
        //對報告進行留言
        DiscussComment(){
            let xhr = new XMLHttpRequest();
            xhr.open("POST",process.env.VUE_APP_PHP_PATH + 'discussMessage.php',true);

            // let comment_data = `mem_no=${this.member.mem_no}&
            //                     discuss_no=${this.discussId}&
            //                     comment_content=${this.comment_content}`;
            let formData = new FormData();
            formData.append('mem_no', this.member.mem_no);
            formData.append('discuss_no', this.discussId);
            formData.append('comment_content', this.comment_content);
            xhr.send(formData);
            console.log(formData);
            this.FetchAPIComment();
            alert("留言成功");
            this.comment_content = '';
            let thus = this;
            // thus.router.go(0)
        },
        //檢舉燈箱
        toggleModal() { 
            this.isShow = !this.isShow;
            //關閉燈箱
        },
        //留言檢舉送出
        reportComment(e){
            let xhr = new XMLHttpRequest();
            xhr.open("POST",process.env.VUE_APP_PHP_PATH + 'discussReportCom.php',true);
            
            let formData = new FormData();
            formData.append('comment_no', e);
            formData.append('memNo', this.memNo);
            formData.append('report_content', this.report_content);
            xhr.send(formData);
            console.log(e);
            console.log(this.memNo);
            console.log(this.report_content);
            console.log(formData);
            alert("檢舉成功");
            this.report_content = '';
            this.toggleModal();
        },
    },
    created() {
        this.FetchAPIComment();
        //是否有登入狀態
        let checkLogin = sessionStorage.getItem('member');
        if(checkLogin == null){
            return
        }else{
            this.discuss_show = true;
        }
        this.getMemData();
    },
    mounted() {
        this.scrollToTop();
    },
}
</script>

<style lang="scss" scoped>
@import '../assets/scss/style.scss';
.wrap_report_message{
    padding: 150px 0;
    background: $color-basic-White;
}
.message_container{
    width: 80%;
    max-width: 1296px;
    margin: 0 auto;
    @include lg(){
        width: 90%;
    }
    @include md(){
        width: 95%;
    }
}
//返回報告
.Report_link_path{
    padding-bottom: 30px;
}
.back_Report_page{
    display: flex;
    justify-content: flex-start;
    align-items: center;
    span{
        color: $color-str-green;
        font-size: $title_h4;
        font-weight: 700;
        letter-spacing: 1px;
    }
    .back_Report_icon{
        width: 40px;
        padding-right: 10px;
    }
}
//會員個人留言欄
.message_member_container{
    width: 70%;
    padding: 20px;
    margin: 0 auto 20px;
    border-radius: 10px;
    background: $color-main-yellow;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .4);
    @include lg(){
        width: 80%;
    }
    @include tb(){
        width: 100%;
    }
}
.personal_write{
    width: 100%;
    height: 140px;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid $color-main-green;
    resize: none;
}
.message_personal{
text-align: end;
}
//其他會員留言
.other_message_wrap{
    width: 70%;
    padding: 20px;
    margin: 0 auto;
    border-radius: 10px;
    background: $color-main-yellow;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .4);
    @include lg(){
        width: 80%;
    }
    @include tb(){
        width: 100%;
    }
}
.row_other_member{
    padding: 16px;
    border-radius: 10px;
    background: $color-basic-White;
    margin: 0 0 20px;
}
.col_other_data{
    display: flex;
    justify-content: flex-start;
    align-items: center;
    width: 100%;
    margin-bottom: 14px;
}
.col_other_data .member_pic{
    border-radius: 50%;
    overflow: hidden;
    width: 40px;
    margin-right: 10px;
}
.other_message_content .other_write{
    margin-bottom: 20px;
    color: $color-basic-gray1;
    text-align: justify;
}
.inform_icon img{
    width: 26px;
    cursor: pointer;
}
.message_time_inform{
    display: flex;
    justify-content: flex-end;
}
.message_time{
    padding-left: 20px;
    color: $color-basic-gray1;
}
.message_inform_icon{
    width: 28px;
}

//燈箱================
//檢舉灰背景
.modal_mask {
    position: fixed;
    z-index: 1000;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    margin: auto;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    transition: opacity .3s ease;
}
.modal_container {
    cursor: pointer;
    width: 100%;
    height: 100%;
}
//檢舉區塊
.modal_body {
    position: relative;
    top: 50%;  
    left: 50%;
    transform: translate(-50%, -50%);
    cursor: auto;
    width: 400px;
    padding: 20px;
    border-radius: 5px;
    background-color: $color-main-yellow;
    text-align: center;
    h4 {
        color: $color-basic-gray2;
        padding-bottom: 20px;
    }
    p {
        font-size: $title_h4;
        font-weight: 700;
        letter-spacing: 1px;
        line-height: 24px;
    }
    @include md(){
            width: 300px;
        }
}
.inform_txt{
    width: 100%;
    height: 200px;
    letter-spacing: 1px;
    border-radius: 5px;
    padding: 10px 10px;
    margin-bottom: 20px;
    border: 1px solid $color-main-green;
    resize: none;
}
//叉叉
.btn_closure{
    position: absolute;
    cursor: pointer;
    width: 40px;
    top: 0;
    right: 0;
    transform: translate(50%, -50%);
}
//檢舉icon
.inform_icon{
    display: inline-block;
    width: 26px;
    cursor: pointer;
}
</style>