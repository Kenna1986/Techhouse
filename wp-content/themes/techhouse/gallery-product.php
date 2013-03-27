
    <?php
        global $post;
        $productOptions = get_post_meta($post->ID, Product::OPTIONS_KEY, true);
    ?>
    <div class="slideshow">
        <div class="preview slide-content">
            <ul>
                <?php if (isset($productOptions['gallery']) && $productOptions['gallery']) :?>
                    <?php foreach ($productOptions['gallery'] as $item) : ?>
                    <li>
                        <?php echo wp_get_attachment_image($item, 'full') ?>
                    </li>
                    <?php endforeach ?>
                <?php endif ?>
            </ul>
        </div>
        <div class="thumb">
            <div class="inner-thumb">
                <div class="preview">
                    <ul>
                    <?php if (isset($productOptions['gallery']) && $productOptions['gallery']) :?>
                        <?php $count = 0 ?>
                        <?php foreach ($productOptions['gallery'] as $item) : $count++; ?>
                        <li<?php if ($count == 1) : ?> class="active"<?php endif ?>>
                            <a href="javascript:void(0)"><?php echo wp_get_attachment_image($item, 'product_gallery_thumb') ?></a>
                        </li>
                        <?php endforeach ?>
                    <?php endif ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.slideshow .thumb li a').click(function(event) {
            	event.preventDefault();
            	var position = jQuery(this).parent().index();
            	var widthStep = 978;
            	var marginLeft = position * widthStep;
            	jQuery('.slideshow .slide-content ul').animate({'margin-left' : - marginLeft}, 500);
            });
        });
    </script>