<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package pelham
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>
    <div class="comments-container">
        <div id="comments" class="comments-area">
            <?php if ( have_comments() ) : ?>
                <h2 class="comments-title"><?php printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'pelham' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?></h2>
                <ol class="comment-list">
                    <?php wp_list_comments(); ?>
                </ol><!-- .comment-list -->
                <div class="pagination-container">
                    <?php paginate_comments_links(); ?>
                </div>
            <?php endif; // have_comments() ?>
            <?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
                <p class="no-comments"><?php _e( 'Comments are closed.', 'pelham' ); ?></p>
            <?php endif; ?>

            <?php comment_form(); ?>
        </div><!-- #comments -->
    </div>