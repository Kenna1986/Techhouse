<?php
if (!class_exists('Techhouse')) {
    class Techhouse
    {
        public static function getProduct($postId)
        {

        }
    }
}

function getProduct($args = array())
{
    $product = new Product($args);
    return $product;
}

function countTaxonomy($taxonomy)
{
    global $wpdb;
    $sql = "SELECT COUNT(*) as total FROM $wpdb->term_taxonomy WHERE `taxonomy` = '$taxonomy'";
    return $wpdb->get_var($sql);
}

function getFinalPrice($postId)
{
    $prices = get_post_meta($postId, Product::PRICES_KEY, true);
    if (isset($prices['default'])) {
        return $prices['default'];
    }
    return 0;
}

function getFormatPrice($price)
{
    $default = 0;
    return number_format($price, $default);
}

function getCurrency()
{
    return 'VND';
}

function formatCurrency($price)
{
    $currency = getCurrency();
    $price = getFormatPrice($price);
    $output = $price . ' ' . $currency;
    return $output;
}

function formatPrice($price = 0)
{
    $price = getFormatPrice($price);
    $currency = getCurrency();
    return '<span class="cost">' . $price . ' ' . $currency . '</span>';
}

function addCustomField()
{
    add_meta_box(
        'techhouse_product_prices',
        __('Product Prices', 'techhouse'),
        'productPrices',
        'product',
        'side'
    );

    add_meta_box(
        'techhouse_product_prices',
        __('Prices', 'techhouse'),
        'productPrices',
        'accessory',
        'side'
    );

    add_meta_box(
        'techhouse_product_options',
        __('Product Options', 'techhouse'),
        'productOptions',
        'product'
    );

    add_meta_box(
        'techhouse_product_related',
        __('Product Related', 'techhouse'),
        'productRelated',
        'accessory'
    );
}
add_action('add_meta_boxes', 'addCustomField');

function productOptions()
{
    locate_template('template/product/Options.php', true);
}

function productPrices()
{
    locate_template('template/product/Prices.php', true);
}

function productRelated()
{
    locate_template('template/product/Related.php', true);
}

function saveProductData($postId)
{
    saveProductPrices($postId);
    saveProductOptions($postId);
    saveProductRelated($postId);
    return;
}
add_action('save_post', 'saveProductData');

function saveProductPrices($postId)
{
    $oldPrices = get_post_meta($postId, Product::PRICES_KEY, true);
    $newPirces = $_POST[Product::PRICES_KEY];
    if ($oldPrices) {
        $priceData = array_merge($oldPrices, $newPirces);
    } else {
        $priceData = $newPirces;
    }

    $priceData = removeEmptyVal($priceData);
    if ($oldPrices === false) {
        add_post_meta($postId, Product::PRICES_KEY, $priceData);
    } else {
        update_post_meta($postId, Product::PRICES_KEY, $priceData);
    }
}

function saveProductRelated($postId)
{
    if (isset($_POST['product']['related'])) {
        $productRelated = get_post_meta($postId, Product::RELATED_KEY, true);
        if ($_POST['product']['related']) {
            if ($productRelated !== false) {
                update_post_meta($postId, Product::RELATED_KEY, $_POST['product']['related']);
            } else {
                add_post_meta($postId, Product::RELATED_KEY, $_POST['product']['related']);
            }
        } elseif ($productRelated !== false) {
            delete_post_meta($postId, Product::RELATED_KEY);
        }
    }
}

function removeEmptyVal($priceData)
{
    if (is_array($priceData)) {
        foreach ($priceData as $key => $value) {
            if (is_array($value)) {
                $priceData[$key] = removeEmptyVal($value);
            } elseif (!trim($value)) {
                unset($priceData[$key]);
            } else {
                $priceData[$key] = convertPrice($value);
            }
        }
    }
    return $priceData;
}

function saveProductOptions($postId)
{
    $oldOptions = get_post_meta($postId, Product::OPTIONS_KEY, true);
    if (isset($_POST['product']['options'])) {
        $productOptions = $_POST['product']['options'];
        if ($oldOptions === false) {
            add_post_meta($postId, Product::OPTIONS_KEY, $productOptions);
        } else {
            update_post_meta($postId, Product::OPTIONS_KEY, $productOptions);
        }
    } elseif ($oldOptions !== false) {
        update_post_meta($postId, Product::OPTIONS_KEY, array());
    }
}

function convertPrice($price)
{
    return intval(str_replace(',', '', $price));
}

function getMenuObject($menuItem) {
    $objectType = get_post_meta($menuItem->ID, '_menu_item_type', true);
    switch ($objectType) {
        case 'taxonomy' :
            $term = get_post_meta($menuItem->ID, '_menu_item_object_id', true);
            $taxonomy = get_post_meta($menuItem->ID, '_menu_item_object', true);
            $term = get_term($term, $taxonomy);
            $object = new stdClass();
            $object->object_id = $term->term_id;
            $object->object = $term->taxonomy;
            $object->type = 'taxonomy';
            $object->url = get_term_link( $term, $taxonomy );
            $object->title = $term->name;
            break;
        case 'custom' :
            $post = get_post($menuItem->ID);
            $object = new stdClass();
            $object->object_id = $post->post_id;
            $object->object = $post->post_type;
            $object->type = 'custom';
            $object->url = get_post_meta($post->ID, '_menu_item_url', true);
            $object->title = $post->post_title;
            break;
        default :
            $postId = get_post_meta($menuItem->ID, '_menu_item_object_id', true);
            $post = get_post($postId);
            $object = new stdClass();
            $object->object_id = $post->post_id;
            $object->object = $post->post_type;
            $object->type = 'post_type';
            $object->url = get_permalink($post->ID);
            $object->title = $post->post_title;
            break;
    }
    return $object;
}

function generateNavMenu() {
    $items = wp_get_nav_menu_items('header');
    if ($items) {
    ?>
        <ul id="nav">
            <?php
                foreach($items as $key => $item) :
                    if ($item->menu_item_parent) {
                        continue;
                    }
            ?>
            <li>
                <?php
                    $loop = new WP_Query(array(
                                        'post_type'    => 'nav_menu_item',
                                        'meta_key'     => '_menu_item_menu_item_parent',
                                        'meta_value'   => $item->ID
                                    ));
                ?>
                <a title="<?php echo $item->attr_title; ?>" href="<?php echo $item->url; ?>">
                    <?php echo $item->title; ?>
                    <?php if ($loop->have_posts()) : ?>
                        <img class=" wi-icon init-icon-13" alt="" src="<?php bloginfo('template_url'); ?>/images/transparent.png" />
                    <?php endif; ?>
                </a>
                <?php
                    if ($loop->have_posts()) :
                ?>
                    <div class="sub-nav">
                        <ul class="lev-1">
                            <?php
                                while ($loop->have_posts()) : $loop->the_post();
                                    $menuObject = getMenuObject($loop->post);
                            ?>
                            <li id="<?php echo $loop->post->ID; ?>">
                                <a title="<?php echo $menuObject->attr_title; ?>" href="<?php echo $menuObject->url; ?>">
                                    <?php echo $menuObject->title; ?>
                                </a>
                                <?php if (has_post_thumbnail()) : ?>
                                <div class="sub-nav-lev2">
                                    <?php the_post_thumbnail('nav_image'); ?>
                                </div>
                                <?php endif; ?>
                                <?php
                                    $loopSecond = new WP_Query(array(
                                                        'post_type'    => 'nav_menu_item',
                                                        'meta_key'     => '_menu_item_menu_item_parent',
                                                        'meta_value'   => $loop->post->ID
                                                    ));
                                    if ($loopSecond->have_posts()) :
                                ?>
                                <ul class="lev-2">
                                    <?php
                                        while($loopSecond->have_posts()) : $loopSecond->the_post();
                                            $menuObject = getMenuObject($loopSecond->post);
                                    ?>
                                    <li>
                                        <a title="<?php echo $menuObject->attr_title; ?>" href="<?php echo $menuObject->url; ?>">
                                            <?php echo $menuObject->title; ?>
                                        </a>
                                    </li>
                                    <?php endwhile; ?>
                                </ul>
                                <?php endif; ?>
                            </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </li>
            <?php endforeach; wp_reset_query(); ?>
        </ul>
        <?php
    }
}