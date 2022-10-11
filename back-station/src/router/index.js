import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/CampTentIndividualView',
    name: 'CampTentIndividual',
    chtName: '個別營帳管理',
    component: () => import('../views/CampInfo/CampTentIndividualView.vue'),
  },
  {
    path: '/CampBookingView',
    name: 'CampBooking',
    chtName: '營區預訂管理',
    component: () => import('../views/CampInfo/CampBookingView.vue'),
  },
  {
    path: '/LocationView',
    name: 'Location',
    chtName: '主題地區管理',
    component: () => import('../views/Navigation/LocationView.vue'),
  },
  {
    path: '/ActivityView',
    name: 'Activity',
    chtName: '活動方案管理',
    component: () => import('../views/Navigation/ActivityView.vue'),
  },
  {
    path: '/TentTypeView',
    name: 'TentType',
    chtName: '營帳類型管理',
    component: () => import('../views/Service/TentTypeView.vue'),
  },
  {
    path: '/FoodView',
    name: 'Food',
    chtName: '食材方案管理',
    component: () => import('../views/Service/FoodView.vue'),
  },
  {
    path: '/EquipmentView',
    name: 'Equipment',
    chtName: '裝備方案管理',
    component: () => import('../views/Service/EquipmentView.vue'),
  },
  {
    path: '/ForumView',
    name: 'Forum',
    chtName: '營火報告管理',
    component: () => import('../views/Forum/ForumView.vue'),
  },
  {
    path: '/ForumMessageView',
    name: 'ForumMessage',
    chtName: '留言管理',
    component: () => import('../views/Forum/ForumMessageView.vue'),
  },
  {
    path: '/ForumReportView',
    name: 'ForumReport',
    chtName: '檢舉管理',
    component: () => import('../views/Forum/ForumReportView.vue'),
  },
  {
    path: '/NewsReleaseView',
    name: 'NewsRelease',
    chtName: '消息發布管理',
    component: () => import('../views/News/NewsReleaseView.vue'),
  },
  {
    path: '/ProductsInfoView',
    name: 'ProductsInfo',
    chtName: '商品資訊管理',
    component: () => import('../views/Store/ProductsInfoView.vue'),
  },
  {
    path: '/productsPOView',
    name: 'productsPO',
    chtName: '商品訂單管理',
    component: () => import('../views/Store/productsPOView.vue'),
  },
  {
    path: '/ProductsLogisticView',
    name: 'ProductsLogistic',
    chtName: '商品物流管理',
    component: () => import('../views/Store/ProductsLogisticView.vue'),
  },
  {
    path: '/ProductsPaymentView',
    name: 'ProductsPayment',
    chtName: '商品付款管理',
    component: () => import('../views/Store/ProductsPaymentView.vue'),
  },
  {
    path: '/MemberPOView',
    name: 'MemberPO',
    chtName: '會員訂單管理',
    component: () => import('../views/Member/MemberPOView.vue'),
  },
  {
    path: '/MemberInfoView',
    name: 'MemberInfo',
    chtName: '會員資訊管理',
    component: () => import('../views/Member/MemberInfoView.vue'),
  },
  {
    path: '/StaffInfoView',
    name: 'StaffInfo',
    chtName: '員工資訊管理',
    component: () => import('../views/Staff/StaffInfoView.vue'),
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
