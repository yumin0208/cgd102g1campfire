<template>
<Menu></Menu>
<Header></Header>
<section class="page_section">
    <div class="breadcrum">
        <div class="breadcrum_left">
            <p class="router_name">{{chtName}}</p>
        </div>
        <div class="breadcrum_right">
            <div class="breadcrumb_text">
                <p class="breadcrumb_text_title">{{title}}</p>
                <router-link class="breadcrumb_text_chtname" :to="path">{{chtName}}</router-link>
            </div>
        </div>
    </div>
    <div class="serch_bar">
    <!-- <input type="text" placeholder="搜尋"/> -->
        <button>新增</button>
    </div>
    <div class="table_roll">
        <table>
    <tr class="table_title">
        <th v-for="item in titles" :key="item">{{item}}</th>
    </tr>
    <tr class="item_content" v-for="item in employee" :key="item">
        <td>{{item.employee_no}}</td>
        <td>{{item.employee_name}}</td>
        <td>{{item.employee_auth}}</td>
        <td>{{item.employee_sex}}</td>
        <td>{{item.employee_email}}</td>
        <td>{{item.employee_phone}}</td>
        <td>{{item.employee_status}}</td>
        <td><button>更多</button></td>
    </tr>
    </table>
    </div>
    
</section>
<Footer></Footer>
</template>

<script>

import Menu from "@/components/Menu.vue";
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import { useRouter } from "vue-router";
export default {
    name: 'HomeView',
    components: {
        Menu,
        Header,
        Footer,
    },
    data() {
        return {
        chtName: '員工資訊管理',
        title: '員工專區',
        path:'/Employee',
        titles: [
            '員工編號',
            '員工姓名',
            '權限',
            '員工性別',
            '員工信箱',
            '員工電話',
            '員工狀態',
            '詳細資訊',
        ],
        employee: [],
        router:useRouter()
        };
    },
    methods: {
        FetchAPIComment() {
        fetch(process.env.VUE_APP_PHP_PATH + 'backstation_employee.php')
            .then((response) => {
            if (response) {
                this.fetchError = response.status !== 200;
                return response.json();
            }
            })
            .then((responseText) => {
            this.employee = responseText;
            })
            .catch((err) => {
            this.employee = [];
            });
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
                this.FetchAPIComment();
            }
        }
    },
};
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';

</style>
