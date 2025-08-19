<?php
$hero_ja = get_field("hero_ja");
$hero_en = get_field("hero_en");

$post_type = get_post_type();
if (empty($post_type)) $post_type = get_query_var("post_type"); //投稿が一件もない時のエラーハンドリング

if ($post_type === "post") {
  $hero_ja = "ブログ";
  $hero_en = "blog";
} elseif (is_search()) {
  $hero_ja = "検索結果 : " . get_search_query();
  $hero_en = "search";
}
// elseif( $post_type === ""){}
?>

<div class="c-hero">
  <div class="c-inner">
    <?php
    echo !is_singular() ? '<h1 class="c-her0__title">' : '<p class="c-her0__title">';
    echo esc_html($hero_ja);
    echo !is_singular() ? '</h1>' : '</p>';
    ?>
    <p class="c-hero__text" lang="en"><?php echo esc_html($hero_en); ?></p>
  </div>
</div>