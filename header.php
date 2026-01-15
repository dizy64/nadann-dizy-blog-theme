<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- 헤더 -->
  <header class="header">
    <div class="header-inner">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
        <?php bloginfo('name'); ?>
      </a>
      <nav class="nav">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'primary',
          'menu_class'     => 'nav-menu',
          'container'      => false,
          'fallback_cb'    => 'nadann_dizy_fallback_menu',
        ));
        ?>
      </nav>
    </div>
  </header>

  <!-- 메인 콘텐츠 -->
  <main class="main">
