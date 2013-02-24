
    <div class="content">

        <?php get_template_part('gallery', 'product') ?>
        <div class="product-details-block">
            <div class="product-details">
                <h2 class="title"><?php the_title() ?></h2>
                <div class="choose-block">

                    <?php get_template_part('product', 'options') ?>

                    <div class="overview">
                        <div class="item-choose">
                            <h3><?php _e('Overview', 'techhouse') ?></h3>
                        </div>
                        <div class="desc fck"><?php the_content() ?></div>
                    </div>
                </div>
            </div>

            <?php get_template_part('product', 'related') ?>

        </div>
    </div>