<?php
/**
 * 댓글 템플릿
 *
 * @package Nadann_Dizy_Blog
 */

// 비밀번호로 보호된 글이면 댓글 표시 안 함
if (post_password_required()) {
    return;
}
?>

<section id="comments" class="comments-section">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            댓글 <?php comments_number('0', '1', '%'); ?>개
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 0,
                'callback'    => 'nadann_dizy_comment',
            ));
            ?>
        </ol>

        <?php
        // 댓글 페이지네이션
        the_comments_navigation(array(
            'prev_text' => '&larr; 이전 댓글',
            'next_text' => '다음 댓글 &rarr;',
        ));
        ?>

    <?php endif; ?>

    <?php
    // 댓글이 닫혀있고 댓글이 있는 경우
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
        <p class="no-comments">댓글이 닫혔습니다.</p>
    <?php endif; ?>

    <?php
    // 댓글 폼
    comment_form(array(
        'title_reply'          => '댓글 남기기',
        'title_reply_to'       => '%s에게 답글',
        'cancel_reply_link'    => '답글 취소',
        'label_submit'         => '댓글 작성',
        'comment_notes_before' => '',
        'comment_field'        => '<p class="comment-form-comment"><label for="comment">댓글 <span class="required">*</span></label><textarea id="comment" name="comment" rows="5" required></textarea></p>',
        'fields'               => array(
            'author' => '<p class="comment-form-author"><label for="author">이름 <span class="required">*</span></label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" required></p>',
            'email'  => '<p class="comment-form-email"><label for="email">이메일 <span class="required">*</span></label><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" required></p>',
            'url'    => '<p class="comment-form-url"><label for="url">웹사이트</label><input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '"></p>',
        ),
    ));
    ?>

</section>
