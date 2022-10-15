<template>
    <Menu></Menu>
    <Header></Header>
    <section class="page_section">
        <header class="project_header">
            <div class="header_left">
                <p class="router_name">最新消息</p>
            </div>
            <div class="breadcrumb">
                <span>最新消息  &nbsp> &nbsp</span><router-link to ="/NewsRelease">消息發布管理 </router-link><span>&nbsp&nbsp > &nbsp新增文章</span>
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
            <div class="btn">
                <button class="addNews" id="addNews" @click="addNews">確認</button>
                <button class="go_back" id="go_back" @click="goBack">返回</button>
            </div>
        </form>

    </section>
    <Footer></Footer>
</template>

<script>
import { useRouter } from "vue-router";

export default {
    data(){
        return{
            news_title:'',
            news_content:'',
            news_status:'',
            newsmodifydata:{},
            news_data:[],
            router:useRouter()
        }
    },
    methods:{
        addNews(e){
            if(
                //指定css選擇器的節點
                e.target.closest('button') &&
                e.target.closest('button').id === 'addNews'
                ) {
                //取消預設submit事件
                e.preventDefault()
                if(this.news_title == "" || this.news_content == "" || this.news_status ==""){
                    alert('有欄位空白喔！')
                }else{
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST",process.env.VUE_APP_PHP_PATH + 'backstation_news_add.php', true);
                    let formData = new FormData();
                    formData.append('news_title', this.news_title);
                    formData.append('news_content', this.news_content);
                    formData.append('news_status', this.news_status);
                    xhr.send(formData);
                    xhr.onload = ()=>{
                        // console.log(xhr.responseText);
                        if(xhr.status == 200){
                            let thus = this
                            alert("發布成功");
                            thus.router.push({path:'/NewsRelease'});
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
                let thus = this;
                thus.router.push({path:'/NewsRelease'})
            }
        },
        getEmpData(){
            this.emp_login = JSON.parse(sessionStorage.getItem('emp_login'));
            this.employee_name = this.emp_login.employee_name;
        }
    },
    created() {
        this.getEmpData();
        let checkLogin = sessionStorage.getItem('emp_login');
        if(checkLogin == null){
        alert("請先登入");
        let thus = this;
        thus.router.push({path:'/Login'})
        }else{
        if(this.emp_login.employee_auth != 1){
            console.log(this.emp_login.employee_auth)
            alert("權限不足")
            let thus = this;
            thus.router.push({path:'/home'})
        }else{
            return;
        }
        }
    },
}
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';
@import'@/assets/scss/components/form.scss';

</style>