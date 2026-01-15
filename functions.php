<?php
/**
 * Nadann Dizy Blog 테마 기능
 *
 * @package Nadann_Dizy_Blog
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * 테마 설정
 */
function nadann_dizy_setup() {
    // 타이틀 태그 지원
    add_theme_support('title-tag');

    // 포스트 썸네일 지원
    add_theme_support('post-thumbnails');

    // HTML5 지원
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // 블록 에디터 스타일
    add_theme_support('editor-styles');
    add_editor_style('style.css');

    // 반응형 임베드
    add_theme_support('responsive-embeds');

    // 메뉴 등록
    register_nav_menus(array(
        'primary' => __('메인 메뉴', 'nadann-dizy-blog'),
    ));
}
add_action('after_setup_theme', 'nadann_dizy_setup');

/**
 * 스타일 및 스크립트 등록
 */
function nadann_dizy_scripts() {
    // 나눔스퀘어라운드 폰트
    wp_enqueue_style(
        'nanum-square-round',
        'https://hangeul.pstatic.net/hangeul_static/css/nanum-square-round.css',
        array(),
        null
    );

    // 메인 스타일시트
    wp_enqueue_style(
        'nadann-dizy-style',
        get_stylesheet_uri(),
        array('nanum-square-round'),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'nadann_dizy_scripts');

/**
 * 위젯 영역 등록
 */
function nadann_dizy_widgets_init() {
    register_sidebar(array(
        'name'          => __('푸터 1 - 검색', 'nadann-dizy-blog'),
        'id'            => 'footer-1',
        'description'   => __('푸터 첫 번째 위젯 영역', 'nadann-dizy-blog'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('푸터 2 - 카테고리', 'nadann-dizy-blog'),
        'id'            => 'footer-2',
        'description'   => __('푸터 두 번째 위젯 영역', 'nadann-dizy-blog'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('푸터 3 - 최신 글', 'nadann-dizy-blog'),
        'id'            => 'footer-3',
        'description'   => __('푸터 세 번째 위젯 영역', 'nadann-dizy-blog'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('푸터 4 - 관리', 'nadann-dizy-blog'),
        'id'            => 'footer-4',
        'description'   => __('푸터 네 번째 위젯 영역', 'nadann-dizy-blog'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'nadann_dizy_widgets_init');

/**
 * 메뉴가 없을 때 기본 메뉴 출력
 */
function nadann_dizy_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">글</a></li>';

    // 소개 페이지가 있으면 표시
    $about_page = get_page_by_path('about');
    if ($about_page) {
        echo '<li><a href="' . esc_url(get_permalink($about_page->ID)) . '">소개</a></li>';
    }

    echo '</ul>';
}

/**
 * 커스터마이저 설정
 */
function nadann_dizy_customize_register($wp_customize) {
    // 인트로 섹션 추가
    $wp_customize->add_section('nadann_intro_section', array(
        'title'    => __('인트로 설정', 'nadann-dizy-blog'),
        'priority' => 30,
    ));

    // 인트로 제목
    $wp_customize->add_setting('nadann_intro_title', array(
        'default'           => '이야기를 담는 공간',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('nadann_intro_title', array(
        'label'    => __('인트로 제목', 'nadann-dizy-blog'),
        'section'  => 'nadann_intro_section',
        'type'     => 'text',
    ));

    // 인트로 설명
    $wp_customize->add_setting('nadann_intro_desc', array(
        'default'           => '생각과 경험을 글로 기록합니다',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('nadann_intro_desc', array(
        'label'    => __('인트로 설명', 'nadann-dizy-blog'),
        'section'  => 'nadann_intro_section',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'nadann_dizy_customize_register');

/**
 * 발췌문 길이 설정
 */
function nadann_dizy_excerpt_length($length) {
    return 40;
}
add_filter('excerpt_length', 'nadann_dizy_excerpt_length');

/**
 * 발췌문 더보기 텍스트 제거
 */
function nadann_dizy_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'nadann_dizy_excerpt_more');

/**
 * body 클래스 추가
 */
function nadann_dizy_body_classes($classes) {
    if (is_singular()) {
        $classes[] = 'singular';
    }
    return $classes;
}
add_filter('body_class', 'nadann_dizy_body_classes');
