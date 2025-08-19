<?php
$previous_post = get_previous_post();
$next_post = get_next_post();
$post_type = get_post_type() === "post" ? "blog" : get_post_type();
$link = esc_url(home_url()) . "/" . esc_html($post_type) . "/";
?>

<div class="c-pager-single">
  <?php if (!empty($previous_post)) : ?>
    <div class="c-pager-single-prev">
      <a class="c-pager-single-prev__link" href="<?php echo get_permalink($previous_post->ID); ?>">
        <span class="visually-hidden">前の投稿へ</span>
      </a>
    </div>
  <?php endif; ?>

  <div class="c-pager-single-home">
    <a href="<?php echo esc_url($link) ?>" class="c-pager-single-home__link">一覧へ戻る</a>
  </div>

  <?php if (!empty($next_post)) : ?>
    <div class="c-pager-single-next">
      <a class="c-pager-single-next__link" href="<?php echo get_permalink($next_post->ID); ?>">
        <span class="visually-hidden">次の投稿へ</span>
      </a>
    </div>
  <?php endif; ?>
</div>