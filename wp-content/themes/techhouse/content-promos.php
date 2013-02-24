
    <div class="promos">
        <?php
            $args = array(
                'post_type' => 'promos',
                'posts_per_page' => 4
            );
            $loop = new WP_Query($args);
            if ($loop->have_posts()) :
                $count = 0;
        ?>
            <ul>
                <?php while ($loop->have_posts()) : $loop->the_post(); $count++; ?>
                <li<?php if ($count % 4 == 0) : ?> class="last"<?php endif ?>>
                    <div class="desc">
                        <h2>
                            <a title="<?php the_title_attribute() ?>" href="<?php echo get_post_meta($loop->post->ID, 'wpcf-promos_link', true) ?>">
                                <?php the_title() ?>
                            </a>
                        </h2>
                        <?php the_excerpt() ?>
                    </div>
                    <a title="<?php the_title_attribute() ?>" href="<?php echo get_post_meta($loop->post->ID, 'wpcf-promos_link', true) ?>">
                        <?php the_post_thumbnail('home_promos') ?>
                    </a>
                </li>
                <?php endwhile ?>
            </ul>
        <?php endif ?>
        <?php wp_reset_query() ?>
    </div>