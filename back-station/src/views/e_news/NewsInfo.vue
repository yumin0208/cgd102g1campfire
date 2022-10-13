<template>
    <Menu></Menu>
    <Header></Header>
    <section class="page_section">
        <header class="project_header">
            <div class="header_left">
                <p class="router_name">最新消息</p>
            </div>
            <div class="breadcrumb">
                <span>最新消息  &nbsp> &nbsp</span><router-link to ="/NewsRelease">消息發布管理 </router-link><span>&nbsp&nbsp > &nbsp詳細內容</span>
            </div>
        </header>
        
        <form>
            <div class="row">
                <label for="news_title">文章標題：</label>
                <input id="news_title" type="text" v-model="news_title">
            </div>
            <div class="row">
                <label for="news_content">文章內容：</label>
                <textarea class="news_content" name="news_content" maxlength="300" v-model="news_content"></textarea>
            </div>
            <div class="news_pic">

            </div>
            <div class="row">
                <label for="news_status">消息狀態：</label>
                <select name="news_status" id="news_status" v-model="news_status">
                    <option value="1">顯示</option>
                    <option value="0">隱藏</option>
                </select>
            </div>
            <div class="row">
                發布時間：<span class="post_time">{{news_post_time}}</span>
            </div>
            <div class="btn">
                <button class="update" id="update" @click="update">確認</button>
                <button class="go_back" id="go_back" @click="goBack">返回</button>
            </div>
        </form>

    </section>
    <Footer></Footer>
</template>

<script>
import Menu from "@/components/Menu.vue";
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import { useRouter } from "vue-router";

export default {
    components: {
        Menu,
        Header,
        Footer
    },
    data(){
        return{
            news_title:'',
            news_content:'',
            news_status:'',
            news_post_time:'',
            newsmodifydata:{},
            news_data:[],
            router:useRouter()
        }
    },
    created(){
        this.getNewsData()
        this.fetchNewsData()
    },
    methods:{
        getNewsData(){
            //抓到sessionStorage的資料
            this.news = JSON.parse(sessionStorage.getItem('news'));
            //抓取文章編號，要去後端撈資料
            this.news_no = this.news.news_no;
            //確認有抓到東西
            console.log(this.news)
            console.log(this.news_no)
        },
        fetchNewsData(){
            console.log(this.news_no)
            fetch(process.env.VUE_APP_PHP_PATH + `backstaion_news_modify.php?news_no=${this.news_no}`)                
            .then((response) => {
                this.fetchError = (response.status !== 200)
            //json(): 返回 Promise，resolves 是 JSON 物件
                return response.json()
            }).then(responseText => {
                console.log(responseText)
                //傳送資料
                const useData = responseText
                //篩選文章編號之後撈回來的第一筆資料
                this.newsmodifydata = useData[0]
                //這邊的mem_xxx資料是綁在v-model上
                this.news_title = responseText.news_title;
                this.news_content = responseText.news_content;
                this.news_status = responseText.news_status;
                this.news_post_time = responseText.news_post_time;
            }).catch((err) => {
                this.newsmodifydata = true
            });
        },
        update(e){
            if (
                //指定css選擇器的節點
                e.target.closest('button') &&
                e.target.closest('button').id === 'update'
                ) {
                //取消預設submit事件
                    e.preventDefault()
                if(this.news_title == '' || this.news_content == '' ){
                    alert("不可以有空白喔");
                    return;
                }
                else{
                //沒有錯誤則將更新後的會員傳送到資料庫
                    var xhr = new XMLHttpRequest();
            
                    xhr.open("POST",process.env.VUE_APP_PHP_PATH + 'backstation_update_news.php', true);
                    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                    //回傳過去的資料
                    let news_data = `news_no=${this.news_no}&news_title=${this.news_title}&news_content=${this.news_content}&news_post_time=${this.news_post_time}&news_status=${this.news_status}`;
                    xhr.send(news_data);
                    //重新撈回資料庫資料，再寫進sessionStorage
                    xhr.onload = ()=>{
                        console.log(xhr.responseText);
                        if(xhr.status == 200){
                            this.session = JSON.parse(xhr.responseText);
                            console.log(this.session)
                            sessionStorage.setItem("news", JSON.stringify(this.session)); 
                            alert("修改成功");
                            let thus = this
                            thus.router.go(0)
                        }
                    }  
                }   
            }
        },
        goBack(e){
            if(
                //指定css選擇器的節點
                e.target.closest('button') &&
                e.target.closest('button').id === 'go_back'
                ) {
                //取消預設submit事件
                e.preventDefault()
                sessionStorage.removeItem("news", JSON.stringify(this.session));
                let thus = this;
                thus.router.push({path:'/NewsRelease'})
            }
        }
    },
}
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';
@import'@/assets/scss/components/form.scss';

</style>