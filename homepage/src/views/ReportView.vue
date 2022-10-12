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
    <ReportCard v-if="discussReport.length>0" :disCard="discussReport"/>
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
        }
    },
    methods:{
        scrollToTop(){
            window.scrollTo(0,0)
        },
        //寫入新報告
        // DiscussSend(){
        //     let xhr = new XMLHttpRequest();
        //     xhr.open("POST",process.env.VUE_APP_PHP_PATH + 'discussSend.php',true);
        //     // xhr.send(null);

        //     // let discuss_data = `mem_no=${this.member.mem_no}&
        //     //                     discuss_title=${this.discuss_title}&
        //     //                     discuss_content=${this.discuss_content}&
        //     //                     background_type=${this.background_type}`;
        //     let formData = new FormData();
        //     formData.append('mem_no', this.member.mem_no);
        //     formData.append('discuss_title', this.discuss_title);
        //     formData.append('discuss_content', this.discuss_content);
        //     formData.append('background_type', this.background_type);
        //     xhr.send(formData);
        //     console.log(object);
        //     this.FetchAPIDiscuss();
        //     alert("發佈成功");
        //     this.discuss_title = '';
        //     this.discuss_content = '';
        //     this.background_type = '1';
        // },
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
    },
    mounted(){
        this.scrollToTop()
    }
}
</script>


<style lang="scss" scoped>
    @import '../assets/scss/style.scss';
</style>