<template>
  <div class="page_top btn_leave">
    <img src="../assets/images/main/page_top.png" alt="" />
  </div>
</template>
<script>
export default {
  mounted() {
    const scroll = document.querySelector('.page_top');
    let timer = null; // 設置定時器
    let isTop = true; // 確認定時器的開關

    window.addEventListener('scroll', scrollFunction);

    function scrollFunction() {
      //show
      if (window.scrollY > 800) {
        scroll.classList.remove('btn_leave');
        scroll.classList.add('btn_start');
        scroll.style.display = 'block';
        isTop = false;
        // 一開始在初始值就加上.leave 就不需要去判斷屬性質去執行條件
        // 只需要單純判斷他滑了800就可以了
        // if (!scroll.classList.contains('btn_start')) {
        // }
      } else {
        //hide
        scroll.classList.remove('btn_start');
        scroll.classList.add('btn_leave');
        scroll.style.display = 'none';
        // if (!scroll.classList.contains('btn_start')) {
        // }
      }
    }
    scroll.addEventListener('click', backToTop);

    function backToTop() {
      timer = setInterval(() => {
        // 獲取滾動條高度
        let osTop =
          document.documentElement.scrollTop || document.body.scrollTop;

        // 讓滑動效果產生
        let speed = Math.floor(-osTop / 8);
        document.documentElement.scrollTop = document.body.scrollTop =
          osTop + speed;

        isTop = true;

        // 清除定時器
        if (osTop < 800) {
          clearInterval(timer);
        }
      }, 30);
    }
  },
};
</script>
<style lang="scss" scoped>
@import '../assets/scss/style.scss';

@keyframes start {
  from {
    opacity: 0;
    transform: scale3D(0.3, 0.3, 0.3);
  }
  to {
    opacity: 1;
  }
}
@keyframes leave {
  from {
    opacity: 1;
    transform: scale3D(0.3, 0.3, 0.3);
  }
  to {
    opacity: 0;
  }
}
.btn_start {
  animation: start 0.5s;
  animation-fill-mode: both;
}
.btn_leave {
  animation: leave 0.25s;
  animation-fill-mode: both;
  // pointer-events: none;
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
