<footer class="footer section featured-section">
    <?php if ( is_active_sidebar( 'footer-left-sidebar' ) ) : ?>
        <?php if ( is_active_sidebar( 'footer-left-sidebar' ) ) : ?>
            <div id="footer-widget" class="container section">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <?php dynamic_sidebar( 'footer-left-sidebar' ); ?>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <?php dynamic_sidebar( 'footer-right-sidebar' ); ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div id="footer-widget" class="container section">
                <div class="row">
                    <div class="col-xs-12">
                        <?php dynamic_sidebar( 'footer-left-sidebar' ); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="container links">
        <?php
        wp_nav_menu( array( 
            'theme_location' => 'footer-menu',
            'fallback_cb' => false
        ) );
        
        $location = 'social-menu';
        if (has_nav_menu($location)) {
            wp_nav_menu( array( 
                'theme_location' => $location,
                'fallback_cb' => false,
                'menu_class' => 'menu',
                'container' => 'div',
                'container_class' => 'social'
            ) );
        }
        ?>
    </div>
</footer>

<!-- <script src="script.js"></script> -->
<?php wp_footer(); ?>
</body>
</html>