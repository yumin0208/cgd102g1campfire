<template>
  <MainHeader></MainHeader>
  <div class="banner">
    <img src="@/assets/images/main/banner_shop.png" alt="banner" />
  </div>
  <section class="section_payment">
    <div class="payment_container">
      <div class="rwd_payment_col_1">
        <div class="wrap_cart">
          <div class="rwd_amount">
            <h3 class="rwd_amount_title">結帳金額</h3>
            <h3 class="rwd_amount_title">${{ itemTotal }}</h3>
            <!-- <div class="drop_down">
              <img 
                class="drop_down_img"
                src="../assets/images/shop/shopping_down.png"
                alt="查看更多"
              />
            </div> -->
          </div>

          <div class="cart_payment_container">
            <table
              class="cart_payment_info"
              v-for="item in orderList"
              :key="'item' + item.product_name"
            >
              <tbody>
                <tr class="table_tr_grid">
                  <td class="payment_item_image">
                    <img
                      class="cart_prod_image"
                      :src="
                        require(`@/assets/images/shop/shopping_prod_${item.product_pic}`)
                      "
                      alt=""
                    />
                  </td>
                  <td>
                    <p>{{ item.product_name }}</p>
                    <p>數量:{{ item.product_qty }}</p>
                    <p>單價:${{ item.product_price }}</p>
                    <p>小計:${{ item.product_qty * item.product_price }}</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="payment_rows_2">
        <div class="wrap_delivery">
          <h3 class="para">配送資訊</h3>
          <h4 class="para">收件人資訊</h4>
          <form class="delivery_info">
            <div class="user_input_box">
              <label for="name"
                >姓名
                <input type="text" id="name" v-model="member.mem_name" required />
              </label>
              <label for="tel"
                >電話
                <input type="tel" v-model="member.mem_phone" required />
              </label>
              <label for="email"
                >E-mail
                <input type="email" v-model="member.mem_email" required />
              </label>
            </div>
            <div class="user_input_box">
              <label for="city"
                >縣市
                <input type="text" v-model="member.mem_city" required/>
              </label>
              
              <label for=""
                >詳細地址
                <input type="text" v-model="member.mem_addr" />
              </label>
            </div>
          </form>
        </div>

        <div class="wrap_payment">
          <h3 class="para">付款資訊</h3>
          <h4 class="para">信用卡資訊</h4>
          <form class="payment_info">
            <div class="user_input_box">
              <label
                >持卡人姓名
                <input type="text" placeholder="營火叢" required />
              </label>
              <label
                >信用卡號
                <input type="text" placeholder="1111-1234-1234" v-model="ConfirmBoxInfo.text" required />
              </label>
              <div class="credit_box">
                <div class="credit_info">
                  <label
                    >到期日
                    <input type="text" placeholder="08/29" required />
                  </label>
                </div>
                <div class="credit_check_no">
                  <label
                    >檢核碼
                    <input type="text" placeholder="888" required />
                  </label>
                </div>
              </div>
            </div>
          </form>
          <div class="btn_link_group">
            <router-link to="/Shopping"
              ><button class="btn_return">返回購物</button></router-link
            >
            <button class="btn_purchase" @click="checkOut">確認結帳</button>
          </div>
        </div>
      </div>
      <div class="payment_col_1">
        <div class="wrap_cart">
          <div class="amount">
            <h3>結帳金額</h3>
            <h3>${{ itemTotal }}</h3>
          </div>

          <div class="cart_payment_container">
            <table
              class="cart_payment_info"
              v-for="item in orderList"
              :key="'item' + item.product_name"
            >
              <tbody>
                <tr class="table_tr_grid">
                  <td class="payment_item_image">
                    <img
                      class="details_product_img"
                      :src="
                        require(`../assets/images/shop/shopping_prod_${item.product_pic}`)
                      "
                      alt="hello"
                    />
                  </td>
                  <td>
                    <p>{{ item.product_name }}</p>
                    <p>數量:{{ item.product_qty }}</p>
                    <p>單價:${{ item.product_price }}</p>
                    <p>小計:${{ item.product_qty * item.product_price }}</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <ShopOrderConfirm v-if="confirmBox" @cancelBox="closeBox" :confirmation="ConfirmBoxInfo" :member='member' :itemTotal='itemTotal'></ShopOrderConfirm>
  <MainFooter></MainFooter>
</template>
<script>
import ShopOrderConfirm from "@/components/ShopOrderConfirm.vue";

export default {
  components: {
    ShopOrderConfirm
  },
  data() {
    return {
      member:[],
      orderList: [],//下訂單的產品
      itemTotal: 0,
      confirmBox: false, //確認付款後的確認pop box
      ConfirmBoxInfo: {
        text:null,
      },
    };
  },
  methods: {
    scrollToTop(){
      window.scrollTo(0,0)
    },
    //確認有無登入，用click事件，判斷提示
    // checkId() {
    //     let checkLogin = sessionStorage.getItem('member');
    //     if(checkLogin == null){
    //         alert("請先登入");
    //     }else{
    //         this.discuss_show = true;
    //     }
    // },
    
    // 將資料存進sessionStroage 
    setSessionStorage() {
			// 上面引用 v-model 雙向綁定,不需要另外丟參數, 可直接用this 呼叫
			sessionStorage.setItem('confirmInfo', JSON.stringify(this.ConfirmBoxInfo));
		},

    //拿到會員資料
    getMemData(){
        this.member = JSON.parse(sessionStorage.getItem('member'));
        this.memId = this.member.mem_id;
        // console.log(this.member)  
    },
    // 從 shopOrderConfirm 的component $emit 調資料過來
    closeBox(closeBox) {
      this.confirmBox = closeBox
    },
    checkOut() {
      // this.setSessionStorage()
      if(this.ConfirmBoxInfo.text == null){
        alert('欸~~請先填入付款資訊唷 ^__^');
      }else{
        this.confirmBox = true
      }
    },
    getOrderList() {
      const tempOrderList = localStorage.getItem("cart");
      if (!tempOrderList || tempOrderList === "undefined") return;
      this.orderList = JSON.parse(tempOrderList);
    },
    itemSum() {
      this.itemTotal = this.orderList.reduce(
        (acc, obj) => acc + obj.product_qty * obj.product_price,
        0
      );
    },
  },
  mounted(){
    this.scrollToTop()
  },
  created() {
    this.getMemData();
    this.getOrderList();
    this.itemSum();
    //是否有登入狀態
    let checkLogin = sessionStorage.getItem('member');
    if(checkLogin == null){
        return
    }else{
        this.discuss_show = true;
    }
  },
};
</script>
<style lang="scss" scoped>
@import "@/assets/scss/style.scss";
@import "@/assets/scss/shoppingPayment.scss";

</style>
