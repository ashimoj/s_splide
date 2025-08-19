<?php
$post_type = get_post_type() === "post" ? "category" : get_post_type() . "_type";
$cats = get_the_terms(get_the_ID(), $post_type);
$tags = get_the_terms(get_the_ID(), "post_tag");

$thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large');
// if (empty($thumbnail)) {
//   $thumbnail = get_stylesheet_directory_uri() . "/img/common/thumbnail.png";
// }
?>

<?php get_header(); ?>

<main id="main" class="l-main">
  <?php
  //MV
  get_template_part('inc/hero');

  //パンクズリスト
  get_template_part('inc/breadcrumb');
  ?>

  <div class="p-single">
    <div class="c-inner">
      <h1 class="p-single__title u-mb-16"><?php the_title(); ?></h1>

      <div class="p-single__meta u-mb-24">
        <time class="p-single__time" datetime="<?php the_time("Y-m-d"); ?>"><?php the_time("Y.m.d"); ?></time>
        <?php if (!empty($cats)) : ?>
          <ul class="p-single__cats c-cats">
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
        <ul class="c-archive01__item-cats c-tags u-mb-24">
          <?php foreach ($tags as $tag) : ?>
            <li class="c-tags__item">
              <a href="<?php echo get_category_link($tag->term_id) ?>" class="c-tags__link">
                #<?php echo esc_html($tag->name); ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>

      <?php if (!empty($thumbnail)) : ?>
        <figure class="p-single__img u-mb-24">
          <img src='<?php echo esc_url($thumbnail); ?>' alt='' decoding='async'>
        </figure>
      <?php endif; ?>

      <div class="c-single__content">
        <?php
        remove_filter('the_content', 'wpautop');
        the_content();
        ?>
      </div>

      <?php get_template_part("inc/c-pager02") ?>

      <?php // 関連記事
      ?>
      <div class="u-mt-60 u-mb-60">
        <?php get_template_part("inc/relatedArticles") ?>
      </div>

    </div>
  </div>

</main>

<?php get_footer() ?>