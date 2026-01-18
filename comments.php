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
            <?php
            printf(
                esc_html(
                    /* translators: 1: number of comments */
                    _nx(
                        '댓글 %1$s개',
                        '댓글 %1$s개',
                        get_comments_number(),
                        'comments title',
                        'nadann-dizy-blog'
                    )
                ),
                number_format_i18n(get_comments_number())
            );
            ?>
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
            'prev_text' => esc_html__('&larr; 이전 댓글', 'nadann-dizy-blog'),
            'next_text' => esc_html__('다음 댓글 &rarr;', 'nadann-dizy-blog'),
        ));
        ?>

    <?php endif; ?>

    <?php
    // 댓글이 닫혀있고 댓글이 있는 경우
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
        <p class="no-comments"><?php esc_html_e('댓글이 닫혔습니다.', 'nadann-dizy-blog'); ?></p>
    <?php endif; ?>

    <?php
    // 댓글 폼 설정
    $commenter = wp_get_current_commenter();
    
    comment_form(array(
        'title_reply'          => esc_html__('댓글 남기기', 'nadann-dizy-blog'),
        'title_reply_to'       => esc_html__('%s에게 답글', 'nadann-dizy-blog'),
        'cancel_reply_link'    => esc_html__('답글 취소', 'nadann-dizy-blog'),
        'label_submit'         => esc_html__('댓글 작성', 'nadann-dizy-blog'),
        'comment_notes_before' => '',
        'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . esc_html__('댓글', 'nadann-dizy-blog') . ' <span class="required">*</span></label><textarea id="comment" name="comment" rows="5" required></textarea></p>',
        'fields'               => array(
            'author' => '<p class="comment-form-author"><label for="author">' . esc_html__('이름', 'nadann-dizy-blog') . ' <span class="required">*</span></label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" required></p>',
            'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__('이메일', 'nadann-dizy-blog') . ' <span class="required">*</span></label><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" required></p>',
            'url'    => '<p class="comment-form-url"><label for="url">' . esc_html__('웹사이트', 'nadann-dizy-blog') . '</label><input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '"></p>',
        ),
    ));
    ?>

</section>
