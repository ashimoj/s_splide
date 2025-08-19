<?php get_header(); ?>

<main id="main" class="l-main">
  <?php
  //MV
  get_template_part('inc/hero');

  //パンクズリスト
  get_template_part('inc/breadcrumb');
  ?>

  <div class="p-archive">
    <div class="c-inner">

      <?php if (have_posts()): ?>
        <div class="p-archive__wrap">
          <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part("inc/c-archive01__item") ?>
          <?php endwhile; ?>
        </div>

        <?php get_template_part("inc/c-pager01") ?>

      <?php endif; ?>

    </div>
  </div>
</main>

<?php get_footer() ?>