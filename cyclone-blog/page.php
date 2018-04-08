<?php get_header(); ?>

	<section id="blog" class="blog-section">

		<div class="container">

			<div class="two-tone-layout"><!-- two tone layout start -->

				<div class="col-sm-9 content-wrapper"><!-- primary start -->

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

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

		</div><!-- #main -->
	
	</section><!-- #primary -->

<?php
get_footer();
