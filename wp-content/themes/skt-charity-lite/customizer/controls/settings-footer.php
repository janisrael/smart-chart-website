<?php


//============================FOOTER SECTION=================================

//Scroll To Top Button
$wp_customize->add_setting('complete[totop_id]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'complete_sanitize_checkbox',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control( new complete_Controls_Toggle_Control( $wp_customize, 'totop_id', array(
				'label' => __('Scroll To Top Button','complete'),
				'description' => __( 'Turn On/Off The button that appears on bottom right when you scroll down to pages.', 'complete' ),
				'section' => 'footercolors_section',
				'settings' => 'complete[totop_id]',
			)) );


// Footer Background Color
$wp_customize->add_setting( 'complete[footer_color_id]', array(
	'type' => 'option',
	'default' => '#1d1d1d',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_color_id', array(
				'label' => __('Footer Background Color','complete'),
				'section' => 'footercolors_section',
				'settings' => 'complete[footer_color_id]',
			) ) );

// Footer Background Image
	$wp_customize->add_setting( 'complete[footer_bg_image]',array( 
		'type' => 'option',
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_bg_image',array(
			'label'       => __( 'Footer Background Image', 'complete' ),
			'section'     => 'footercolors_section',
			'settings'    => 'complete[footer_bg_image]'
				)
			)
	);

//FOOTER Widget Text Color
$wp_customize->add_setting( 'complete[footwdgtxt_color_id]', array(
	'type' => 'option',
	'default' => '#a6a6a6',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footwdgtxt_color_id', array(
				'label' => __('Footer Text Color','complete'),
				'section' => 'footercolors_section',
				'settings' => 'complete[footwdgtxt_color_id]',
			) ) );


//FOOTER Widget Title Color
$wp_customize->add_setting( 'complete[footer_title_color]', array(
	'type' => 'option',
	'default' => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_title_color', array(
				'label' => __('Footer Title Color','complete'),
				'section' => 'footercolors_section',
				'settings' => 'complete[footer_title_color]',
			) ) );
			

$wp_customize->add_setting( 'complete[footer_menu_color]', array(
	'type' => 'option',
	'default' => '#a6a6a6',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_menu_color', array(
				'label' => __('Footer Menu Color','complete'),
				'section' => 'footercolors_section',
				'settings' => 'complete[footer_menu_color]',
			) ) );
			
$wp_customize->add_setting( 'complete[footer_menu_hover_color]', array(
	'type' => 'option',
	'default' => '#00b965',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_menu_hover_color', array(
				'label' => __('Footer Menu Hover Color','complete'),
				'section' => 'footercolors_section',
				'settings' => 'complete[footer_menu_hover_color]',
			) ) );
			
//FOOTER LAYOUT SELECT
$wp_customize->add_setting('complete[foot_layout_id]', array(
		'type' => 'option',
        'default' => '4',
		'sanitize_callback' => 'complete_sanitize_choices',
) );
 
			$wp_customize->add_control( new complete_Control_Radio_Image( $wp_customize, 'foot_layout_id', array(
					'type' => 'radio-image',
					'label' => __('Footer Layout','complete'),
					'section' => 'footercolors_section',
					'settings' => 'complete[foot_layout_id]',
					'choices' => array(
						'4' => array( 'url' => get_template_directory_uri().'/assets/images/foot-4-col.jpg', 'label' => 'Layout 4' ),
					),
			) ));			
			
//----------------------Footer Columns 1----------------------------------
	$wp_customize->add_setting('complete[foot_cols1_title]', array(
		'type' => 'option',
		'default'	=> __('Charity','complete'),
		'sanitize_callback' => 'wp_kses_post',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control(	new WP_Customize_Text_Control( $wp_customize, 'foot_cols1_title', array( 
		'type' => 'text',
		'label'	=> __('Columns 1 Title','complete'),
		'section' => 'footer_columns_section',
		'settings' => 'complete[foot_cols1_title]',
	)) );	
	
$wp_customize->add_setting('complete[foot_cols1_content]', array(
	'type' => 'option',
	'default' => '<p>Pellentesque placerat urna eu iaculis<br> dictum. Donec bibendum pellentesq risus, commodo dapibus eros maximus quis. Curabitur at finibus nulla.</p> [social_area][social icon="facebook" link="#"][social icon="google-plus" link="#"][social icon="twitter" link="#"][social icon="instagram" link="#"][social icon="youtube" link="#"][social icon="linkedin" link="#"][/social_area]',
	'sanitize_callback' => 'wp_kses_post',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control(	new complete_Editor_Control( $wp_customize, 'foot_cols1_content', array( 
				'type' => 'editor',
				'label' => __('Columns 1 Content','complete'), 
				'section' => 'footer_columns_section',
				'settings' => 'complete[foot_cols1_content]',
			)) );	
 	 
//----------------------Footer Columns 1----------------------------------		

//----------------------Footer Columns 2----------------------------------
	$wp_customize->add_setting('complete[foot_cols2_title]', array(
		'type' => 'option',
		'default'	=> __('Latest News','complete'),
		'sanitize_callback' => 'wp_kses_post',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control(	new WP_Customize_Text_Control( $wp_customize, 'foot_cols2_title', array( 
		'type' => 'text',
		'label'	=> __('Columns 2 Title','complete'),
		'section' => 'footer_columns_section',
		'settings' => 'complete[foot_cols2_title]',
	)) );	
	
$wp_customize->add_setting('complete[foot_cols2_content]', array(
	'type' => 'option',
	'default' => '[footerposts show="5"]',
	'sanitize_callback' => 'wp_kses_post',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control(	new complete_Editor_Control( $wp_customize, 'foot_cols2_content', array( 
				'type' => 'editor',
				'label' => __('Columns 2 Content','complete'), 
				'section' => 'footer_columns_section',
				'settings' => 'complete[foot_cols2_content]',
			)) );	
 	 
//----------------------Footer Columns 2----------------------------------	

//----------------------Footer Columns 3----------------------------------
	$wp_customize->add_setting('complete[foot_cols3_title]', array(
		'type' => 'option',
		'default'	=> __('Quick Links','complete'),
		'sanitize_callback' => 'wp_kses_post',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control(	new WP_Customize_Text_Control( $wp_customize, 'foot_cols3_title', array( 
		'type' => 'text',
		'label'	=> __('Columns 3 Title','complete'),
		'section' => 'footer_columns_section',
		'settings' => 'complete[foot_cols3_title]',
	)) );	
	
$wp_customize->add_setting('complete[foot_cols3_content]', array(
	'type' => 'option',
	'default' => '[footermenu menu="footer"]',
	'sanitize_callback' => 'wp_kses_post',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control(	new complete_Editor_Control( $wp_customize, 'foot_cols3_content', array( 
				'type' => 'editor',
				'label' => __('Columns 3 Content','complete'), 
				'section' => 'footer_columns_section',
				'settings' => 'complete[foot_cols3_content]',
			)) );	
 	 
//----------------------Footer Columns 3----------------------------------	

//----------------------Footer Columns 4----------------------------------
	$wp_customize->add_setting('complete[foot_cols4_title]', array(
		'type' => 'option',
		'default'	=> __('Contact Info','complete'),
		'sanitize_callback' => 'wp_kses_post',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control(	new WP_Customize_Text_Control( $wp_customize, 'foot_cols4_title', array( 
		'type' => 'text',
		'label'	=> __('Columns 4 Title','complete'),
		'section' => 'footer_columns_section',
		'settings' => 'complete[foot_cols4_title]',
	)) );	
	
$wp_customize->add_setting('complete[foot_cols4_content]', array(
	'type' => 'option',
	'default' => '<p>Street 238,52 tempor<br>Donec ultricies mattis nulla, suscipitris<br> utmattis nulla</p> 
		<p><span>Phone:</span> 1.800.555.6789 <br>
		<span>E-mail:</span> <a href="mailto:support@sitename.com">support@sitename.com</a> <br>
		<span>Website:</span> <a href="https://www.sktthemes.net">sktthemes.net</a></p>',
	'sanitize_callback' => 'wp_kses_post',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control(	new complete_Editor_Control( $wp_customize, 'foot_cols4_content', array( 
				'type' => 'editor',
				'label' => __('Columns 4 Content','complete'), 
				'section' => 'footer_columns_section',
				'settings' => 'complete[foot_cols4_content]',
			)) );	
 	 
//----------------------Footer Columns 4----------------------------------	