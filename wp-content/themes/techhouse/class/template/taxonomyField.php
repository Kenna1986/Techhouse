<style>
.taxonomy-custom-field .field-wrapper input[type="button"]{width: auto}
.taxonomy-custom-field .field-wrapper .upload-image {cursor: pointer}
</style>
<?php $termId = $_GET['tag_ID'] ?>
<tr class="form-field taxonomy-custom-field">
    <th valign="top" scope="row">
        <label for="site-title"><?php _e('Site Title', 'techhouse') ?></label>
    </th>
    <td>
        <div class="field-wrapper">
            <input id="site-title" type="text" name="taxonomy_field[title]" value="<?php echo tcfGetTaxonomyFieldValue($termId, 'title') ?>" />
        </div>
    </td>
</tr>
<tr class="form-field taxonomy-custom-field">
    <th valign="top" scope="row">
        <label><?php _e('Thumbnail', 'techhouse') ?></label>
    </th>
    <td>
        <div class="field-wrapper">
            <?php $imageId = tcfGetTaxonomyFieldValue($termId, 'thumbnail') ?>
            <input type="hidden" name="taxonomy_field[thumbnail]" value="<?php echo $imageId ?>" />
            <?php if ($imageId && $image = wp_get_attachment_image($imageId, 'thumbnail', false, array('class' => 'upload-image'))) : ?>
                <?php echo $image ?>
            <?php else : ?>
                <input type="button" class="button upload-image" value="<?php _e('Upload Image', 'techhouse') ?>" />
            <?php endif ?>
        </div>
    </td>
</tr>
<script type="text/javascript">
jQuery(document).ready(function() {
    var btnAddImage = jQuery('.field-wrapper .upload-image');

    btnAddImage.live('click', addImage);

    function addImage(event) {
        var fileFrame;
        var that = jQuery(this);
        event.preventDefault();
        if (fileFrame) {
            fileFrame.open();
            return;
        }
        fileFrame = wp.media.frames.file_frame = wp.media({
            title: jQuery(this).data('uploader_title'),
            button: {
                text: jQuery(this).data('uploader_button_text'),
            },
            multiple: false // Set to true to allow multiple files to be selected
        });

        // When an image is selected, run a callback.
        fileFrame.on('select', function() {
            // We set multiple to false so only get one image from the uploader
            attachment = fileFrame.state().get('selection');
            // Do something with attachment.id and/or attachment.url here
            attachment.each(function(item) {
                //console.log(that.parent());
                //console.log(item);
                thumbUrl = item.attributes.sizes.thumbnail.url;
                imageName = item.attributes.name;
                imageId = item.id;
                image = '<img src="' + thumbUrl + '" class="upload-image" alt="" />';
                fieldContainer = that.parent();
                that.remove();
                fieldContainer.append(image);
                fieldContainer.find('input[type="hidden"]').val(imageId);
            });
        });

        // Finally, open the modal
        fileFrame.open();
    }
});
</script>