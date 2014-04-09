<nav role="navigation" class="prev-next-post">
    <?php if ( is_attachment() ) : ?>
        <?php previous_image_link( false, '<span class="prev"><span class="meta-nav">&larr;</span> Previous</span>' ); ?>
        <?php next_image_link( false, '<span class="next">Next <span class="meta-nav">&rarr;</span></span>' ); ?>
    <?php else : ?>
        <?php previous_post_link('<span class="prev">&laquo; %link</span>', '%title'); ?>
        <?php next_post_link('<span class="next">%link &raquo;</span>', '%title'); ?>
    <?php endif; ?>
</nav>