<?php

/**
 * WordPressの設定
 */

//acfプラグイン用
require get_theme_file_path() . '/functions/acf.php';

// 管理画面に対するfunctions
require get_theme_file_path() . '/functions/admin.php';

// 投稿関連読み込み
require get_theme_file_path() . '/functions/post.php';

// リダイレクト処理
require get_theme_file_path() . '/functions/redirect.php';

// WordPressの基本的な設定
require get_theme_file_path() . '/functions/setup.php';

// ショートコード読み込み
require get_theme_file_path() . '/functions/shortcode.php';
