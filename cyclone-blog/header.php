<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class('sidebar'); ?>>

<header id="masthead">

	<?php 
	do_action( 'cyclone_blog_top_header' );
	?>
	
    <nav class="navbar navbar-default with-slicknav">
        <div id="navbar" class="collapse navbar-collapse navbar-arrow">
            <div class="container">
                <a class="logo pull-left " href="<?php echo esc_url( home_url('/') ); ?>">

                	<?php 
                	if ( has_custom_logo() ) { ?>
                    	<img src="<?php echo esc_url( cyclone_blog_get_custom_logo_link() ); ?>" alt="Logo">
                    	<?php 
                    } else {
                    	echo '<h3>' . esc_html( get_bloginfo( 'name' ) ) . '</h3>';
                    	echo '<p>' . esc_html( get_bloginfo( 'description' ) ) . '</p>';
                    } ?>

                </a>

                <?php 
                wp_nav_menu( array(
				    'theme_location' => 'menu-1',
				    'menu_class'=>'nav navbar-nav pull-right',
				    'container' => 'ul',
				    'menu_id' => 'responsive-menu'
				) );
                ?>

            </div>

        </div><!--/.nav-collapse -->

        <div id="slicknav-mobile" class="<?php echo ( !has_custom_logo() ? 'text-logo' : '' ); ?>"></div>

    </nav> 
</header><!-- header section end -->

<?php 
if( is_page_template( 'homepage.php' ) || is_404() || is_page_template( 'contact-us.php' ) ){
	// no breadcrum
} elseif( !is_front_page() ){
	cyclone_get_breadcrums();
} else { 
	// Slider or Banner
	if( get_theme_mod( 'slider_banner' , 'banner' ) == 'slider' ){
		cyclone_blog_get_slider_1();
	} else {
		cyclone_blog_get_banner();
	}
} 
?>