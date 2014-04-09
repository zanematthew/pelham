<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

    <div class="entry-main clearfix">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="entry-featured-image">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before'=>__('Permalink to: ','pelham')) ); ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a>
            </div>
        <?php endif; ?>

        <?php if ( get_the_title() ) : ?>
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before'=>__('Permalink to: ','pelham')) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        <?php endif; ?>

        <div class="entry-meta">
            <ul>
                <?php $categories_list = get_the_category_list( __( ', ', 'pelham' ) ); if ( $categories_list ) : ?>
                    <li class="categories"><div class="genericon genericon-category"></div><?php echo $categories_list; ?></li>
                <?php endif; ?>
                <?php if ( get_the_tags() ) : ?>
                    <li class="tags"><div class="genericon genericon-tag"></div><?php the_tags(''); ?></li>
                <?php endif; ?>
                <li class="permalink"><div class="genericon genericon-link"></div><a href="<?php the_permalink(); ?>" title="Bookmark the URL for <?php echo the_title_attribute( $post->ID ); ?>">Permalink</a></li>
                <?php if ( is_attachment() ) : ?>
                    <?php $metadata = wp_get_attachment_metadata(); ?>
                    <li class="download"><div class="genericon genericon-cloud-download"></div><a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" title="Download <?php echo the_title_attribute( $post->post_parent ); ?>"><?php echo $metadata['width']; ?> x <?php echo $metadata['height']; ?></a></li>
                <?php endif; ?>
                <?php edit_post_link( __('Edit','pelham'), '<li><span class="genericon genericon-edit"></span>','</li>'); ?>
            </ul>
        </div>


        <?php if ( ! is_single() && has_excerpt() ) : ?>
            <div class="entry-excerpt">
                <?php the_excerpt(); ?>
            </div>
        <?php else : ?>
            <div class="entry-content">
                <?php the_content(); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'pelham' ), 'after' => '</div>' ) ); ?>
            </div>
        <?php endif; ?>
    </div>
</article>
