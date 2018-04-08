<div class="detail-content single_page">

	<?php 
	if( has_post_thumbnail() ){
		echo '<div class="detail_image_wrapper">';
		the_post_thumbnail( 'cyclone_blog_detail_image' );
		echo '</div>';
	}

	if( !is_attachment() ){ ?>

		<div class="meta">
			<i class="fa fa-calendar"></i> 
			<a href="<?php echo esc_url( home_url() ); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>">
				<?php echo get_the_date(); ?>
			</a> 
			<span class="ml-5 mr-5">|</span> 
			<i class="fa fa-user"></i> 
			<a href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>"> 
				<?php echo esc_html( cyclone_blog_get_display_name( $post ) ); ?>		
			</a> 
			<span class="ml-5 mr-5"> | </span> 
			<i class="fa fa-folder"></i> 
			<?php cyclone_blog_post_categories($post); ?> 
		</div>

		<?php 

	} ?>

	<h3 class="blog-title"><?php the_title(); ?></h3>

	<?php

	do_action( 'cyclone_blog_before_single_content' , $post );

	the_content();

	do_action( 'cyclone_blog_after_single_content' , $post );

	if( has_tag() ){
		echo '<div class="tag-cloud-wrapper clearfix mb-40">
			<div class="tag-cloud-heading">' . esc_html__( 'Tags :' , 'cyclone-blog' ) . ' </div>
			<div class="tagcloud tags clearfix mt-5">';
			echo the_tags('','','');
			echo '</div>
		</div>';
	} ?>

	<?php 
	if( !is_attachment() ){  ?>

		<div class="blog-author">
			<div container>
				<h3><?php esc_html_e( 'About the Author' , 'cyclone-blog' ); ?></h3>
				<div class="row">
					<div class="col-sm-2">
						<?php 
						echo get_avatar( $post->post_author , 150 ); ?>
					</div>
					<div class="col-sm-10">
						<h4>
							<a href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>">
								<?php 
								cyclone_blog_get_display_name( $post );
								?>
							</a>
						</h4>
						<p><?php 
							$userdata = get_user_meta( $post->post_author );
							echo esc_html( $userdata['description'][0] );
							?>
						</p>
					</div>
				</div>
			</div>
		</div>

		<?php 

	} ?>
	
</div>