<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= bloginfo('name') . wp_title() ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?=  wp_meta() ?>
    <?php wp_head(); ?>
</head>
<body>

<section class="section">
	<div class="container-fluid">
		<nav class="navbar">
			<a href="<?=home_url('/')?>" class="logo"><?=bloginfo('name');?></a>
			<?php
			wp_nav_menu( array( 
				'theme_location' => 'header-menu',
				'fallback_cb' => false
			) );
			?>
			<!-- <ul class="menu">
				<li><a href="#">Test 1</a></li>
				<li><a href="#">Test 2</a></li>
				<li><a href="#">Test 3</a></li>
			</ul> -->
		</nav>
	</div>
</section>

<?php get_template_part( 'template-parts/archive/header' ); ?>