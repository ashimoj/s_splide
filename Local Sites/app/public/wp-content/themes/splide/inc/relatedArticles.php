<?php

// 【通常投稿】カテゴリー取得
$cats = get_the_terms(get_the_ID(), "category") ?? [];
$cats_slug_array = [];

if (!empty($cats)) {
  foreach ($cats as $cat) {
    array_push($cats_slug_array, $cat->slug);
  }
}

$args = array(
  'post_type' => 'post',
  'posts_per_page' => '3',
  'post__not_in' => array(get_the_ID()),
  'tax_query' => array(
    'relation' => 'OR',
    array(
      'taxonomy' => "category",
      'field' => 'slug',
      'terms' => $cats_slug_array,
    )
  ),
);

$the_query = new WP_Query($args);
?>

<div class="c-relation01 u-under-mt-60 u-upper-mt-120">
  <p class="c-relation01__ttl">関連記事一覧</p>
  <div class="c-relation01__contents">

    <!-- 取得した記事をwhile文で一つずつ取り出す -->
    <div class="c-archive01">
      <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
        <?php get_template_part('inc/c-archive01__item'); ?>
      <?php endwhile; ?>
    </div>

  </div>
</div>