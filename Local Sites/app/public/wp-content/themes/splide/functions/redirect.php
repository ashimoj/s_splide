<?php

/**
 * author 情報を非表示に
 */
function disable_author_archive_query()
{
  if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) {
    wp_safe_redirect(home_url());
    exit;
  }
}
add_action('init', 'disable_author_archive_query');

/* author サイトマップに非表示 */
add_filter('wp_sitemaps_add_provider', function ($provider, $name) {
  return 'users' === $name ? false : $provider;
}, 10, 2);

/* REST API 非表示 */
function hide_rest_api($endpoints)
{
  if (isset($endpoints['/wp/v2/users'])) {
    unset($endpoints['/wp/v2/users']);
  }
  if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
    unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
  }
  if (isset($endpoints['/wp/v2/users/me'])) {
    unset($endpoints['/wp/v2/users/me']);
  }
  if (isset($endpoints['/wp/v2/comments'])) {
    unset($endpoints['/wp/v2/comments']);
  }
  if (isset($endpoints['/wp/v2/comments/(?P<id>[\d]+)'])) {
    unset($endpoints['/wp/v2/comments/(?P<id>[\d]+)']);
  }
  if (isset($endpoints['/wp/v2/settings'])) {
    unset($endpoints['/wp/v2/settings']);
  }

  return $endpoints;
}
add_filter('rest_endpoints', 'hide_rest_api');

/* oembed REST API */
function deny_restapi_except_plugins($result, $wp_rest_server, $request)
{
  $namespaces = $request->get_route();
  if (strpos($namespaces, 'oembed/') === 1) {
    return new WP_Error('rest_disabled', __('The REST API on this site has been disabled.'), array('status' => rest_authorization_required_code()));
  }
  return $result;
}
add_filter('rest_pre_dispatch', 'deny_restapi_except_plugins', 10, 3);

/**
 * 独自のリダイレクト処理が必要であればこのファイルに追記してください。
 */

// function my_redirect()
// {
//   // sample
//   if (is_singular('hoge')) {
//     $url = home_url('/hoge/');
//     wp_safe_redirect($url, 301);
//     exit();
//   }
// }
// add_action('template_redirect', 'my_redirect');
