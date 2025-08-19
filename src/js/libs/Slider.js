import Splide from "@splidejs/splide";
import "@splidejs/splide/css";

function splide() {

  const splide = new Splide(".splide", {
    mediaQuery: 'min',
    perPage: 1,
    gap: 12,
    // autoWidth: true, // 異なる高さを持ったスライドの調整
    type: 'loop', // 一周させるかどうか
    breakpoints: {
      600: {
        perPage: 2,
      },
      1025: {
        perPage: 4,
        gap: 20,
      }
    },
  });
  
  const bar = splide.root.querySelector(".my-carousel-progress-bar");
  
  // Splideの初期化が終わった際、またはスライドが切り替わる際にバーの長さを更新する
  splide.on("mounted move", function () {
    const end = splide.Components.Controller.getEnd() + 1;
    const rate = Math.min((splide.index + 1) / end, 1);
    bar.style.width = String(100 * rate) + "%";
  });
   
  splide.mount();

}


export { splide };
