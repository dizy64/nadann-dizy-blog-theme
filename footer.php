  </main>

  <!-- 푸터 -->
  <footer class="footer">
    <div class="footer-widgets">
      <?php if (is_active_sidebar('footer-1')) : ?>
        <div class="footer-widget">
          <?php dynamic_sidebar('footer-1'); ?>
        </div>
      <?php else : ?>
        <div class="footer-widget">
          <h3>검색</h3>
          <?php get_search_form(); ?>
        </div>
      <?php endif; ?>

      <?php if (is_active_sidebar('footer-2')) : ?>
        <div class="footer-widget">
          <?php dynamic_sidebar('footer-2'); ?>
        </div>
      <?php else : ?>
        <div class="footer-widget">
          <h3>카테고리</h3>
          <ul>
            <?php wp_list_categories(array(
              'title_li' => '',
              'show_count' => true,
            )); ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if (is_active_sidebar('footer-3')) : ?>
        <div class="footer-widget">
          <?php dynamic_sidebar('footer-3'); ?>
        </div>
      <?php else : ?>
        <div class="footer-widget">
          <h3>최신 글</h3>
          <ul>
            <?php
            $recent_posts = wp_get_recent_posts(array(
              'numberposts' => 5,
              'post_status' => 'publish',
            ));
            foreach ($recent_posts as $post) :
            ?>
              <li><a href="<?php echo get_permalink($post['ID']); ?>"><?php echo esc_html($post['post_title']); ?></a></li>
            <?php endforeach; wp_reset_query(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if (is_active_sidebar('footer-4')) : ?>
        <div class="footer-widget">
          <?php dynamic_sidebar('footer-4'); ?>
        </div>
      <?php else : ?>
        <div class="footer-widget">
          <h3>관리</h3>
          <ul>
            <?php wp_register(); ?>
            <li><?php wp_loginout(); ?></li>
            <li><a href="<?php bloginfo('rss2_url'); ?>">글 RSS</a></li>
            <li><a href="<?php bloginfo('comments_rss2_url'); ?>">댓글 RSS</a></li>
            <li><a href="https://wordpress.org/">WordPress.org</a></li>
          </ul>
        </div>
      <?php endif; ?>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>
