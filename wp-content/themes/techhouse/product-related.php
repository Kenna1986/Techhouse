<?php
global $post;
switch ($post->post_type) {
    case 'product':
        $args = array(
            'post_type' => 'accessory',
            'meta_key' => Product::RELATED_KEY,
            'meta_value' => $post->ID,
            'posts_per_page' => 3
        );
        $loop = new WP_Query($args);
        if (!$loop->have_posts()) {
            unset($args['meta_key']);
            unset($args['meta_value']);
            $loop = new WP_Query($args);
        }
        $title = __('Accessories', 'techhouse');
        break;
    default :
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 3
        );
        $loop = new WP_Query($args);
        $title = __('Products', 'techhouse');
        break;
}
?>
    <div class="block-2">
        <div class="slideshow">
            <h3><?php echo $title ?></h3>
            <div class="inner-slideshow">
                <!-- <a class="previous" title="<?php _e('Previous') ?>" href="javascript:void(0)"><?php _e('Previous') ?></a> -->
                <div class="preview">
                    <ul>
                        <?php while ($loop->have_posts()) : $loop->the_post() ?>
                        <?php $price = get_post_meta($loop->post->ID, Product::PRICES_KEY, true) ?>
                        <li>
                            <a title="<?php the_title_attribute() ?>" href="<?php the_permalink() ?>">
                                <?php the_post_thumbnail('thumbnail') ?>
                            </a>
                            <div class="desc">
                                <h5><a title="<?php the_title_attribute() ?>" href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                                <?php echo formatPrice(isset($price['default']) ? $price['default'] : 0)?>
                            </div>
                        </li>
                        <?php endwhile; wp_reset_query() ?>
                    </ul>
                </div>
                <!-- <a class="next" title="<?php _e('Next') ?>" href="javascript:void(0)"><?php _e('Next') ?></a> -->
            </div>
        </div>
    </div>