<?php
global $post;
$productOptions = get_post_meta($post->ID, Product::OPTIONS_KEY, true);
$prices = get_post_meta($post->ID, Product::PRICES_KEY, true);
?>

<?php if (isset($productOptions['color'])) : ?>
    <div class="choose choose-color">
        <div class="item-choose">
            <h3><?php _e('Choose a color') ?>:</h3>
        </div>
        <div class="desc"></div>
    </div>
<?php endif ?>
<?php if ($prices) : ?>
    <div class="choose choose-color">
        <h4><?php _e('Price', 'techhouse') ?> : <?php echo formatPrice(getFinalPrice($prices)) ?></h4>
    </div>
<?php endif ?>