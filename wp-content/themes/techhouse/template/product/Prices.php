<?php
global $post;
$prices = get_post_meta($post->ID, Product::PRICES_KEY, true);
$defaultPrice = isset($prices['default']) ? getFormatPrice($prices['default']) : '';
?>
<div id="techhouse-product-price" class="form-item form-item-textfield wpcf-form-item wpcf-form-item-textfield">
    <label for="techhouse-product-field-price-default"><?php _e('Price') ?> : </label>
    <input type="text" id="techhouse-product-field-price-default" name="<?php echo Product::PRICES_KEY?>[default]" value="<?php echo $defaultPrice ?>" />
</div>