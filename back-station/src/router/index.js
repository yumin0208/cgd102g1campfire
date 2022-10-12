import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/Booking',
    name: 'CampBooking',
    chtName: '營區預訂管理',
    component: () => import('../views/a_booking/Booking.vue'),
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
    path: '/ActivityPlan',
    name: 'ActivityPlan',
    chtName: '活動方案管理',
    component: () => import('../views/b_activity/ActivityPlan.vue'),
  },
  {
    path: '/TentType',
    name: 'TentType',
    chtName: '營帳類型管理',
    component: () => import('../views/c_service/TentType.vue'),
  },
  {
    path: '/LngredientsPlan',
    name: 'LngredientsPlan',
    chtName: '食材方案管理',
    component: () => import('../views/c_service/LngredientsPlan.vue'),
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
    path: '/Message',
    name: 'Message',
    chtName: '留言管理',
    component: () => import('../views/d_report/Message.vue'),
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
<<<<<<< HEAD
    path: '/ProductsInfo',
=======
    path: '/NewsInfo',
    name: 'NewsInfo',
    chtName: '最新消息詳細資料',
    component: () => import('../views/News/NewsInfoView.vue'),
  },
  {
    path: '/ProductsInfoView',
>>>>>>> c4eed6b6e73de6250eb460dc319401710f565cff
    name: 'ProductsInfo',
    chtName: '商品資訊管理',
    component: () => import('../views/f_shopping/ProductsInfo.vue'),
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
    path: '/MemberPO',
    name: 'MemberPO',
    chtName: '會員訂單管理',
    component: () => import('../views/g_member/MemberPO.vue'),
  },
  {
    path: '/MemberInfo',
    name: 'MemberInfo',
    chtName: '會員資訊管理',
    component: () => import('../views/g_member/MemberInfo.vue'),
  },
  {
    path: '/CrewInfo',
    name: 'CrewInfo',
    chtName: '員工資訊管理',
    component: () => import('../views/h_crew/CrewInfo.vue'),
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
