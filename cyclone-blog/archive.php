<?php
get_header(); ?>

	<section id="blog" class="blog-lists <?php echo esc_html( cyclone_blog_sidebar_position() ); ?>">

	    <div class="container">

		    <div class="row">

		    	<div class="col-sm-9">		    		

					<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>

						<?php
						endif;

						/* Start the Loop */
						echo '<div class="row">';
						while ( have_posts() ) : the_post();

							if( cyclone_blog_sidebar_position() != 'blog-nosidebar-1' ){
								get_template_part( 'template-parts/content', get_post_format() );
							} else {
								get_template_part( 'template-parts/content', 'nosidebar' );
							}

						endwhile;
						echo '</div>';

						cyclone_blog_numbered_pagination();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>					

				</div>

				<?php 
				
				/**
				* Disable sidebar in grid view
				*/

				if( cyclone_blog_sidebar_position() != 'blog-nosidebar-1' ){ ?>
					<div class="col-sm-3">
						<?php get_sidebar(); ?>
			    	</div>
					<?php
				} ?>				

			</div>

		</div>

	</section>

<?php
get_footer();
