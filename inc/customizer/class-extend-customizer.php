<?php

class ModernFurniture_Customizer extends ModernFurniture_AbstractCustomizer {

    public function __construct() {

        parent::__construct();

    }

    public function extend_customize(&$wp_customize) {
        
        $themeSettingPanel = new TeamDevCustomizer($wp_customize,MF_THEME_DOMAIN);
        $themeSettingPanel->add_panel('mf_theme_setting_panel', 'Theme Settings','Theme General Setting',null);
        //Admin Option
        $themeSettingPanel->add_section('mf_theme_option', 'Admin Option Setting','Admin Option Setting','10','mf_theme_setting_panel');
        
        //select for development and production mode
        $themeSettingPanel->add_select_control('mf_underconstruction',
            [
                'default'   =>  'development',
                'type'      =>  'theme_mod'
            ],
            [
                'label'         =>  __('Stage Type', 'nabco'),
                'choices'       => array(
                    'development'       => __( 'Development', 'nabco' ),
                    'stage' => __( 'Staging ', 'nabco' ),
                    'full_prod' => __( 'Full Production ', 'nabco' ),
                ),
                'priority'  =>  '10'
            ]
        );

        //select for development and production mode
        $themeSettingPanel->add_select_control('mf_uc_cover',
        [
            'default'   =>  'all',
            'type'      =>  'theme_mod'
        ],
        [
            'label'         =>  __('UC Cover',MF_THEME_DOMAIN),
            'choices'       => array(
                'wc'       => __( 'Woocommerce', MF_THEME_DOMAIN ),
                'wc_fr'       => __( 'Woocommerce + FrontPage', MF_THEME_DOMAIN ),
                'all' => __( 'All Pages', MF_THEME_DOMAIN ),
            ),
            'priority'  =>  '20'
        ]);

         //select for development and production mode
         $themeSettingPanel->add_select_control('mf_theme_color',
         [
             'default'   =>  'classic_white',
             'type'      =>  'theme_mod'
         ],
         [
             'label'         =>  __('Theme Color',MF_THEME_DOMAIN),
             'choices'       => array(
                 'classic_white'       => __( 'Classic White', MF_THEME_DOMAIN ),
                 'modern_white'       => __( 'Modern White', MF_THEME_DOMAIN ),
                 'groovy_white' => __( 'Groovy White', MF_THEME_DOMAIN ),
             ),
             'priority'  =>  '30'
         ]);
        
         
         //Product Collection
        $themeSettingPanel->add_section('mf_product_collection', 'Front Page Product Collection','Front Page Product Collection','20','mf_theme_setting_panel');
        
        //select for development and production mode
        $themeSettingPanel->add_select_control('mf_prodcol_visible',
        [
            'default'   =>  'show',
            'type'      =>  'theme_mod'
        ],
        [
            'label'         =>  __('Hide Section',MF_THEME_DOMAIN),
            'choices'       => array(
                'hide'       => __( 'Hide', MF_THEME_DOMAIN ),
                'show'       => __( 'Show', MF_THEME_DOMAIN ),
            ),
            'priority'  =>  '5'
        ]);


        $themeSettingPanel->add_basic_control('mf_prodcol_title','text',
            array('default'   =>  'Our Product Collection','type'		=>	'theme_mod'),
            array('label' => __('Title',MF_THEME_DOMAIN),'priority' => '10')
        );

        $themeSettingPanel->add_color_control('mf_prodcol_bgcolor',[
            'default'     => '#fff',
            'transport'   => 'refresh',
        ],
        [
            'label'         =>  __('Product Collection Background Color',MF_THEME_DOMAIN),
            'priority'      =>  '20'
        ]);
        

        //categories
        $args = array(
            'taxonomy' => 'product_cat',
            'orderby' => 'name',
            'show_count' => '0',
            'pad_counts' => '0',
            'hierarchical' => '1',
            'title_li' => '',
            'hide_empty' => '0',
        );
        
        $categories = get_categories($args);
        $choices = array('none' => '--Select Categories--');
        foreach($categories as $category) {
            $choices[$category->slug] = $category->cat_name;
        }

        //**********TOP **************/
        //select for development and production mode
        $themeSettingPanel->add_select_control('mf_prodcol_toplink',
        [
            'default'   =>  'none',
            'type'      =>  'theme_mod'
        ],
        [
            'label'         =>  __('Top Link',MF_THEME_DOMAIN),
            'choices'       => $choices,
            'priority'  =>  '30'
        ]);

        $themeSettingPanel->add_upload_control('mf_prodcol_topimg',
        array('default' => '','type' => 'theme_mod'),
        array(
                'label'         => __('Add Background Image'),
                'description'   =>  __('Maximum 1MB Recommended Size (730 x 330)'),
                'priority'      => '40'));


        //********** SIDE **************/
        $themeSettingPanel->add_select_control('mf_prodcol_sidelink',
        [
            'default'   =>  'none',
            'type'      =>  'theme_mod'
        ],
        [
            'label'         =>  __('Side Link',MF_THEME_DOMAIN),
            'choices'       => $choices,
            'priority'  =>  '50'
        ]);

        $themeSettingPanel->add_upload_control('mf_prodcol_sideimg',
        array('default' => '','type' => 'theme_mod'),
        array(
                'label'         => __('Add Background Image'),
                'description'   =>  __('Maximum 1MB Recommended Size (730 x 330)'),
                'priority'      => '60'));

        
        //********** FOOTER **************/
        $themeSettingPanel->add_select_control('mf_prodcol_footerlink',
        [
            'default'   =>  'none',
            'type'      =>  'theme_mod'
        ],
        [
            'label'         =>  __('Footer Link',MF_THEME_DOMAIN),
            'choices'       => $choices,
            'priority'  =>  '70'
        ]);

        $themeSettingPanel->add_upload_control('mf_prodcol_footerimg',
        array('default' => '','type' => 'theme_mod'),
        array(
                'label'         => __('Add Background Image'),
                'description'   =>  __('Maximum 1MB Recommended Size (730 x 330)'),
                'priority'      => '80'));
        

        //********** MINI SIDE 1 **************/
        $themeSettingPanel->add_select_control('mf_prodcol_thumb1link',
        [
            'default'   =>  'none',
            'type'      =>  'theme_mod'
        ],
        [
            'label'         =>  __('Mini Thumbnail 1 Link',MF_THEME_DOMAIN),
            'choices'       => $choices,
            'priority'  =>  '90'
        ]);

        $themeSettingPanel->add_upload_control('mf_prodcol_thumb1img',
        array('default' => '','type' => 'theme_mod'),
        array(
                'label'         => __('Add Background Image'),
                'description'   =>  __('Maximum 1MB Recommended Size (500 x 300)'),
                'priority'      => '100'));

        //********** MINI SIDE 2 **************/
        $themeSettingPanel->add_select_control('mf_prodcol_thumb2link',
        [
            'default'   =>  'none',
            'type'      =>  'theme_mod'
        ],
        [
            'label'         =>  __('Mini Thumbnail 2 Link',MF_THEME_DOMAIN),
            'choices'       => $choices,
            'priority'  =>  '110'
        ]);

        $themeSettingPanel->add_upload_control('mf_prodcol_thumb2img',
        array('default' => '','type' => 'theme_mod'),
        array(
                'label'         => __('Add Background Image'),
                'description'   =>  __('Maximum 1MB Recommended Size (500 x 300)'),
                'priority'      => '120'));

        //********** MINI SIDE 3 **************/
        $themeSettingPanel->add_select_control('mf_prodcol_thumb3link',
        [
            'default'   =>  'none',
            'type'      =>  'theme_mod'
        ],
        [
            'label'         =>  __('Mini Thumbnail 3 Link',MF_THEME_DOMAIN),
            'choices'       => $choices,
            'priority'  =>  '130'
        ]);

        $themeSettingPanel->add_upload_control('mf_prodcol_thumb3img',
        array('default' => '','type' => 'theme_mod'),
        array(
                'label'         => __('Add Background Image'),
                'description'   =>  __('Maximum 1MB Recommended Size (500 x 300)'),
                'priority'      => '140'));


        //Testimony Section
        $themeSettingPanel->add_section('mf_testimonial', 'Front Page Testimonial','Front Page Testimonial','30','mf_theme_setting_panel');
         
        //select for development and production mode
         $themeSettingPanel->add_select_control('mf_testimonial_visible',
         [
             'default'   =>  'show',
             'type'      =>  'theme_mod'
         ],
         [
             'label'         =>  __('Hide Section',MF_THEME_DOMAIN),
             'choices'       => array(
                 'hide'       => __( 'Hide', MF_THEME_DOMAIN ),
                 'show'       => __( 'Show', MF_THEME_DOMAIN ),
             ),
             'priority'  =>  '5'
         ]);

        $themeSettingPanel->add_basic_control('mf_testimonial_title','text', 
            array('default'   =>  '','type'		=>	'theme_mod'),
            array('label' => __('Title',MF_THEME_DOMAIN),'priority' => '10'));

        $themeSettingPanel->add_upload_control('mf_testimonial_bg',
            array('default' => '','type' => 'theme_mod'),
            array(
                    'label'         => __('Add Background Image'),
                    'description'   =>  __('Maximum 1MB Recommended Size (2100 x 500)'),
                    'priority'      => '20'));
        
        $themeSettingPanel->add_select_control('mf_testimonial_shortcode', [
            'default'   =>  'bizpack',
            'type'      =>  'theme_mod'
        ],
        [
            'label'         =>  __('Short Code',MF_THEME_DOMAIN),
            'choices'       => array(
                'bizpack'       => __( 'Bizpack Testimonial', MF_THEME_DOMAIN ),
                'custom'       => __( 'Custom', MF_THEME_DOMAIN ),
            ),
            'priority'  =>  '30'
        ]);

        $themeSettingPanel->add_basic_control('mf_testimonial_custom_shortcode','text', 
            array('default'   =>  '','type'		=>	'theme_mod'),
            array('label' => __('Custom Shortcode',MF_THEME_DOMAIN),'priority' => '40'));
        

    }   
}

return new ModernFurniture_Customizer();