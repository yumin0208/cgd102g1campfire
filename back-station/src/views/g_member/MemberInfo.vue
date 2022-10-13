<template>
    <Menu></Menu>
    <Header></Header>
    <section class="page_section">
        <header class="project_header">
            <div class="header_left">
                <p class="router_name">會員中心</p>
            </div>
            <div class="breadcrumb">
                <span>會員中心  &nbsp> &nbsp</span><router-link to ="/MemberList">會員資訊管理 </router-link><span>&nbsp&nbsp > &nbsp會員詳細資訊</span>
            </div>
        </header>
        
        <form>
            <div class="row">
                會員編號：{{mem_no}}
            </div>
            <div class="row">
                會員帳號：{{mem_id}}
            </div>
            <div class="row">
                會員姓名：{{mem_name}}
            </div>
            <div class="row">
                會員暱稱：{{mem_nick_name}}
            </div>
            <div class="row">
                會員信箱：{{mem_email}}
            </div>
            <div class="row">
                居住縣市：{{mem_city}}
            </div>
            <div class="row">
                詳細住址；{{mem_addr}}
            </div>
            <div class="row">
                電話：{{mem_phone}}
            </div>
            <div class="row">
                <label for="mem_status">會員狀態：</label>
                <select name="mem_status" id="mem_status" v-model="mem_status">
                    <option value="1">正常</option>
                    <option value="0">停權</option>
                </select>
            </div>
            <div class="row">
                註冊時間：<span class="post_time">{{register_date}}</span>
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
            mem_no:'',
            mem_id:'',
            mem_name:'',
            mem_nick_name:'',
            mem_email:'',
            mem_city:'',
            mem_addr:'',
            mem_phone:'',
            mem_status:'',
            memmodifydata:{},
            mem_data:[],
            router:useRouter()
        }
    },
    created(){
        this.getMemberData()
        this.fetchMemberData()
    },
    methods:{
        getMemberData(){
            //抓到sessionStorage的資料
            this.member = JSON.parse(sessionStorage.getItem('member'));
            //抓取文章編號，要去後端撈資料
            this.mem_no = this.member.mem_no;
            //確認有抓到東西
        },
        fetchMemberData(){
            fetch(process.env.VUE_APP_PHP_PATH + `backstaion_member_modify.php?mem_no=${this.mem_no}`)                
            .then((response) => {
                this.fetchError = (response.status !== 200)
            //json(): 返回 Promise，resolves 是 JSON 物件
                return response.json()
            }).then(responseText => {
                //傳送資料
                const useData = responseText
                //篩選文章編號之後撈回來的第一筆資料
                this.memmodifydata = useData[0]
                //這邊的mem_xxx資料是綁在v-model上
                this.mem_no = responseText.mem_no;
                this.mem_id = responseText.mem_id;
                this.mem_name = responseText.mem_name;
                this.mem_nick_name = responseText.mem_nick_name;
                this.mem_email = responseText.mem_email;
                this.mem_city = responseText.mem_city;
                this.mem_addr = responseText.mem_addr;
                this.mem_phone = responseText.mem_phone;
                this.mem_status = responseText.mem_status;
            }).catch((err) => {
                this.memmodifydata = true
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
                if(this.mem_status == '' ){
                    alert("不可以有空白喔");
                    return;
                }
                else{
                //沒有錯誤則將更新後的會員傳送到資料庫
                    var xhr = new XMLHttpRequest();
            
                    xhr.open("POST",process.env.VUE_APP_PHP_PATH + 'backstation_update_member.php', true);
                    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                    //回傳過去的資料
                    let mem_data = `mem_no=${this.mem_no}&mem_id=${this.mem_id}&mem_name=${this.mem_name}&mem_nick_name=${this.mem_nick_name}&mem_email=${this.mem_email}&mem_city=${this.mem_city}&mem_addr=${this.mem_addr}&mem_phone=${this.mem_phone}&mem_status=${this.mem_status}`;
                    xhr.send(mem_data);
                    //重新撈回資料庫資料，再寫進sessionStorage
                    xhr.onload = ()=>{
                        if(xhr.status == 200){
                            this.session = JSON.parse(xhr.responseText);
                            console.log(this.session)
                            sessionStorage.setItem("member", JSON.stringify(this.session)); 
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
                sessionStorage.removeItem("member", JSON.stringify(this.session));
                let thus = this;
                thus.router.push({path:'/MemberList'})
            }
        }
    },
}
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';
@import'@/assets/scss/components/form.scss';

</style>