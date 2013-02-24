
    <ul class="blogs">
        <?php while (have_posts()) : the_post() ?>
        <li>
            <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_title() ?></a></h2>
            <div class="description">
                <div class="thumbnail">
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
                        <?php the_post_thumbnail('thumbnail') ?>
                    </a>
                </div>
                <?php the_excerpt() ?>
            </div>
        </li>
        <?php endwhile ?>
    </ul>