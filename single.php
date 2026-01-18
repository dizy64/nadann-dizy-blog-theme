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

        <?php comments_template(); ?>

        <nav class="post-navigation">
          <?php
          $prev_post = get_previous_post();
          $next_post = get_next_post();
          ?>
          <div class="nav-previous">
            <?php if ($prev_post) : ?>
              <span class="nav-label">&larr; 이전 글</span>
              <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="nav-title">
                <?php echo esc_html($prev_post->post_title); ?>
              </a>
            <?php endif; ?>
          </div>
          <div class="nav-next">
            <?php if ($next_post) : ?>
              <span class="nav-label">다음 글 &rarr;</span>
              <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="nav-title">
                <?php echo esc_html($next_post->post_title); ?>
              </a>
            <?php endif; ?>
          </div>
        </nav>
      </article>

    <?php endwhile; endif; ?>

<?php get_footer(); ?>
