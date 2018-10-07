<?php get_header();?>

<section class="section posts">
<?php
    $counter = 0;
    global $do_not_duplicate;
    $do_not_duplicate = [];
?>
<?php if (have_posts()): while (have_posts()): $counter++; the_post(); ?>
    <?php if ($counter == 1):?>
        <?php if (is_home() || is_singular()): ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="post">
                            <?php the_post_thumbnail('minimo_featured', array('class' => 'fluid post_image')) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="post">
                            <h3 class="post_category"><?=the_category(' | ')?></h3>
                            <h1 class="post_title"><a href="<?=the_permalink()?>"><?=the_title()?></a></h1>
                            <div class="post_description"><?= the_content('') ?></div>
                            <?php if (!is_singular()) : ?>
                                <div class="post_comments_link"><a href="<?=the_permalink()?>"><?php _e('Leave a comment', 'minimo'); ?></a></div>
                            <?php endif; ?>
                            <?=get_template_part( 'template-parts/post/related')?>
                            <?=get_template_part( 'template-parts/comments/content')?>
                        </div>
                    </div>
                </div>
            </div> <!-- .container -->
            <div class="container">
                <div class="row">
        <?php else: ?>
        <div class="container">
            <div class="row">
                <?=get_template_part( 'template-parts/post/content', 'half')?>
        <?php endif; ?>
            
    <?php else: ?>
            <?=get_template_part( 'template-parts/post/content', 'half')?>
    <?php endif; ?>

    <?php if ($counter == 5):?>
            </div> <!-- .row -->
        </div> <!-- .container -->
        <?=get_template_part( 'template-parts/home/newsletter')?>
        <div class="container">
            <div class="row">
    <?php endif; ?>
    <?php $do_not_duplicate[] = $post->ID; // Post published ?>
<?php endwhile; ?>
            <?php if ($counter < 5):?>
                </div> <!-- .row -->
            </div> <!-- .container -->
            <?=get_template_part( 'template-parts/home/newsletter' )?>
            <div class="container">
                <div class="row">
            <?php endif; ?>
            <?=get_template_part( 'template-parts/home/ajax_load_more' )?>
                </div> <!-- .row -->
            </div> <!-- .container -->
<?php else: ?>
<div class="container">
    <p><?php _e('There is no post to show.', 'minimo'); ?></p>
</div>
<?php endif; ?>
</section>

<?php get_footer();?>