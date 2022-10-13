<template>
<MainHeader/>
<section class="wrap_news">
    <div id="app">
        <div class="banner">
            <img src="@/assets/images/main/banner_news.png" alt="" />
        </div>
        <div class="news_v_container">
            <div class="news_v_box" 
                v-for="news in filterData"
                :class="{news_v_reverse: news % 2 === 0}"
                :key="news.news_no">
                <div class="news_v_pic">
                    <img :src="require(`@/assets/images/news/${news.news_pic}`)" alt="最新消息照片">
                </div>
                <div class="news_v_txt">
                    <h3>{{news.news_title}}</h3>
                    <p class="news_v_content">{{news.news_content}}</p>
                    <p class="news_v_post_time">{{news.news_post_time}}</p>
                </div>
            </div>
            <div class="news_v_box md sm" 
                v-for="news in filterData"
                :key="news.news_no">
                <div class="news_v_pic">
                    <img :src="require(`@/assets/images/news/${news.news_pic}`)" alt="最新消息照片">
                </div>
                <div class="news_v_txt">
                    <h3>{{news.news_title}}</h3>
                    <p class="news_v_content">{{news.news_content}}</p>
                    <p class="news_v_post_time">{{news.news_post_time}}</p>
                </div>
            </div>
        </div>
        <div class="btnContainer">
            <button @click="prevPage" type="button"> ＜ </button>
            <button 
                v-for="page in paginateTotal" 
                :key="page"
                :class="{'activeBtnStyle': (current === page)}"
                @click="selectPage " 
                type="button"
            >
                {{page}}
            </button>
            <button @click="nextPage" type="button"> ＞ </button>
        </div>
    </div>
</section>
<MainFooter/>
</template>

<script>
export default{
    data(){
    return{
      newsList:[],
      paginate: 4,
      current: 1,
    }
    },
    methods:{
        scrollToTop(){
            window.scrollTo(0,0)
        },
        prevPage(){
            if(this.current === 1) return
            this.current -= 1 ;
            this.scrollToTop() ;
        },
        //當前頁面是最後一頁，不能再往後
        nextPage(){
            if(this.current >= this.paginateTotal) return
            this.current += 1
            this.scrollToTop() ;
        },
        selectPage(e){
            console.log(e)
            console.log(this.current)
            this.current = e;
            this.scrollToTop() ;
        },
    },
    computed: {
        paginateTotal() {
            //卡片長度 除以 一頁可顯示的數量，會有小數點所以要用Math無條件進位
            return Math.ceil(this.newsList.length / this.paginate)
        },
        filterData() {
            //一頁有幾筆數目，透過slice做計算
            return this.newsList.slice((this.current - 1) * this.paginate , this.current * this.paginate);
        }
    },
    created(){
        fetch(process.env.VUE_APP_PHP_PATH + 'news.php')
        .then((res)=>{
        // this.fetchError = (response.status !== 200)
        return res.json()
        })
        .then((newsContent)=>{
        this.newsList=newsContent
        })
    },
    mounted(){
        //要用到mounted，不能用在created中，因為Dom元件還沒被掛載，讀不到window
        this.scrollToTop()
    }
} 
</script>
<style lang="scss" scoped>
@import '@/assets/scss/style.scss';
@import '../assets/scss/page/NewsView';
</style>