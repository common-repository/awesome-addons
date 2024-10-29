<?php
namespace Awesome_Addons;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_categories
	 *
	 * Register new category for widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'Awesome_Addons',
			[
				'title' => esc_html__( 'Awesome Addons', 'awesome-addones' ),
				'icon' => 'fa fa-plug',
			]
		);

	}


	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_enqueue_style( 'bootstrap', plugins_url( '/assets/css/bootstrap.min.css', __FILE__ ) );
		wp_enqueue_style( 'awesome-addones-color', plugins_url( '/assets/css/color.css', __FILE__ ) );
		wp_enqueue_style( 'magnific-popup', plugins_url( '/assets/css/magnific-popup.css', __FILE__ ) );
		wp_enqueue_style( 'awesome-addones', plugins_url( '/assets/css/infobox.css', __FILE__ ) );

		wp_enqueue_script( 'bootstrap', plugins_url( '/assets/js/bootstrap.min.js', __FILE__ ) , [ 'jquery' ], false, true );
		wp_enqueue_script( 'magnific-popup', plugins_url( '/assets/js/jquery.magnific-popup.min.js', __FILE__ ) , [ 'jquery' ], false, true );
		wp_enqueue_script( 'counterup', plugins_url( '/assets/js/jquery.counterup.min.js', __FILE__ ) , [ 'jquery' ], false, true );
		wp_enqueue_script( 'waypoints', plugins_url( '/assets/js/jquery.waypoints.min.js', __FILE__ ) , [ 'jquery' ], false, true );
		wp_enqueue_script( 'isotope', plugins_url( '/assets/js/isotope.pkgd.min.js', __FILE__ ) , [ 'jquery' ], false, true );
		wp_enqueue_script( 'slick', plugins_url( '/assets/js/slick.min.js', __FILE__ ) , [ 'jquery' ], false, true );
		wp_enqueue_script( 'awesome-addones', plugins_url( '/assets/js/infobox.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/widget-accordion.php' );
		require_once( __DIR__ . '/widgets/widget-blog.php' );
		require_once( __DIR__ . '/widgets/widget-button.php' );
		require_once( __DIR__ . '/widgets/widget-counter.php' );
		require_once( __DIR__ . '/widgets/widget-iconbox.php' );
		require_once( __DIR__ . '/widgets/widget-list.php' );
		require_once( __DIR__ . '/widgets/widget-pricing.php' );
		require_once( __DIR__ . '/widgets/widget-team.php' );
		require_once( __DIR__ . '/widgets/widget-testimonials.php' );
		require_once( __DIR__ . '/widgets/widget-video.php' );
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ Awesome_Addons_Widget_Accordion() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ Awesome_Addons_Widget_Blog() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ Awesome_Addons_Widget_Button() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ Awesome_Addons_Widget_Counter() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ Awesome_Addons_Widget_Iconbox() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ Awesome_Addons_Widget_List() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ Awesome_Addons_Widget_Pricing() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ Awesome_Addons_Widget_Team() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ Awesome_Addons_Widget_Testimonials() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ Awesome_Addons_Widget_video() );
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {
		add_action( 'elementor/elements/categories_registered', [ $this, 'widget_categories' ] );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}
}

// Instantiate Plugin Class
Plugin::instance();