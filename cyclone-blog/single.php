<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Cyclone_Blog
 */

get_header(); ?>

	<section id="blog" class="blog-section blog-detail-page">

		<div class="container">

			<div class="two-tone-layout"><!-- two tone layout start -->

				<div class="col-sm-9 content-wrapper"><!-- primary start -->

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'detail' );

						the_post_navigation();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</div>

				<div class="col-sm-3">
					<?php 
					get_sidebar(); 
					?>
				</div>

			</div>

		</div>

	</section>

<?php
get_footer();
