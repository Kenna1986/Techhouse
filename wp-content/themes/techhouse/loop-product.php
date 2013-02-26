    <ul>
    <?php while (have_posts()) : the_post() ?>
        <?php $prices = get_post_meta($post->ID, Product::PRICES_KEY, true) ?>
        <li>
            <div class="inner-pro">
                <div class="desc">
                    <h5><a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_title() ?></a></h5>
                    <br />
                    <?php echo formatPrice(getFinalPrice($post->ID)) ?>
                    <span><?php _e('In Stock', 'techhouse') ?></span>
                    <span class="btn-buy">
                        <a title="<?php _e('Buy Now', 'techhouse') ?>" href="<?php the_permalink() ?>"><?php _e('Buy Now', 'techhouse') ?></a>
                    </span>
                </div>
                <span class="frm-1">
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
                        <?php the_post_thumbnail('product_grid_view') ?>
                    </a>
                </span>
            </div>
        </li>
    <?php endwhile ?>
    </ul>