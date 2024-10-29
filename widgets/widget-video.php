<?php 
namespace Awesome_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// video
class Awesome_Addons_Widget_video extends Widget_Base {
 
   public function get_name() {
      return 'video';
   }
 
   public function get_title() {
      return esc_html__( 'Video', 'awesome-addones' );
   }
 
   public function get_icon() { 
        return 'eicon-video-camera';
   }
 
   public function get_categories() {
      return [ 'Awesome_Addons' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'video_section',
         [
            'label' => esc_html__( 'Video Image', 'awesome-addones' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'image',
         [
            'label' => __( 'Choose Photo', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );

      $this->add_control(
         'overlay',
         [
            'label' => __( 'Overlay', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#',
         ]
      );

      $this->add_control(
         'play_button',
         [
            'label' => __( 'Play Button URL', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::TEXT
         ]
      );

      $this->end_controls_section();
   }
   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <div class="awesome-addones-video-popup" style="background-image: url( <?php echo esc_url( $settings['image']['url'] ); ?> );">
         <div class="awesome-addones-video-popup-overlay" style="background: <?php echo esc_attr( $settings['overlay'] ); ?>;">
            <a class="awesome-addones-popup-video" href="<?php echo esc_url($settings['play_button']); ?>">
               <span class="awesome-addones-popup-icon"><i class="fa fa-play"></i></span>
            </a>
         </div>
      </div>
      <?php
   }
}