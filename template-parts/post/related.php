<?php if (is_single()) : ?>
    <?php
    $categories = get_the_category();
    $categoriesID = [];
    foreach ( $categories as $category ) { 
        array_push($categoriesID, $category->cat_ID);
    }

    $args = array(
        'post__not_in'   => [get_the_ID()],
        'category__in'   => $categoriesID,
        'posts_per_page' => 4,
        'orderby'        => 'rand',
    );
    
    $related_query = new WP_Query($args);
    if ( $related_query->have_posts() ) :
    ?>
                </div> <!-- .post -->
            </div> <!-- .col-md-6 -->
        </div> <!-- .row -->
    </div> <!-- .container -->

    <section class="related section featured-section">
        <div class="container">
            <h3 class=""><?php _e('You may also like', 'minimo') ?></h3>
            <div class="row">
                <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                    <?=get_template_part( 'template-parts/post/content', 'half')?>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="post">

    <?php
    wp_reset_postdata();
    // wp_reset_query();
    endif;
    ?>
<?php endif; ?>