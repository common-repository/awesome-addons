<?php 
namespace Awesome_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Pricing
class Awesome_Addons_Widget_Pricing extends Widget_Base {
 
   public function get_name() {
      return 'pricing';
   }
 
   public function get_title() {
      return esc_html__( 'Pricing', 'awesome-addones' );
   }
 
   public function get_icon() { 
        return 'eicon-price-table';
   }
 
   public function get_categories() {
      return [ 'Awesome_Addons' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'pricing_section',
         [
            'label' => esc_html__( 'Pricing', 'awesome-addones' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'style',
         [
            'label' => __( 'Icon Box Style', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'style_1',
            'options' => [
               'style_1'  => __( 'Card', 'awesome-addones' ),
               'style_2' => __( 'Tabs', 'awesome-addones' ),
               'none' => __( 'None', 'awesome-addones' )
            ],
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'title', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Standard Plan',
            'condition' => ['style' => 'style_1']
         ]
      );

      $this->add_control(
         'icon',
         [
            'label' => __( 'icon', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'label_block' => true,
            'default' => 'fa fa-shield',
            'condition' => ['style' => 'style_1']
         ]
      );

      $this->add_control(
         'price',
         [
            'label' => __( 'Price', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '70',
            'condition' => ['style' => 'style_1']
         ]
      );
      
      $this->add_control(
         'currency',
         [
            'label' => __( 'Currency', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'default' => 'fa fa-dollar',
            'include' => [
               'fa fa-bitcoin',
               'fa fa-btc',
               'fa fa-cny',
               'fa fa-dollar',
               'fa fa-eur',
               'fa fa-euro',
               'fa fa-gbp',
               'fa fa-ils',
               'fa fa-inr',
               'fa fa-jpy',
               'fa fa-krw',
               'fa fa-money',
               'fa fa-rmb',
               'fa fa-rouble',
               'fa fa-rub',
               'fa fa-ruble',
               'fa fa-rupee',
               'fa fa-shekel',
               'fa fa-sheqel',
               'fa fa-try',
               'fa fa-turkish-lira',
               'fa fa-usd',
               'fa fa-won',
               'fa fa-yen',
            ],
         ]
      );
      
      $this->add_control(
         'package',
         [
            'label' => __( 'Package', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'Yealry',
            'options' => [
               'Daily'  => __( 'Daily', 'awesome-addones' ),
               'Weekly'  => __( 'Weekly', 'awesome-addones' ),
               'Monthly' => __( 'Monthly', 'awesome-addones' ),
               'Yealry' => __( 'Yealry', 'awesome-addones' ),
               'none' => __( 'None', 'awesome-addones' )
            ],
         ]
      );

      $feature = new \Elementor\Repeater();

      $feature->add_control(
         'feature',
         [
            'label' => __( 'Feature', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( '10 Free Domain Names', 'awesome-addones' )
         ]
      );

      $this->add_control(
         'feature_list',
         [
            'label' => __( 'Feature List', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $feature->get_controls(),
            'default' => [
               [
                  'feature' => __( '5GB Storage Space', 'awesome-addones' )
               ],
               [
                  'feature' => __( '20GB Monthly Bandwidth', 'awesome-addones' )
               ],
               [
                  'feature' => __( 'My SQL Databases', 'awesome-addones' )
               ],
               [
                  'feature' => __( '100 Email Account', 'awesome-addones' )
               ],
               [
                  'feature' => __( '10 Free Domain Names', 'awesome-addones' )
               ]
            ],
            'title_field' => '{{{ feature }}}',
            'condition' => ['style' => 'style_1']
         ]
      );

      $this->add_control(
         'btn_text',
         [
            'label' => __( 'button text', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Select Plan',
            'condition' => ['style' => 'style_1']
         ]
      );

      $this->add_control(
         'btn_url',
         [
            'label' => __( 'button URL', 'awesome-addones' ),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => __( 'https://example.com', 'awesome-addones' ),
            'show_external' => true,
            'default' => [
               'url' => '#',
               'is_external' => true,
               'nofollow' => true,
            ],
            'condition' => ['style' => 'style_1']
         ]
      );

      $this->add_control(
         'recommended',
         [
            'label' => __( 'Recommended', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'On', 'awesome-addones' ),
            'label_off' => __( 'Off', 'awesome-addones' ),
            'return_value' => 'on',
            'default' => 'off',
         ]
      );

      $this->end_controls_section();
   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'title', 'basic' );
      $this->add_inline_editing_attributes( 'price', 'basic' );
      $this->add_inline_editing_attributes( 'btn_text', 'basic' );
      $this->add_inline_editing_attributes( 'btn_url', 'basic' );

      $target = $settings['website_link']['is_external'] ? ' target="_blank"' : '';
      $nofollow = $settings['website_link']['nofollow'] ? ' rel="nofollow"' : '';

      ?>

      <div class="awesome-addones-pricing-table <?php if ( 'on' == $settings['recommended'] ){ echo"recommended"; }?>">
         <h6 class="type elementor-inline-editing" <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo esc_html( $settings['title'] ); ?></h6>
         <h1 class="awesome-addones-price elementor-inline-editing" <?php echo $this->get_render_attribute_string( 'price' ); ?>>
            <span class="awesome-addones-currency <?php echo esc_attr($settings['currency']) ?>"></span>
            <?php echo esc_html( $settings['price'] ); ?>
         </h1>
         <span><?php echo esc_html( $settings['package'] ); ?></span>
         <ul>
            <?php 
               foreach (  $settings['feature_list'] as $index => $feature ) { 
               $feature_inline = $this->get_repeater_setting_key( 'feature','feature_list',$index);
               $this->add_inline_editing_attributes( $feature_inline, 'basic' );
            ?>
               <li <?php echo $this->get_render_attribute_string( $feature_inline ); ?>><?php echo $feature['feature'] ?></li>
            <?php 
            } ?>
         </ul>
         <a class="elementor-inline-editing awesome-addones-buy-button" href="<?php echo esc_attr( $settings['btn_url'] ) ?>" <?php echo $this->get_render_attribute_string( 'btn_text' ); ?><?php echo esc_attr( $target ) . esc_attr( $nofollow ) ?>><?php echo esc_html( $settings['btn_text'] ) ?></a>
      </div>

      <?php
   }
 
}