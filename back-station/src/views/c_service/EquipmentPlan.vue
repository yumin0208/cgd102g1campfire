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
    <!-- <div class="serch_bar">
    <input type="text" placeholder="搜尋"/>
        <button>新增</button>
        <button>修改</button>
        <button>刪除</button>
    </div> -->
    <div class="table_roll">
        <table>
            <tr class="table_title">
                <th v-for="item in titles" :key="item">{{item}}</th>
            </tr>
            <tr class="item_content" v-for="item in equip" :key="item">
                <td>{{item.equip_no}}</td>
                <td>{{item.equip_name}}</td>
                <td>{{item.equip_price}}</td>
                <td>{{item.equip_pic}}</td>
                <td>{{item.equip_info}}</td>
                <!-- <td><button>更多</button></td> -->
            </tr>
        </table>
    </div>
    
</section>
<Footer></Footer>
</template>

<script>
import { useRouter } from "vue-router";
export default {
    data() {
        return {
        router:useRouter(),
        chtName: '裝備方案管理',
        title: '營區服務',
        path:'/EquipmentPlan',
        titles: [
            '裝備編號',
            '裝備名稱',
            '裝備價格',
            '裝備圖片',
            '裝備介紹',
            // '詳細資訊',
        ],
        equip: [],
        };
    },
    methods: {
        FetchAPIComment() {
        fetch(process.env.VUE_APP_PHP_PATH + 'backstation_serviceEquipment.php')
            .then((response) => {
            if (response) {
                this.fetchError = response.status !== 200;
                return response.json();
            }
            })
            .then((responseText) => {
            this.equip = responseText;
            })
            .catch((err) => {
            this.equip = [];
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
.table_roll{
    margin-top: 80px;
}
</style>
