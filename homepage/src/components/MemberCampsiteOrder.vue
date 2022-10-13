<template>
    <div class="mem_content_group">
        <!-- <div class="tabcontent_booking_search">
            <input type="text" class="input_box input_spacing"><input type="button" value="搜尋" class="btn_purchase" @click="filterItems">
        </div> -->
        <div class="tabcontent_booking_info">
            <ul class="booking_order_title">
                <li>預定編號</li>
                <li>日期</li>
                <li>&emsp;</li>
                <li>&emsp;</li>
            </ul>
        <div class="tabcontent_booking_info_tab" v-for="item in memcamporders" :key="item.orders_no">
            <input type="radio" name="orders" class="booing_input" :id="`${item.orders_no}`">
            <label class="info_tab" :for="`${item.orders_no}`" > 
                <ul class="booking_order_info">
                    <li>{{item.orders_no}}</li>
                    <li><span>{{item.checkin_date}}</span>至{{item.checkout_date}}<span></span></li>
                    <li class="status_none">{{item.payment_status}}</li>
                </ul>
            </label>
            <div class="info_tab_content">
                <h4>營地預定訂單明細</h4>
                <div class="info_tab_contents">
                    <ul class="info_tab_contents_title">
                        <li>下訂日期/時間</li>
                        <li>預定地區</li>
                        <li>預訂帳篷類型</li>
                        <li>預訂餐點類型</li>
                        <li>預定裝備類型</li>
                        <li>預訂活動類型</li>
                        <li>訂單總金額</li>
                    </ul>
                    <ul>
                        <li>{{item.orders_time}}</li>
                        <li>{{item.area_name}}</li>
                        <li>{{item.tent_style_name}}</li>
                        <li>{{item.food_name}}</li>
                        <li>{{item.equip_name}}</li>
                        <li>{{item.activity_name}}</li>
                        <li>&emsp;</li>
                    </ul>
                    <ul class="price">
                        <li><span>{{item.tent_style_price}}</span>元</li>
                        <li><span>{{item.food_price}}</span>元</li>
                        <li><span>{{item.equip_price}}</span>元</li>
                        <li><span>{{item.activity_price}}</span>元</li>
                        <li>$<span>{{item.orders_total}}</span>元</li>
                    </ul>
                </div>
                <div class="cancel_order" v-if="item.payment_status!=3&&item.payment_status!=2">
                    <button type="botton" class="btn_submit btn_cancel"
                            @click="cancelOrder(item.orders_no)">取消訂單</button>
                </div>
             </div>
        </div>
        </div>
    </div>
</template>

<script>
import { useRouter } from "vue-router";
    export default {
        name: "MemberCampsiteOrder",
        created(){
            this.getMemData()
            this.fetchCampOrders()
        },
        data(){
            return {
                isShow:null,
                member:'' ,
                mem_no:'',
                memcamporders:[],
                payment_status:'',
                router:useRouter(),
                keyword:'',
            }
        },methods:{
            getMemData(){
                //抓到sessionStorage的會員資料
                this.member = JSON.parse(sessionStorage.getItem('member'));
                //抓取會員編號，要去後端撈會員資料需要
                this.mem_no = this.member.mem_no;
                //確認有抓到東西
                console.log(this.member)
                console.log(this.mem_no)
            },
            fetchCampOrders(){
                console.log(this.mem_no)
                fetch(process.env.VUE_APP_PHP_PATH + `getMemOrders.php?mem_no=${this.mem_no}`)                
                .then((response) => {
                    this.fetchError = (response.status !== 200)
                //json(): 返回 Promise，resolves 是 JSON 物件
                    return response.json()
                }).then(responseText => {
                    console.log(responseText)
                    //傳送資料
                    const useData = responseText
                    //篩選會員編號之後撈回來的訂單資料
                    this.memcamporders = useData
                    console.log(this.memcamporders)
                }).catch((err) => {
                    this.memcamporders = true
                });
            },
            cancelOrder(e){
                //取消訂單，送訂單編號到資料庫，刪除資料
                var xhr = new XMLHttpRequest();

                xhr.open("POST",process.env.VUE_APP_PHP_PATH + `deleteCampOrder.php?orders_no=${e}`, true);
                xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                xhr.send();
                
                //重新更新畫面
                xhr.onload = ()=>{
                    console.log(xhr.responseText);
                    if(xhr.status == 200){
                        alert("修改訂單成功");
                        let thus = this
                        thus.router.go(0)
                    }
                }  
            },
        },    
    }
</script>

<style  lang="scss" scoped>
@import '@/assets/scss/style.scss';
.mem_content_group{
    padding: 70px 0;
}
.booking_order_title{
    width: 100%;
    display: flex;
    color:$color-basic-gray4 ;
    font-size: 20x;
    font-weight: 700;
    padding: 10px;
    background-color:$color-main-yellow ;
    border-bottom: 2px solid $color-str-hov-green;
    li:nth-child(1){
        width: 32%;
    }
    li:nth-child(2){
        width: 32%;
    }
    li:nth-child(3){
        width: 26%;
    }
    li:nth-child(4){
        width: 10%;
    }
}
.tabcontent_booking_search{
    text-align: end;
    width: 95%;
    margin-bottom: 30px;
    @include md(){
        width: 90%;
        } 
    .input_spacing{
        margin: 0 10px;
    }
    .btn_purchase{
        @include md(){
        width: 80px;
        padding: 5px 0;
        }   
    }
}
.tabcontent_booking_info{
    width: 90%;
    margin: auto;
    border-radius: 3px;
    overflow: hidden;
    border: 2px solid $color-str-hov-green; 
    .info_tab_content{
        border-bottom: 1px solid $color-str-hov-green;
        padding: 10px 0;
        h4{
            color:$color-str-hov-green ;
        }
    }
}
.tabcontent_booking_info_tab{
    width: 100%;
    color: $color-basic-gray3;
    overflow: hidden;
    .info_tab{
        background-color: #ffffff;
        padding: 10px 0;
        cursor: pointer;
        .booking_order_info{
            display: flex;
            padding: 10px;
            &:hover{
                background-color: #e0f1ec;
            }
            &::after {
                content: "\276F";
                width: 16px;
                height: 16px;
                transition: all .35s;
            }
        }
        li:nth-child(1){
            width: 32%;
            @include md(){
                font-size: 14px;
            }
        }
        li:nth-child(2){
            width: 32%;
            @include md(){
                font-size: 14px;
                padding: 0 5px;
            } 
        }
        li:nth-child(3){
            width: 26%;
            @include md(){
                font-size: 14px;
            }
        }
        li:nth-child(4){
            width: 10%;
        }
        .status_none{
            color: transparent;
        }
    }
    .info_tab_content {
        margin: auto;
        max-height: 0;
        padding: 0 16px;
        color: $color-basic-gray3;
        background: white;
        transition: all .35s;
    }
}
.booing_input:checked {
  + .info_tab {
    background-color: $color-main-yellow;
    .booking_order_info{
        background-color: $color-main-yellow;
        &::after {
        transform: rotate(90deg);
        }
    }  
  }
  ~ .info_tab_content {
    max-height: 100vh;
    padding: 1em;
  }
}
.booing_input{
    display: none;
}
.info_tab_contents{
    display: flex;
    text-align: left;
    align-items: flex-end;
    width: 80%;
    margin: auto;
    @include md(){
        width: 100%;
        font-size: 15px;
        }  
    ul{
        padding: 45px 0;
    }
    ul li{
        padding: 6px 15px;
        @include md(){
            padding: 5px 5px;
        }  
    }
    .info_tab_contents_title{
        font-weight: 700;
    }
    .price{
        text-align: right;
    }
}
.cancel_order{
    width: 80%;
    margin: auto;
    text-align: right;
    padding: 0 15px;
    margin-bottom: 20px;
    @include md(){
        width: 0%;   
    }
    .btn_cancel{
        width: 100px;
        font-size: 16px;
        border-radius: 30px;
        border: 2px solid $color-str-green;
        padding: 10px 0;
        @include md(){
            width: 80px;
            padding: 5px 0;
            font-size: 14px;
        }
    }
}
</style>