<?php if ( shortcode_exists( 'newsletter_form' ) && is_home() ):?>
<section class="newsletter section featured-section">
    <div class="container section">
        <h1 class="text-center section"><?php _e('Sign up for our newletter!', 'jahani-theme') ?></h1>
        <div class="theme-newsletter section">
            <form class="section" method="post" action="<?=home_url('/')?>?na=s" onsubmit="return newsletter_check(this)">
                <div class="form">
                    <input type="email" name="ne" placeholder="<?php _e('Enter a valid email address', 'jahani-theme') ?>" required>
                    <button type="submit"><i class="far fa-paper-plane fa-2x"></i></button>
                </div>
            </form>
        </div>
    </div>
</section>
<?php endif; ?>