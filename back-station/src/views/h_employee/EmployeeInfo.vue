<template>
    <Menu></Menu>
    <Header></Header>
    <section class="page_section">
        <header class="project_header">
            <div class="header_left">
                <p class="router_name">員工專區</p>
            </div>
            <div class="breadcrumb">
                <span>員工專區  &nbsp> &nbsp</span><router-link to ="/MemberList">員工資訊管理 </router-link><span>&nbsp&nbsp > &nbsp員工詳細資訊</span>
            </div>
        </header>
        
        <form>
            <div class="row">
                員工編號：{{employee_no}}
            </div>
            <div class="row">
                員工帳號：{{employee_id}}
            </div>
            <div class="row">
                員工姓名：{{employee_name}}
            </div>
            <div class="row">
                員工性別：{{employee_sex}}
            </div>
            <div class="row">
                員工信箱：{{employee_email}}
            </div>
            <div class="row">
                員工電話：{{employee_phone}}
            </div>
            <div class="row">
                <label for="employee_auth">員工權限：</label>
                <select class="employee_auth" name="employee_auth" id="employee_auth" v-model="employee_auth">
                    <option value="1">高級管理員</option>
                    <option value="2">營帳管理員</option>
                    <option value="3">商城管理員</option>
                </select>
            </div>
            <div class="row">
                <label for="employee_status">員工狀態：</label>
                <select name="employee_status" id="employee_status" v-model="employee_status">
                    <option value="1">正常</option>
                    <option value="0">停權</option>
                </select>
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
import { useRouter } from "vue-router";

export default {
    data(){
        return{
            employee_no:'',
            employee_id:'',
            employee_name:'',
            employee_auth:'',
            employee_sex:'',
            employee_email:'',
            employee_phone:'',
            employee_status:'',
            empmodifydata:{},
            emp_data:[],
            router:useRouter()
        }
    },
    methods:{
        getEmployeeData(){
            //抓到sessionStorage的資料
            this.employee = JSON.parse(sessionStorage.getItem('employee'));
            //抓取文章編號，要去後端撈資料
            this.employee_no = this.employee.employee_no;
            //確認有抓到東西
        },
        fetchEmployeeData(){
            fetch(process.env.VUE_APP_PHP_PATH + `backstaion_employee_modify.php?employee_no=${this.employee_no}`)                
            .then((response) => {
                this.fetchError = (response.status !== 200)
            //json(): 返回 Promise，resolves 是 JSON 物件
                return response.json()
            }).then(responseText => {
                //傳送資料
                const useData = responseText
                //篩選文章編號之後撈回來的第一筆資料
                this.empmodifydata = useData[0]
                //這邊的mem_xxx資料是綁在v-model上
                this.employee_no = responseText.employee_no;
                this.employee_id = responseText.employee_id;
                this.employee_name = responseText.employee_name;
                this.employee_auth = responseText.employee_auth;
                this.employee_sex = responseText.employee_sex;
                this.employee_email = responseText.employee_email;
                this.employee_phone = responseText.employee_phone;
                this.employee_status = responseText.employee_status;
            }).catch((err) => {
                this.empmodifydata = true
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
                if(this.employee_status == '' ){
                    alert("不可以有空白喔");
                    return;
                }
                else{
                //沒有錯誤則將更新後的員工傳送到資料庫
                    var xhr = new XMLHttpRequest();
            
                    xhr.open("POST",process.env.VUE_APP_PHP_PATH + 'backstation_update_employee.php', true);
                    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                    //回傳過去的資料
                    let emp_data = `employee_no=${this.employee_no}&employee_id=${this.employee_id}&employee_name=${this.employee_name}&employee_auth=${this.employee_auth}&employee_sex=${this.employee_sex}&employee_email=${this.employee_email}&employee_phone=${this.employee_phone}&employee_status=${this.employee_status}`;
                    xhr.send(emp_data);
                    //重新撈回資料庫資料，再寫進sessionStorage
                    xhr.onload = ()=>{
                        if(xhr.status == 200){
                            this.session = JSON.parse(xhr.responseText);
                            console.log(this.session)
                            sessionStorage.setItem("employee", JSON.stringify(this.session)); 
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
                sessionStorage.removeItem("employee", JSON.stringify(this.session));
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
                this.getEmployeeData()
                this.fetchEmployeeData()
            }
        }
    },
}
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';
@import'@/assets/scss/components/form.scss';
.employee_auth{
    width: 120px;
}
</style>