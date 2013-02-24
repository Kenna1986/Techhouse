
    <div class="store-header">
        <?php
            if (!is_archive()) {
                global $post;
                switch ($post->post_type) {
                    case 'product':
                        $termSlug = 'catalog'; break;
                    case 'post':
                        $termSlug = 'category'; break;
                    default :
                        $termSlug = ''; break;
                }
                $terms = get_the_terms(get_the_ID(), $termSlug);
                if ($terms) {
                    $term = end($terms);
                }
                $title = $term->name;
            } else {
                $title = wp_title('', false);
            }
        ?>
        <div class="masthead">
            <span class="ico-apple">&nbsp</span>
            <h2><a title="" href="#"><?php echo $title ?></a></h2>
        </div>
        <div class="breadcrumbs">
            <?php if (function_exists('bread_crumb')) bread_crumb(array('current_class' => 'last')) ?>
        </div>
    </div>