<?php global $post ?>
    <form id="frm-search" class="frmGeneral frm-search" method="get" action="#" name="frm-search">
        <ul>
            <li>
                <label for="product-qty"><?php _e('Quality') ?> :</label>
                <span class="left"><span class="right">
                    <input id="product-qty" class="txt-name" type="text" name="qty" />
                </span></span>
            </li>
            <li>
                <span class="btn-1">
                    <a title="" href="javascript:void(0)"><?php _e('Add to cart', 'techhouse') ?></a>
                </span>
            </li>
        </ul>
    </form>
    <div class="infor">
        <div class="service">
            <h3><?php _e('Contact Sales', 'techhouse') ?></h3>
            <ul>
                <li>
                    <span><?php _e('Support Online', 'techhouse') ?> : </span>
                    <span><?php _e('Bussiness people', 'techhouse') ?></span>
                </li>
                <li>
                    <span><?php _e('Phone support', 'techhouse') ?> : </span>
                    <span>(84)8 38329531</span>
                </li>
                <li>
                    <span><?php _e('Email', 'techhouse') ?> : </span>
                    <span>example@email.com</span>
                </li>
                <li>
                    <span><?php _e('Address', 'techhouse') ?> : </span>
                    <span><?php _e('69/12b Cao Thang, Ward 3, District 3, Ho Chi Minh City', 'techhouse') ?>
                        <a href="http://www.map-generator.org/f9a9fca1-66a7-480a-82ee-963daf6bdf18/large-map.aspx">
                            (<?php _e('View map', 'techhouse') ?>)
                        </a>
                    </span>
                </li>

            </ul>
        </div>
        <div class="service">
            <h3><?php _e('Promotions', 'techhouse') ?></h3>
            <?php echo apply_filters('the_content', get_post_meta($post->ID, 'wpcf-promotion', true)) ?>
        </div>
    </div>