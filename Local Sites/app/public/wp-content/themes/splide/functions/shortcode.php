<?php
/* srcset属性を無効化
/* http://increment-log.com/wordpress-disabling-responsive-images/
------------------------------------------------------------ */
add_filter('wp_calculate_image_srcset', '__return_false');

/* srcset属性内でショートコードを使用する
/* https://monkas.hateblo.jp/entry/2019/08/02/103938
------------------------------------------------------------ */
function my_wp_kses_allowed_html($tags, $context)
{
  $tags['source']['srcset'] = true;
  return $tags;
}
add_filter('wp_kses_allowed_html', 'my_wp_kses_allowed_html', 10, 2);
