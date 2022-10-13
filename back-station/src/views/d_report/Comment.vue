<template>
<<<<<<< HEAD
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
		<input type="text" placeholder="搜尋"/>
		<button>新增</button>
		<button>修改</button>
		<button>刪除</button>
	</div>
	<table>
		<tr class="table_title">
		<th v-for="item in titles" :key="item">{{item}}</th>
		</tr>
		<tr v-for="item in commentCount" :key="item.comment_no">
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
=======
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
    <input type="text" placeholder="搜尋"/>
    <button>新增</button>
    <button>修改</button>
    <button>刪除</button>
  </div>
  <table>
    <tr class="table_title">
      <th v-for="item in titles" :key="item">{{item}}</th>
    </tr>
    <tr class="item_content" v-for="item in comment" :key="item">
      <td>{{item.comment_no}}</td>
      <td>{{item.discuss_no}}</td>
      <td>{{item.comment_content}}</td>
      <td>{{item.mem_no}}</td>
      <td>{{item.comment_date}}</td>
      <td>{{item.comment_status}}</td>
      <td><button>更多</button></td>
    </tr>
  </table>
</section>
<Footer></Footer>
>>>>>>> 7d61ecdee829310139f045e75c455b6614f563f9
</template>

<script>

import Menu from "@/components/Menu.vue";
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";

export default {
<<<<<<< HEAD
	name: 'HomeView',
	components: {
		Menu,
		Header,
		Footer,
	},
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
		};
	},
	methods: {
		// 抓取留言資訊
		FetchAPIComment(){
			fetch(process.env.VUE_APP_PHP_PATH + `discussComment.php`
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
	},
	created() {
		this.FetchAPIComment();
	},
=======
name: 'HomeView',
components: {
  Menu,
  Header,
  Footer,
},
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
      '詳細資訊',
    ],
    comment: [],
  };
},
methods: {
  FetchAPIComment() {
    fetch(``)
      .then((response) => {
        if (response) {
          this.fetchError = response.status !== 200;
          return response.json();
        }
      })
      .then((responseText) => {
        this.comment = responseText;
      })
      .catch((err) => {
        this.comment = [];
      });
  },
},
created() {
  this.FetchAPIComment();
  },
>>>>>>> 7d61ecdee829310139f045e75c455b6614f563f9
};
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';

</style>
