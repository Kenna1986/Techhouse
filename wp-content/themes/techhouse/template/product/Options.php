<?php
global $post;
//$product = getProduct((array) $post);
$productOptions = get_post_meta($post->ID, Product::OPTIONS_KEY, true);
?>
<style>
#gallery-container {overflow: hidden;}
#gallery-container li {float: left; padding: 5px 10px; position: relative;}
#gallery-container li .remove-image {position: absolute; right: 0px; top: 0px; cursor: pointer;}
</style>
<div id="techhouse-product-options" class="form-item form-item-textfield wpcf-form-item wpcf-form-item-textfield">
    <div id="techhouse-product-options-container">
        <input type="button" id="add-image" value="<?php _e('Add more image', 'techhouse') ?>" class="button" />
        <ul id="gallery-container">
            <?php if (isset($productOptions['gallery'])) : ?>
                <?php foreach ($productOptions['gallery'] as $imageId) : ?>
                <li>
                    <?php $image = wp_get_attachment_image_src($imageId, 'thumbnail') ?>
                    <img src="<?php echo $image[0] ?>" alt="" />
                    <input type="hidden" name="product[options][gallery][]" value="<?php echo $imageId ?>" />
                    <img class="remove-image" src="<?php bloginfo('template_url') ?>/images/icon_remove.png" alt="" />
                </li>
                <?php endforeach ?>
            <?php endif ?>
        </ul>
    </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){
    var fileFrame;
    jQuery('#add-image').live('click', function(event) {
        event.preventDefault();
        if (fileFrame) {
            fileFrame.open();
            return;
        }
        fileFrame = wp.media.frames.file_frame = wp.media({
            title: jQuery(this).data( 'uploader_title' ),
            button: {
                text: jQuery(this).data('uploader_button_text'),
            },
            multiple: true // Set to true to allow multiple files to be selected
        });

        // When an image is selected, run a callback.
        fileFrame.on('select', function() {
            // We set multiple to false so only get one image from the uploader
            attachment = fileFrame.state().get('selection');
            // Do something with attachment.id and/or attachment.url here
            attachment.each(function(item) {
                jQuery('#gallery-container').append(getElementHtml(item));
            });
            jQuery('#gallery-container .remove-image').unbind('click').bind('click', function() {
                jQuery(this).parent().remove();
            });
        });

        // Finally, open the modal
        fileFrame.open();
    });

    function getElementHtml(element){
        html = '<li>';
        html += '<img src="' + element.attributes.sizes.thumbnail.url + '" alt="" />';
        html += '<input type="hidden" name="product[options][gallery][]" value="' + element.id + '" />';
        html += '<img class="remove-image" src="<?php bloginfo('template_url') ?>/images/icon_remove.png" alt="" />';
        html += '</li>';
        return html;
    }

    jQuery('#gallery-container .remove-image').unbind('click').bind('click', function() {
        jQuery(this).parent().remove();
    });
});
</script>