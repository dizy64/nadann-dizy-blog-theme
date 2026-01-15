<?php get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>
        <header class="article-header">
          <span class="article-date"><?php echo get_the_date('Y년 n월 j일'); ?></span>
          <h1 class="single-title"><?php the_title(); ?></h1>
        </header>

        <div class="article-body">
          <?php the_content(); ?>
        </div>

        <footer class="article-footer">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="back-link">&larr; 목록으로 돌아가기</a>
        </footer>
      </article>
    <?php endwhile; endif; ?>

<?php get_footer(); ?>
