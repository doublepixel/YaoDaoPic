<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cyclone_Blog
 */

?>

<footer id="footer" class="footer-style"><!-- footer section start -->
    <div class="container">

        <?php 
        $social_icons = get_theme_mod( 'footer_social_links' );

        if( !empty( $social_icons ) && is_array( $social_icons ) ){

            echo '<ul class="social-net">';
            $count = 0.2;
            foreach( $social_icons as $value ){
                echo '<li class="wow fadeInUp animated" data-wow-delay="' . esc_html( $count ) . 's" data-wow-offset="50"><a href="' . esc_html( $value['link'] ) . '"><i class="fa ' . esc_html( $value['icon'] ) . '"></i></a></li>';
                $count = $count + 0.2;
            }
            echo '</ul>';

        }

        wp_nav_menu( array(
            'theme_location' => 'footer',
            'menu_class'=>'inline-menu',
            'container' => 'ul',
            'depth' => 1
        ) );
        ?>

        <p class="copyright">
            <?php cyclone_blog_get_copyright_section(); ?>
        </p>
    </div>
</footer><!--footer section end--> 

<?php wp_footer(); ?>

<!-- start Back To Top -->
<div id="back-to-top">
    <a href="javascript:void(0)"><i class="fa fa-angle-up"></i></a>
</div>
<!-- end Back To Top -->

</body>
</html>
