<?php
/**
 * Initialize the custom Theme Options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.0
 */
function custom_theme_options() {
  
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
    $custom_settings = array(
        'sections' => array(
          array(
            'id'        => 'general_section',
            'title'     => 'General'
          ),
          array(
            'id'        => 'menu_section',
            'title'     => 'Menu Section'
          ),
          array(
            'id'        => 'header_slider_section',
            'title'     => 'Header Slider'
          ),
          array(
            'id'        => 'the_bakery_section',
            'title'     => 'The Bakery'
          ),
          array(
            'id'        => 'bakery_menu_section',
            'title'     => 'Bakery Menu'
          ),
          array(
            'id'        => 'cupon_section',
            'title'     => 'Cupon'
          ),
          array(
            'id'        => 'the_pastry_section',
            'title'     => 'The Pastry'
          ),
          array(
            'id'        => 'requests_section',
            'title'     => 'Requests'
          ),
          array(
            'id'        => 'reviews_section',
            'title'     => 'Reviews'
          ),
          array(
            'id'        => 'footer_section',
            'title'     => 'Footer'
          ),
          array(
            'id'        => 'legal_privacy_section',
            'title'     => 'Legal / Privacy'
          )
        ),
        'settings' => array(
          array(
            'id'        => 'general_bkg',
            'label'     => 'Background',
            'section'   => 'general_section',
            'type'      => 'upload',
            'operator'  => 'and'
          ),
          array(
            'id'        => 'menu_section_logo',
            'label'     => 'Logo',
            'section'   => 'menu_section',
            'type'      => 'upload',
            'operator'  => 'and'
          ),
          array(
            'id'        => 'menu_section_mobile_logo',
            'label'     => 'Mobile Logo',
            'section'   => 'menu_section',
            'type'      => 'upload',
            'operator'  => 'and'
          ),
          array(
            'id'        => 'menu_section_bkg',
            'label'     => 'Background',
            'section'   => 'menu_section',
            'type'      => 'upload',
            'operator'  => 'and'
          ),
          array(
            'id'          => 'facebook_url',
            'label'       => 'Facebook URL',
            'type'        => 'text',
            'section'     => 'menu_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'pinterest_url',
            'label'       => 'Pinterest URL',
            'type'        => 'text',
            'section'     => 'menu_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'twitter_url',
            'label'       => 'Twitter URL',
            'type'        => 'text',
            'section'     => 'menu_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'instagram_url',
            'label'       => 'Instagram URL',
            'type'        => 'text',
            'section'     => 'menu_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'menu_section_content',
            'label'       => 'Content',
            'type'        => 'textarea',
            'section'     => 'menu_section',
            'rows'        => '15',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'header_slider_section_content',
            'label'       => 'Desktop Header Slider Shortcode',
            'type'        => 'text',
            'section'     => 'header_slider_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'mobile_header_slider_section_content',
            'label'       => 'Mobile Header Slider Shortcode',
            'type'        => 'text',
            'section'     => 'header_slider_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'the_bakery_section_title',
            'label'       => 'Title',
            'type'        => 'text',
            'section'     => 'the_bakery_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'the_bakery_section_content',
            'label'       => 'Content',
            'type'        => 'textarea',
            'section'     => 'the_bakery_section',
            'rows'        => '15',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'the_bakery_section_slider',
            'label'       => 'Slider Shortcode',
            'type'        => 'text',
            'section'     => 'the_bakery_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'bakery_menu_section_title',
            'label'       => 'Title',
            'type'        => 'text',
            'section'     => 'bakery_menu_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'bakery_menu_section_content',
            'label'       => 'Content',
            'type'        => 'textarea',
            'section'     => 'bakery_menu_section',
            'rows'        => '15',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'cupon_section_content',
            'label'       => 'Content',
            'type'        => 'textarea',
            'section'     => 'cupon_section',
            'rows'        => '15',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'cupon_section_slider_1',
            'label'       => 'Slider 1',
            'type'        => 'upload',
            'section'     => 'cupon_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'cupon_section_slider_2',
            'label'       => 'Slider 2',
            'type'        => 'upload',
            'section'     => 'cupon_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'cupon_section_slider_3',
            'label'       => 'Slider 3',
            'type'        => 'upload',
            'section'     => 'cupon_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'cupon_section_slider_4',
            'label'       => 'Slider 4',
            'type'        => 'upload',
            'section'     => 'cupon_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'cupon_section_slider_5',
            'label'       => 'Slider 5',
            'type'        => 'upload',
            'section'     => 'cupon_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'the_pastry_section_title',
            'label'       => 'Title',
            'type'        => 'text',
            'section'     => 'the_pastry_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'requests_section_title',
            'label'       => 'Title',
            'type'        => 'text',
            'section'     => 'requests_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'requests_section_content',
            'label'       => 'Content',
            'type'        => 'textarea',
            'section'     => 'requests_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'reviews_section_title',
            'label'       => 'Title',
            'type'        => 'text',
            'section'     => 'reviews_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'reviews_section_background',
            'label'       => 'Desktop Background',
            'type'        => 'upload',
            'section'     => 'reviews_section',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'reviews_section_mobile_background',
            'label'       => 'Mobile Background',
            'type'        => 'upload',
            'section'     => 'reviews_section',
            'operator'    => 'and'
          ),
          array(
            'id'        => 'footer_section_bkg',
            'label'     => 'Desktop Background',
            'section'   => 'footer_section',
            'type'      => 'upload',
            'operator'  => 'and'
          ),
          array(
            'id'        => 'footer_section_mobile_bkg',
            'label'     => 'Mobile Background',
            'section'   => 'footer_section',
            'type'      => 'upload',
            'operator'  => 'and'
          ),
          array(
            'id'        => 'footer_section_content',
            'label'     => 'Content',
            'section'   => 'footer_section',
            'type'      => 'textarea',
            'operator'  => 'and'
          ),
          array(
            'id'        => 'footer_section_mobile_content',
            'label'     => 'Mobile Content',
            'section'   => 'footer_section',
            'type'      => 'textarea',
            'operator'  => 'and'
          ),
          array(
            'id'          => 'legal_privacy_title',
            'label'       => 'Title',
            'type'        => 'text',
            'section'     => 'legal_privacy_section',
            'operator'    => 'and'
          ),
          array(
            'id'        => 'legal_privacy_content',
            'label'     => 'Content',
            'section'   => 'legal_privacy_section',
            'type'      => 'textarea',
            'operator'  => 'and'
          ),
        )
    );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
}