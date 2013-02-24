<ul class="nav">
    <?php dynamic_sidebar('footer-first') ?>
    <?php dynamic_sidebar('footer-second') ?>
    <li>
        <h2><?php _e('Follow us', 'techhouse') ?></h2>
        <?php
            $socials = array(
                'facebook' => array('label' => __('Facebook', 'techhouse'), 'url' => '#'),
                'google' => array('label' => __('Google +', 'techhouse'), 'url' => '#'),
                'twitter' => array('label' => __('Twitter', 'techhouse'), 'url' => '#'),
                'youtube' => array('label' => __('Youtube', 'techhouse'), 'url' => '#'),
            );
        ?>
        <ul class="social-network">
            <?php foreach ($socials as $key => $value) : ?>
            <li>
                <a title="<?php echo esc_attr($value['label']) ?>" href="<?php echo $value['url'] ?>">
                    <span class="ico <?php echo $key ?>"></span><span><?php echo $value['label'] ?></span>
                </a>
            </li>
            <?php endforeach ?>
        </ul>
    </li>
    <li>
        <h2><?php _e('Opening hours', 'techhouse') ?></h2>
        <ul class="open-hours">
            <li><span><?php _e('Monday - Saturday', 'techhouse') ?>:</span><span>9:00 - 20:00</span></li>
            <li><span><?php _e('Sunday', 'techhouse') ?>:</span><span>9:00 - 15:00</span></li>
        </ul>
    </li>
</ul>