<?php get_header() ?>

<main id="main" class="l-main p-error">
  <?php
  //パンクズリスト
  get_template_part('inc/breadcrumb');
  ?>

  <div class="c-inner">
    <h1 class="c-head u-mb-40">404 Not Found</h1>
    <h2 class="p-error__title u-mb-16">
      お探しのページが見つかりませんでした。
    </h2>
    <div class="p-error__textWrap u-mb-40">
      <p>アクセスしようとしたページは、<br class="u-view-under-medium">変更されたか、利用できない可能性があります。</p>
    </div>

    <a href="<?php echo esc_url(home_url()); ?>" class="c-btn">TOPに戻る</a>
  </div>
</main>

<?php get_footer() ?>