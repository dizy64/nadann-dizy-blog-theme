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

  <!-- 이미지 라이트박스 -->
  <div class="lightbox-overlay" id="lightbox">
    <img src="" alt="">
  </div>
  <script>
  (function() {
    var lightbox = document.getElementById('lightbox');
    var lightboxImg = lightbox.querySelector('img');

    function getFullImageUrl(img) {
      // 부모가 링크면 링크의 href 사용 (원본 이미지)
      var parent = img.parentElement;
      if (parent && parent.tagName === 'A' && parent.href) {
        return parent.href;
      }
      // data-full-url 또는 data-src 확인
      if (img.dataset.fullUrl) return img.dataset.fullUrl;
      if (img.dataset.src) return img.dataset.src;
      // srcset에서 가장 큰 이미지 추출
      if (img.srcset) {
        var sources = img.srcset.split(',').map(function(s) {
          var parts = s.trim().split(' ');
          return { url: parts[0], width: parseInt(parts[1]) || 0 };
        });
        sources.sort(function(a, b) { return b.width - a.width; });
        if (sources.length > 0) return sources[0].url;
      }
      // 기본값: 현재 src
      return img.src;
    }

    // 이미지 고정 크기 속성 제거 (반응형 적용, 비율 유지)
    document.querySelectorAll('.main img').forEach(function(img) {
      img.removeAttribute('width');
      img.style.width = '';
    });

    document.querySelectorAll('.main img').forEach(function(img) {
      img.addEventListener('click', function(e) {
        e.preventDefault();
        var fullUrl = getFullImageUrl(this);
        lightboxImg.src = fullUrl;
        lightboxImg.alt = this.alt || '';
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
      });
    });

    lightbox.addEventListener('click', function() {
      this.classList.remove('active');
      lightboxImg.src = '';
      document.body.style.overflow = '';
    });

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && lightbox.classList.contains('active')) {
        lightbox.classList.remove('active');
        lightboxImg.src = '';
        document.body.style.overflow = '';
      }
    });
  })();
  </script>

  <?php wp_footer(); ?>
</body>
</html>
