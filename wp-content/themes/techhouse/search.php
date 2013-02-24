<?php get_header() ?>

    <?php get_template_part('content', 'header') ?>

    <div class="product-block">
        <div class="sort-block">
            <form class="sort-form" name="sort-form" action="" method="post">
                <div class="cluster-view">
                    <ul>
                        <li class="active"><a id="gridview" href="#"><?php _e('Grid View', 'techhouse') ?></a></li>
                        <li><a id="listview"><?php _e('List View', 'techhouse') ?></a></li>
                    </ul>
                </div>
            </form>
        </div>
        <div class="products">
            <?php if (have_posts()) : ?>

                <?php get_template_part('loop', 'product') ?>

            <?php endif ?>
        </div>
        <?php if(function_exists('wp_paginate')) wp_paginate() ?>
    </div>

<?php get_footer() ?>