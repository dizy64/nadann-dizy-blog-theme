<?php get_header(); ?>

    <section class="intro">
      <h1 class="intro-title"><?php echo esc_html(get_theme_mod('nadann_intro_title', '이야기를 담는 공간')); ?></h1>
      <p class="intro-desc"><?php echo esc_html(get_theme_mod('nadann_intro_desc', '생각과 경험을 글로 기록합니다')); ?></p>
    </section>

    <section class="article-list">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <!-- 아티클 -->
          <article id="post-<?php the_ID(); ?>" <?php post_class('article-item'); ?>>
            <a href="<?php the_permalink(); ?>" class="article-link">
              <span class="article-date"><?php echo get_the_date('Y년 n월 j일'); ?></span>
              <h2 class="article-title"><?php the_title(); ?></h2>
              <p class="article-excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 60, '...'); ?>
              </p>
            </a>
          </article>
        <?php endwhile; ?>
      <?php else : ?>
        <article class="article-item">
          <p class="article-excerpt">아직 작성된 글이 없습니다.</p>
        </article>
      <?php endif; ?>
    </section>

    <?php
    // 페이지네이션
    the_posts_pagination(array(
      'mid_size'  => 2,
      'prev_text' => '&larr; 이전',
      'next_text' => '다음 &rarr;',
      'class'     => 'pagination',
    ));
    ?>

<?php get_footer(); ?>
