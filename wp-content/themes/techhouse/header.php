<?php
/*
 * Header of template
 *
 **/
$cart = new Checkout_Cart();
$items = $cart->load(1)->getAllItems();
print_r($items);
exit;
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes() ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes() ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes() ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width" />
<meta name="format-detection" content="telephone=no" />
<title><?php wp_title('|', true, 'right') ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head() ?>
</head>
<body <?php body_class() ?>>
<div id="container">
	<div id="header">
	    <div class="inner">
            <a class="logo" title="<?php bloginfo('name') ?>" href="<?php bloginfo('url') ?>">
                <img width="300" alt="<?php bloginfo('name') ?>" src="<?php bloginfo('template_url') ?>/images/logo.png" />
            </a>
            <div class="right">
                <div class="block-1">
                    <span class="phone">0966 222288</span>
                    <?php dynamic_sidebar('languages') ?>
                    <script type="text/javascript">
                    jQuery(document).ready(function() {
                        if (jQuery('#lang').length > 0) {
                            jQuery('#lang').appendTo(jQuery('#transposh-2'));
                            jQuery('#transposh-2 .no_translate').remove();
                            var languageSelect = jQuery('#lang');
                            var selectText = languageSelect.find('option').eq(languageSelect[0].selectedIndex).html();
                            html = '<span>' + selectText + '</span>';
                            html += '<a title="<?php _e('Select', 'techhouse') ?>" href="javascript:void(0);"> </a>';
                            jQuery('#transposh-2').prepend(html);
                        }
                    });
                    </script>
                    <form class="search-form" name="search-form" action="<?php bloginfo('url') ?>">
                        <input id="search" type="text" name="s" value="<?php echo get_search_query() ?>" />
                        <input type="hidden" name="post_type[]" value="product" />
                        <input type="hidden" name="post_type[]" value="accessory" />
                        <input id="btn-search" type="submit" value=" " />
                    </form>
                </div>
                <?php generateNavMenu() ?>
            </div>
		</div>
	</div><!-- #header -->
	<div id="main">
        <div class="inner <?php if (is_home()) : ?>home<?php endif ?>">