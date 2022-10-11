<template>
<aside class="aside_menu">
    <router-link to="/" class="project_logo">
        <img src="@/assets/Image/logo/logo_row_FFF.png" alt="Logo">
    </router-link>
    <div class="menu_zone">
        <div class="menu_row" v-for="menu,index in menus" :key="menu"> 
            <input type="radio" name="menu_title" :id="'menu_title' + index" v-model="openMenu" :value="menu.title">
            <label :for="'menu_title' + index">
                <p class="more">{{menu.title}}</p>
            </label>
            <ul class="content" v-for="router,index in menu.routes">
                <li>
                    <router-link class="router_list" :key="router" :to="router.path">
                        <p class="router_name">{{router.myname}}</p>
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</aside>
</template>

<script>

export default {
    data() {
        return {
            openMenu: '',
            menus: [
                {
                    title:'營區預訂',
                    routes:[
                        {
                            path: '/CampTentIndividualView',
                            myname:'個別營帳管理',
                        },
                        {
                            path: '/CampBookingView',
                            myname:'營區預訂管理',
                        },
                    ],
                },
                {
                    title: '營區導覽',
                    routes:[
                        {
                            path: '/LocationView',
                            myname:'主題地區管理',
                        },
                        {
                            path: '/ActivityView',
                            myname:'活動方案管理',
                        },
                    ],
                },
                {
                    title: '營區服務',
                    routes:[
                        {
                            path: '/TentTypeView',
                            myname:'營帳類型管理',
                        },
                        {
                            path: '/FoodView',
                            myname:'食材方案管理',
                        },
                        {
                            path: '/EquipmentView',
                            myname:'裝備方案管理',
                        },
                    ],
                },
                {
                    title: '營火報告',
                    routes:[
                        {
                            path: '/ForumView',
                            myname:'營火報告管理',
                        },
                        {
                            path: '/ForumMessageView',
                            myname:'留言管理',
                        },
                        {
                            path: '/ForumReportView',
                            myname:'檢舉管理',
                        },
                    ],
                },
                {
                    title: '最新消息',
                    routes:[
                        {
                            path: '/NewsReleaseView',
                            myname:'消息發佈管理',
                        },
                    ],
                },
                {
                    title: '營火商城',
                    routes:[
                        {
                            path: '/ProductsInfoView',
                            myname:'商品資訊管理',
                        },
                        {
                            path: '/productsPOView',
                            myname:'商品訂單管理',
                        },
                        {
                            path: '/ProductsLogisticView',
                            myname:'商品物流管理',
                        },
                        {
                            path: '/ProductsPaymentView',
                            myname:'商品付款管理',
                        },
                    ],
                },
                {
                    title: '會員中心',
                    routes:[
                        {
                            path: '/MemberPOView',
                            myname:'會員訂單管理',
                        },
                        {
                            path: '/MemberInfoView',
                            myname:'會員資訊管理',
                        },
                    ],
                },
                {
                    title: '員工專區',
                    routes:[
                        {
                            path: '/StaffInfoView',
                            myname:'員工資訊管理',
                        },
                    ],
                },
            ],
        }
    },
    watch: {
        openMenu(nVal) {
            localStorage.setItem('menu-tab', nVal);
        }
    },
    mounted(){
        this.openMenu = localStorage.getItem('menu-tab');
    }
}
</script>

<style lang="scss" scoped>

@import'@/assets/scss/Style.scss';

</style>