<?php
// ============================================
// 既存の投稿のラベルを「任意」に
// (案件ごとに変更してください)
// ============================================
function custom_post_labels($labels)
{
  // 変更後の投稿のラベル名（案件ごとに変更してください）
  $post_label_name = 'お知らせ';

  foreach ($labels as $key => $value) {
    if ($value !== null) {
      $labels->$key = str_replace('投稿', $post_label_name, $value);
    }
  }

  return $labels;
}
// ↓↓ 実効する際はコメントアウトを外す ↓↓
// add_filter('post_type_labels_post', 'custom_post_labels');

// ============================================
// デフォルト投稿(post)画面から不要な機能削除
// ============================================
function remove_post_support()
{
  // remove_post_type_support('post', 'title');            // タイトル
  // remove_post_type_support('post','editor');            // 本文
  // remove_post_type_support('post', 'author');              // 作成者
  // remove_post_type_support('post', 'thumbnail');           // アイキャッチ画像
  // remove_post_type_support('post', 'excerpt');           // 抜粋
  remove_post_type_support('post', 'trackbacks');          // トラックバック
  remove_post_type_support('post', 'custom-fields');       // カスタムフィールド
  remove_post_type_support('post', 'tag');                 // タグ
  remove_post_type_support('post', 'comments');            // コメント
  // remove_post_type_support('post','revisions');         // リビジョン
  remove_post_type_support('post', 'page-attributes');     // 表示順
  remove_post_type_support('post', 'post-formats');        // 投稿フォーマット
  // unregister_taxonomy_for_object_type('category', 'post'); // カテゴリ
  // unregister_taxonomy_for_object_type('post_tag', 'post'); // タグ
}
add_action('init', 'remove_post_support');


// ============================================
// 現在のURLを取得する関数
// ============================================
function get_current_url()
{
  return (is_ssl() ? 'https' : 'http') . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
}


// ============================================
// 新着記事判定関数
// ============================================
function is_new_post($days = '7') // 引数 $days は New を表示させたい期間の日数
{
  $today = wp_date('U'); // 現在の日付を取得
  $entry = get_the_time('U'); // 現在の投稿の時刻を取得
  $total = date('U', ($today - $entry)) / 86400; // 秒数指定 86400 は1日

  if ($days > $total) return true;
}


// ============================================
// 親子関係判定関数
// 引数に設定したスラッグの記事が
// 現在のページの親子関係内にあれば{true} なければ {false} を返す。
// ============================================
function page_is_ancestor_of($slug)
{
  global $post;

  $page = get_page_by_path($slug);
  $result = false;

  if (isset($page)) {
    foreach ($post->ancestors as $ancestor) {
      if ($ancestor == $page->ID) {
        $result = true;
      }
    }
    return $result;
  }
}

// ============================================
// 現在のページの投稿タイプを取得
// ============================================
function is_post_type()
{
  $post_type = "";
  // アーカイブページの場合
  if (is_archive()) {
    if (is_tax()) {
      // タクソノミーアーカイブの場合
      $tax = get_query_var('taxonomy');
      $post_type = get_taxonomy($tax)->object_type[0];
    } else {
      $post_type = get_query_var('post_type');
    }
  } elseif (is_single() || is_page()) {
    // 記事ページの場合
    $post_type = get_post_type();
  }
  return $post_type;
}

// ============================================
// bodyのclassにスラッグと最上位の親ページスラッグを追加する
// ============================================
add_filter('body_class', 'add_page_slug_class_name');
function add_page_slug_class_name($classes)
{
  if (is_page()) {
    $page = get_post(get_the_ID());
    $classes[] = $page->post_name;

    $parent_id = $page->post_parent;
    if (0 == $parent_id) {
      $classes[] = get_post($parent_id)->post_name;
    } else {
      $progenitor_id = array_pop(get_ancestors($page->ID, 'page', 'post_type'));
      $classes[] = get_post($progenitor_id)->post_name;
    }
  }
  return $classes;
}

// ============================================
// pre_get_posts の設定
// ============================================
function my_posts_control($query)
{
  if (is_admin() || !$query->is_main_query()) {
    return;
  }

  // if (is_front_page() || is_home()) {
  //   $query->set('posts_per_page', '3');
  //   $query->set('ignore_sticky_posts', true);
  //   return;
  // }
}
add_action('pre_get_posts', 'my_posts_control');
