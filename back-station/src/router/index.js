import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import Login from '../views/i_login/Login.vue';

const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login,
  },
  {
    path: '/home',
    name: 'home',
    component: HomeView,
  },
  // {
  //   path: '/Login',
  //   name: 'Login',
  //   chtName: '登入',
  //   component: () => import('../views/i_login/Login.vue'),
  // },
  {
    path: '/Reservation',
    name: 'Reservation',
    chtName: '預約狀態管理',
    component: () => import('../views/a_booking/Reservation.vue'),
  },
  {
    path: '/IndividualTent',
    name: 'IndividualTent',
    chtName: '個別營帳管理',
    component: () => import('../views/a_booking/IndividualTent.vue'),
  },
  {
    path: '/Theme',
    name: 'Theme',
    chtName: '主題地區管理',
    component: () => import('../views/b_activity/Theme.vue'),
  },
  {
    path: '/AreaInfo',
    name: 'AreaInfo',
    chtName: '主題地區詳細資料',
    component: () => import('../views/b_activity/AreaInfo.vue'),
  },
  {
    path: '/ActivityPlan',
    name: 'ActivityPlan',
    chtName: '活動方案管理',
    component: () => import('../views/b_activity/ActivityPlan.vue'),
  },
  {
    path: '/ActivityInfo',
    name: 'ActivityInfo',
    chtName: '主題地區詳細資料',
    component: () => import('../views/b_activity/ActivityInfo.vue'),
  },
  {
    path: '/TentType',
    name: 'TentType',
    chtName: '營帳類型管理',
    component: () => import('../views/c_service/TentType.vue'),
  },
  {
    path: '/FoodPlan',
    name: 'FoodPlan',
    chtName: '食材方案管理',
    component: () => import('../views/c_service/FoodPlan.vue'),
  },
  {
    path: '/EquipmentPlan',
    name: 'EquipmentPlan',
    chtName: '裝備方案管理',
    component: () => import('../views/c_service/EquipmentPlan.vue'),
  },
  {
    path: '/Report',
    name: 'Report',
    chtName: '營火報告管理',
    component: () => import('../views/d_report/Report.vue'),
  },
  {
    path: '/ReportInfo',
    name: 'ReportInfo',
    chtName: '營火報告詳細資料',
    component: () => import('../views/d_report/ReportInfo.vue'),
  },
  {
    path: '/Comment',
    name: 'Comment',
    chtName: '留言管理',
    component: () => import('../views/d_report/Comment.vue'),
  },
  {
    path: '/Challenge',
    name: 'Challenge',
    chtName: '檢舉管理',
    component: () => import('../views/d_report/Challenge.vue'),
  },
  {
    path: '/NewsRelease',
    name: 'NewsRelease',
    chtName: '消息發布管理',
    component: () => import('../views/e_news/NewsRelease.vue'),
  },
  {
    path: '/NewsInfo',
    name: 'NewsInfo',
    chtName: '最新消息詳細資料',
    component: () => import('../views/e_news/NewsInfo.vue'),
  },
  {
    path: '/NewsAdd',
    name: 'NewsAdd',
    chtName: '新增最新消息文章',
    component: () => import('../views/e_news/NewsAdd.vue'),
  },
  {
    path: '/ProductsInfo',
    name: 'ProductsInfo',
    chtName: '商品資訊管理',
    component: () => import('../views/f_shopping/ProductsInfo.vue'),
  },
  {
    path: '/ProductEdit',
    name: 'ProductEdit',
    chtName: '商品資訊修改',
    component: () => import('../views/f_shopping/ProductEdit.vue'),
  },
  {
    path: '/ProductsPO',
    name: 'ProductsPO',
    chtName: '商品訂單管理',
    component: () => import('../views/f_shopping/ProductsPO.vue'),
  },
  {
    path: '/ProductsLogistic',
    name: 'ProductsLogistic',
    chtName: '商品物流管理',
    component: () => import('../views/f_shopping/ProductsLogistic.vue'),
  },
  {
    path: '/ProductsPayment',
    name: 'ProductsPayment',
    chtName: '商品付款管理',
    component: () => import('../views/f_shopping/ProductsPayment.vue'),
  },
  {
    path: '/Booking',
    name: 'CampBooking',
    chtName: '預訂訂單管理',
    component: () => import('../views/g_member/Booking.vue'),
  },
  {
    path: '/MemberList',
    name: 'MemberList',
    chtName: '會員資訊管理',
    component: () => import('../views/g_member/MemberList.vue'),
  },
  {
    path: '/MemberInfo',
    name: 'MemberInfo',
    chtName: '會員詳細資訊',
    component: () => import('../views/g_member/MemberInfo.vue'),
  },
  {
    path: '/Employee',
    name: 'Employee',
    chtName: '員工資訊管理',
    component: () => import('../views/h_employee/Employee.vue'),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
