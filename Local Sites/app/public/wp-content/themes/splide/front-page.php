<?php get_header() ?>

<main id="main" class="l-main p-home">
  <section class="splide p-splide" aria-label="Splideの基本的なHTML">
    <div class="p-splide__inner">
      <h2 class="p-splide__ttl">本日のお寿司は7種類あります</h2>
      <!--   ページネーション -->
      <ul class="splide__pagination"></ul>
      <div class="splide-wrapper">
        <div class="splide__track">
        <ul class="splide__list">
          <li class="splide__slide">
            <div class="p-splide__contents">
              <figure class="p-splide__contents-img">
                <img src="https://illustkun.com/wp-content/uploads/2019/02/illustkun-02960-sushi.png" alt="まぐろ">
              </figure>
              <div class="p-splide__contents-txtArea">
                <p class="p-splide__contents-ttl"><strong>まぐろ</strong></p>
                <div class="p-splide__contents-txt">まぐろはおいしい</div>
              </div>
            </div>
          </li>
          <li class="splide__slide">
            <figure class="p-splide__contents-img">
              <img src="https://illustkun.com/wp-content/uploads/illustkun-04878-sushi.png" alt="鯛">
            </figure>
            <div class="p-splide__contents-txtArea">
              <p class="p-splide__contents-ttl"><strong>鯛</strong></p>
              <div class="p-splide__contents-txt">鯛です</div>
            </div>
          </li>
          <li class="splide__slide">
            <figure class="p-splide__contents-img">
              <img src="https://illustkun.com/wp-content/uploads/2019/02/illustkun-02961-sushi.png" alt="サーモン">
            </figure>
            <div class="p-splide__contents-txtArea">
              <p class="p-splide__contents-ttl"><strong>サーモン</strong></p>
              <div class="p-splide__contents-txt">みんな大好きサーモン</div>
          </li>
          <li class="splide__slide">
            <figure class="p-splide__contents-img">
              <img src="https://illustkun.com/wp-content/uploads/illustkun-06681-20220522-b.png" alt="シャリのみ">
            </figure>
            <div class="p-splide__contents-txtArea">
              <p class="p-splide__contents-ttl"><strong>シャリ</strong></p>
              <div class="p-splide__contents-txt">しゃりのみ...</div>
          </li>
          <li class="splide__slide">
            <figure class="p-splide__contents-img">
              <img src="https://illustkun.com/wp-content/uploads/2019/02/illustkun-02975-sushi.png" alt="えび">
            </figure>
            <div class="p-splide__contents-txtArea">
              <p class="p-splide__contents-ttl"><strong>えび</strong></p>
              <div class="p-splide__contents-txt">えび大好きなひと多い</div>
          </li>
          <li class="splide__slide">
            <figure class="p-splide__contents-img">
              <img src="https://illustkun.com/wp-content/uploads/2019/02/illustkun-02966-sushi.png" alt="たまご">
            </figure>
            <div class="p-splide__contents-txtArea">
              <p class="p-splide__contents-ttl"><strong>たまご</strong></p>
              <div class="p-splide__contents-txt">子供に人気なたまご</div>
          </li>
          <li class="splide__slide">
            <figure class="p-splide__contents-img">
              <img src="https://illustkun.com/wp-content/uploads/2019/02/illustkun-02969-sushi.png" alt="軍艦">
            </figure>
            <div class="p-splide__contents-txtArea">
              <p class="p-splide__contents-ttl"><strong>軍艦</strong></p>
              <div class="p-splide__contents-txt">軍艦です</div>
          </li>
        </ul>
      </div>

      <div class="splide-controller">
        <!--   矢印カスタマイズ -->
        <div class="splide__arrows">
          <button class="splide__arrow splide__arrow--prev" aria-label="前へ">＜</button>
          <button class="splide__arrow splide__arrow--next" aria-label="次へ">＞</button>
        </div>

        <!--  現在地表示バー -->
        <div class="my-carousel-progress">
          <div class="my-carousel-progress-bar" aria-hidden="true"></div>
        </div>
        
        <!-- 下層ボタン -->
        <div class="p-splide__btn">
          <a href="#" class="p-splide__btn-link">お寿司の一覧を見る<span class="p-splide__btn-link-arw" aria-hidden="true"></span></a>
        </div>
      </div>
      
    </div>
    
  </section>
</main>

<?php get_footer() ?>