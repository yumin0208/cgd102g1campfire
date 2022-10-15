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
    <div class="table_roll table_spacing">
        <table>
            <tr class="table_title">
                <th v-for="item in titles" :key="item">{{item}}</th>
            </tr>
            <tr class="item_content" v-for="item in activityPlan" :key="item.activity_no" @click="goInfo(item)">
                <td>{{item.activity_no}}</td>
                <td>{{item.area_no}}</td>
                <td>{{item.activity_name}}</td>
                <td>{{item.activity_subtitle}}</td>
                <td>{{item.activity_synopsis}}</td>
                <td>{{item.activity_info}}</td>
                <td>{{item.activity_pic}}</td>
                <td>{{item.activity_price}}</td>
                <td>{{item.activity_suitable_guest}}</td>
                <td>{{item.activity_note}}</td>
                <td><button>更多</button></td>
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
        chtName: '活動方案管理',
        title: '營區導覽',
        path:'/ActivityPlan',
        titles: [
            '活動編號',
            '地區編號',
            '活動名稱',
            '活動介紹副標題',
            '活動簡介',
            '活動介紹',
            '活動圖片',
            '活動價格',
            '活動適合族群',
            '活動注意事項',
            '詳細資訊',
        ],
        activityPlan: [],
        router:useRouter()
        };
    },
    methods: {
        // 抓取活動資訊
        FetchAPIPlan(){
            fetch(process.env.VUE_APP_PHP_PATH + 'activityPlan.php').then((response) => {
                if(response){
                    this.fetchError = (response.status !== 200)
                    //json(): 返回 Promise，resolves 是 JSON 物件
                    return response.json()
                }
            }).then(responseText => {
                this.activityPlan = responseText;
                console.log(this.activityPlan);
            }).catch((err) => {
                this.activityPlan = []
                // this.discussCard = true
            })
        },
        goInfo(e){
            console.log(e)
            sessionStorage.setItem("activity", JSON.stringify(e) );
            let thus = this;
            thus.router.push({path:'/ActivityInfo'});
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
                this.FetchAPIPlan();
            }
        }
    },
};
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';
.table_spacing{
    margin-top: 80px;
}

</style>
