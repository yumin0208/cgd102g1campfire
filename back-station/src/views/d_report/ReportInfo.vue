<template>
<Menu></Menu>
<Header></Header>
<section class="page_section">
	<header class="project_header">
	<div class="header_left">
		<h2 class="router_name">營火報告</h2>
	</div>
	<div class="breadcrumb">
		<span>營火報告 &nbsp ＞ &nbsp</span>
		<router-link to="/MemberList">營火報告資訊管理</router-link>
		<span>&nbsp&nbsp ＞ &nbsp 營火報告詳細資訊</span>
	</div>
	</header>

	<form class="discuss_form">
	<div class="row">
		<h4>報告編號：</h4>
		<p>{{ discuss.discuss_no }}</p>
	</div>
	<div class="row">
		<h4>會員編號：</h4>
		<p>{{ discuss.mem_no }}</p>
	</div>
	<div class="row">
		<h4>報告標題：</h4>
		<p>{{ discuss.discuss_title }}</p>
	</div>
	<div class="row">
		<h4>報告內容：</h4>
		<p>{{ discuss.discuss_content }}</p>
	</div>
	<div class="row">
		<h4>發佈時間：</h4>
		<p>{{ discuss.discuss_post_time }}</p>
	</div>
	<div class="row">
		<label for="discuss_status" class="dis_status">報告狀態：</label>
		<select
		name="discuss_status"
		id="discuss_status"
		v-model="discuss.discuss_status"
		>
		<option value="1">顯示</option>
		<option value="0">隱藏</option>
		</select>
	</div>
	<div class="row">
		<h4>留言數量：</h4>
		<p>{{ discuss.comment_count }}</p>
	</div>
	<div class="row">
		<h4>背景樣式：</h4>
		<p>{{ discuss.background_type }}</p>
	</div>
	<div class="btn">
		<button class="update" id="update" @click="update" type="button">確認</button>
		<button class="go_back" id="go_back" @click="goBack" type="button">返回</button>
	</div>
	</form>
</section>
<Footer></Footer>
</template>

<script>
import { useRouter } from 'vue-router';

export default {
name: 'ReportInfo',
path: '/ReportInfo',
components: {
	Menu,
	Header,
	Footer,
},
data() {
	return {
	// discussId: null,
	discuss_no: '',
	mem_no: '',
	discuss_title: '',
	discuss_content: '',
	discuss_post_time: '',
	discuss_status: '1',
	comment_count: '',
	background_type: '',
	discussModifyData: {},
	discuss_data: [],
	router: useRouter(),
	};
},
created() {
	this.getDiscussData();
	this.fetchDiscussData();
},
methods: {
	getDiscussData() {
	//抓到sessionStorage的資料
	// discuss，php設的變數要一樣
	this.discuss = JSON.parse(sessionStorage.getItem('discuss'));
	//抓取文章編號，要去後端撈資料
	this.discuss_no = this.discuss.discuss_no;
	//確認有抓到東西
	},
	//抓報告no，連結報告資料
	fetchDiscussData() {
		fetch(
			process.env.VUE_APP_PHP_PATH +
			`backDiscussCardModify.php?discuss_no=${this.discuss_no}`
		)
		.then((response) => {
			this.fetchError = response.status !== 200;
			//json(): 返回 Promise，resolves 是 JSON 物件
			return response.json();
		})
		.then((responseText) => {
			//傳送資料
			const useData = responseText;
			console.log(useData);
			//篩選文章編號之後撈回來的第一筆資料
			this.discussModifyData = useData[0];
			//這邊的mem_xxx資料是綁在v-model上
			this.discuss_title = responseText.discuss_title;
			this.discuss_content = responseText.discuss_content;
			this.discuss_post_time = responseText.discuss_post_time;
			this.discuss_status = responseText.discuss_status;
			this.comment_count = responseText.comment_count;
			this.background_type = responseText.background_type;
		})
		.catch((err) => {
			this.discussModifyData = true;
		});
	},
	//上傳更新資料
	update(){
		var xhr = new XMLHttpRequest();

		xhr.open("POST",process.env.VUE_APP_PHP_PATH + 'backDiscussCardUpdate.php', true);
		xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
		//回傳過去的資料
		let discuss_data = `discuss_no=${this.discuss_no}&discuss_status=${this.discuss.discuss_status}`;
		console.log(discuss_data);
		console.log(this.discuss_no);
		console.log(this.discuss.discuss_status);
		//傳送要送的值
		xhr.send(discuss_data);
		xhr.onload = ()=>{
			if(xhr.status == 200){
				// this.session = JSON.parse(xhr.responseText);
				sessionStorage.setItem("discuss", JSON.stringify(this.session)); 
				alert("修改成功");
				let thus = this;
				thus.router.push({path:'/Report'})
			}
		}
	},
	//返回報告總覽
	goBack(){
		let thus = this;
		thus.router.push({path:'/Report'})
	}
},
};
</script>

<style lang="scss" scoped>
@import '@/assets/scss/style.scss';
@import '@/assets/scss/components/form.scss';

.discuss_form {
.row {
	h4 {
	width: 14%;
	}
	p {
	width: 86%;
	}
}
}
.dis_status {
font-size: $title_h4;
font-weight: 700;
letter-spacing: 1px;
line-height: 34px;
}
</style>
