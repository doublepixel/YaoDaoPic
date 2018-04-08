<div id="post-<?php the_ID(); ?>" <?php post_class('col-sm-4 col-xs-4 blog-listing'); ?>>
    <div class="blog-post blog-large">
        <article>
            <header class="entry-header">
            	<?php 
            	if( has_post_thumbnail() ){ ?>
	                <div class="entry-thumbnail">
	                    <?php 
	                    the_post_thumbnail( 
	                    	'cyclone_blog_blog_list', 
	                    	array( 
	                    		'class' => 'img-responsive', 
	                    		'alt' => esc_attr( get_the_title() ) 
	                    	) 
	                    ); ?>
	                    <span class="post-format post-format-video">
	                    	<i class="fa <?php echo esc_attr( cyclone_blog_icon( $post->ID ) ); ?>"></i>
	                    </span>
	                </div>
	                <?php 
	            } ?>
                <div class="entry-date">
                	<a href="<?php echo esc_url( home_url() ); ?>/<?php echo date( 'Y/m' , strtotime( get_the_date() ) ); ?>"><?php echo get_the_date(); ?></a>
                </div>
                <h4 class="entry-title">
                	<a href="<?php the_permalink(); ?>">
                		<?php the_title(); ?>		
                	</a>
                </h4>
            </header>

            <div class="entry-content">

                <?php the_excerpt(); 

                $read_more = get_theme_mod( 'read_more_text' );
                $read_more = ( $read_more ? $read_more : 'Read More' ); ?>

                <div class="red-btn">
                	<a class="btn btn-primary btn-lg" href="<?php the_permalink(); ?>">
                		<?php echo esc_html( $read_more ); ?>
                	</a>
                </div>
            </div>

            <footer class="entry-meta">

            	<?php 
            	$hide_author = get_theme_mod( 'hide_author' , 0 );
            	$hide_category = get_theme_mod( 'hide_category' , 0 );

            	if( $hide_author == 0 ){ ?>
	                <span class="entry-author">
	                	<i class="fa fa-user"></i> 
	                	<a href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>">
	                		<?php cyclone_blog_get_display_name( $post ); ?>
	                	</a>
	                </span>
	                <?php 
                } 

                if( $hide_category == 0 ){ ?>

	                <span class="entry-category">
	                	<i class="fa fa-folder"></i> 
	                	<?php cyclone_blog_post_categories( $post ); ?>
	                </span>

	                <?php 
	            } ?>

                <span class="entry-comments">
                    <?php 
                    cyclone_blog_get_comments_number( $post );
                    ?>
                </span>

            </footer>

        </article>

    </div>

</div>