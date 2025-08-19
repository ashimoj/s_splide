<?php get_header(); ?>

<main id="main" class="l-main p-mv">
  <?php
  //MV
  get_template_part('inc/hero');

  //パンクズリスト
  // get_template_part('inc/breadcrumb');
  ?>

  <?php // mouseStalker ?>
  <div class="p-stalker">
    <div class="p-stalker__circle js-circle">
      <div class="p-stalker__circle-item js-circle__item"></div>
      <div class="p-stalker__circle-item js-circle__item"></div>
      <div class="p-stalker__circle-item js-circle__item"></div>
    </div>
    <div class="p-stalker__circle-txtWrap">
      <p class="p-stalker__circle-txt" lang="en">TANE-be World!</p>
    </div>
  </div>

</main>

<?php get_footer(); ?>