<div class="entry-meta">
    <ul>
        <li class="time"><div class="genericon genericon-month"></div>
            <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php echo get_the_date('D M j, Y'); ?></a></li>
        <li class="permalink"><div class="genericon genericon-link"></div><a href="<?php the_permalink(); ?>" title="Bookmark the URL for <?php echo the_title_attribute( $post->ID ); ?>">Permalink</a></li>
        <?php if ( comments_open() ) : ?>
            <li class="comments"><div class="genericon genericon-comment"></div><a href="#comment"><?php comments_number( 'Be the first', 'One Comment', '% Comments' ); ?></a></li>
        <?php endif; ?>
        <?php $categories_list = get_the_category_list( __( ', ', 'pelham' ) ); if ( $categories_list ) : ?>
            <li class="categories"><div class="genericon genericon-category"></div><?php echo $categories_list; ?></li>
        <?php endif; ?>
        <?php if ( get_the_tags() ) : ?>
            <li class="tags"><div class="genericon genericon-tag"></div><?php the_tags(''); ?></li>
        <?php endif; ?>
        <?php if ( is_attachment() ) : ?>
            <?php $metadata = wp_get_attachment_metadata(); ?>
            <li class="download"><div class="genericon genericon-cloud-download"></div><a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" title="Download <?php echo the_title_attribute( $post->post_parent ); ?>"><?php echo $metadata['width']; ?> x <?php echo $metadata['height']; ?></a></li>
        <?php endif; ?>
        <?php edit_post_link( __('Edit','pelham'), '<li><span class="genericon genericon-edit"></span>','</li>'); ?>
    </ul>
</div>
