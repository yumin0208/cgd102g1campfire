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
    <div class="table_roll table_spacing">
      <table>
        <tr class="table_title">
          <th v-for="item in titles" :key="item">{{ item }}</th>
        </tr>
        <tr class="item_content" v-for="item in reserve" :key="item">
          <td>{{ item.order_no }}</td>
          <td>{{ item.mem_id }}</td>
          <td>{{ item.mem_name }}</td>
          <td>{{ item.checkin_date }}</td>
          <td>
            <select
              name="which_tent"
              id="which_current_tent"
              v-model="item.tent_no"
            >
              <option
                v-for="(tentItem, index) in current_tent_no[
                  item.tent_style_no - 1
                ]"
                :value="current_tent_no[item.tent_style_no - 1][index].tent_no"
                :key="tentItem"
              >
                {{ current_tent_no[item.tent_style_no - 1][index].tent_no }}
              </option>
            </select>
          </td>
          <td><button @click="update(item)">確認</button></td>
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
      chtName: '預約狀態管理',
      title: '營區預訂',
      path: '/Reservation',
      titles: [
        '預約編號',
        '會員ID',
        '會員姓名',
        '入住日期',
        '帳篷編號',
        '確定入住',
      ],
      reserve: [],
      current_tent_no: [
        // [1, 2, 3, 4, 5],
        // [6, 7, 8, 9, 10],
        // [11, 12, 13, 14, 15],
        // [16, 17, 18, 19, 20],
        // [21, 22, 23, 24, 25],
        // [26, 27, 28, 29, 30],
        // [31, 32, 33, 34, 35],
        // [36, 37, 38, 39, 40],
        // [41, 42, 43, 44, 45],
        // [46, 47, 48, 49, 50],
        // [51, 52, 53, 54, 55],
        // [56, 57, 58, 59, 60],
        // [61, 62, 63, 64, 65],
        // [66, 67, 68, 69, 70],
        // [71, 72, 73, 74, 75],
        // [76, 77, 78, 79, 80],
        // [81, 82, 83, 84, 85],
        // [86, 87, 88, 89, 90],
        // [91, 92, 93, 94, 95],
        // [96, 97, 98, 99, 100],
        // [101, 102, 103, 104, 105],
        // [106, 107, 108, 109, 110],
        // [111, 112, 113, 114, 115],
        // [116, 117, 118, 119, 120],
        // [121, 122, 123, 124, 125],
        // [126, 127, 128, 129, 130],
        // [131, 132, 133, 134, 135],
      ],
    };
  },
  methods: {
    FetchAPIComment() {
      fetch(process.env.VUE_APP_PHP_PATH + 'back_giveTentNo.php')
        .then((response) => {
          if (response) {
            this.fetchError = response.status !== 200;
            return response.json();
          }
        })
        .then((responseText) => {
          this.reserve = responseText;
        })
        .catch((err) => {
          this.reserve = [];
        });
      this.FetchAPICurrentTent();
    },
    FetchAPICurrentTent() {
      //第一支程式已經抓到有幾筆訂單後，要用for迴圈去跑每筆訂單裡的訂單項目
      for (let i = 1; i <= 27; i++) {
        fetch(
          process.env.VUE_APP_PHP_PATH +
            `back_getCurrentTentNo.php?tent_style_no=${i}`
        )
          .then((response) => {
            this.fetchError = response.status !== 200;
            //json(): 返回 Promise，resolves 是 JSON 物件
            return response.json();
          })
          .then((responseText) => {
            console.log(responseText);
            //傳送資料
            const useData = responseText;
            //篩選會員編號之後撈回來的訂單資料
            this.current_tent_no.push(useData);
          })
          .catch((err) => {
            this.memProductOrderDetail = true;
          });
      }
    },
    update(e) {
      var xhr = new XMLHttpRequest();

      xhr.open(
        'POST',
        process.env.VUE_APP_PHP_PATH + 'back_update_tent_no.php',
        true
      );
      xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
      //回傳過去的資料
      let news_data = `order_no=${e.order_no}&tent_no=${e.tent_no}`;
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
#which_current_tent {
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
