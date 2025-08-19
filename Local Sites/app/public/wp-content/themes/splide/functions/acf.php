<?php
/*-------------------------------------------*/
/* 　カスタムフィールドもプレビューで見れるるようにする
/*-------------------------------------------*/
function get_preview_id($postId)
{
  global $post;
  $previewId = 0;
  if (
    isset($_GET['preview'])
    && ($post?->ID == $postId)
    && $_GET['preview'] == true
    &&  ($postId == url_to_postid($_SERVER['REQUEST_URI']))
  ) {
    $preview = wp_get_post_autosave($postId);
    if ($preview != false) {
      $previewId = $preview->ID;
    }
  }
  return $previewId;
}

add_filter('get_post_metadata', function ($meta_value, $post_id, $meta_key, $single) {
  if ($preview_id = get_preview_id($post_id)) {
    if ($post_id != $preview_id) {
      $meta_value = get_post_meta($preview_id, $meta_key, $single);
    }
  }
  return $meta_value;
}, 10, 4);

add_action('wp_insert_post', function ($postId) {
  global $wpdb;
  if (wp_is_post_revision($postId)) {
    if (!empty($_POST['fields'])) {
      if (count($_POST['fields']) != 0) {
        foreach ($_POST['fields'] as $key => $value) {
          $field = get_field($key);
          if (!isset($field['name']) || !isset($field['key'])) continue;
          if (count(get_metadata('post', $postId, $field['name'], $value)) != 0) {
            update_metadata('post', $postId, $field['name'], $value);
            update_metadata('post', $postId, "_" . $field['name'], $field['key']);
          } else {
            add_metadata('post', $postId, $field['name'], $value);
            add_metadata('post', $postId, "_" . $field['name'], $field['key']);
          }
        }
      }
    }
    do_action('save_preview_postmeta', $postId);
  }
});
