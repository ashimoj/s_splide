<?php
// ===============================
//▼▼▼ 初期設定 ▼▼▼
//通常投稿のスラッグ
$default_post_name = "blog";
// ===============================

$wp_obj = get_queried_object();
?>

<div class="c-breadcrumb">
  <ol class="c-breadcrumb__list" itemscope itemtype="https://schema.org/BreadcrumbList">
    <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
      <a class="c-breadcrumb__link" href="<?php echo esc_url(home_url()) ?>" itemprop="item">
        <span itemprop="name" class="c-breadcrumb__name">TOP</span>
      </a>
      <meta itemprop="position" content="1" />
    </li>

    <?php
    //投稿ページ ( $wp_obj : WP_Post )
    if (is_single()) :
      $post_id    = $wp_obj->ID;
      $post_type  = $wp_obj->post_type;
      $post_title = apply_filters('the_title', $wp_obj->post_title);

      $post_type_link = $post_type !== "post" ? esc_url(home_url($post_type . "/")) : esc_url(home_url($default_post_name . "/"));
      $post_type_label = esc_html(get_post_type_object($post_type)->label);
    ?>

      <?php /* 所属の投稿一覧ページのパンクズ */ ?>
      <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a class="c-breadcrumb__link" href="<?php echo $post_type_link; ?>" itemprop="item">
          <span itemprop="name" class="c-breadcrumb__name"><?php echo $post_type_label; ?></span>
        </a>
        <meta itemprop="position" content="2" />
      </li>

      <?php /* 自身の投稿ページのパンクズ */ ?>
      <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span itemprop="name" class="c-breadcrumb__name"><?php echo esc_html(strip_tags($post_title)); ?></span>
        <meta itemprop="position" content="3" />
      </li>

      <?php
    //固定ページ ( $wp_obj : WP_Post )
    elseif (is_page()) :
      $page_id    = $wp_obj->ID;
      $page_title = apply_filters('the_title', $wp_obj->post_title);
      $bread_counter = 2;

      // もしも親ページがあれば順番に表示
      if ($wp_obj->post_parent !== 0) :
        $parent_array = array_reverse(get_post_ancestors($page_id));
        foreach ($parent_array as $parent_id) :
          $parent_link = esc_url(get_permalink($parent_id));
          $parent_name = esc_html(get_the_title($parent_id));
      ?>
          <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a class="c-breadcrumb__link" href="<?php echo $parent_link; ?>" itemprop="item">
              <span itemprop="name" class="c-breadcrumb__name"><?php echo $parent_name; ?></span>
            </a>
            <meta itemprop="position" content="<?php echo $bread_counter; ?>" />
          </li>
          <?php $bread_counter++; ?>
        <?php endforeach; ?>
      <?php endif; ?>

      <?php /* 自身の固定ページのパンクズ */ ?>
      <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span itemprop="name" class="c-breadcrumb__name"><?php echo esc_html(strip_tags($page_title)); ?></span>
        <meta itemprop="position" content="<?php echo $bread_counter; ?>" />
      </li>

    <?php
    // カスタム投稿タイプアーカイブページ ( $wp_obj : WP_Post_Type )
    elseif (is_post_type_archive()) :
      $post_type = get_post_type();
      if (empty($post_type)) {
        $post_type = get_queried_object()->name;
      }

      $post_type_label = get_post_type_object($post_type)->label;
      $post_archive_url = $post_type === "post" ? esc_url(home_url($post_type . "/")) : esc_url(home_url($post_type . "/"));
    ?>
      <?php
      // カスタム投稿の日付アーカイブの場合
      $year  = get_query_var('year');
      $month = get_query_var('monthnum');

      if ($year && $month):
      ?>
        <?php /* 日付アーカイブのパンクズ */ ?>
        <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
          <a class="c-breadcrumb__link" href="<?php echo $post_archive_url; ?>" itemprop="item">
            <span itemprop="name" class="c-breadcrumb__name"><?php echo esc_html($post_type_label); ?></span>
          </a>
          <meta itemprop="position" content="2" />
        </li>
        <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
          <span itemprop="name" class="c-breadcrumb__name"><?php echo esc_html($year . '年' . $month . '月'); ?></span>
          <meta itemprop="position" content="3" />
        </li>
      <?php else : ?>
        <?php /* カスタム投稿一覧のパンクズ */ ?>
        <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
          <span itemprop="name" class="c-breadcrumb__name"><?php echo esc_html($post_type_label); ?></span>
          <meta itemprop="position" content="2" />
        </li>
      <?php endif; ?>

    <?php
    // 日付アーカイブ ( $wp_obj : null )
    elseif (is_date()) :
      $year  = get_query_var('year');
      $month = get_query_var('monthnum');
      $day   = get_query_var('day');
    ?>

      <?php if ($day !== 0) : ?>
        <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
          <a class="c-breadcrumb__link" href="<?php echo esc_url(get_year_link($year)); ?>" itemprop="item">
            <span itemprop="name" class="c-breadcrumb__name"><?php echo esc_html($year) . '年'; ?></span>
          </a>
          <meta itemprop="position" content="2" />
        </li>
        <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
          <a class="c-breadcrumb__link" href="<?php echo esc_url(get_year_link($month)); ?>" itemprop="item">
            <span itemprop="name" class="c-breadcrumb__name"><?php echo esc_html($month) . '月'; ?></span>
          </a>
          <meta itemprop="position" content="3" />
        </li>
        <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
          <span itemprop="name" class="c-breadcrumb__name"><?php echo esc_html($day) . '日'; ?></span>
          <meta itemprop="position" content="4" />
        </li>
      <?php elseif ($month !== 0) : ?>
        <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
          <a class="c-breadcrumb__link" href="<?php echo esc_url(get_year_link($year)); ?>" itemprop="item">
            <span itemprop="name" class="c-breadcrumb__name"><?php echo esc_html($year) . '年'; ?></span>
          </a>
          <meta itemprop="position" content="2" />
        </li>
        <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
          <span itemprop="name" class="c-breadcrumb__name"><?php echo esc_html($month) . '月'; ?></span>
          <meta itemprop="position" content="3" />
        </li>
      <?php else :  ?>
        <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
          <span itemprop="name" class="c-breadcrumb__name"><?php echo esc_html($year) . '年'; ?></span>
          <meta itemprop="position" content="2" />
        </li>
      <?php endif; ?>

      <?php
    // 投稿アーカイブページ
    elseif (is_archive() || is_home()) :

      $post_type = get_post_type();

      // タクソノミーアーカイブの場合は記事がない場合投稿タイプを取得できないので別の手法で取得
      if (is_category() || is_tax()) {
        $taxonomy = get_query_var('taxonomy') ? get_query_var('taxonomy') : 'category';
        $post_type = get_taxonomy($taxonomy)->object_type[0];
      }

      $post_type_label = get_post_type_object($post_type)->label;
      $post_archive_url = $post_type === 'post' ? esc_url(home_url($default_post_name . "/")) : esc_url(home_url($post_type . "/"));

      // カテゴリなどのページ
      if (is_category() || is_tag() || is_tax()) :
      ?>
        <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
          <a class="c-breadcrumb__link" href="<?php echo $post_archive_url; ?>" itemprop="item">
            <span itemprop="name" class="c-breadcrumb__name"><?php echo esc_html($post_type_label); ?></span>
          </a>
          <meta itemprop="position" content="2" />
        </li>

        <?php
        /**
         * タームアーカイブ ( $wp_obj : WP_Term )
         */
        $term_id   = $wp_obj->term_id;
        $term_name = $wp_obj->name;
        $tax_name  = $wp_obj->taxonomy;
        $bread_counter = 3;

        if ($wp_obj->parent !== 0) :

          $parent_array = array_reverse(get_ancestors($term_id, $tax_name));
          foreach ($parent_array as $parent_id) :
            $parent_term = get_term($parent_id, $tax_name);
            $parent_link = esc_url(get_term_link($parent_id, $tax_name));
            $parent_name = esc_html($parent_term->name);
        ?>
            <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
              <a class="c-breadcrumb__link" href="<?php echo $parent_link; ?>" itemprop="item">
                <span itemprop="name" class="c-breadcrumb__name"><?php echo $parent_name; ?></span>
              </a>
              <meta itemprop="position" content="<?php echo $bread_counter; ?>" />
            </li>
            <?php $bread_counter++; ?>
          <?php endforeach; ?>
        <?php endif; ?>

        <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
          <span itemprop="name" class="c-breadcrumb__name"><?php echo esc_html($term_name); ?></span>
          <meta itemprop="position" content="<?php echo $bread_counter; ?>" />
        </li>

      <?php else : ?>
        <?php /* 投稿一覧ページの時 */ ?>
        <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
          <span itemprop="name" class="c-breadcrumb__name"><?php echo esc_html($post_type_label); ?></span>
          <meta itemprop="position" content="2" />
        </li>
      <?php endif; ?>

    <?php
    // 検索結果ページ
    elseif (is_search()) :
    ?>
      <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span itemprop="name" class="c-breadcrumb__name"><?php echo '『' . esc_html(get_search_query()) . '』の検索結果'  ?></span>
        <meta itemprop="position" content="2" />
      </li>

    <?php
    // 404ページ
    elseif (is_404()) :
    ?>
      <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span itemprop="name" class="c-breadcrumb__name"><?php echo 'お探しの記事は見つかりませんでした。'  ?></span>
        <meta itemprop="position" content="2" />
      </li>

    <?php else : ?>
      <?php /* 念の為のフォールバック */ ?>
      <li class="c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span itemprop="name" class="c-breadcrumb__name"><?php echo esc_html(get_the_title()); ?></span>
        <meta itemprop="position" content="2" />
      </li>
    <?php endif; ?>
  </ol>
</div>