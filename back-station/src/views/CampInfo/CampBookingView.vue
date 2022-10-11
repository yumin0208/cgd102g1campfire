<template>
  <Main></Main>
  <section class="page_section">
    <header class="project_header">
      <div class="header_left">
        <p class="router_name">{{ chtName }}</p>
      </div>
      <div class="header_right">
        <div class="breadcrumb">
          <p>{{ title }} > {{ chtName }}</p>
        </div>
      </div>
    </header>

    <div class="serch_bar">
      <input type="text" placeholder="搜尋" />
      <button>新增</button>
      <button>修改</button>
      <button>刪除</button>
    </div>

    <table>
      <tr class="table_title">
        <th v-for="item in titles" :key="item">
          {{ item }}
        </th>
      </tr>
      <tr v-for="item in orders" :key="item">
        <td>{{ item.order_no }}</td>
        <td>{{ item.mem_id }}</td>
        <td>{{ item.mem_name }}</td>
        <td>{{ item.tent_no }}</td>
        <td>{{ item.tent_style_no }}</td>
        <td>{{ item.payment_methods }}</td>
        <td>{{ item.payment_status }}</td>
        <td>{{ item.order_total }}</td>
        <td>{{ item.checkin_date }}</td>
        <td>{{ item.checkout_date }}</td>
        <td><button>更多</button></td>
      </tr>
    </table>
  </section>
</template>

<script>
// @ is an alias to /src
import Main from '@/components/Main.vue';

export default {
  name: 'HomeView',
  components: {
    Main,
  },
  data() {
    return {
      chtName: '營區預訂管理',
      title: '營區預訂',
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
        '詳細資訊',
      ],
      orders: [],
    };
  },
  methods: {
    FetchAPIComment() {
      fetch(`http://127.0.0.1/g1/back-end/bookedOrdersBack.php`)
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
  },
  created() {
    this.FetchAPIComment();
  },
};
</script>

<style lang="scss" scoped>
@import '@/assets/Scss/Page/table.scss';
</style>
