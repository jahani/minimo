<?php if (shortcode_exists('ajax_load_more') && !is_singular()): ?>
    <!-- <div class="row"> -->
    <?php

        global $do_not_duplicate;
        // $default_posts_per_page = get_option('posts_per_page');

        // // Standard WP Query
        // $args = array(
        //     // 'category_name' => 'wordpress',
        //     'posts_per_page' => $default_posts_per_page,
        // );
        // $query = new WP_Query($args);
        // while ($query->have_posts()): $query->the_post();
        //     $do_not_duplicate[] = $post->ID; // Store post ID in array
        //     // Other loop actions could go here
        // endwhile;
        // wp_reset_query();

        // Ajax Load More
        $post__not_in = '';
        if ($do_not_duplicate) {
            $post__not_in = implode(',', $do_not_duplicate);
        }

        // Specify Page Type
        $authorParam = is_author() ? 'author="'.get_the_author_meta('ID').'"' : '';
        $categoryParam = is_category() ? 'category="'.(get_category( get_query_var( 'cat' ) ))->slug.'"' : '';
        $tagParam = is_tag() ? 'tag="'.get_query_var('tag').'"' : '';
        $dateParam = '';
        if(is_year()){
            $dateParam = 'year="' . $year . '"';
        }
        elseif(is_month()){
            $dateParam = 'year="' . $year . '" month="' . $month . '"';
        }
        elseif(is_day()){
            $dateParam = 'year="' . $year . '" month="' . $month . '" day="' . $day . '"';
        }
        $params = implode(' ', [$authorParam, $categoryParam, $tagParam, $dateParam]);

    ?>
    <?=do_shortcode('[ajax_load_more transition_container="false" css_classes="row" '.$params.' post__not_in="' . $post__not_in . '" button_label="'.__('Load More', 'jahani-theme').'" button_loading_label="'.__('Loading...', 'jahani-theme').'" posts_per_page="6" scroll="false" pause="true"]')?>
    <!-- </div> -->
<?php endif;?>