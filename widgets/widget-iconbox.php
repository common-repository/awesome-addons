<?php 
namespace Awesome_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Iconbox
class Awesome_Addons_Widget_Iconbox extends Widget_Base {
 
   public function get_name() {
      return 'iconbox';
   }
 
   public function get_title() {
      return esc_html__( 'Iconbox', 'awesome-addones' );
   }
 
   public function get_icon() { 
        return 'eicon-icon-box';
   }
 
   public function get_categories() {
      return [ 'Awesome_Addons' ];
   }
   protected function _register_controls() {

      $this->start_controls_section(
         'iconbox_section',
         [
            'label' => esc_html__( 'Icon Box', 'awesome-addones' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
      
      $this->add_control(
         'style',
         [
            'label' => __( 'Iconbox Style', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'style_1',
            'options' => [
               'style_1'  => __( 'Font Icon', 'awesome-addones' ),
               'style_2' => __( 'Image Icon', 'awesome-addones' )
            ],
         ]
      );

      $this->add_control(
         'icon',
         [
            'label' => __( 'Icon', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'default' => 'fa fa-user',
            'condition' => ['style' => 'style_1']
         ]
      );

      $this->add_control(
         'image',
         [
            'label' => __( 'Choose photo', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => ['style' => 'style_2']
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Lorem Ipsum', 'awesome-addones' ),
         ]
      );

      $this->add_control(
         'text',
         [
            'label' => __( 'Text', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'awesome-addones' ),
         ]
      );

      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'title', 'basic' );
      $this->add_inline_editing_attributes( 'text', 'basic' );
      ?>
      <?php if ($settings['style'] == 'style_1'){ ?>

         <div class="awesome-addones-item-iconbox <?php echo esc_attr($settings['style']); ?>">
            <div class="awesome-addones-item-iconbox-icon">
               <i class="<?php echo esc_attr($settings['icon']) ?> fa-fw" aria-hidden="true"></i>
            </div>
            <div class="awesome-addones-item-iconbox-content">
               <h5 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo esc_html($settings['title']); ?></h5>
               <p <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo esc_html($settings['text']); ?></p>            
            </div>
         </div>

      <?php } elseif ($settings['style'] == 'style_2'){ ?>

         <div class="awesome-addones-item-iconbox <?php echo esc_attr($settings['style']); ?>">
            <div class="awesome-addones-item-iconbox-icon">
               <?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ); ?>
            </div>
            <div class="awesome-addones-item-iconbox-content">
               <h5 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo esc_html($settings['title']); ?></h5>
               <p <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo esc_html($settings['text']); ?></p>     
            </div>
         </div>

      <?php } ?>
         
      
      <?php
   }
 
}