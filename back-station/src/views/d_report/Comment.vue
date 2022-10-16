<template>
	<Menu></Menu>
	<Header></Header>
	<section class="page_section">
	<div class="breadcrum">
		<div class="breadcrum_left">
			<p class="router_name">{{chtName}}</p>
		</div>
		<div class="breadcrum_right">
			<div class="breadcrumb_text">
				<p class="breadcrumb_text_title">{{title}}</p>
				<router-link class="breadcrumb_text_chtname" :to="path">{{chtName}}</router-link>
			</div>
		</div>
	</div>
	<div class="serch_bar">
		<button 
                class="btn_no" 
                type="button"
                @click="activeBtn = 'numberDate'" 
                :class="{btn_active:activeBtn === 'numberDate'}"
            >編號排序
            </button>
            <button 
                    class="btn_new" 
                    type="button"
                    @click="activeBtn = 'timeDate'" 
                    :class="{btn_active:activeBtn === 'timeDate'}"
            >最新留言
            </button>
	</div>
	<table>
		<tr class="table_title">
		<th v-for="item in titles" :key="item">{{item}}</th>
		</tr>
		<tr class="item_content" v-for="item in filterData" :key="item.comment_no">
		<td>{{item.comment_no}}</td>
		<td>{{item.discuss_no}}</td>
		<td>{{item.comment_content}}</td>
		<td>{{item.mem_no}}</td>
		<td>{{item.comment_date}}</td>
		<td>{{item.comment_status}}</td>
		<!-- <td><button>更多</button></td> -->
		</tr>
	</table>
	</section>
	<Footer></Footer>
</template>

<script>
import { useRouter } from 'vue-router';
export default {
	data() {
		return {
			chtName: '留言管理',
			title: '營火報告',
			path:'/Comment',
			titles: [
				'留言編號',
				'報告編號',
				'留言內容',
				'會員編號',
				'留言日期',
				'留言狀態',
			],
			commentCount: [],
			activeBtn:'timeDate',
            current: 1,
            paginate: 1000,
			router: useRouter(),
		};
	},
	computed: {
        paginateTotal() {
            //卡片長度 除以 一頁可顯示的數量，會有小數點所以要用Math無條件進位
            return Math.ceil(this.commentCount.length / this.paginate)
        },
        filterData() {
            //一頁有幾筆數目，透過slice做計算，所以不能寫discussCard原始資料
            //array.slice((page_number - 1) * page_size, page_number * page_size);
            let arr = this.activeBtn == 'timeDate' ? this.timeDate : this.numberDate;
            return arr.slice((this.current - 1) * this.paginate , this.current * this.paginate);
        },
        numberDate() {
            //根據留言數做比較排序
            // console.log(this.discussCard.comment_count);
            return [...this.commentCount].sort( function(a,b) {
                return a.comment_no - b.comment_no;
            });
        },
        timeDate() {
            return [...this.commentCount].sort( function(a,b) {
                return Date.parse(b.comment_date) - Date.parse(a.comment_date);
                //將時間轉換成秒數
            });
        },
    },
	methods: {
		// 抓取留言資訊
		FetchAPIComment(){
			fetch(process.env.VUE_APP_PHP_PATH + `backDiscussCom.php`
			).then((response) => {
				if(response){
					this.fetchError = (response.status !== 200)
					return response.json()
				}
			}).then(responseText => {
				this.commentCount = responseText;
				console.log(this.commentCount);
			}).catch((err) => {
				this.commentCount = []
			})
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
			if(this.emp_login.employee_auth != 1){
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
@import'@/assets/scss/style.scss';
.serch_bar{
    .btn_no , .btn_new{
        width: 100px;
    }
}
.btn_active{
    background: #0e685e;
    color: #ffff;
}

</style>
