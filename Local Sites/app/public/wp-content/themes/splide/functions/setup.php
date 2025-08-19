<?php

/**
 * wp_head 不要タグの削除
 */
remove_action('wp_head', 'wp_generator'); // WordPressのバージョン
remove_action('wp_head', 'wp_shortlink_wp_head'); // 短縮URLのlink
remove_action('wp_head', 'wlwmanifest_link'); // ブログエディターのマニフェストファイル
remove_action('wp_head', 'rsd_link'); // 外部から編集するためのAPI
remove_action('wp_head', 'feed_links', 2); //サイト全体のfeed
remove_action('wp_head', 'feed_links_extra', 3); // フィードへのリンク
remove_action('wp_head', 'print_emoji_detection_script', 7); // 絵文字に関するJavaScript
remove_action('wp_head', 'rel_canonical'); // カノニカル
remove_action('wp_head', 'adjacent_posts_rc-link_wp_head', 10, 0); //前後の記事 Link
remove_action('wp_head', 'rest_outpu-link_wp_head'); //Embed Link
remove_action('wp_head', 'wp_oembed_add_discovery_links'); //Embed Link
remove_action('wp_head', 'wp_oembed_add_host_js'); //Embed JS
// 絵文字機能削除
function disable_emoji()
{
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script'); // 絵文字に関するJavaScript
  remove_action('wp_print_styles', 'print_emoji_styles'); // 絵文字に関するCSS
  remove_action('admin_print_styles', 'print_emoji_styles'); // 絵文字に関するCSS
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'disable_emoji');

//dns-prefetch
function remove_dns_prefetch($hints, $relation_type)
{
  if ('dns-prefetch' === $relation_type) {
    return array_diff(wp_dependencies_unique_hosts(), $hints);
  }
  return $hints;
}
add_filter('wp_resource_hints', 'remove_dns_prefetch', 10, 2);


/**
 * 基本設定 -- after_setup_theme --
 */
function mytheme_setup()
{
  // HTML5対応
  add_theme_support('html', array('style', 'script'));

  // ページタイトル出力
  add_theme_support('title-tag');

  //アイキャッチ機能の追加
  add_theme_support('post-thumbnails');

  //固定ページの抜粋有効化 meta-descriptionのため
  add_post_type_support('page', 'excerpt');

  //Default block styles を有効に (※区切り線などのオプショナルなスタイルをフロントにも反映させるため)
  add_theme_support('wp-block-styles');

  // 「幅広」と「全幅」に対応
  add_theme_support('align-wide');

  // 埋め込みコンテンツのレスポンシブ化
  add_theme_support('responsive-embeds');

  // リビジョン有効か
  add_post_type_support('page', 'revisions');
  add_post_type_support('column', 'revisions');
}
add_action('after_setup_theme', 'mytheme_setup');

// ============================================
// メディアのサイズ自動生成を制御
// ============================================
// function not_create_media_image_sizes($sizes)
// {
//   // unset($sizes['thumbnail']);
//   // unset($sizes['medium']);
//   unset($sizes['medium_large']);
//   // unset($sizes['large']);
//   unset($sizes['1536x1536']);
//   unset($sizes['2048x2048']);
//   return $sizes;
// }
// add_filter('intermediate_image_sizes_advanced', 'not_create_media_image_sizes');

/* wp_titleの$sepが空文字または半角スペースの場合は余分な空白削除
/* http://yumeneko.pmfan.jp/wordpress/wp-technique/trap-wp_title-function.html
------------------------------------------------------------ */
function my_title_fix($title, $sep, $seplocation)
{
  if (!$sep || $sep == " ") {
    $title = str_replace(' ' . $sep . ' ', $sep, $title);
  }
  return $title;
}
add_filter('wp_title', 'my_title_fix', 10, 3);

/* カスタム分類のラベルをwp_titleから削除
/* 例）<title><?php wp_title(''); ?>｜<?php bloginfo('name'); ?></title>
/* https://monoxa.net/2015/10/how-to-hide-a-custom-category-name-to-wp-title/
------------------------------------------------------------ */
function remove_tax_name($title, $sep, $seplocation)
{
  if (is_tax()) {
    $term_title = single_term_title('', false);
    if ('right' == $seplocation) {
      $title = $term_title . " $sep ";
    } else {
      $title = " $sep " . $term_title;
    }
  }
  return $title;
}
add_filter('wp_title', 'remove_tax_name', 10, 3);

/* メディアファイルページをインデックスさせない
------------------------------------------------------------ */
function my_add_noindex_attachment()
{
  if (is_attachment()) {
    echo '<meta name="robots" content="noindex,follow">';
  }
}
add_action('wp_head', 'my_add_noindex_attachment');

/* メディアファイルページを404へリダイレクト
------------------------------------------------------------ */
function attachment404()
{
  // attachmentページだった場合
  if (is_attachment()) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
  }
}
add_action('template_redirect', 'attachment404');

// 管理画面にstyleファイル読み込み
// ============================================
$editor_style_path = get_stylesheet_directory_uri() . "/css/editor-style.css?" . date('YmdGis');
add_editor_style($editor_style_path);

/* =====================================================
追加関数
======================================================== */

/* 親ページと子ページをスラッグで判定
/* http://qiita.com/thanks2music@github/items/5ee9151592d35eef3bd1
------------------------------------------------------------ */
function is_parent_slug()
{
  global $post;
  if ($post->post_parent) {
    $post_data = get_post($post->post_parent);
    return $post_data->post_name;
  }
}

/* 非公開や下書きの固定ページを親ページに設定できるようにする
/* http://kachibito.net/wp-code/add-private-draft
------------------------------------------------------------ */
add_filter('page_attributes_dropdown_pages_args', 'add_private_draft');
function add_private_draft($args)
{
  $args['post_status'] = 'publish,private,draft';
  return $args;
}

/* 固定ページの親を全て取得して配列にする
/* https://securavita.net/wordpress-get-page-parent/
------------------------------------------------------------ */
function get_page_parent($parent_id, $object = true, $root = true)
{
  //parent_idが0の場合何もしない
  if ($parent_id == false) {
    return false;
  }
  if ($object == true) { //返り値がpostオブジェクト
    while ($parent_id) {
      $page = get_post($parent_id);
      $result[] = $page;
      $parent_id = $page->post_parent;
    }
  } else { //返り値がpostID
    while ($parent_id) {
      $page_id = get_post_field('post_parent', $parent_id);
      $result[] = $parent_id;
      $parent_id = $page_id;
    }
  }
  //配列を逆順に(rootを0に)
  $result = array_reverse($result);
  //rootがtureの場合0番目(rootページのみ)をセット
  if ($root == true) {
    $result = $result[0];
  }
  return $result;
}

//投稿のみ検索表示
function SearchFilter( $query ) {
	if ( $query -> is_search ) {
		$query -> set( 'post_type', 'post' );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'SearchFilter' );
