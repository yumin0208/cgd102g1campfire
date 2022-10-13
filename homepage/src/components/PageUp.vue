<template>
  <div class="page_top">
    <img src="../assets/images/main/page_top.png" alt="" />
  </div>
</template>
<script>
export default {
  mounted() {
    const scroll = document.querySelector('.page_top');

    window.addEventListener("scroll", scrollFunction);

    function scrollFunction() { //show
      if (window.scrollY > 800){
        if(!scroll.classList.contains("btn_start")){
          scroll.classList.remove("btn_leave");
          scroll.classList.add("btn_start");
          scroll.style.display = "block";
        }
      }
      else{ //hide
        if(!scroll.classList.contains("btn_start")){
          scroll.classList.remove("btn_start");
          scroll.classList.add("btn_leave");
          scroll.style.display = "none";
    }
    }
    scroll.addEventListener("click", backToTop);

    function backToTop() {
      window.scrollTo(0,0);
    }
}
}
}
</script>
<style lang="scss" scoped>
@import '../assets/scss/style.scss';

@keyframes start {
  from{
    opacity: 0;
    transform: scale3D(0.3,0.3,0.3);
  }
  to{
    opacity: 1;
  }
}
@keyframes leave {
  from{
    opacity: 1;
    transform: scale3D(0.3,0.3,0.3);
  }
  to{
    opacity: 0;
  }
}
.btn_start{
  animation: start .5s;
  animation-fill-mode: both;
}
.btn_leave{
  animation: leave .25s;
  animation-fill-mode: both;
}
.page_top {
  // display: none;
  position: fixed;
  right: 20px;
  bottom: 100px;
  padding: 15px 10px;
  border-radius: 50px;
  background-color: rgba(255, 255, 255, 0.5);
  z-index: 1000;
  cursor: pointer;
  img {
    width: 50px;
    @include md() {
      width: 30px;
    }
    
  }
  &:hover {
    background-color: #fff;
    transition: all 0.3s;
    transform: translateY(-3px);
  }
}
</style>