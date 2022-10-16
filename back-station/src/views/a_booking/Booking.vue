<template>
  <Menu></Menu>
  <Header></Header>
  <section class="page_section">
    <div class="breadcrum">
      <div class="breadcrum_left">
        <p class="router_name">{{ chtName }}</p>
      </div>
      <div class="breadcrum_right">
        <div class="breadcrumb_text">
          <p class="breadcrumb_text_title">{{ title }}</p>
          <router-link class="breadcrumb_text_chtname" :to="path">{{
            chtName
          }}</router-link>
        </div>
      </div>
    </div>
    <!-- <div class="serch_bar">
      <input type="text" placeholder="搜尋" />
      <button>新增</button>
      <button>修改</button>
      <button>刪除</button>
    </div> -->
    <div class="table_roll table_spacing">
      <table>
        <tr class="table_title">
          <th v-for="item in titles" :key="item">{{ item }}</th>
        </tr>
        <tr class="item_content" v-for="item in orders" :key="item">
          <td>{{ item.order_no }}</td>
          <td>{{ item.mem_id }}</td>
          <td>{{ item.mem_name }}</td>
          <td>{{ item.tent_no }}</td>
          <td>{{ item.tent_style_no }}</td>
          <td>{{ payment_methods_show[item.payment_methods] }}</td>
          <td>
            <select
              name="which_tent"
              id="status_change"
              v-model="item.payment_status"
            >
              <option value="0">未付款</option>
              <option value="1">已付款</option>
              <option value="2">已完成</option>
            </select>
            <button @click="update(item)">確認</button>
          </td>
          <td>{{ item.order_total }}</td>
          <td>{{ item.checkin_date }}</td>
          <td>{{ item.checkout_date }}</td>
        </tr>
      </table>
    </div>
  </section>
  <Footer></Footer>
</template>

<script>
import { useRouter } from 'vue-router';

export default {
  data() {
    return {
      router: useRouter(),
      chtName: '預訂訂單管理',
      title: '會員中心',
      path: '/Booking',
      titles: [
        '預訂號碼',
        '會員ID',
        '會員姓名',
        '營帳編號',
        '營帳類型編號',
        '付款方式',
        '付款狀態',
        '總金額',
        '入住日期',
        '退房日期',
      ],
      payment_methods_show: ['現場付款', '轉帳'],
      status_show: ['未付款', '已付款', '已完成'],
      status_show_change: [0, 1, 2],
      orders: [],
    };
  },
  methods: {
    FetchAPIComment() {
      fetch(process.env.VUE_APP_PHP_PATH + 'backstation_bookedOrders.php')
        .then((response) => {
          if (response) {
            this.fetchError = response.status !== 200;
            return response.json();
          }
        })
        .then((responseText) => {
          this.orders = responseText;
        })
        .catch((err) => {
          this.orders = [];
        });
    },
    update(e) {
      //沒有錯誤則將更新後的會員傳送到資料庫
      var xhr = new XMLHttpRequest();

      xhr.open(
        'POST',
        process.env.VUE_APP_PHP_PATH + 'back_order_status.php',
        true
      );
      xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
      //回傳過去的資料
      let news_data = `order_no=${e.order_no}&payment_status=${e.payment_status}`;
      xhr.send(news_data);
      //重新撈回資料庫資料，再寫進sessionStorage
      xhr.onload = () => {
        if (xhr.status == 200) {
          alert('修改成功');
          let thus = this;
          thus.router.go(0);
        }
      };
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
          if(this.emp_login.employee_auth == 3){
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
@import '@/assets/scss/style.scss';
#status_change {
  width: 80px;
  height: 36px;
  option {
    font-size: 20px;
  }
}
.table_spacing{
    margin-top: 80px;
}
</style>
