<?php get_header() ?>

    <?php get_template_part('content', 'header') ?>

    <div class="content single">
        <div class="product-details">
            <?php if (have_posts()) :?>
                <?php get_template_part('content', 'archive') ?>
            <?php else : ?>
            <h1><?php _e('No post found in this archive.', 'techhouse') ?></h1>
            <?php endif ?>
        </div>
        <?php if(function_exists('wp_paginate')) wp_paginate() ?>
    </div>

<?php get_footer() ?>