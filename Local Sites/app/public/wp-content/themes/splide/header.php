<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head prefix="og: https://ogp.me/ns#">
  <meta charset="<?php bloginfo('charset'); ?>">
  <!-- ▼▼▼ Google Analytics start ▼▼▼ -->

  <!-- ▲▲▲ Google Analytics end ▲▲▲ -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preload" as="style" fetchpriority="high" href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" media="print" onload='this.media="all"' />

  <!-- リンク -->
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css?<?php echo filemtime(get_theme_file_path('/css/style.css')); ?>" rel="stylesheet">
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/editor-style.css?<?php echo filemtime(get_theme_file_path('/css/editor-style.css')); ?>" rel="stylesheet">
  <!-- <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8" defer></script> -->
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bundle.js?<?php echo filemtime(get_theme_file_path('/js/bundle.js')); ?>" defer></script>

  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
  <!-- ▼▼▼ Google Analytics start ▼▼▼ -->

  <!-- ▲▲▲ Google Analytics end ▲▲▲ -->
  <?php wp_body_open(); ?>
  <header id="header" class="l-header js-header">
    <div class="l-header__inner">
      <a href="#main" class="l-header__skip-content visually-hidden">本文にスキップ</a>

      <!-- ロゴ -->
      <?php echo is_front_page() ? '<h1 class="l-header__logo">' : '<p class="l-header__logo">'; ?>
      <span class="visually-hidden"><?php bloginfo('name'); ?></span>
      <a href="<?php echo esc_url(home_url()) ?>" class="l-header__logo-link">
        TANE-be
      </a>
      <?php echo is_front_page() ? "</h1>" : "</p>"; ?>

      <!-- PCナビゲーション -->
      <?php /*
      <div class="l-navigation">
        <ul class="l-navigation__list">
          <li class="l-navigation__item">
            <a href="<?php echo esc_url(home_url()) ?>" class="l-navigation__link" lang="en">
              HOME
            </a>
          </li>
          <li class="l-navigation__item">
            <a href="<?php echo esc_url(home_url()) ?>/blog/" class="l-navigation__link" lang="en">
              BLOG
            </a>
          </li>
        </ul>
      </div>
      */ ?>

      <!-- ハンバーガー -->
      <button role="button" class="c-hamburger js-drawer-hamburger" aria-expanded="false" aria-controls="navigation" aria-label="メニューを開く">
        <span class="-bar"></span>
        <span class="-bar"></span>
        <span class="-bar"></span>
        <p class="c-hamburger__txt js-drawer-hamburger__txt" lang="en">menu</p>
      </button>

      <!-- SPドロワーメニュー -->
      <div id="navigation" class="l-drawer js-drawer-navigation" aria-hidden="true">
        <div class="l-drawer__overlay" tabindex="-1" data-micromodal-close>
          <div class="l-drawer__content" role="dialog" aria-modal="true" aria-labelledby="navigation-title">
            <div class="l-drawer__header">
              <h2 class="l-drawer__title visually-hidden" id="navigation-title">サイト内メニュー</h2>
              <button type="button" id="navigationCloseBtn" class="c-hamburger  visually-hidden" aria-labelledby="navigationCloseTitle" data-micromodal-close>
                <span id="navigationCloseTitle" class=" visually-hidden">モーダルを閉じる</span>
              </button>
            </div>

            <nav class="l-drawer__nav">
              <ul class="l-drawer__list">
                <li class="l-drawer__item">
                  <a href="<?php echo esc_url(home_url()) ?>" class="l-drawer__link" lang="en">HOME</a>
                </li>
                <li class="l-drawer__item">
                  <a href="<?php echo esc_url(home_url()) ?>/blog/" class="l-drawer__link" lang="en">BLOG</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>

    </div><!-- l-header__inner -->
  </header>