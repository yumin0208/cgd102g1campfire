<template>
    <section class="wrap_card_report">
        <div class="report_container">
            <div class="title_main">
                <h2>報告討論</h2>
            </div>
            <!-- 最新熱門btn -->
            <div class="report_new_hot">
                <form class="new_hot_choose">
                    <button class="btn_report_new" type="button"
                        @click="activeBtn = 'timeDate'" 
                        :class="{btn_active:activeBtn === 'timeDate'}"
                        >最新報告
                    </button>
                    <button class="btn_report_new" type="button"
                        @click="activeBtn = 'hotData'" 
                        :class="{btn_active:activeBtn === 'hotData'}"
                        >熱門報告
                    </button>
                </form>
            </div>
            <!-- 報告卡片 -->
            <div id="discussCard">
                <div class="row_card_report">
                    <div class="col_card_report" v-for="item in filterData" :key="item.discuss_no">
                        <div class="report_mem">
                            <div class="mem_pic">
                                <!-- <img :src="require(`${item.memPic}`)" alt="avatar"> -->
                                <img :src="require(`@/assets/images/report/report_avatar_${item.mem_pic}.png`)" alt="avatar">
                            </div>
                            <div class="mem_data">
                                <h4 class="mem_name">{{item.mem_nick_name}}</h4>
                                <p class="release_time">{{formatDate(item.discuss_post_time)}}</p>
                            </div>
                        </div>
                        <div class="report_content">
                            <h4 class="report_title">{{item.discuss_title}}</h4>
                            <p class="report_txt">{{item.discuss_content}}</p>
                        </div>
                        <div class="report_btn">
                            <!-- 檢舉icon -->
                            <div 
                                class="inform_icon" 
                                @click="isShowGo"
                            >
                                <img src="@/assets/images/report/report_icon_caution.png" alt="caution">
                            </div>
                            <!-- 連結使用抓取報告的id，discuss_no，使用query傳遞資料，?no=1-->
                            <!-- <router-link class="message_icon" :to="`/reportMessage?discuss_no=${item.discuss_no}`"> -->
                            <router-link 
                                class="message_icon" 
                                :to="{
                                    name:'ReportMessage',
                                    query: {
                                        'discuss_no': item.discuss_no
                                    }
                                }"
                                @click="checkId"
                            >
                            <!-- v-if="message_show == false" -->
                                <img src="@/assets/images/report/report_msg_1.png" alt="report">
                                <p class="message_count">{{item.comment_count}}</p>
                            </router-link>
                        </div>
                    </div>
                </div>
                <!-- 分頁 -->
                <div class="btnContainer">
                    <button @click="prevPage" type="button"> ＜ </button>
                    <button 
                        v-for="page in paginateTotal" 
                        :key="page"
                        :class="{'activeBtnStyle': (current === page)}"
                        @click="current = page"  
                        type="button"
                    >
                        {{page}}
                    </button>
                    <button @click="nextPage" type="button"> ＞ </button>
                </div>
            </div>
            <!-- 判斷登入 -->
            <ReportLoginBox @close="loginBox" v-if="login"/>
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
                                    @click="reportDiscuss(item.discuss_no)"
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
</template>

<script>
import ReportLoginBox from '../components/ReportLoginBox.vue';

export default {
    props: ['disCard','memNo'],
    name: "ReportCard",
    el: '#discussCard',
    components: {
        ReportLoginBox,
    },
    data(){
        return {
            activeBtn:'timeDate',
            current: 1,
            paginate: 6,
            isShow: false,
            member: [],
            login: false, //請先登入
            // 原始資料
            // discussCard: [],
        }
    },
    computed: {
        paginateTotal() {
            //卡片長度 除以 一頁可顯示的數量，會有小數點所以要用Math無條件進位
            return Math.ceil(this.disCard.length / this.paginate)
        },
        //因為直接在computed做計算，資料是彈性的，做熱門和時間判斷
        //key值要抓報告編號，只有編號都會是不樣的
        filterData() {
            //一頁有幾筆數目，透過slice做計算，所以不能寫discussCard原始資料
            //array.slice((page_number - 1) * page_size, page_number * page_size);
            let arr = this.activeBtn == 'timeDate' ? this.timeDate : this.hotData;
            return arr.slice((this.current - 1) * this.paginate , this.current * this.paginate);
        },
        hotData() {
            //根據留言數做比較排序
            // console.log(this.discussCard.comment_count);
            return [...this.disCard].sort( function(a,b) {
                return b.comment_count - a.comment_count;
            });
        },
        timeDate() {
            return [...this.disCard].sort( function(a,b) {
                return Date.parse(b.discuss_post_time) - Date.parse(a.discuss_post_time);
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
    methods: {
        //當前頁面是第一頁，不能再往前
        prevPage(){
            if(this.current === 1) return
            this.current -= 1
        },
        //當前頁面是最後一頁，不能再往後
        nextPage(){
            if(this.current >= this.paginateTotal) return
            this.current += 1
        },
        selectPage(val){
            this.current = val
        },
        // 請先登入
        loginBox (response) {
            this.login = response;
        },
        //把資料庫撈出來的時間，在做轉換喧染
        formatDate(date) {
            const myDate = new Date(date); 
            return `${myDate.getFullYear()}-${myDate.getMonth() + 1}-${myDate.getDate()}` 
        },
        //檢舉燈箱
        toggleModal() { 
            this.isShow = !this.isShow;
            //關閉燈箱
        },
        //報告檢舉送出
        reportDiscuss(e){
            let xhr = new XMLHttpRequest();
            xhr.open("POST",process.env.VUE_APP_PHP_PATH + 'discussReportDis.php',true);
            
            let formData = new FormData();
            // formData.append('comment_no', this.comment_no);
            formData.append('discuss_no', e);
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
        //確認有無登入，判斷跳轉留言頁面
        // checkId() {
        //     let checkLogin = sessionStorage.getItem('member');
        //     if(checkLogin == null){
        //         // alert("請先登入");
        //         this.login = true
        //     }else{
        //         this.message_show = true;
        //     }
        // }
    },
    created() {
        //是否有登入狀態
        let checkLogin = sessionStorage.getItem('member');
        if(checkLogin == null){
            return
        }else{
            this.message_show = true;
        }
        //拿到會員資料
        // this.getMemData()
    },
    watch: {
        // 做監聽，不管在最新和最熱都要回第一頁
        activeBtn(){
            this.current = 1
        }
    }
}
</script>

<style lang="scss" scoped>
@import '../assets/scss/style.scss';

// 分頁 按紐
.btnContainer{
    display: flex;
    justify-content: center;
    button{
        cursor: pointer;
        border: none;
        width: 35px;
        height: 35px;
        padding: 10px;
        margin: 0 10px;
        border-radius: 50%;
        color: $color-basic-White;
        background: $color-aid-green1;
        text-align: center;
        font-weight: 700px;
    }
    .activeBtnStyle{
        background: $color-str-green;
        color: $color-basic-White;
        border: none;
    }
}

.wrap_card_report{
    padding: 150px 0;
    background: $color-main-yellow;
}
.report_container{
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

//最新 熱門 btn
.report_new_hot {
    display: flex;
    justify-content: flex-end;
    padding: 0 30px 30px;
}
.btn_report_new {
    font-size: $txt_btn;
    font-weight: 700;
    letter-spacing: 1px;
    border-radius: 5px;
    padding: 8px 10px;
    margin-left: 15px;
    border: 2px solid $color-str-green;
    color: $color-str-green;
    background: $color-basic-White;
    cursor: pointer;
    &:hover{
        background: $color-str-green;
        color: $color-basic-White;
        border: 2px solid $color-str-green;
    }
}
.btn_active{
    background: $color-str-green;
    color: $color-basic-White;
    border: 2px solid $color-str-green;
}
//卡片
.row_card_report {
    display: flex;
    // justify-content: center;
    flex-wrap: wrap;
    margin: 0 auto;
    padding: 0 0 60px;
}
.col_card_report {
    display: flex;
    flex-direction: column;
    width: 31%;
    height: 480px;
    margin: 10px;
    padding: 30px;
    border-radius: 10px;
    background: #fff;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
    @include lg() {
        width: 45%;
    }
    @include md() {
        width: 100%;
    }
}
.report_mem {
    display: flex;
    align-items: center;
    padding-bottom: 20px;
    border-bottom: 1px solid #8a8a8a;
}
.mem_pic {
    width: 80px;
    border-radius: 50px;
    overflow: hidden;
    margin-right: 20px;
}
.report_content {
    flex-grow: 1;
    padding: 20px 0;
}
.report_title {
    margin-bottom: 10px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    text-align: justify;
}
.report_txt {
    color: $color-basic-gray2;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 8;
    -webkit-box-orient: vertical;
    text-align: justify;
}

//檢舉 留言 button
.report_btn{
    display: flex;
    justify-content: flex-end;
    align-items: center;
    vertical-align:middle;
}
.message_icon{
    display: flex;
    margin-left: 20px;
    img{
        width: 26px;
        margin-right: 5px;
    }
    .message_count{
        color: $color-basic-gray1;
        font-size: 20px;
        font-weight: 500;
    }
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
