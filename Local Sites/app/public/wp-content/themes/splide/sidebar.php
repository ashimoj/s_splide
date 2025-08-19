<?php
$post_type = get_post_type() === "post" ? "category" : get_post_type() . "_type";
$cats = get_terms($post_type);
?>

<div class="l-sidebar">
  <ul class="l-sidebar__list">
    <?php foreach ($cats as $cat) : ?>
      <li class="l-sidebar__item">
        <a href="<?php echo get_category_link($cat->term_id) ?>" class="l-sidebar__link">
          <?php echo $cat->name; ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</div><!-- l-sidebar -->