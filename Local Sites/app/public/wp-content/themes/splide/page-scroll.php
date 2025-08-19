<?php get_header(); ?>

<main id="main" class="l-main p-page">
  <?php
  //MV
  get_template_part('inc/hero');

  //パンクズリスト
  // get_template_part('inc/breadcrumb');
  ?>

  <div class="c-container p-scroll">
    <div class="c-inner">
      <div class="p-scroll__contents">
        <div class="p-scroll__contents-intro">
          <h2 class="c-scrollーdown">スクロールしてください！</h2>
        </div>
        <div class="c-container__item">
          <div class="c-scroll01 js-scrollTrigger">
            <?php for( $i=1; $i<=20; $i++ ): ?>
              <div class="c-scroll01__box"></div>
            <?php endfor; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<?php get_footer(); ?>