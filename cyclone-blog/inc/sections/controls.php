<?php
/**
 * Custom Customizer Controls.
 *
 * @package Blog_Way
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Cycloneblog_Customize_section extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'upsell';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<a href="https://www.templatesell.com/item/cyclone-blog-plus-blog-portfolio-wordpress-theme/" class="button button-secondary alignright button-red" target="_blank">
				<?php esc_html_e( 'Upgrade To PRO', 'cyclone-blog' ); ?>	
			</a>

			<a href="http://cyclone-blog-pro.cyclonethemes.com/" class="button button-secondary alignright" target="_blank">
				<?php esc_html_e( 'Demo', 'cyclone-blog' ); ?>	
			</a>

			<a href="https://wordpress.org/support/theme/cyclone-blog" class="button button-secondary alignright" target="_blank">
				<?php esc_html_e( 'Support', 'cyclone-blog' ); ?>		
			</a>

			<a href="https://cyclonethemes.com/our_products/cyclone-blog-plus/" class="button button-secondary alignright" target="_blank">
				<?php esc_html_e( 'FREE VS PRO', 'cyclone-blog' ); ?>		
			</a>

		</li>

	<?php }
}
