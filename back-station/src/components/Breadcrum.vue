<template>
<div class="breadcrum">
    <div class="breadcrum_left">
        <p class="router_chtname">{{chtName}}</p>
    </div>
    <div class="breadcrum_right">
        <div class="breadcrumb_text">
            <p class="breadcrumb_text_title">{{title}}</p>
            <router-link class="breadcrumb_text_chtname" :to="path">{{chtName}}</router-link>
        </div>
    </div>
</div>
</template>

<script>
export default {
    
}
</script>

<style lang="scss">

@import'@/assets/scss/style.scss';

</style>