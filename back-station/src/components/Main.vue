<template>
<Menu></Menu>
<Header></Header>
<!-- <Footer></Footer> -->
</template>

<script>
import Menu from '@/components/Menu.vue';
import Header from '@/components/Header.vue';
import Footer from '@/components/Footer.vue';

export default {

  components: {
    Menu,
    Header,
    Footer,
  },
};

</script>

<style lang="scss" scoped>

@import'@/assets/scss/Style.scss';

</style>
