<?php if (is_new_day() && !is_day()): ?>
    <div class="col-xs-12">
        <h2 class="center-xs post_title">
        <?php 
        $archive_year  = get_the_time('Y'); 
        $archive_month = get_the_time('m'); 
        $archive_day   = get_the_time('d'); 
        ?>
            <a href="<?= get_day_link( $archive_year, $archive_month, $archive_day) ?>">
                <?php the_date(); ?>
            </a>
        </h2>
    </div>
<?php endif; ?>