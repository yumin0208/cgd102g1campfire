<template>
    <section class="login_page">
        <form class="login_form" action="#">
            <h2>後台登入</h2>
            <div class="block">
                <div class="input_title">帳號：</div>
                <input  type="text" 
                        name="login_id" 
                        id="login_id"
                        v-model="employee_id"
                        >
            </div>
            <div class="block">
                <div class="input_title">密碼：</div>
                <input  type="password" 
                        name="login_psw" 
                        id="login_psw" 
                        v-model="employee_psw"
                        >
            </div>
            <div class="login_btn" 
                    @click="doLogin()"> 
                    登入
            </div>
        </form>
    </section>
</template>
<script>
import { useRouter } from "vue-router";
    export default{
        data(){
            return{
                employee_id:'',
                employee_psw:'',
                router:useRouter()
            }
        },
        methods:{
            doLogin(){
                var xhr = new XMLHttpRequest();
                xhr.onload = ()=>{
                    console.log(xhr.responseText);
                    if(xhr.status == 200){
                        if(xhr.responseText == 2){
                            alert("帳號停權中！")
                        }else if(xhr.responseText == 0){
                            alert("帳號或密碼錯誤");
                        }else{
                            alert("登入成功！");
                            this.session = JSON.parse(xhr.responseText);
                            // console.log(this.session)
                            sessionStorage.setItem("emp_login", JSON.stringify(this.session));
                            this.loginStatus = sessionStorage.getItem("emp_login")
                            let thus = this
                            if (this.loginStatus != '') {
                                thus.router.push({path:'/home'});
                            }
                        }
                    }
                }
                xhr.open("POST",process.env.VUE_APP_PHP_PATH + 'backstation_login.php', true);

                // let mem_deta = `mem_id=${this.id}&mem_psw=${this.psw}`;
                let formData = new FormData();
                formData.append('employee_id', this.employee_id);
                formData.append('employee_psw', this.employee_psw);
                xhr.send(formData);
            },
        }
    }
</script>
<style>
    .login_page{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .login_form{
        width: 500px;
        height: 300px;
        border: 1px solid #000;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        background-color: #28776C;
        color: #fff;
    }
    .login_form h2{
        margin-bottom: 30px;
    }
    .input_title{
        display: inline-block;
        margin-bottom: 30px;
        font-size: 20px;
    }
    input{
        height: 30px;
    }
    .login_btn{
    width: 140px;
    font-size: 20px;
    font-weight: 700;
    letter-spacing: 1px;
    text-align: center;
    border-radius: 30px;
    color: #000;
    background: #fff;
    border: 2px solid #000;
    padding: 10px 0;
    cursor: pointer;
}
.login_btn:hover{
    color: #ccc;
    background-color: #000;
    border: 2px solid #ccc;
}
</style>