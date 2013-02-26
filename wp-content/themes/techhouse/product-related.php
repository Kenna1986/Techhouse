<?php
global $post;
switch ($post->post_type) {
    case 'product':
        $args = array(
            'orderby' => 'term_id',
            'order' => 'DESC',
        );
        $taxonomy = 'accessory-catalog';
        $collection = get_terms($taxonomy, $args);
        $title = __('Accessories', 'techhouse');
        break;
    default :
        $args = array(
            'orderby' => 'term_id',
            'order' => 'DESC',
        );
        $taxonomy = 'catalog';
        $collection = get_terms($taxonomy, $args);
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
                        <?php foreach ($collection as $row) : ?>
                        <li>
                            <?php $imageId = tcfGetTaxonomyFieldValue($row->term_id, 'thumbnail') ?>
                            <?php if ($image = wp_get_attachment_image($imageId, 'thumbnail')) : ?>
                                <a href="<?php echo get_term_link($row) ?>" title="<?php echo esc_attr($row->name) ?>">
                                    <?php echo $image ?>
                                </a>
                            <?php endif ?>
                            <div class="desc">
                                <h5>
                                    <a href="<?php echo get_term_link($row) ?>" title="<?php echo esc_attr($row->name) ?>">
                                        <?php echo $row->name ?>
                                    </a>
                                </h5>
                            </div>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <!-- <a class="next" title="<?php _e('Next') ?>" href="javascript:void(0)"><?php _e('Next') ?></a> -->
            </div>
        </div>
    </div>