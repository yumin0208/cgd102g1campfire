<template>
    <Menu></Menu>
    <Header></Header>
    <section class="page_section">
        <header class="project_header">
            <div class="header_left">
                <p class="router_name">主題地區</p>
            </div>
            <div class="breadcrumb">
                <span>主題地區  &nbsp> &nbsp</span><router-link to ="/ActivityPlan">地區發布管理 </router-link><span>&nbsp&nbsp > &nbsp詳細內容</span>
            </div>
        </header>
        
        <form>
            <div class="row">
                <p>地區名稱:{{areadata.area_name}}</p>
            </div>
            <div class="row">
                <p>地區介紹副標題:</p>
                <p>{{areadata.area_subtitle}}</p>
            </div>

            <div class="row">
                <p>地區介紹:{{areadata.area_info}}</p>
            </div>
            <div class="btn">
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
            areadata:[],
            router:useRouter()
        }
    },
    methods:{
        getAreaData(){
            //抓到sessionStorage的資料
            let area = JSON.parse(sessionStorage.getItem('area'));
            //抓取地區編號，要去後端撈資料
            this.areadata = area;
            //確認有抓到東西
        },
        goBack(e){
            sessionStorage.removeItem("area", JSON.stringify(this.session));
            let thus = this;
            thus.router.push({path:'/Theme'})
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
                this.getAreaData();
            }
        }
    },
}
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';
@import'@/assets/scss/components/form.scss';

</style>