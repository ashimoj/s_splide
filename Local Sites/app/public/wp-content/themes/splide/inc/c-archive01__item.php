<?php
$post_type = get_post_type() === "post" ? "category" : get_post_type() . "_type";
$cats = get_the_terms(get_the_ID(), $post_type);
$tags = get_the_terms(get_the_ID(), "post_tag");

$thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large');
// if (empty($thumbnail)) {
//   $thumbnail = get_stylesheet_directory_uri() . "/img/common/thumbnail.png";
// }
?>

<article class="c-archive01__item">
  <a href="<?php the_permalink(); ?>" class="c-archive01__item-link" aria-label="<?php the_title(); ?>"></a>
  <div class="c-archive01__item-body">
    <h3 class="c-archive01__item-title"><?php the_title(); ?></h3>

    <div class="c-archive01__item-meta">
      <time class="c-archive01__item-time" datetime="<?php the_time("Y-m-d"); ?>"><?php the_time("Y.m.d"); ?></time>
      <?php if (!empty($cats)) : ?>
        <ul class="c-archive01__item-cats c-cats">
          <?php foreach ($cats as $cat) : ?>
            <li class="c-cats__item">
              <a href="<?php echo get_category_link($cat->term_id) ?>" class="c-cats__link">
                <?php echo esc_html($cat->name); ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>

    <?php if (!empty($tags)) : ?>
      <ul class="c-archive01__item-cats c-tags">
        <?php foreach ($tags as $tag) : ?>
          <li class="c-tags__item">
            <a href="<?php echo get_category_link($tag->term_id) ?>" class="c-tags__link">
              #<?php echo esc_html($tag->name); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>

  <?php if (!empty($thumbnail)) : ?>
    <figure class="c-archive01__item-img">
      <img src='<?php echo esc_url($thumbnail); ?>' alt='' decoding='async'>
    </figure>
  <?php endif; ?>
</article>