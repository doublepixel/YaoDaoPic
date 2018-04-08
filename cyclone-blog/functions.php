<?php
/**
 * Cyclone Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Cyclone_Blog
 */

if ( ! function_exists( 'cyclone_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function cyclone_blog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Cyclone Blog, use a find and replace
		 * to change 'cyclone-blog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'cyclone-blog', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_post_type_support( 'page', 'excerpt' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-formats' , array( 'aside', 'gallery' , 'standard', 'link', 'image' , 'quote', 'status', 'video', 'audio' , 'chat' ));

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'cyclone-blog' ),
			'footer' => esc_html__( 'Footer', 'cyclone-blog' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 172,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		add_image_size( 'cyclone_blog_medium', 300, 300, true );
		add_image_size( 'cyclone_blog_gallery', 500, 400, true );
		add_image_size( 'cyclone_blog_blog_list', 368, 240, true );
		add_image_size( 'cyclone_blog_detail_image', 825, 400, true );
		add_image_size( 'cyclone_blog_portfolio_homepage', 600, 400, true );
		add_image_size( 'cyclone_blog_blog_list_no_sidebar_1', 220, 190, true );
	}
endif;
add_action( 'after_setup_theme', 'cyclone_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cyclone_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cyclone_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'cyclone_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cyclone_blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'cyclone-blog' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'cyclone-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'cyclone_blog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cyclone_blog_scripts() {

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/icons/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'cyclone-blog-main', get_template_directory_uri() . '/assets/css/main.css' );
	wp_enqueue_style( 'cyclone-blog-custom', get_template_directory_uri() . '/assets/css/custom.css' );
	wp_enqueue_style( 'cyclone-blog-component', get_template_directory_uri() . '/assets/css/component.css' );

	wp_enqueue_style( 'cyclone-blog-style2', get_template_directory_uri() . '/assets/css/style.css' , array() , 0.8 );
	wp_enqueue_style( 'cyclone-blog-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );
	wp_enqueue_style( 'cyclone-blog-style', get_stylesheet_uri() );

	$scripts = array(
		array(
			'id' => 'bootstrap',
			'url' => get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js',
			'footer' => true
		),
		array(
			'id' => 'mousescroll',
			'url' => get_template_directory_uri() . '/assets/js/jquery.mousewheel.min.js',
			'footer' => true
		),
		array(
			'id' => 'smoothscroll',
			'url' => get_template_directory_uri() . '/assets/js/smoothscroll.js',
			'footer' => true
		),
		array(
			'id' => 'inview',
			'url' => get_template_directory_uri() . '/assets/js/jquery.inview.min.js',
			'footer' => true
		),
		array(
			'id' => 'isotope',
			'url' => get_template_directory_uri() . '/assets/js/jquery.isotope.min.js',
			'footer' => true
		),
		array(
			'id' => 'slicknav',
			'url' => get_template_directory_uri() . '/assets/js/jquery.slicknav.min.js',
			'footer' => true
		),
		array(
			'id' => 'matchHeight',
			'url' => get_template_directory_uri() . '/assets/js/jquery.matchHeight-min.js',
			'footer' => true
		),
		array(
			'id' => 'custom',
			'url' => get_template_directory_uri() . '/assets/js/custom.js',
			'footer' => true
		)
	);

	cyclone_blog_add_scripts( $scripts );

    wp_add_inline_style( 'cyclone-blog-style', cyclone_blog_inline_style() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cyclone_blog_scripts' );

function cyclone_blog_inline_style(){

	$detail_page_img_position = get_theme_mod( 'detail_page_img_position' , 'left' );

	$inline_css = '';
	if( $detail_page_img_position == 'center' ){
		$inline_css .= "
        .detail-content.single_page img {
			display: block;
			margin-left: auto;
			margin-right: auto;
			text-align: center;
		}";
	}

	return apply_filters( 'cyclone_blog_inline_style', $inline_css );

} 

function cyclone_blog_add_scripts( $scripts ){

	foreach ( $scripts as $key => $value ) {
		wp_enqueue_script( $value['id'] , $value['url'] , array('jquery'), 0.8, $value['footer'] );
	}

}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * WP Comment Walker
 */
require get_template_directory() . '/wp-comment-walker.php';
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

require get_template_directory() . '/inc/plugins/kirki/kirki.php';

/**
* Displays the author name
*/

function cyclone_blog_get_display_name( $post ){

	$user_id = $post->post_author;
	$user_info = get_userdata($user_id);
	echo esc_html( $user_info->display_name );

}

function cyclone_blog_post_categories( $post , $limit = false ){
	
	$post_categories = wp_get_post_categories( $post->ID );
	$cats = array();

	foreach($post_categories as $key =>  $c){

		if( $key == $limit && $limit != false ){
			break;
		}

	    $cat = get_category( $c );
	    $cats[] = '<a href="' . esc_url( get_category_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a>';	    
	}
	
	echo implode( ' , ' , $cats);
	
}

function cyclone_blog_numbered_pagination(){

	echo '<div class="result-paging-wrapper">';
	the_posts_pagination( 
		array(
			'mid_size' 	=> 2,
			'prev_text' => esc_html__( '&laquo; Previous', 'cyclone-blog' ),
			'next_text' => esc_html__( 'Next &raquo;', 'cyclone-blog' ),
		) 
	);
	echo '</div>';

}

function cyclone_blog_get_custom_logo_link(){

	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

	if ( has_custom_logo() ) {
        return $logo[0];
	} else {}
	       

}

function cyclone_blog_get_slider_1(){ 

	$args = array(
		'post_type' => 'post',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'cat' => get_theme_mod( 'slider_category' , '0' )
	);

	$query = new WP_Query( $args );
	$count = 0;

	if( $query->have_posts() ): ?>
	
		<section id="featured-banner" class="featured-banner home-style">

	        <div id="myCarousel" class="carousel slide">

	            <div class="carousel-inner">

	            	<?php 
	            	while( $query->have_posts() ): $query->the_post(); 

	            	$thumbnail_id = get_post_thumbnail_id(); ?>

		                <div class="item <?php echo ( $count == 0 ? 'active' : '' ); ?>">
		                    <!-- Set the first background image using inline CSS below. -->
		                    <div class="fill" style="background-image:url(<?php echo esc_url( cyclone_blog_get_image_link_by_id( $thumbnail_id , 'full' ) ); ?>);"></div>
		                    <div class="carousel-caption">
		                        <h1><?php the_title(); ?></h1>
		                        <?php the_content(); ?>
		                    </div>
		                    <div class="overlay"></div>
		                </div>

	                <?php 
	                $count++;
	                endwhile; ?>

	            </div>

	            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
	                <span class="icon-prev"></span>
	            </a>
	            <a class="right carousel-control" href="#myCarousel" data-slide="next">
	                <span class="icon-next"></span>
	            </a>

	        </div>

	    </section><!-- carousel-inner ends --> 

		<?php

	endif;

	wp_reset_postdata();
}

function cyclone_blog_get_image_link_by_id( $image_id , $size ){
	$image_attributes = wp_get_attachment_image_src( $image_id , $size );
	if( !empty( $image_attributes[0] ) ){
		return $image_attributes[0];
	}
	return;
}

function cyclone_blog_get_all_posts( $post_type = 'post' ){

	$args = array(
		'post_type' => $post_type,
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'orderby' => 'name',
		'order' => 'ASC'
	);

	$query = new WP_Query($args);
	$data = array();

	if( $query->have_posts() ):

		while( $query->have_posts() ): $query->the_post();

			global $post;
			$data[$post->ID] = esc_html( get_the_title() );

		endwhile;

		wp_reset_postdata();

	endif;

	return $data;
}

function cyclone_blog_get_post_categories(){

	$terms = get_terms( array(
	    'taxonomy' => 'category',
	    'hide_empty' => false,
	) );

	if( empty($terms) || !is_array( $terms ) ){
		return array();
	}

	$data = array();
	foreach ( $terms as $key => $value) {
		$term_id = absint( $value->term_id );
		$data[$term_id] =  esc_html( $value->name );
	}
	return $data;

}

function cyclone_blog_sidebar_position(){

	$position =  get_theme_mod( 'sidebar_settings' , 1 );

	switch ( $position ) {
		case 1:
			return 'blog-rightsidebar';
			break;
		
		case 2:
			return 'blog-leftsidebar';
			break;

		case 3:
			return 'blog-nosidebar';
			break;

		default:
			return 'blog-nosidebar-1';
			break;
	}

}

function cyclone_blog_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'excerpt_length' , 60 );
	return $excerpt_length;
}
add_filter( 'excerpt_length', 'cyclone_blog_excerpt_length', 999 );

function cyclone_blog_icon( $post_id ){

	$format = get_post_format( $post_id );

	$custom_icon = get_post_meta( $post_id, 'listing_icon', true );

	if( !empty( $custom_icon ) ){
		return $custom_icon;
	}

	switch ( $format ) {
		case 'aside':
			return 'fa-file-text';
			break;

		case 'gallery':
			return 'fa-camera';
			break;
		
		case 'link':
			return 'fa-link';
			break;	

		case 'image':
			return 'fa-file-image-o';
			break;	

		case 'quote':
			return 'fa-quote-right';
			break;	

		case 'status':
			return 'fa-commenting';
			break;	

		case 'video':
			return 'fa-video-camera';
			break;	

		case 'audio':
			return 'fa-headphones';
			break;	

		case 'chat':
			return 'fa-comments';
			break;		

		default:
			return 'fa-thumb-tack';
			break;
	}

}

add_filter( 'get_search_form', 'cyclone_blog_search_form', 100 );
function cyclone_blog_search_form( $form ) {
    $form = '<form role="search" method="get" id="search-form" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
    	<label for="s">
    		<input placeholder="' . esc_attr__( 'Search ...' , 'cyclone-blog' ) . '" type="text" value="' . esc_attr( get_search_query() ) . '" name="s" id="s" class="search-field" />
    		<input class="search-submit" type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' , 'cyclone-blog' ) .'" />
    	</label>    	
    </form>';

    return $form;
}

function cyclone_blog_get_banner(){ 

	$breadcrumb_bg = get_theme_mod( 'banner_image' );

	if( empty( $breadcrumb_bg ) ){
		$breadcrumb_bg = get_template_directory_uri() . '/assets/images/breadcrum.jpg';		
	} ?>

	<div class="breadcrumb-wrapper homepage_banner" style="<?php echo ( $breadcrumb_bg ? 'background-image: url( ' . esc_url( $breadcrumb_bg ) . ' )' : '' ); ?>">
		<div class="section-title">
			<h1 class="banner_title">
				<?php 
				$banner_title = get_theme_mod( 'banner_title' );
				echo esc_html( $banner_title ? $banner_title : 'Blog' ); ?>
			</h1>
			<p class="banner_subtitle">
				<?php 
				$banner_subtitle = get_theme_mod( 'banner_subtitle' );
				echo esc_html( $banner_subtitle ? $banner_subtitle : "Lorem Ipsum has been the industry's standard dummy" ); 
				?> 
			</p>
		</div>
		<div class="overlay"></div>
	</div>

	<?php
}

function cyclone_blog_get_banner_title(){
	return esc_html( get_theme_mod( 'banner_title' ) );
}

function cyclone_blog_get_banner_subtitle(){
	return esc_html( get_theme_mod( 'banner_subtitle' ) );
}

function cyclone_get_breadcrums(){

	$breadcrumb_bg = get_theme_mod( 'banner_image' );

	if( empty( $breadcrumb_bg ) ){
		$breadcrumb_bg = get_template_directory_uri() . '/assets/images/breadcrum.jpg';		
	} ?>

	<div class="breadcrumb-wrapper" style="<?php echo ( $breadcrumb_bg ? 'background-image: url( ' . esc_url( $breadcrumb_bg ) . ' )' : '' ); ?>">
		<div class="section-title">
			<h1><?php cyclone_blog_get_breadcrum_title(); ?></h1>
			<ol class="breadcrumb">
				<?php cyclone_blog_custom_breadcrumbs(); ?>
			</ol>
		</div>
		<div class="overlay"></div>
	</div>
	<?php
}

function cyclone_blog_get_breadcrum_title(){

	if( is_single() || is_page() ){
		the_title();
	} elseif( is_search() ){
		$search_title = explode( ',' , get_search_query() );
		printf(
			esc_html__( 'Search Results for: %s' , 'cyclone-blog' ),
			esc_html( $search_title[0] )
		);
	} elseif( is_404() ){
		echo esc_html__( 'Error 404' , 'cyclone-blog' );
	} else {
		the_archive_title( '', '' );
	}

}

function cyclone_blog_custom_breadcrumbs() {
       
    // Settings
    $separator          = '/';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = esc_html__( 'Home' , 'cyclone-blog' );;
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'destinations';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
           
        // Home page
        echo '<li class="item-home cyclone-blog-home"><a class="bread-link bread-home" href="' . esc_url( home_url() ) . '">' . esc_html( $home_title ) . '</a></li>';
        
        if ( is_single() ) {
              
            // Get post category info
            $category = get_the_category();

            if(!empty($category)) {
              
                // Get last category post is in
                $last_category =array_pop((array_slice($category, -1)));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'. wp_kses_post( $parents ) .'</li>';
                    //$cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );

                if( !empty( $taxonomy_terms ) && is_array( $taxonomy_terms ) ){

                	$cat_id         = $taxonomy_terms[0]->term_id;
	                $cat_nicename   = $taxonomy_terms[0]->slug;
	                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
	                $cat_name       = $taxonomy_terms[0]->name;

                }
                
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {

                $allowed_html = array(
                	'li' => array(
                		'class' => array()
                	),
                	'a' => array(
                		'href' => array()
                	)
                );

                echo wp_kses( $cat_display , $allowed_html );
                echo '<li class="item-current"><span class="bread-current active">' . esc_html( get_the_title() ) . '</span></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat"><a class="bread-cat" href="' . esc_url( $cat_link ) . '">' . esc_html( $cat_name ) . '</a></li>';

                echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_title() ) . '</span></li>';
              
            } else {
                  
                echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_title() ) . '</span></li>';
                  
            }
              
        } elseif ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><span class="active bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';
               
        } elseif ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                $parents = '';
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent"><a class="bread-parent" href="' . esc_url( get_permalink($ancestor) ) . '">' . esc_html( get_the_title($ancestor) ) . '</a></li>';
                }
                   
                // Display parent pages

                echo wp_kses( 
                	$parents, 
                	array(
                		'li' => array(
                			'class' => array()
                		),
                		'a' => array(
                			'class' => array(),
                			'href' => array(),
                			'title' => array()
                		),
                	)
                );
                   
                // Current page
                echo '<li class="item-current"><span class="active"> ' . esc_html( get_the_title() ) . '</span></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_title() ) . '</span></li>';
                   
            }
               
        } elseif ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current"><span class="active">' . esc_html( $get_term_name ) . '</span></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year"><a class="bread-year" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a></li>';
            //echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month"><a class="bread-month" href="' . esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ) . '">' . esc_html( get_the_time('M') ) . '</a></li>';
           // echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current"><span class="active bread-current"> ' . esc_html( get_the_time('jS') ) . ' ' . esc_html( get_the_time('M') ) . '</span></li>';
               
        } elseif ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year"><a class="bread-year" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a></li>';
            //echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month"><span class="active bread-month">' . esc_html( get_the_time('M') ) . '</span></li>';
               
        } elseif ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_time('Y') ) . ' </span></li>';
               
        } elseif ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );

            /* translators: %s is replaced with "string". It will display the author name */
            echo '<li class="item-current"><span class="active bread-current">' . sprintf( esc_html__( 'Author: %s', 'cyclone-blog' ) , esc_html( $userdata->display_name ) ) . '</span></li>';
           
        } elseif ( is_search() ) {
           
           $search_title = explode( ',' , get_search_query() );

            /* translators: %s is replaced with "string". It will display the search title */
            echo '<li class="item-current"><span class="active bread-current">' . sprintf( esc_html__( 'Search results for: %s' , 'cyclone-blog' ) , esc_html( $search_title[0] ) ) . '</span></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li class="active">' . esc_html__( 'Error 404' , 'cyclone-blog' ) . '</li>';
        } elseif( is_tax() ){

        	$term = get_term_by("slug", get_query_var("term"), get_query_var("taxonomy") );

	        $tmpTerm = $term;
	        $tmpCrumbs = array();
	        while ($tmpTerm->parent > 0){
	            $tmpTerm = get_term($tmpTerm->parent, get_query_var("taxonomy"));
	            $crumb = '<li><a href="' . esc_url( get_term_link($tmpTerm, get_query_var('taxonomy')) ) . '">' . esc_html( $tmpTerm->name ) . '</a></li>';
	            array_push($tmpCrumbs, $crumb);
	        }
	        echo implode('', array_reverse($tmpCrumbs));
	        echo '<li class="item-current item-cat"><span class="active bread-current bread-cat">' . esc_html( $term->name ) . '</span></li>';

        }
                  
    }
       
}

if( !function_exists( 'cyclone_blog_get_copyright_section' ) ){

	function cyclone_blog_get_copyright_section(){

		esc_html_e( 'Copyright &copy;', 'cyclone-blog' ); 
		echo date_i18n( __( 'Y' , 'cyclone-blog' ) ); ?> 
				
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
			<?php bloginfo( 'name' ); ?>
		</a>

		<?php 

		esc_html_e( '. All rights reserved. ', 'cyclone-blog' ); 

		printf( 
			esc_html__( 'Powered %1$s by %2$s', 'cyclone-blog' ), 
			'', 
			'<a href="https://wordpress.org/" target="_blank">WordPress</a>' ); 
		?>

	    <span class="sep"> &amp; </span>

	    <?php esc_html_e( 'Designed by', 'cyclone-blog' ); ?> 

	    <a href="<?php echo esc_url( 'http://cyclonethemes.com/'); ?>" target="_blank">
	    	<?php esc_html_e( 'Cyclone Themes', 'cyclone-blog' ); ?>
	    </a>

	    <?php

	}

}

function cyclone_blog_get_comments_number( $post ){

	$no_of_comments = get_comments_number( $post->ID );

	echo '<a href="' . get_comments_link() . '"><i class="fa fa-comments-o"></i> ';
	echo absint( $no_of_comments );	
	echo '</a>';

}

add_action( 'cyclone_blog_before_single_content', 'cyclone_blog_social_icons_title_content' );
function cyclone_blog_social_icons_title_content( $post ){

	if( false == get_theme_mod( 'social_share_status', true ) ){
		return;
	}

	if( get_theme_mod( 'social_share_position' , 'after_title' ) != 'after_title' ){
		return;
	}

	cyclone_blog_get_social_icons( $post , 'after_title'  );

}

add_action( 'cyclone_blog_after_single_content', 'cyclone_blog_social_icons_after_content' );
function cyclone_blog_social_icons_after_content( $post ){

	if( false == get_theme_mod( 'social_share_status', true ) ){
		return;
	}

	if( get_theme_mod( 'social_share_position' , 'after_title' ) != 'after_content' ){
		return;
	}

	cyclone_blog_get_social_icons( $post , 'after_content' );

}

function cyclone_blog_get_social_icons( $post , $class_name ){

	$link = get_permalink( $post );

	// get featured image
	$thumb_id = get_post_thumbnail_id( $post );
	$thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail', true );
	$thumb_url = $thumb_url_array[0];

	// Get the title
	$title = get_the_title( $post );

	echo '<div class="social_share_icon ' . esc_attr( $class_name ) . '"><a class="facebook_share" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=' . esc_url( $link ) . '&picture=' . esc_url( $thumb_url ) . '&title=' . esc_attr( $title ) . '&quote=' . esc_attr( $title ) . '&description=' . esc_attr( wp_trim_words( $post->post_content, $num_words = 20, $more = ' [ ... ]' )  ) . '"><i class="fa fa-facebook"></i></a>';

	echo '<a class="twitter_share" target="_blank" href="https://twitter.com/intent/tweet?url=' . esc_url( $link ) . '&picture=' . esc_url( $thumb_url ) . '&text=' . esc_attr( $title ) . '"><i class="fa fa-twitter"></i></a>';

	echo '<a target="_blank" class="linkedin_share" href="https://www.linkedin.com/shareArticle?mini=true&url=' . esc_url( $link ) . '&title=' . esc_attr( $title ) . '&summary=' . esc_attr( wp_trim_words( $post->post_content, $num_words = 20, $more = ' [ ... ]' ) ) . '&source="><i class="fa fa-linkedin"></i></a>';

	echo '<a class="google_plus_share" href="https://plus.google.com/share?url=' . esc_url( $link ) . '&picture=' . esc_url( $thumb_url ) . 
	'&title=' . esc_attr( $title ) . '&quote=' . esc_attr( $title ) . '&description=' . esc_attr( wp_trim_words( $post->post_content, $num_words = 20, $more = ' [ ... ]' )  ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></div>';

}

add_action( 'admin_notices', 'cyclone_blog_admin_notice_demo_data' );
function cyclone_blog_admin_notice_demo_data() {

	// Hide cyclone blog admin message
	if( !empty( $_GET['status'] ) && $_GET['status'] == 'cyclone_blog_hide_msg' ){
		update_option( 'cyclone_blog_hide_msg', true );
	}

	$status = get_option( 'cyclone_blog_hide_msg' );
	if( $status == true ){
		return;
	} ?>

    <div class="notice notice-success" style="padding-bottom: 15px;">
        <p>Welcome! Thank you for choosing Cyclone Blog Lite! We have recently released <strong>PRO Version</strong> of <strong>Cyclone Blog</strong> <a target="_blank" href="https://cyclonethemes.com/our_products/cyclone-blog-plus" class="button">click here</a> to buy the PRO Version.</p>
        <a href="<?php echo esc_url( admin_url() . '?status=cyclone_blog_hide_msg' ); ?>" class="button">Hide this Message</a>
    </div>
    
    <?php
}