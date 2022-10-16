<template>
    <Menu></Menu>
    <Header></Header>
    <section class="page_section">
        <header class="project_header">
            <div class="header_left">
                <p class="router_name">員工專區</p>
            </div>
            <div class="breadcrumb">
                <span>員工專區  &nbsp> &nbsp</span><router-link to ="/NewsRelease">員工資訊管理 </router-link><span>&nbsp&nbsp > &nbsp新增員工</span>
            </div>
        </header>
        
        <form>
            <div class="row">
                <label for="employee_id">員工帳號：</label>
                <input id="employee_id" type="text" v-model="employee_id">
            </div>
            <div class="row">
                <label for="employee_psw">員工密碼：</label>
                <input id="employee_psw" type="password" v-model="employee_psw">
            </div>
            <div class="row">
                <label for="employee_name">員工姓名：</label>
                <input type="text" class="employee_name" name="employee_name"  v-model="name">
            </div>
            <div class="row">
                <label for="employee_sex">員工性別：</label>
                <input type="text" class="employee_sex" name="employee_sex"  v-model="employee_sex">
            </div>
            <div class="row">
                <label for="employee_email">員工信箱：</label>
                <input type="text" class="employee_email" name="employee_email"  v-model="employee_email">
            </div>
            <div class="row">
                <label for="employee_phone">員工電話：</label>
                <input type="text" class="employee_phone" name="employee_phone"  v-model="employee_phone">
            </div>
            <div class="row">
                <label for="employee_auth">消息狀態：</label>
                <select name="employee_auth" id="employee_auth" v-model="employee_auth">
                    <option value="1">高級管理員</option>
                    <option value="2">營帳管理員</option>
                    <option value="3">商城管理員</option>
                </select>
            </div>
            <div class="btn">
                <button class="addEmployee" id="addEmployee" @click="addEmployee">確認</button>
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
            employee_id:'',
            employee_psw:'',
            name:'',
            employee_auth:'',
            employee_sex:'',
            employee_email:'',
            employee_phone:'',
            employeemodifydata:{},
            employee_data:[],
            router:useRouter()
        }
    },
    methods:{
        addEmployee(e){
            if(
                //指定css選擇器的節點
                e.target.closest('button') &&
                e.target.closest('button').id === 'addEmployee'
                ) {
                //取消預設submit事件
                e.preventDefault()
                if(this.employee_id == "" || this.employee_psw == "" || this.name == "" || this.employee_auth =="" || this.employee_sex =="" || this.employee_email =="" || this.employee_phone ==""){
                    alert('有欄位空白喔！')
                }else{
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST",process.env.VUE_APP_PHP_PATH + 'backstation_employee_add.php', true);
                    let formData = new FormData();
                    formData.append('employee_id', this.employee_id);
                    formData.append('employee_psw', this.employee_psw);
                    formData.append('employee_name', this.name);
                    formData.append('employee_auth', this.employee_auth);
                    formData.append('employee_sex', this.employee_sex);
                    formData.append('employee_email', this.employee_email);
                    formData.append('employee_phone', this.employee_phone);
                    xhr.send(formData);
                    xhr.onload = ()=>{
                        // console.log(xhr.responseText);
                        if(xhr.status == 200){
                            let thus = this
                            alert("發布成功");
                            // thus.router.push({path:'/Employee'});
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
                thus.router.push({path:'/Employee'})
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