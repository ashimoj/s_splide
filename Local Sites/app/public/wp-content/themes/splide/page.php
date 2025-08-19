<?php get_header(); ?>

<main id="main" class="l-main p-page">
  <?php
  //MV
  get_template_part('inc/hero');

  //パンクズリスト
  get_template_part('inc/breadcrumb');
  ?>

  <?php
  //本文
  while (have_posts()) {
    the_post();
    remove_filter('the_content', 'wpautop');
    the_content();
  }
  ?>
</main>

<?php get_footer(); ?>