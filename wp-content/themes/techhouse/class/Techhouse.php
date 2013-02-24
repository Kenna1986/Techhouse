<?php
require_once 'Product.php';

function getProduct($args = array())
{
    $product = new Product($args);
    return $product;
}

function getFinalPrice($prices)
{
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

function createCustomType() {
    $labels = array(
        'name' => __('Product', 'techhouse'),
        'singular_name' => __('Product', 'techhouse'),
        'add_new' => __('Add Product', 'techhouse'),
        'add_new_item' => __('Add New Product', 'techhouse'),
        'edit_item' => __('Edit Product', 'techhouse'),
        'new_item' => __('New Product', 'techhouse'),
        'all_items' => __('All Products', 'techhouse'),
        'view_item' => __('View Product', 'techhouse'),
        'search_items' => __('Search Product', 'techhouse'),
        'not_found' =>  __('No product found', 'techhouse'),
        'not_found_in_trash' => __('No product found in Trash', 'techhouse'),
        'parent_item_colon' => '',
        'menu_name' => __('Products', 'techhouse'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'san-pham'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments')
    );

    register_post_type('product', $args);

    $labels = array(
        'name' => __('Promos', 'techhouse'),
        'singular_name' => __('Promos', 'techhouse'),
        'add_new' => __('Add Promos', 'techhouse'),
        'add_new_item' => __('Add New Promos', 'techhouse'),
        'edit_item' => __('Edit Promos', 'techhouse'),
        'new_item' => __('New Promos', 'techhouse'),
        'all_items' => __('All Promos', 'techhouse'),
        'view_item' => __('View Promos', 'techhouse'),
        'search_items' => __('Search promos', 'techhouse'),
        'not_found' =>  __('No promos found', 'techhouse'),
        'not_found_in_trash' => __('No promos found in Trash', 'techhouse'),
        'parent_item_colon' => '',
        'menu_name' => __('Promos', 'techhouse'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'promos'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'thumbnail', 'excerpt')
    );

    register_post_type('promos', $args);

    $labels = array(
        'name' => __('Accessories', 'techhouse'),
        'singular_name' => __('Accessories', 'techhouse'),
        'add_new' => __('Add Accessory', 'techhouse'),
        'add_new_item' => __('Add New Accessory', 'techhouse'),
        'edit_item' => __('Edit Accessory', 'techhouse'),
        'new_item' => __('New Accessory', 'techhouse'),
        'all_items' => __('All Accessories', 'techhouse'),
        'view_item' => __('View Accessory', 'techhouse'),
        'search_items' => __('Search Accessories', 'techhouse'),
        'not_found' =>  __('No promos accessory', 'techhouse'),
        'not_found_in_trash' => __('No accessory found in Trash', 'techhouse'),
        'parent_item_colon' => '',
        'menu_name' => __('Accessories', 'techhouse'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'phu-kien'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail')
    );

    register_post_type('accessory', $args);
}
add_action('init', 'createCustomType');

function createCustomTaxonomy()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => _x('Catalog', 'taxonomy general name'),
        'singular_name' => _x('Catalog', 'taxonomy singular name'),
        'search_items' =>  __('Search Catalogs', 'techhouse'),
        'all_items' => __('All Catalogs', 'techhouse'),
        'parent_item' => __('Parent Catalog', 'techhouse'),
        'parent_item_colon' => __('Parent Catalog:', 'techhouse'),
        'edit_item' => __('Edit Catalog', 'techhouse'),
        'update_item' => __('Update Catalog', 'techhouse'),
        'add_new_item' => __('Add New Catalog', 'techhouse'),
        'new_item_name' => __('New Catalog Name', 'techhouse'),
        'menu_name' => __('Catalogs', 'techhouse'),
    );

    register_taxonomy('catalog', array('product'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'danh-muc'),
    ));

    $labels = array(
        'name' => _x('Accessories Catalog', 'taxonomy general name'),
        'singular_name' => _x('Accessories Catalog', 'taxonomy singular name'),
        'search_items' =>  __('Search Accessories Catalogs', 'techhouse'),
        'all_items' => __('All Accessories Catalogs', 'techhouse'),
        'parent_item' => __('Parent Accessories Catalog', 'techhouse'),
        'parent_item_colon' => __('Parent Accessories Catalog:', 'techhouse'),
        'edit_item' => __('Edit Accessories Catalog', 'techhouse'),
        'update_item' => __('Update Accessories Catalog', 'techhouse'),
        'add_new_item' => __('Add New Accessories Catalog', 'techhouse'),
        'new_item_name' => __('New Accessories Catalog Name', 'techhouse'),
        'menu_name' => __('Accessories Catalog', 'techhouse'),
    );

    register_taxonomy('accessory-catalog', array('accessory'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'danh-muc-phu-kien'),
    ));
}
add_action('init', 'createCustomTaxonomy', 0);

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
    include_once 'product/Options.php';
}

function productPrices()
{
    include_once 'product/Prices.php';
}

function productRelated()
{
    include_once 'product/Related.php';
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