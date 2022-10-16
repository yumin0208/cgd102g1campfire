<template>
    <Menu></Menu>
    <Header></Header>
    <section class="page_section">
        <header class="project_header">
            <div class="header_left">
                <p class="router_name">活動方案</p>
            </div>
            <div class="breadcrumb">
                <span>活動方案  &nbsp> &nbsp</span><router-link to ="/ActivityPlan">活動發布管理 </router-link><span>&nbsp&nbsp > &nbsp詳細內容</span>
            </div>
        </header>
        
        <form>
            <div class="row">
                <label for="activity_name">標題：</label>
                <input id="activity_name" type="text" v-model="activity_name">
            </div>
            <div class="row">
                <label for="activity_subtitle">副標題：</label>
                <input id="activity_subtitle" type="text" v-model="activity_subtitle">
            </div>
            <div class="row">
                <label for="activity_price">活動價格：</label>
                <input id="activity_price" type="number" v-model.number="activity_price">
            </div>
            <div class="row">
                <label for="activity_suitable_guest">適合族群：</label>
                <input id="activity_suitable_guest" type="text" v-model="activity_suitable_guest">
            </div>
            <div class="row">
                <label for="activity_note">注意事項：</label>
                <textarea class="activity_note" name="activity_note" maxlength="300" v-model="activity_note"></textarea>
            </div>
            <div class="row">
                <label for="activity_synopsis">活動簡介：</label>
                <textarea class="activity_synopsis" name="activity_synopsis" maxlength="300" v-model="activity_synopsis"></textarea>
            </div>
            <div class="row">
                <label for="activity_info">詳細內容：</label>
                <textarea class="activity_info" name="activity_info" maxlength="300" v-model="activity_info"></textarea>
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
            activity_name:'',
            activity_subtitle:'',
            activity_synopsis:'',
            activity_info:'',
            activity_price:'',
            activity_suitable_guest:'',
            activity_note:'',
            activitymodifydata:{},
            activity_data:[],
            activity:'',
            router:useRouter()
        }
    },
    methods:{
        getActivityData(){
            //抓到sessionStorage的資料
            this.activity = JSON.parse(sessionStorage.getItem('activity'));
            //抓取編號，要去後端撈資料
            this.activity_no = this.activity.activity_no;
            //確認有抓到東西
        },
        fetchActivityData(){
            fetch(process.env.VUE_APP_PHP_PATH + `backstation_activity.php?activity_no=${this.activity_no}`)                
            .then((response) => {
                this.fetchError = (response.status !== 200)
            //json(): 返回 Promise，resolves 是 JSON 物件
                return response.json()
            }).then(responseText => {
                //傳送資料
                const useData = responseText
                //篩選文章編號之後撈回來的第一筆資料
                this.activitymodifydata = useData[0]
                //這邊的mem_xxx資料是綁在v-model上
                this.activity_name = responseText.activity_name;
                this.activity_subtitle = responseText.activity_subtitle;
                this.activity_synopsis = responseText.activity_synopsis;
                this.activity_info = responseText.activity_info;
                this.activity_price = responseText.activity_price;
                this.activity_suitable_guest = responseText.activity_suitable_guest;
                this.activity_note = responseText.activity_note;
            }).catch((err) => {
                this.activitymodifydata = []
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
                if(this.activity_name == '' || this.activity_subtitle == '' ||this.activity_synopsis == ''||this.activity_info == ''||this.activity_price == ''||this.activity_suitable_guest == ''||this.activity_note =='' ){
                    alert("不可以有空白喔");
                    return;
                }else{
                //沒有錯誤則將更新後的會員傳送到資料庫
                    var xhr = new XMLHttpRequest();
            
                    xhr.open("POST",process.env.VUE_APP_PHP_PATH + 'backstation_update_activity.php', true);
                    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                    //回傳過去的資料
                    let activity_data = `activity_no=${this.activity_no}&activity_name=${this.activity_name}&activity_subtitle=${this.activity_subtitle}&activity_synopsis=${this.activity_synopsis}&activity_info=${this.activity_info}&activity_price=${this.activity_price}&activity_suitable_guest=${this.activity_suitable_guest}&activity_note=${this.activity_note}`;
                    xhr.send(activity_data);
                    //重新撈回資料庫資料，再寫進sessionStorage
                    xhr.onload = ()=>{
                        if(xhr.status == 200){
                            this.session = JSON.parse(xhr.responseText);
                            sessionStorage.setItem("activity", JSON.stringify(this.session)); 
                            alert("修改成功");
                            let thus = this
                            thus.router.push({path:'/ActivityPlan'})
                        }
                    }  
                }   
            }
        },
        goBack(e){
<<<<<<< HEAD
            //取消預設submit事件
            e.preventDefault()
            sessionStorage.removeItem("activity", JSON.stringify(this.session));
            let thus = this;
            thus.router.push({path:'/ActivityPlan'})
=======
                //取消預設submit事件
                e.preventDefault()
                sessionStorage.removeItem("activity", JSON.stringify(this.session));
                let thus = this;
                thus.router.push({path:'/ActivityPlan'})
        },
        getEmpData(){
            this.emp_login = JSON.parse(sessionStorage.getItem('emp_login'));
            this.employee_name = this.emp_login.employee_name;
>>>>>>> 65b0d391a37edf03572ae0cbfd5c6263719650eb
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
                    this.getActivityData()
                this.fetchActivityData()
                }
            }
        },
}
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';
@import'@/assets/scss/components/form.scss';

</style>