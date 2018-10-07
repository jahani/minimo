<div class="col-md-6 col-xs-12">
    <div id="<?php the_ID(); ?>" class="post" <?php post_class(); ?>>
        <?php the_post_thumbnail('minimo_thumbnail', array('class' => 'fluid post_image')) ?>
        <h3 class="post_category"><?=the_category(' | ')?></h3>
        <h1 class="post_title"><a href="<?=the_permalink()?>"><?=the_title()?></a></h1>
        <div class="post_description"><?php the_excerpt(); ?></div>
    </div>
</div>