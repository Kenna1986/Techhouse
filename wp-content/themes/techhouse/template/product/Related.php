<?php
global $post;
$args = array(
    'post_type' => 'product'
);
$products = new WP_Query($args);
$productRelated = get_post_meta($post->ID, Product::RELATED_KEY, true);
?>
<div>
    <label>
        <?php _e('Select product related', 'techhouse') ?>
        <select name="product[related]">
            <option value="0">-----------</option>
            <?php while ($products->have_posts()) : $products->the_post() ?>
            <option value="<?php the_ID() ?>" <?php if($productRelated == $products->post->ID) : ?>selected<?php endif ?>><?php the_title() ?></option>
            <?php endwhile ?>
        </select>
    </label>
</div>