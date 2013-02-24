<?php get_header() ?>

    <?php get_template_part('content', 'header') ?>

	<?php while (have_posts()) : the_post(); ?>

        <?php
            global $post;
            $product = getProduct((array) $post);
        ?>

		<?php get_template_part('content', 'product') ?>

		<?php //comments_template( '', true ); ?>

	<?php endwhile; // end of the loop. ?>
<?php get_footer() ?>