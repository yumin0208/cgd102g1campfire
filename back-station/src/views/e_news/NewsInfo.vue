<template>
    <Menu></Menu>
    <Header></Header>
    <section class="page_section">
        <header class="project_header">
            <div class="header_left">
                <p class="router_name">最新消息</p>
            </div>
        </header>
        <div class="breadcrumb">
            
            <router-link to ="/NewsRelease">最新消息</router-link> <span> > 詳細內容</span>
            
        </div>
        <form>
            <div class="row">
                <label for="news_title">文章標題：</label>
                <input id="news_title" type="text">
            </div>
            <div class="row">
                <label for="news_content">文章內容：</label>
                <textarea class="news_content" name="news_content" maxlength="300"></textarea>
            </div>
            <div class="news_pic">

            </div>
            <div class="row">
                <label for="news_status">消息狀態：</label>
                <select name="news_status" id="news_status">
                    <option value="1">顯示</option>
                    <option value="0">隱藏</option>
                </select>
            </div>
            <div class="btn">
                <button>確認</button>
                <button>返回</button>
            </div>
        </form>

    </section>
    <Footer></Footer>
</template>

<script>
import Menu from "@/components/Menu.vue";
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";

export default {
    components: {
        Menu,
        Header,
        Footer
    },
}
</script>

<style lang="scss" scoped>

@import'@/assets/scss/style.scss';
@import'@/assets/scss/components/form.scss';

</style>