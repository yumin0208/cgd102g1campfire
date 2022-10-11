<template>

<Main></Main>
<section class="page_section">

    <header class="project_header">
    <div class="header_left">
        <p class="router_name">{{chtName}}</p>
    </div>
    <div class="header_right">
        <div class="breadcrumb">
        <p>{{title}} > {{chtName}} > {{detailsName}}</p>
        </div>
    </div>
    </header>

    <form action="">
        <div>
            <label for="type_number">類型編號：</label>
            <input id="type_number" type="text">
        </div>
        <div>
            <label for="peoele">入住人數：</label>
            <input id="people" type="text">
        </div>
        <div>
            <label for="location_number">地區編號：</label>
            <select name="location_number" id="location_number">
                <option value="">地區編號</option>
                <option value="">000</option>
                <option value="">111</option>
                <option value="">222</option>
            </select>
        </div>
        <div>
            <label for="type_tent">營帳種類：</label>
            <select name="type_tent" id="type_tent">
                <option value="">營帳種類</option>
                <option value="">經濟</option>
                <option value="">豪華</option>
                <option value="">主題</option>
            </select>
        </div>
        <div>
            <label for="tent_name">營帳名稱：</label>
            <input id="tent_name" type="text">
        </div>
        <div>
            <label for="tent_info">營帳介紹：</label>
            <textarea name="tent_info" id="tent_info" cols="40" rows="70"></textarea>
        </div>
        <div>
            <label for="price">營帳價格：</label>
            <input id="price" type="text">
        </div>
        <div>
            <label for="unit">營帳數量：</label>
            <input id="unit" type="text">
        </div>
        <div>
            <label for="unit">營帳數量：</label>
            <input id="unit" type="text">
        </div>
        <div>
            <label for="photo">營帳照片：</label>
            <input id="photo" type="text">
            <button>瀏覽</button>
        </div>
        <div>
            <label for="state">營帳狀態：</label>
            <select name="state" id="state">
                <option value="">營帳狀態</option>
                <option value="">1</option>
                <option value="">2</option>
            </select>
        </div>
        <div class="btn">
            <button>確認</button>
            <button>返回</button>
        </div>
    </form>

</section>

</template>
    
<script>
// @ is an alias to /src
import Main from '@/components/Main.vue';

export default {
    components:{
        Main,
    },
    data() {
        return {
            chtName: '營帳類型管理',
            title:'營區服務',
            detailsName:'類型管理明細',
        }
    },
}

</script>

<style lang="scss" scoped>

@import'@/assets/Scss/Page/form.scss';
    
</style>
