<?php

//管理画面上部ツールバーに更新アイコンを非表示
function hide_adminbar_update_icon()
{
  if (!current_user_can('administrator')) { //管理者以外は非表示にする
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('updates');
  }
}
add_action('wp_before_admin_bar_render', 'hide_adminbar_update_icon');

// 固定ページ・MW WP Form編集時にビジュアルエディタを非表示に
function disable_visual_editor_in_page()
{
  global $typenow;
  if ($typenow == 'page') {
    add_filter('user_can_richedit', 'disable_visual_editor_filter');
  }
  if (in_array($typenow, array('page', 'mw-wp-form'))) {
    add_filter('user_can_richedit', 'disable_visual_editor_filter');
  }
}
function disable_visual_editor_filter()
{
  return false;
}
add_action('load-post.php', 'disable_visual_editor_in_page');
add_action('load-post-new.php', 'disable_visual_editor_in_page');

// ダッシュボードにあるメニューを非表示
function update_remove_menus()
{
  if (!current_user_can('administrator')) { //管理者以外は非表示にする
    remove_submenu_page('index.php', 'update-core.php'); //ダッシュボード/更新
    remove_menu_page('profile.php'); //プロフィール欄
    remove_menu_page('tools.php'); //ツール欄
  }
  remove_menu_page('edit-comments.php'); //コメント欄削除
  remove_submenu_page('plugins.php', 'plugin-editor.php'); //プラグインエディター
  remove_submenu_page('themes.php', 'theme-editor.php'); //テーマエディター
}
add_action('admin_menu', 'update_remove_menus', 999);

// WordPress本体の更新通知を非表示
function hide_update_notices()
{
  if (!current_user_can('administrator')) { //管理者以外は非表示にする
    remove_action('admin_notices', 'update_nag', 3);
  }
}
add_action('admin_init', 'hide_update_notices');

//自動更新を無効にする
// add_filter('automatic_updater_disabled', '__return_true');

// ============================================
// 管理画面記事一覧にて項目表示
// ============================================
function add_posts_columns($columns)
{
  // 項目を削除
  unset($columns['comments']); // コメント削除
  $new_columns = array();
  foreach ($columns as $column_name => $column_display_name) {
    if ($column_name == 'author') {
      $new_columns['page_slug'] = "スラッグ";
    }
    $new_columns[$column_name] = $column_display_name;
  }
  return $new_columns;
}

function custom_posts_column($column_name, $post_id)
{
  // ページのスラッグを表示
  if ($column_name === "page_slug") {
    $p_slug = get_post($post_id)->post_name;
    echo $p_slug;
  }
}
add_filter('manage_pages_columns', 'add_posts_columns');
add_action('manage_pages_custom_column', 'custom_posts_column', 10, 2);
