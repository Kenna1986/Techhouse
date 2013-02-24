<?php get_header() ?>

    <div class="slideshow">
        <?php
            if (function_exists('slideshow')) {
                slideshow('default', true);
            }
        ?>
    </div>

    <?php get_template_part('content', 'promos') ?>

<?php get_footer() ?>