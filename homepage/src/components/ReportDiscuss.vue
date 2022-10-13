<template>
    <div class="row_report_write">
        <!-- 明信片 -->
        <div class="col_postcard">
            <div class="postcard_group">
                <div class="postcard_release">

                    <h3 class="postcard_title_area">{{discuss.discuss_title}}</h3>
                    <p class="postcard_text_area">{{discuss.discuss_content}}</p>
                    <!-- 檢舉 留言 button -->
                    <div class="report_btn">
                        <!-- 檢舉icon -->
                        <div 
                            class="inform_icon" 
                            @click="isShowGo"
                        >
                            <img src="@/assets/images/report/report_icon_caution.png" alt="caution">
                        </div>
                        <div class="message_icon">
                            <img src="@/assets/images/report/report_msg_1.png" alt="report">
                            <p class="message_count">{{discuss.comment_count}}</p>
                        </div>
                    </div>
                </div>

                <!-- 頭像 會員 -->
                <div class="postcard_member_data">
                    <div class="member_content">
                        <div class="postcard_member_pic">
                            <img :src="require(`@/assets/images/report/report_avatar_${discuss.mem_pic}.png`)" alt="avatar">
                        </div>
                        <div class="postcard_name_time">
                            <h4 class="postcard_member_name">{{discuss.mem_nick_name}}</h4>
                            <p class="postcard_release_time">{{formatDate(discuss.discuss_post_time)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 明信片背景 -->
            <div class="postcard_bg">
                <img :src="require(`@/assets/images/report/report_postcard_${discuss.background_type}.jpg`)" alt="postcard">
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
                                @click="reportDiscuss(discuss_no)"
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
</template>

<script>

export default {
    props: ['discuss', 'discussId'],
    name: "ReportDiscuss",
    components: {},
    data() {
        return {
            isShow: false,
            memNo: null,
            commentCount: [],
            // discuss_no: '',
            // discussCard:[]
        }
    },
    computed: {
        //燈箱
        modalStyle() {
            return {
                'display': this.isShow ? '' : 'none'
                //燈箱不隱藏 : 隱藏
            };
        }
    },
    methods: {
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
        this.getMemData()
    },
}

</script>

<style lang="scss" scoped>
@import '../assets/scss/style.scss';

.row_report_write{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

// 明信片
.col_postcard{
    position: relative;
    width: 70%;
    margin-bottom: 20px;
    @include lg(){
        width: 80%;
    }
    @include tb(){
        width: 100%;
    }
}
.postcard_group{
    position: absolute;
    display: flex;
    justify-content: space-between;
    padding: 20px;
    right: 0;
    left: 0;
    top: 0;
    bottom: 0;
    margin: auto;
    @include md(){
        flex-direction: column-reverse;
    }
}

//檢舉 留言 button
.report_btn{
    display: flex;
    justify-content: flex-end;
    align-items: center;
    vertical-align:middle;
}
.inform_icon img{
    width: 26px;
    cursor: pointer;
}
.message_icon{
    display: flex;
    margin-left: 20px;
    img{
        width: 26px;
        margin-right: 5px;
    }
    .message_count{
        color: #939393;
        font-size: 20px;
        font-weight: 700;
    }
}
.postcard_bg{
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .4);
    overflow: hidden;
    img{
        height: 100%;
        object-fit: cover;
    }
    @include md(){
        height: 600px;
    }
}
//文字
.postcard_release{
    width: 70%;
    padding: 20px;
    display: flex;
    flex-direction: column;
    @include md(){
        width: 100%;
        height: 80%;
    }
}
.postcard_title_area{
    padding: 0 0 20px;
    color: $color-basic-gray3;
}
.postcard_text_area{
    color: $color-basic-gray2;
    text-align: justify;
    flex-grow: 1;
}
// 頭像會員
.postcard_member_data{
    width: 30%;
    text-align: center;
    border-left: 2px solid $color-basic-gray1;
    @include md(){
        width: 100%;
        height: 20%;
        border-left: none;
        border-bottom: 2px solid $color-basic-gray1;
    }
}
.member_content{
    margin: 0 40px;
    @include md(){
        width: 100%;
        height: 100%;
        display: flex;
        margin: 0;
        justify-content: flex-start;
        align-items: center;
    }
}
.postcard_member_pic{
    width: 80%;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 10px;
    @include md(){
        width: 80px;
        height: 80px;
        margin: 0 20px 0 0;
    }
}
//會員名字 時間 0929
.postcard_member_name{
    margin-bottom: 5px;
}
.postcard_release_time{
    color: $color-basic-gray2;
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