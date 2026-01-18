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
          <h3><?php esc_html_e('검색', 'nadann-dizy-blog'); ?></h3>
          <?php get_search_form(); ?>
        </div>
      <?php endif; ?>

      <?php if (is_active_sidebar('footer-2')) : ?>
        <div class="footer-widget">
          <?php dynamic_sidebar('footer-2'); ?>
        </div>
      <?php else : ?>
        <div class="footer-widget">
          <h3><?php esc_html_e('카테고리', 'nadann-dizy-blog'); ?></h3>
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
          <h3><?php esc_html_e('최신 글', 'nadann-dizy-blog'); ?></h3>
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
          <h3><?php esc_html_e('최신 댓글', 'nadann-dizy-blog'); ?></h3>
          <ul class="recent-comments">
            <?php
            $recent_comments = get_comments(array(
              'number' => 5,
              'status' => 'approve',
            ));
            if ($recent_comments) :
              foreach ($recent_comments as $comment) :
            ?>
              <li class="recent-comment">
                <span class="comment-author-name"><?php echo esc_html($comment->comment_author); ?></span>
                <span class="comment-on"><?php esc_html_e('님이', 'nadann-dizy-blog'); ?></span>
                <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                  <?php echo esc_html(get_the_title($comment->comment_post_ID)); ?>
                </a>
                <span class="comment-on"><?php esc_html_e('에', 'nadann-dizy-blog'); ?></span>
              </li>
            <?php
              endforeach;
            else :
            ?>
              <li><?php esc_html_e('아직 댓글이 없습니다.', 'nadann-dizy-blog'); ?></li>
            <?php endif; ?>
          </ul>

          <h3 class="footer-subtitle"><?php esc_html_e('관리', 'nadann-dizy-blog'); ?></h3>
          <ul>
            <?php wp_register(); ?>
            <li><?php wp_loginout(); ?></li>
            <li><a href="<?php bloginfo('rss2_url'); ?>"><?php esc_html_e('글 RSS', 'nadann-dizy-blog'); ?></a></li>
            <li><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php esc_html_e('댓글 RSS', 'nadann-dizy-blog'); ?></a></li>
          </ul>
        </div>
      <?php endif; ?>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </div>
  </footer>

  <!-- 이미지 라이트박스 -->
  <div class="lightbox-overlay" id="lightbox" role="dialog" aria-modal="true" aria-hidden="true" tabindex="-1">
    <button class="lightbox-close" aria-label="<?php esc_attr_e('닫기', 'nadann-dizy-blog'); ?>">&times;</button>
    <img src="" alt="">
  </div>
  <script>
  (function() {
    var lightbox = document.getElementById('lightbox');
    var lightboxImg = lightbox.querySelector('img');
    var closeBtn = lightbox.querySelector('.lightbox-close');
    var previousActiveElement = null;

    // 이미지 URL 검증 함수
    function isImageUrl(url) {
      return /\.(jpg|jpeg|png|gif|webp|svg)(\?.*)?$/i.test(url);
    }

    function getFullImageUrl(img) {
      // 부모가 링크면 링크의 href 사용 (원본 이미지) - URL 검증 추가
      var parent = img.parentElement;
      if (parent && parent.tagName === 'A' && parent.href && isImageUrl(parent.href)) {
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

    function openLightbox(imgSrc, imgAlt) {
      previousActiveElement = document.activeElement;
      lightboxImg.src = imgSrc;
      lightboxImg.alt = imgAlt || '';
      lightbox.classList.add('active');
      lightbox.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
      closeBtn.focus();
    }

    function closeLightbox() {
      lightbox.classList.remove('active');
      lightbox.setAttribute('aria-hidden', 'true');
      lightboxImg.src = '';
      document.body.style.overflow = '';
      if (previousActiveElement) {
        previousActiveElement.focus();
      }
    }

    // 이미지 인라인 스타일만 제거 (HTML 속성은 유지)
    document.querySelectorAll('.main img').forEach(function(img) {
      if (img.style.width) img.style.width = '';
      if (img.style.height) img.style.height = '';
    });

    document.querySelectorAll('.main img').forEach(function(img) {
      img.addEventListener('click', function(e) {
        var link = this.closest('a');
        if (link && link.href && !isImageUrl(link.href)) {
          return; // 비-이미지 링크면 기본 동작 유지
        }
        e.preventDefault();
        var fullUrl = getFullImageUrl(this);
        openLightbox(fullUrl, this.alt);
      });
    });

    // 닫기 버튼 클릭
    closeBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      closeLightbox();
    });

    // 오버레이 클릭 (이미지 외부)
    lightbox.addEventListener('click', function(e) {
      if (e.target === lightbox) {
        closeLightbox();
      }
    });

    // ESC 키로 닫기
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && lightbox.classList.contains('active')) {
        closeLightbox();
      }
    });
  })();

  // 하이라이트된 글로 스크롤 (해시 방식)
  (function() {
    var hash = window.location.hash;
    if (hash && hash.startsWith('#post-')) {
      var target = document.getElementById(hash.substring(1));
      if (target) {
        setTimeout(function() {
          var targetTop = target.getBoundingClientRect().top + window.scrollY;
          var windowHeight = window.innerHeight;
          var scrollTo = targetTop - (windowHeight / 2) + (target.offsetHeight / 2);
          window.scrollTo({ top: Math.max(0, scrollTo), behavior: 'smooth' });
          target.classList.add('highlighted');

          // URL에서 해시 제거
          history.replaceState(null, '', window.location.pathname + window.location.search);
        }, 100);
      }
    }
  })();
  </script>

  <?php wp_footer(); ?>
</body>
</html>
