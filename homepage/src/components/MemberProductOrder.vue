<template>
    <div class="mem_content_group">
        <!-- <div class="tabcontent_product_search">
            <input type="text" class="input_box input_spacing"><input type="button" value="搜尋" class="btn_purchase">
        </div> -->
        <div class="tabcontent_product_info">
            <ul class="product_order_title">
                <li>訂單編號</li>
                <li>下單時間</li>
                <li>付款狀態</li>
                <li>&emsp;</li>
            </ul>
        <div class="tabcontent_product_info_tab" v-for="item, index in memproductorders" :key="item">
            <input type="radio" name="orders" class="product_input" :id="`${item.product_order_no}`">
            <label class="info_tab" :for="`${item.product_order_no}`" >
                <ul class="product_order_info">
                    <li>{{item.product_order_no}}</li>
                    <li>{{item.product_order_time}}</li>
                    <li>已付款</li>
                </ul>
            </label>
            <div class="info_tab_content">
                <h4>商品訂單明細</h4>
                <div class="info_tab_contents">
                    <ul class="info_tab_contents_title">
                        <li>商品名稱</li>
                        <li>數量</li>
                        <li>金額</li>
                    </ul>
                    <ul v-for="detailItem in memProductOrderDetail[index]" :key="detailItem">
                        <li>{{detailItem.product_name}}</li>
                        <li>{{detailItem.product_order_list_qty}}</li>
                        <li>{{detailItem.product_order_list_price}}</li>
                    </ul>
                    <ul class="info_tab_contents_sum">
                        <li>&emsp;</li>
                        <li>總金額</li>
                        <li>$<span>
                            {{item.product_order_total}}
                            </span>元
                        </li>
                    </ul> 
                    <p class="delivery_location">配送地點: <span>{{item.product_order_pickup_place}}</span></p>
                </div>
                
             </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MemberCampsiteOrder",
        created(){
            this.getMemData()
            this.fetchProductOrders()
        },
        // beforeMount(){
        //     this.fetchProductOrderDetail()
        // },
        data(){
            return {
                // orders: [
                //     {
                //       id:'product1',
                //       no: '3462889269',
                //       date: '2022-10-07 19:23',
                //       sum:'13400',
                //       payment:'未付款',
                //       name:['營火叢多喝水瓶','營火叢不怕風吹帽'],
                //       qty:['1','4'],
                //       price:['2680','2680'],
                //       place:'桃園市中壢區復興路46號9樓'
                //     },
                //     {
                //       id:'product2',
                //       no: '3462889459',
                //       date: '2022-09-07 08:23',
                //       sum:'10720',
                //       payment:'已付款',
                //       name:['營火叢金勾杯','營火叢T-SHIRT'],
                //       qty:['2','2'],
                //       price:['2680','2680'],
                //       place:'桃園市中壢區復興路46號9樓'
                      
                //     },
                //     {
                //       id:'product3',
                //       no: '3462889249',
                //       date: '2022-05-07 04:23',
                //       sum:'5360',
                //       payment:'已付款',
                //       name:['營火叢漁夫帽','營火叢帽T'],
                //       qty:['1','1'],
                //       price:['2680','2680'],
                //       place:'桃園市中壢區復興路46號9樓'
                      
                //     }              
                // ], 
                member:'',
                mem_no:'',
                memproductorders:[],
                memProductOrderDetail:[],
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
            fetchProductOrders(){
                console.log(this.mem_no)
                fetch(process.env.VUE_APP_PHP_PATH + `getProductOrders.php?mem_no=${this.mem_no}`)                
                .then((response) => {
                    this.fetchError = (response.status !== 200)
                //json(): 返回 Promise，resolves 是 JSON 物件
                    return response.json()
                }).then(responseText => {
                    console.log(responseText)
                    //傳送資料
                    const useData = responseText
                    //篩選會員編號之後撈回來的訂單資料
                    this.memproductorders = useData
                    console.log(this.memproductorders)
                    //先執行上面的程式，抓到product_no，才能執行下面程式
                    this.fetchProductOrderDetail();
                }).catch((err) => {
                    this.memproductorders = true
                });
            },
            fetchProductOrderDetail(){
                //第一支程式已經抓到有幾筆訂單後，要用for迴圈去跑每筆訂單裡的訂單項目
                for(let i = 0; i < this.memproductorders.length; i++){
                    fetch(process.env.VUE_APP_PHP_PATH + `getMemOrderstest.php?product_order_no=${this.memproductorders[i].product_order_no}`)                
                    .then((response) => {
                        this.fetchError = (response.status !== 200)
                        //json(): 返回 Promise，resolves 是 JSON 物件
                        return response.json()
                    }).then(responseText => {
                        console.log(responseText)
                        //傳送資料
                        const useData = responseText
                        //篩選會員編號之後撈回來的訂單資料
                        this.memProductOrderDetail.push(useData);
                    }).catch((err) => {
                        this.memProductOrderDetail = true
                    });
                }
            },
        }
    }
</script>

<style  lang="scss" scoped>
@import '@/assets/scss/style.scss';
.mem_content_group{
    padding: 70px 0;
}
.product_order_title{
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
.tabcontent_product_search{
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
.tabcontent_product_info{
    width: 90%;
    margin: auto;
    border-radius: 3px;
    overflow: hidden;
    border: 2px solid $color-str-hov-green;
    .info_tab_content{
        border-bottom: 1px solid $color-str-hov-green;
        padding: 10px 0;
    }
}
.tabcontent_product_info_tab{
    width: 100%;
    color:$color-basic-gray3;
    overflow: hidden;
    .info_tab{
        background-color: #ffffff;
        padding: 10px 0;
        cursor: pointer;
        .product_order_info{
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
    }
    .info_tab_content {
        max-height: 0;
        padding: 0 16px;
        color: $color-basic-gray3;
        background: white;
        transition: all .35s;
        h4{
            color:$color-str-hov-green ;
        }
    }
}
.product_input:checked {
  + .info_tab {
    background-color: $color-main-yellow;
    .product_order_info{
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
.product_input{
    display: none;
}
.info_tab_contents{
    width: 80%;
    margin: auto;
    padding: 40px 0;
    @include md(){
        width: 100%;
        font-size: 15px;
        }  
    ul{
        display: flex;
        padding: 10px 0;
        li:nth-child(1){
            width: 50%;
        }
        li:nth-child(2){
            width: 20%;
        }
        li:nth-child(3){
            width: 30%;
        }
    } 
    .info_tab_contents_title, .info_tab_contents_sum{
        border-top: 1px solid $color-str-hov-green;
        border-bottom: 1px solid $color-str-hov-green;
        color: $color-basic-gray3;
        font-weight: 600;
    }
    .delivery_location{
        text-align: left;
        padding: 10px 0;
        @include md(){
        font-size: 15px;
        } 
    }        
}
</style>