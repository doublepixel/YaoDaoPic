<?php

/**
 * Enqueue style for custom customize control.
 */
add_action( 'customize_controls_enqueue_scripts', 'cyclone_blog_custom_customize_enqueue' );
function cyclone_blog_custom_customize_enqueue() {

	wp_enqueue_style( 'cyclone-blog-customize-controls', get_template_directory_uri() . '/inc/sections/customizer.css' );
}


add_action( 'customize_register', 'cyclone_blog_upgrade_to_pro_msg' );
function cyclone_blog_upgrade_to_pro_msg( $wp_customize ){

	// Load Upgrade to Pro control.
	require_once trailingslashit( get_template_directory() ) . '/inc/sections/controls.php';

	// Register custom section types.
	$wp_customize->register_section_type( 'Cycloneblog_Customize_section' );

	// Register sections.
	$wp_customize->add_section(
		new Cycloneblog_Customize_section(
			$wp_customize,
			'theme_upsell',
			array(
				'priority' => 1,
			)
		)
	);

}

add_action( 'init' , 'cyclone_blog_kirki_fields' );
function cyclone_blog_kirki_fields(){

	/**
	* If kirki is not installed do not run the kirki fields
	*/

	if ( !class_exists( 'Kirki' ) ) {
		return;
	}

	Kirki::add_config( 'cyclone_blog', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );

	Kirki::add_panel( 'theme_options', array(
	    'title'       => esc_html__( 'Theme Options', 'cyclone-blog' ),
	) );

	Kirki::add_section( 'homepage', array(
	    'title'          => esc_html__( 'Blog Homepage', 'cyclone-blog' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'cyclone_blog', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'slider_banner',
		'label'       => esc_html__( 'Banner / Slider', 'cyclone-blog' ),
		'section'     => 'homepage',
		'default'     => 'banner',
		'choices'     => array(
			'banner'   => esc_html__( 'Banner', 'cyclone-blog' ),
			'slider' => esc_html__( 'Slider', 'cyclone-blog' ),
		)
	) );

	Kirki::add_field( 'cyclone_blog', array(
		'type'        => 'text',
		'settings'    => 'banner_title',
		'label'       => esc_html__( 'Banner Title', 'cyclone-blog' ),
		'section'     => 'homepage',
		'active_callback'    => array(
			array(
				'setting'  => 'slider_banner',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
		'partial_refresh' => array(
			'banner_title' => array(
				'selector'        => '.banner_title',
				'render_callback' => 'cyclone_blog_get_banner_title',
			)
		),
	) );

	Kirki::add_field( 'cyclone_blog', array(
		'type'        => 'text',
		'settings'    => 'banner_subtitle',
		'label'       => esc_html__( 'Banner Subtitle', 'cyclone-blog' ),
		'section'     => 'homepage',
		'active_callback'    => array(
			array(
				'setting'  => 'slider_banner',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
		'partial_refresh' => array(
			'banner_subtitle' => array(
				'selector'        => '.banner_subtitle',
				'render_callback' => 'cyclone_blog_get_banner_subtitle',
			)
		),
	) );

	Kirki::add_field( 'cyclone_blog', array(
		'type'        => 'image',
		'settings'    => 'banner_image',
		'label'       => esc_html__( 'Select Banner Image', 'cyclone-blog' ),
		'section'     => 'homepage',
		'active_callback'    => array(
			array(
				'setting'  => 'slider_banner',
				'operator' => '==',
				'value'    => 'banner',
			),
		)
	) );

	Kirki::add_field( 'cyclone_blog', array(
		'type'        => 'select',
		'settings'    => 'slider_category',
		'label'       => esc_html__( 'Select Slider Category', 'cyclone-blog' ),
		'section'     => 'homepage',
		'multiple'    => 1,
		'choices'     => cyclone_blog_get_post_categories(),
		'active_callback'    => array(
			array(
				'setting'  => 'slider_banner',
				'operator' => '==',
				'value'    => 'slider',
			),
		),

	) );

	Kirki::add_field( 'cyclone_blog', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'sidebar_settings',
		'label'       => esc_html__( 'Sidebar', 'cyclone-blog' ),
		'section'     => 'homepage',
		'default'     => '1',
		'choices'     => array(
			'1'   => esc_html__( 'Right Sidebar', 'cyclone-blog' ),
			'2' => esc_html__( 'Left Sidebar', 'cyclone-blog' ),
			'3'  => esc_html__( 'No Sidebar ( Two Columns )', 'cyclone-blog' ),
			'4'  => esc_html__( 'No Sidebar ( Three Columns )', 'cyclone-blog' ),
		),
	) );

	Kirki::add_field( 'cyclone_blog', array(
		'type'        => 'text',
		'settings'    => 'excerpt_length',
		'label'       => esc_html__( 'Excerpt Length', 'cyclone-blog' ),
		'description' => esc_html__( 'Select number of words to display in excerpt', 'cyclone-blog' ),
		'section'     => 'homepage',
		'default'     => 60
	) );

	Kirki::add_field( 'cyclone_blog', array(
		'type'        => 'text',
		'settings'    => 'read_more_text',
		'label'       => esc_html__( 'Read More Text', 'cyclone-blog' ),
		'section'     => 'homepage'
	) );

	Kirki::add_field( 'cyclone_blog', array(
		'type'        => 'checkbox',
		'settings'    => 'hide_author',
		'label'       => esc_html__( 'Hide Author', 'cyclone-blog' ),
		'section'     => 'homepage'
	) );

	Kirki::add_field( 'cyclone_blog', array(
		'type'        => 'checkbox',
		'settings'    => 'hide_category',
		'label'       => esc_html__( 'Hide category', 'cyclone-blog' ),
		'section'     => 'homepage'
	) );

	Kirki::add_section( 'footer_settings', array(
	    'title'          => esc_html__( 'Footer', 'cyclone-blog' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'    => 40,

	) );

	Kirki::add_field( 'cyclone_blog', array(
		'type'        => 'repeater',
		'label'       => esc_html__( 'Social Links', 'cyclone-blog' ),
		'section'     => 'footer_settings',
		'row_label' => array(
			'type' => 'text',
			'value' => esc_html__( 'Social Link', 'cyclone-blog' ),
		),
		'settings'    => 'footer_social_links',
		'fields' => array(
			'icon' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Fontawesome Icon', 'cyclone-blog' ),
			),
			'link' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'cyclone-blog' ),
			),			
		),
	) );	

	Kirki::add_section( 'detail_page', array(
	    'title'          => esc_html__( 'Detail Page', 'cyclone-blog' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'    => 30,
	) );

	Kirki::add_field( 'cyclone_blog', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'detail_page_img_position',
		'label'       => esc_html__( 'Image Position', 'cyclone-blog' ),
		'section'     => 'detail_page',
		'default'     => 'left',
		'choices'     => array(
			'left'   => esc_html__( 'Left', 'cyclone-blog' ),
			'center' => esc_html__( 'Center', 'cyclone-blog' )
		),
	) );

	Kirki::add_field( 'cyclone_blog', array(
		'type'        => 'checkbox',
		'settings'    => 'social_share_status',
		'label'       => esc_html__( 'Show social icons', 'cyclone-blog' ),
		'section'     => 'detail_page',
		'default'     => true,
	) );

	Kirki::add_field( 'cyclone_blog', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'social_share_position',
		'label'       => esc_html__( 'Social Icon Position', 'cyclone-blog' ),
		'section'     => 'detail_page',
		'default'     => 'after_title',
		'choices'     => array(
			'after_title'   => esc_html__( 'After Title', 'cyclone-blog' ),
			'after_content' => esc_html__( 'After Content', 'cyclone-blog' )
		),
		'active_callback' => array(
			array(
				'setting'  => 'social_share_status',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_section( '404_settings', array(
	    'title'          => esc_html__( '404 Page', 'cyclone-blog' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'    => 30,
	) );

	Kirki::add_field( 'cyclone_blog', array(
		'type'        => 'image',
		'settings'    => '404_background_image',
		'label'       => esc_html__( 'Background Image', 'cyclone-blog' ),
		'section'     => '404_settings',
		'default'     => get_template_directory_uri() . '/assets/images/breadcrum.jpg',
		'transport' => 'postMessage',
	    'js_vars'   => array(
			array(
				'element'  => '.error-section',
				'function' => 'css',
				'property' => 'background-image',
			),
		),
		'output' => array(
			array(
				'element'  => '.error-section',
				'property' => 'background-image'
			)
		),
	) );

}