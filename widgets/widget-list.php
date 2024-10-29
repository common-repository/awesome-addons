<?php 
namespace Awesome_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// List
class Awesome_Addons_Widget_List extends Widget_Base {
 
   public function get_name() {
      return 'list';
   }
 
   public function get_title() {
      return esc_html__( 'List', 'awesome-addones' );
   }
 
   public function get_icon() { 
        return 'eicon-editor-list-ul';
   }
 
   public function get_categories() {
      return [ 'Awesome_Addons' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'section',
         [
            'label' => esc_html__( 'List', 'awesome-addones' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'list_style',
         [
            'label' => __( 'List Style', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'style1',
            'options' => [
               'style1'  => __( 'Style 1', 'awesome-addones' ),
               'style2' => __( 'Style 2', 'awesome-addones' ),
               'style3' => __( 'Style 3', 'awesome-addones' ),
               'none' => __( 'None', 'awesome-addones' ),
            ],
         ]
      );

      $this->add_control(
         'list_icon', [
            'label' => __( 'List Icon', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'label_block' => true,
            'default' => 'fa fa-facebook',
         ]
      );


      $this->add_control(
         'list_icon_bg_color',
         [
            'label' => __( 'Icon Bckground Color', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#f3f3fe'
         ]
      );

      $this->add_control(
         'list_icon_color',
         [
            'label' => __( 'Icon Color', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#696bf3'
         ]
      );

      $this->add_control(
         'linkable_list',
         [
            'label' => __( 'Linkable List', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Enable', 'awesome-addones' ),
            'label_off' => __( 'Desable', 'awesome-addones' ),
            'return_value' => 'yes',
            'default' => 'no',
         ]
      );


      $repeater = new \Elementor\Repeater();

      $repeater->add_control(
         'list_text', [
            'label' => __( 'List Text', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Create your won list',
         ]
      );

      $repeater->add_control(
         'list_url', [
            'label' => __( 'List URL', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#'
         ]
      );
      $this->add_control(
         'lists',
         [
            'label' => __( 'List', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => 'list Item',
            'default' => [
               [
                  'list_text' => 'Dedicated support',
                  'list_url' => '#'
               ],
               [
                  'list_text' => 'Creative minds',
                  'list_url' => '#'
               ],
               [
                  'list_text' => 'Satisfaction Guaranteed',
                  'list_url' => '#'
               ],
               [
                  'list_text' => '24/7 Support',
                  'list_url' => '#'
               ]
            ],
            'lists' => '{{{ lists }}}',
         ]
      );

      $this->add_control(
         'line_height',
         [
            'label' => __( 'Line Height', 'awesome-addones' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range' => [
               'px' => [
                  'min' => 0,
                  'max' => 100,
                  'step' => 1,
               ]
            ],
            'default' => [
               'unit' => 'px',
               'size' => 30,
            ]
         ]
      );

      $this->end_controls_section();
   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>
      
      <ul class="awesome-addones-list <?php echo esc_attr( $settings['list_style'] ); ?>">
         <?php 
         foreach (  $settings['lists'] as $index => $single_list ) { 

         $list_text = $this->get_repeater_setting_key( 'list_text','lists',$index);
         $this->add_inline_editing_attributes( $list_text, 'basic' );

            ?>
            <li <?php echo $this->get_render_attribute_string( $list_text ); ?> style="line-height: <?php echo $settings['line_height']['size'] ?>px">
               <i class="fa-fw <?php echo esc_attr($settings['list_icon']) ?>" style="background: <?php echo esc_attr( $settings['list_icon_bg_color'] ); ?>; color: <?php echo esc_attr( $settings['list_icon_color'] ); ?>;"></i>
               
               <?php if ($settings['linkable_list']  == 'yes'): ?>
                  <a href="<?php echo esc_attr($single_list['list_url']) ?>">
               <?php endif ?>

                  <?php echo esc_html($single_list['list_text']) ?>

               <?php if ($settings['linkable_list'] == 'yes'): ?>
                  </a>
               <?php endif ?>
            </li>
         <?php 
         } ?>
      </ul>

      <?php
   }

}