<?php

$page_slug = 'about';

$args = array(
    'pagename' => $page_slug,
);
$query = new WP_Query( $args );

if ( $query->have_posts() ) {
    echo "test2";
    $query->the_post();

    // Declare global $more (before the loop).
    global $more;
    
    // Set (inside the loop) to display all content, including text below more.
    $more = 1;
    
    the_content();

    // get_template_part( 'template-parts/post/content', 'half');
    wp_reset_postdata();
} else {
    echo "no";
}

?>