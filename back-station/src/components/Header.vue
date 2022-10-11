<template>
<nav class="project_nav">
    <div class="nav_left">
        <div class="nav_serch">
            <h2 class="header_title">{{projectName}}</h2>
            <input type="text" placeholder="搜尋">
        </div>    
    </div>
    <div class="nav_right">
        <div class="nav_logout">
            <a href="#" class="logout_btn">登出</a>
        </div>    
        <div class="nav_account">
            <div class="account_photo">
                <img src="../assets/Image/icon/header_icon_account.png" alt="Staff">
            </div>
            <p class="account_text">您好！{{staffName}}</p>
        </div> 
    </div>
</nav>
</template>

<script>

export default {
    data() {
        return {
            projectName: '營火叢後台系統管理',
        }
    },
}
</script>

<style lang="scss" scoped>

    @import'@/assets/scss/Style.scss';
    
</style>

