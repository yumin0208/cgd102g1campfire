<template>
    <MainHeader/>
    <!-- banner -->
    <div class="banner">
        <img src="@/assets/images/main/banner_report.png" alt="banner">
    </div>
    <!-- 發布報告 -->
    <!-- @update-result='updateResultReload' -->
    <ReportPublish v-if="discussReport.length>0" :disPublish="discussReport"/>
    <!-- <ReportPublish /> -->
    <!-- 報告討論 -->
    <!-- @change="goReload" -->
    <ReportCard v-if="discussReport.length>0" :disCard="discussReport" :memNo="memNo"/>
    <!-- <ReportCard /> -->
    <MainFooter/>
</template>

<script>
import ReportPublish from '@/components/ReportPublish.vue';
import ReportCard from '@/components/ReportCard.vue';

export default {
    components: {
        ReportPublish,
        ReportCard,
    },
    data() {
        return {
            discussReport: [],
            // reload: false,
            // discussReport: [{報告1},{報告2}],
            memNo: null,
        }
    },
    methods:{
        scrollToTop(){
            window.scrollTo(0,0)
        },
        //拿到會員資料
        getMemData(){
            let member = JSON.parse(sessionStorage.getItem('member'));
            this.memNo = member.mem_no;
            // console.log(this.member)  
        },
        // 抓取報告資訊
        FetchAPIDiscuss(){
            fetch(process.env.VUE_APP_PHP_PATH + 'discussCard.php'
            ).then((response) => {
                if(response){
                    this.fetchError = (response.status !== 200)
                    //json(): 返回 Promise，resolves 是 JSON 物件
                    return response.json()
                }
            }).then(responseText => {
                this.discussReport = responseText;
                console.log(this.discussReport);
            }).catch((err) => {
                this.discussReport = []
                // this.discussCard = true
            })
        },
        //emt傳資料
        // updateResultReload(){
        //     this.reload = this.FetchAPIDiscuss;
        // },
        // goReload() {
        //     if(this.reload == true){
        //         this.FetchAPIDiscuss();
        //         this.reload = false;
        //     }
        // },
    },
    created() {
        this.FetchAPIDiscuss();
        this.getMemData();
    },
    mounted(){
        this.scrollToTop()
    }
}
</script>


<style lang="scss" scoped>
    @import '../assets/scss/style.scss';
</style>