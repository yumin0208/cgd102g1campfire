<template>
    <Menu></Menu>
    <Header></Header>
    <section class="page_section">
        <header class="project_header">
            <div class="header_left">
                <p class="router_name">商品資訊修改</p>
            </div>
            <div class="breadcrumb">
                <span>商品資訊  &nbsp> &nbsp</span><router-link to ="/ProductsInfo">商品資訊管理 </router-link><span>&nbsp&nbsp > &nbsp商品資訊修改</span>
            </div>
        </header>
        
        <form>
            <div class="row">
                <label for="product_no">商品編號：</label>
                <input id="product_no" type="text" v-model="product_no">
            </div>
            <div class="row">
                <label for="product_type_no">商品類別編號：</label>
                <input id="product_type_no" type="text" v-model="product_type_no">
            </div>
            <div class="row">
                <label for="product_name">商品名稱：</label>
                <input id="product_name" type="text" v-model="product_name">
            </div>
            <div class="row">
                <label for="product_price">商品價格：</label>
                <input id="product_price" type="text" v-model="product_price">
            </div>
            <div class="row">
                <label for="product_pic">商品圖片：</label>
                <input id="product_pic" type="text" v-model="product_pic">
            </div>
            <div class="row">
                <label for="product_status">商品狀態：</label>
                <input id="product_status" type="text" v-model="product_status">
            </div>
            <div class="row">
                <label for="product_update">上架日期：</label>
                <input id="product_update" type="text" v-model="product_update">
            </div>
            <div class="row">
                <label for="product_qty">數量：</label>
                <input id="product_qty" type="text" v-model="product_qty">
            </div>
            
            <!-- <div class="news_pic"> 

            </div> -->
            <!-- <div class="row">
                <label for="news_status">消息狀態：</label>
                <select name="news_status" id="news_status" v-model="news_status">
                    <option value="1">顯示</option>
                    <option value="0">隱藏</option>
                </select>
            </div> -->
            <!-- <div class="row">
                發布時間：<span class="post_time">{{news_post_time}}</span>
            </div> -->
            <div class="btn">
                <button class="update" id="update" @click="update">確認</button>
                <button class="go_back" id="go_back" @click="goBack">返回</button>
            </div>
        </form>

    </section>
    <Footer></Footer>
</template>

<script>
import { useRouter } from "vue-router";

export default {
    data(){
        return{
            product_no:'',
            product_type_no:'',
            product_name:'',
            product_price:'',
            product_pic:'',
            product_status:'',
            product_update:'',
            product_qty:'',
            product_data:[],
            productmodifydata:{},
            products:'',
            router:useRouter()
        }
    },
    created(){
        this.getProductsData()
        this.fetchProductsData()
    },
    methods:{
        getProductsData(){
            //抓到sessionStorage的資料
            this.products = JSON.parse(sessionStorage.getItem('Products'));
            //抓取文章編號，要去後端撈資料
            this.product_no = this.products.product_no;
            //確認有抓到東西
        },
        fetchProductsData(){
            fetch(process.env.VUE_APP_PHP_PATH + `backstation_product_modify.php?product_no=${this.product_no}`)                
            .then((response) => {
                this.fetchError = (response.status !== 200)
            //json(): 返回 Promise，resolves 是 JSON 物件
                return response.json()
            }).then(responseText => {
                //傳送資料
                const useData = responseText
                //篩選文章編號之後撈回來的第一筆資料
                this.productmodifydata = useData[0]
                //這邊的mem_xxx資料是綁在v-model上
                this.product_no = responseText.product_no;
                this.product_type_no = responseText.product_type_no;
                this.product_name = responseText.product_name;
                this.product_price = responseText.product_price;
                this.product_pic = responseText.product_pic;
                this.product_status = responseText.product_status;
                this.product_update = responseText.product_update;
                this.product_qty = responseText.product_qty;
            }).catch((err) => {
                this.productmodifydata = true
            });
        },
        update(e){
            if (
                //指定css選擇器的節點
                e.target.closest('button') &&
                e.target.closest('button').id === 'update'
                ) {
                //取消預設submit事件
                    e.preventDefault()
                if(this.product_name == '' || this.product_no == '' ){
                    alert("不可以有空白喔");
                    return;
                }
                else{
                //沒有錯誤則將更新後的會員傳送到資料庫
                    var xhr = new XMLHttpRequest();
            
                    xhr.open("POST",process.env.VUE_APP_PHP_PATH + 'products.php', true);
                    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                    //回傳過去的資料
                    let product_data = `product_no=${this.product_no}&product_type_no=${this.product_type_no}&product_name=${this.product_name}&product_price=${this.product_price}&product_pic=${this.product_pic}&payment_status=${this.payment_status}&product_update=${this.product_update}&product_qty=${this.product_qty}`;
                    xhr.send(product_data);
                    //重新撈回資料庫資料，再寫進sessionStorage
                    xhr.onload = ()=>{
                        if(xhr.status == 200){
                            this.session = JSON.parse(xhr.responseText);
                            sessionStorage.setItem("products", JSON.stringify(this.session)); 
                            alert("修改成功");
                            let thus = this
                            thus.router.go(0)
                        }
                    }  
                }   
            }
        },
        goBack(e){
            if(
                //指定css選擇器的節點
                e.target.closest('button') &&
                e.target.closest('button').id === 'go_back'
                ) {
                //取消預設submit事件
                e.preventDefault()
                sessionStorage.removeItem("products", JSON.stringify(this.session));
                let thus = this;
                thus.router.push({path:'/ProductsInfo'})
            }
        }
    },
}
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';
@import'@/assets/scss/components/form.scss';

</style>