<?php get_header() ?>

    <?php get_template_part('content', 'header') ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', get_post_format() ); ?>

		<?php //comments_template( '', true ); ?>

	<?php endwhile; // end of the loop. ?>
<?php get_footer() ?>