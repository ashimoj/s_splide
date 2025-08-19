<?php
//初期値
$pages = '';
$range = 1;

// ページネーション
$showitems = ($range * 2) + 1; //表示するページ数

global $paged; //現在のページ値
if (empty($paged)) $paged = 1; //デフォルトのページ指定

if ($pages == '') {
  global $wp_query;
  $pages = $wp_query->max_num_pages; //全ページ数を取得
  if (!$pages) {
    $pages = 1; //全ページ数が空の場合は、１とする
  }
}

//全ページが１でない場合はページネーションを表示する
if ($pages != 1) {
  echo '<div class="c-pager-archive">';
  echo '<ul class="c-pager-archive__inner">';

  // 前のページがあれば
  if ($paged != 1) {
    echo '<li class="c-pager-archive__prev"><a href="' . esc_url(get_pagenum_link($paged - 1)) . '" class="c-pager-archive__prev-link"></a></li>';
  }

  echo '<li class="c-pager-archive__number">';
  echo '<ul class="c-pager-archive__number-child">';
  for ($i = 1; $i <= $pages; $i++) { //ページの数繰り返す
    if (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems) {
      if ($paged == $i) {
        echo '<li class="c-pager-archive__number-child-item"><span class="c-pager-archive__number-child-link -current">' . $i . '</span></li>';
      } else {
        echo '<li class="c-pager-archive__number-child-item"><a class="c-pager-archive__number-child-link" href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a></li>';
      }
    }
  }
  echo '</ul>';
  echo '</li>';

  // 次のページがあれば
  if ($paged < $pages) {
    echo '<li class="c-pager-archive__next"><a href="' . esc_url(get_pagenum_link($paged + 1)) . '" class="c-pager-archive__next-link"></a></li>';
  }

  echo '</ul>';
  echo '</div>';
}
