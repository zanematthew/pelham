<?php

get_template_part( 'partials/html', 'header' );
get_template_part( 'partials/masthead' );

?>

<main class="grid-container grid-parent">
    <?php if ( get_header_image() ) : ?>
        <div class="custom-header-container">
            <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php echo get_post_meta( get_custom_header()->attachment_id, '_wp_attachment_image_alt', true ); ?>" title="<?php echo get_post_meta( get_custom_header()->attachment_id, '_wp_attachment_image_alt', true ); ?>" />
        </div>
    <?php endif; ?>