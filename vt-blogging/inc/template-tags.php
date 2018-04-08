<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package VT Blogging
 */

/**
 * Search Filter 
 */
if ( ! function_exists( 'vt_blogging_search_filter' ) ) :

function vt_blogging_search_filter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}

add_filter('pre_get_posts','vt_blogging_search_filter');

endif;

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
if ( ! function_exists( 'vt_blogging_custom_excerpt_length' ) ) :

function vt_blogging_custom_excerpt_length( $length ) {
    return get_theme_mod('entry-excerpt-length', '38');
}
add_filter( 'excerpt_length', 'vt_blogging_custom_excerpt_length', 999 );

endif;

/**
 * Customize excerpt more.
 */
if ( ! function_exists( 'vt_blogging_excerpt_more' ) ) :

function vt_blogging_excerpt_more( $more ) {
   return '... ';
}
add_filter( 'excerpt_more', 'vt_blogging_excerpt_more' );

endif;

/**
 * Display the first (single) category of post.
 */
if ( ! function_exists( 'vt_blogging_first_category' ) ) :
function vt_blogging_first_category() {
    $category = get_the_category();
    if ($category) {
      echo '<a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'vt-blogging' ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ';
    }    
}
endif;

/**
 * Footer info, copyright information
 */
if ( ! function_exists( 'vt_blogging_footer' ) ) :
function vt_blogging_footer() {
   $site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';

   $wp_link = '<a href="'.esc_url("http://wordpress.org").'" target="_blank" title="' . esc_attr__( 'WordPress', 'vt-blogging' ) . '"><span>' . __( 'WordPress', 'vt-blogging' ) . '</span></a>';

   $tg_link =  '<a href="'.esc_url("http://volthemes.com/theme/vt-blogging-pro/").'" target="_blank" title="'.esc_attr__( 'VolThemes', 'vt-blogging' ).'"><span>'.__( 'VolThemes', 'vt-blogging') .'</span></a>';

   $default_footer_value = sprintf( __( 'Copyright &copy; %1$s %2$s. All rights reserved.', 'vt-blogging' ), date_i18n( 'Y' ), $site_link ).'<br>'.sprintf( __( 'Theme: %1$s by %2$s.', 'vt-blogging' ), 'VT Blogging', $tg_link ).' '.sprintf( __( 'Powered by %s.', 'vt-blogging' ), $wp_link );

   $vt_blogging_footer = '<div class="site-info">'.$default_footer_value.'</div>';
   echo $vt_blogging_footer;
}
endif;
add_action( 'vt_blogging_footer', 'vt_blogging_footer', 10 );

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'vt_blogging_categorized_blog' ) ) :

function vt_blogging_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'vt_blogging_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'vt_blogging_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so vt_blogging_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so vt_blogging_categorized_blog should return false.
        return false;
    }
}

endif;

/**
 * Flush out the transients used in vt_blogging_categorized_blog.
 */
if ( ! function_exists( 'vt_blogging_category_transient_flusher' ) ) :

function vt_blogging_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'vt_blogging_categories' );
}
add_action( 'edit_category', 'vt_blogging_category_transient_flusher' );
add_action( 'save_post',     'vt_blogging_category_transient_flusher' );

endif;