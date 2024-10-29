<?php
namespace Awesome_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Title
class Awesome_Addons_Widget_Counter extends Widget_Base {
 
   public function get_name() {
      return 'counter';
   }
 
   public function get_title() {
      return esc_html__( 'Counter', 'awesome-addones' );
   }
 
   public function get_icon() { 
        return 'eicon-counter';
   }
 
   public function get_categories() {
      return [ 'Awesome_Addons' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'counter_section',
         [
            'label' => esc_html__( 'Counter', 'awesome-addones' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Download', 'awesome-addones' ),
         ]
      );   

      $this->add_control(
         'count',
         [
            'label' => __( 'Counter Value', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '9652',
         ]
      );
      
      $this->add_control(
         'icon',
         [
            'label' => __( 'Icon', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'label_block' => true,
            'default' => 'fa fa-cloud-download',
         ]
      );

      $this->add_control(
         'icon_color',
         [
            'label' => __( 'Background Color', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#00b9e8',
         ]
      );

      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'title', 'basic' );
      $this->add_inline_editing_attributes( 'count', 'basic' );
      $this->add_inline_editing_attributes( 'icon', 'basic' );
      $this->add_inline_editing_attributes( 'icon_color', 'basic' );
      ?>

      <div class="awesome-addones-counter">
         <div class="awesome-addones-counter-icon" style="background: <?php echo esc_attr($settings['icon_color']) ?>;">
            <i class="<?php echo esc_attr($settings['icon']) ?> fa-fw" aria-hidden="true"></i>
         </div>
         <h5 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo esc_html($settings['title']); ?></h5>
         <p class="awesome-addones-count" <?php echo $this->get_render_attribute_string( 'count' ); ?>><?php echo esc_html($settings['count']); ?></p>
      </div>
      <?php
   }
 
}