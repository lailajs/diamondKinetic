<?php

register_nav_menu( "primary", "Top Navbar" );


// Example of how to use a repeatable box

function example_repeatable_customizer($wp_customize) {
  require 'section_vars.php';  
  require_once 'controller.php';  
  
  $wp_customize->add_section($example_section, array(
    'title' => 'Example Repeaters',
  ));
  
  $wp_customize->add_setting(
    $example_repeater,
    array(
        'sanitize_callback' => 'onepress_sanitize_repeatable_data_field',
        'transport' => 'refresh',
    ) );

  $wp_customize->add_control(
      new Onepress_Customize_Repeatable_Control(
          $wp_customize,
          $example_repeater,
          array(
              'label' 		=> esc_html__('Example Q & A Repeater'),
              'description'   => '',
              'section'       => $example_section,
              'live_title_id' => 'some_quote',
              'title_format'  => esc_html__('[live_title]'), // [live_title]
              'max_item'      => 10, // Maximum item can add
              'limited_msg' 	=> wp_kses_post( __( 'Max items added' ) ),
              'fields'    => array(
                  'some_quote'  => array(
                      'title' => esc_html__('Text'),
                      'type'  =>'text',
                  ),
                  'some_image' => array(
                    'title' => esc_html__('Image'),
                    'type'  =>'media',
                ),
              ),
          )
      )
  );
}
add_action( 'customize_register', 'example_repeatable_customizer' );
