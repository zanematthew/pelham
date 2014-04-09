<?php get_header(); ?>
<section class="<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>grid-70 <?php endif; ?>grid-parent">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'partials/content', get_post_format() ); ?>
		<?php endwhile; ?>
	<?php endif; ?>
</section>
<?php get_sidebar( get_post_type() ); ?>
<?php get_footer(); ?>