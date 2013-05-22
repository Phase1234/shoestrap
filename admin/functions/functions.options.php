<?php

add_action('init','of_options');
if (!function_exists('of_options')) {
  function of_options() {
    //Access the WordPress Categories via an Array
    $of_categories    = array();
    $of_categories_obj  = get_categories('hide_empty=0');
    foreach ($of_categories_obj as $of_cat) {
        $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
    $categories_tmp   = array_unshift($of_categories, "Select a category:");

    //Access the WordPress Pages via an Array
    $of_pages       = array();
    $of_pages_obj     = get_pages('sort_column=post_parent,menu_order');
    foreach ($of_pages_obj as $of_page) {
        $of_pages[$of_page->ID] = $of_page->post_name; }
    $of_pages_tmp     = array_unshift($of_pages, "Select a page:");

    //Testing
    $of_options_select  = array("one","two","three","four","five");
    $of_options_radio   = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");

    //Stylesheets Reader
    $alt_stylesheet_path = LAYOUT_PATH;
    $alt_stylesheets = array();

    if ( is_dir($alt_stylesheet_path) )
    {
        if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) )
        {
            while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false )
            {
                if(stristr($alt_stylesheet_file, ".css") !== false)
                {
                    $alt_stylesheets[] = $alt_stylesheet_file;
                }
            }
        }
    }


    //Background Images Reader
    $bg_images_path = STYLESHEETPATH. '/images/bg/'; // change this to where you store your bg images
    $bg_images_url = get_bloginfo('template_url').'/images/bg/'; // change this to where you store your bg images
    $bg_images = array();

    if ( is_dir($bg_images_path) ) {
        if ($bg_images_dir = opendir($bg_images_path) ) {
            while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
                if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
                    $bg_images[] = $bg_images_url . $bg_images_file;
                }
            }
        }
    }


    /*-----------------------------------------------------------------------------------*/
    /* TO DO: Add options/functions that use these */
    /*-----------------------------------------------------------------------------------*/

    //More Options
    $uploads_arr    = wp_upload_dir();
    $all_uploads_path   = $uploads_arr['path'];
    $all_uploads    = get_option('of_uploads');
    $other_entries    = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
    $body_repeat    = array("no-repeat","repeat-x","repeat-y","repeat");
    $body_pos       = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

    // Image Alignment radio box
    $of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center");

    // Image Links to Options
    $of_options_image_link_to = array("image" => "The Image","post" => "The Post");


    /*-----------------------------------------------------------------------------------*/
    /* The Options Array */
    /*-----------------------------------------------------------------------------------*/

    // Set the Options Array
    global $of_options;

    // General Options
    $of_options[] = array(
      "name"      => __("General", "shoestrap"),
      "type"      => "heading"
    );

    $of_options[] = array(
      "name"      => __("Logo", "shoestrap"),
      "desc"      => __("Upload a logo image using the media uploader, or define the URL directly. Use the shortcodes [site_url] or [site_url_secure] for setting default URLs", "shoestrap"),
      "id"        => "logo",
      "std"       => "",
      "type"      => "media"
    );

    $of_options[] = array(
      "name"      => __("No gradients - \"Flat\" look.", "shoestrap"),
      "desc"      => __("This option will disable all gradients in your site, giving it a cleaner look. Default: OFF.", "shoestrap"),
      "id"        => "general_flat",
      "less"      => true,
      "customizer"=> array(),
      "std"       => 0,
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("Border-Radius", "shoestrap"),
      "desc"      => __("You can adjust the corner-radius of all elements in your site here. This will affect buttons, navbars, widgets and many more. Default: 4", "shoestrap"),
      "id"        => "layout_secondary_width",
      "std"       => 4,
      "min"       => 0,
      "step"      => 1,
      "max"       => 50,
      "advanced"  => true,
      "less"      => true,
      "customizer"=> array(),
      "type"      => "sliderui"
    );

    $of_options[] = array(
      "name"      => __("Featured Images on Archives", "shoestrap"),
      "desc"      => __("Display featured Images on post archives (such as categories, tags, month view etc). Default: OFF.", "shoestrap"),
      "id"        => "feat_img_archive",
      "std"       => 0,
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("Archives Featured Image Width", "shoestrap"),
      "desc"      => __("Select the width of your featured images on post archives. Default: 550px", "shoestrap"),
      "id"        => "feat_img_archive_width",
      "std"       => 550,
      "min"       => 100,
      "step"      => 1,
      "max"       => 1600,
      "type"      => "sliderui"
    );

    $of_options[] = array(
      "name"      => __("Archives Featured Image Height", "shoestrap"),
      "desc"      => __("Select the height of your featured images on post archives. Default: 300px", "shoestrap"),
      "id"        => "feat_img_archive_height",
      "std"       => 300,
      "min"       => 50,
      "step"      => 1,
      "max"       => 1000,
      "type"      => "sliderui"
    );

    $of_options[] = array(
      "name"      => __("Featured Images on Posts", "shoestrap"),
      "desc"      => __("Display featured Images on posts. Default: OFF.", "shoestrap"),
      "id"        => "feat_img_post",
      "std"       => 0,
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("Posts Featured Image Width", "shoestrap"),
      "desc"      => __("Select the width of your featured images on single posts. Default: 550px", "shoestrap"),
      "id"        => "feat_img_post_width",
      "std"       => 550,
      "min"       => 100,
      "step"      => 1,
      "max"       => 1600,
      "type"      => "sliderui"
    );

    $of_options[] = array(
      "name"      => __("Posts Featured Image Height", "shoestrap"),
      "desc"      => __("Select the height of your featured images on single posts. Default: 300px", "shoestrap"),
      "id"        => "feat_img_post_height",
      "std"       => 300,
      "min"       => 50,
      "step"      => 1,
      "max"       => 1000,
      "type"      => "sliderui"
    );

    // Layout Settings
    $of_options[] = array(
      "name"      => __("Layout Settings", "shoestrap"),
      "type"      => "heading"
    );

    $of_options[] = array(
      "name"      => __("Main Layout", "shoestrap"),
      "desc"      => __("Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.", "shoestrap"),
      "id"        => "layout",
      "std"       => get_theme_mod('layout', 1),
      "type"      => "images",
      "customizer"=> array(),
      "options"   => array(
        0         => get_template_directory_uri() . '/assets/img/m.png',
        1         => get_template_directory_uri() . '/assets/img/mp.png',
        2         => get_template_directory_uri() . '/assets/img/pm.png',
        3         => get_template_directory_uri() . '/assets/img/psm.png',
        4         => get_template_directory_uri() . '/assets/img/mps.png',
        5         => get_template_directory_uri() . '/assets/img/pms.png',
      )
    );

    $of_options[] = array(
      "name"      => __("Show sidebars on the frontpage", "shoestrap"),
      "desc"      => __("OFF by default. If you want to display the sidebars in your frontpage, turn this ON.", "shoestrap"),
      "id"        => "layout_sidebar_on_front",
      "customizer"=> array(),
      "std"       => 0,
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("Fluid Layout", "shoestrap"),
      "desc"      => __("OFF by default. If you turn this ON, then the layout of your site will become fluid, spanning accross the whole width of your screen.", "shoestrap"),
      "id"        => "fluid",
      "customizer"=> array(),
      "std"       => 0,
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("Primary Sidebar Width", "shoestrap"),
      "desc"      => __("Select the width of the Primary Sidebar. Please note that the values represent grid columns. The total width of the page is 12 columns, so selecting 4 here will make the primary sidebar to have a width of 1/3 (4/12) of the total page width.", "shoestrap"),
      "id"        => "layout_primary_width",
      "std"       => 4,
      "min"       => 2,
      "step"      => 1,
      "max"       => 6,
      "advanced"  => true,
      "customizer"=> array(),
      "type"      => "sliderui"
    );

    $of_options[] = array(
      "name"      => __("Secondary Sidebar Width", "shoestrap"),
      "desc"      => __("Select the width of the Secondary Sidebar. Please note that the values represent grid columns. The total width of the page is 12 columns, so selecting 4 here will make the secondary sidebar to have a width of 1/3 (4/12) of the total page width.", "shoestrap"),
      "id"        => "layout_secondary_width",
      "std"       => 3,
      "min"       => 2,
      "step"      => 1,
      "max"       => 4,
      "advanced"  => true,
      "customizer"=> array(),
      "type"      => "sliderui"
    );

    $of_options[] = array(
      "name"      => __("Tiny Screen Width", "shoestrap"),
      "desc"      => __("The width of Tiny screens. This is used to calculate the responsive layout breakpoints. Suitable for phones. Default: 480px", "shoestrap"),
      "id"        => "layout_screen_tiny",
      "std"       => 480,
      "min"       => 320,
      "step"      => 2,
      "max"       => 1600,
      "advanced"  => true,
      "less"      => true,
      "type"      => "sliderui"
    );

    $of_options[] = array(
      "name"      => __("Small Screen Width", "shoestrap"),
      "desc"      => __("The width of Small screens. This is used to calculate the responsive layout breakpoints. Suitable for tablets and small screens. Default: 768px", "shoestrap"),
      "id"        => "layout_screen_small",
      "std"       => 768,
      "min"       => 320,
      "step"      => 2,
      "max"       => 1600,
      "advanced"  => true,
      "less"      => true,
      "type"      => "sliderui",

    );

    $of_options[] = array(
      "name"      => __("Medium Screen Width", "shoestrap"),
      "desc"      => __("The width of Normal screens. This is used to calculate the responsive layout breakpoints. Suitable for medium screens. Default: 992px", "shoestrap"),
      "id"        => "layout_screen_medium",
      "std"       => 992,
      "min"       => 320,
      "step"      => 2,
      "max"       => 1600,
      "advanced"  => true,
      "less"      => true,
      "type"      => "sliderui"
    );

    $of_options[] = array(
      "name"      => __("Large Screen Width", "shoestrap"),
      "desc"      => __("The width of Large screens. This is used to calculate the responsive layout breakpoints. Suitable for large screens. Default: 1200px", "shoestrap"),
      "id"        => "layout_screen_large",
      "std"       => 1200,
      "min"       => 320,
      "step"      => 2,
      "max"       => 1600,
      "advanced"  => true,
      "less"      => true,
      "type"      => "sliderui"
    );

    $of_options[] = array(
      "name"      => __("Columns Gutter", "shoestrap"),
      "desc"      => __("The space between the columns in your grid. Default: 30px", "shoestrap"),
      "id"        => "layout_gutter",
      "std"       => 30,
      "min"       => 0,
      "step"      => 2,
      "max"       => 100,
      "advanced"  => true,
      "less"      => true,
      "type"      => "sliderui"
    );

    // Colors
    $of_options[] = array(
      "name"      => __("Site Colors", "shoestrap"),
      "type"      => "heading"
    );

    $of_options[] = array(
      "name"      => __("Background Color", "shoestrap"),
      "desc"      => __("Pick a background color for your site. Default: #ffffff.", "shoestrap"),
      "id"        => "color_body_bg",
      "std"       => "#ffffff",
      "less"      => true,
      "customizer"=> array(),
      "type"      => "color"
    );

    $of_options[] = array(
      "name"      => __("Text Color", "shoestrap"),
      "desc"      => __("Pick a color for your site's main text. Default: #333333.", "shoestrap"),
      "id"        => "color_text",
      "std"       => "#333333",
      "less"      => true,
      "customizer"=> array(),
      "type"      => "color"
    );

    $of_options[] = array(
      "name"      => __("Links Color", "shoestrap"),
      "desc"      => __("Pick a color for your site's links. Default: #428bca.", "shoestrap"),
      "id"        => "color_links",
      "std"       => "#428bca",
      "less"      => true,
      "customizer"=> array(),
      "type"      => "color"
    );

    $of_options[] = array(
      "name"      => __("Brand Colors: Primary", "shoestrap"),
      "desc"      => __("Select your primary branding color. This will affect various areas of your site, including the color of your primary buttons, the background of some elements and many more. Default: #428bca.", "shoestrap"),
      "id"        => "color_brand_primary",
      "std"       => "#428bca",
      "less"      => true,
      "customizer"=> array(),
      "type"      => "color"
    );

    $of_options[] = array(
      "name"      => __("Brand Colors: Success", "shoestrap"),
      "desc"      => __("Select your branding color for success messages etc. Default: #5cb85c.", "shoestrap"),
      "id"        => "color_brand_success",
      "std"       => "#5cb85c",
      "less"      => true,
      "customizer"=> array(),
      "type"      => "color"
    );

    $of_options[] = array(
      "name"      => __("Brand Colors: Warning", "shoestrap"),
      "desc"      => __("Select your branding color for warning messages etc. Default: #f0ad4e.", "shoestrap"),
      "id"        => "color_brand_warning",
      "std"       => "#f0ad4e",
      "less"      => true,
      "customizer"=> array(),
      "type"      => "color"
    );

    $of_options[] = array(
      "name"      => __("Brand Colors: Danger", "shoestrap"),
      "desc"      => __("Select your branding color for success messages etc. Default: #d9534f.", "shoestrap"),
      "id"        => "color_brand_danger",
      "std"       => "#d9534f",
      "less"      => true,
      "customizer"=> array(),
      "type"      => "color"
    );

    $of_options[] = array(
      "name"      => __("Brand Colors: Info", "shoestrap"),
      "desc"      => __("Select your branding color for info messages etc. It will also be used for the Search button color as well as other areas where it semantically makes sense to use an \"info\" class. Default: #5bc0de.", "shoestrap"),
      "id"        => "color_brand_info",
      "std"       => "#5bc0de",
      "less"      => true,
      "customizer"=> array(),
      "type"      => "color"
    );

    // NavBar Settings

    $of_options[] = array(
      "name"      => __("NavBar Settings", "shoestrap"),
      "type"      => "heading"
    );

    $of_options[] = array(
      "name"      => __("Show the Main NavBar", "shoestrap"),
      "desc"      => __("ON by default. If you want to hide your main navbar you can do it here. When you do, the main menu will still be displayed but not styled as a navbar. If you want to completely disable it, then please visit the customizer and on the \"Navigation\" section, select \"None\".", "shoestrap"),
      "id"        => "navbar_toggle",
      "std"       => 1,
      "customizer"=> array(),
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("Display Branding (Sitename or Logo)", "shoestrap"),
      "desc"      => __("Default: ON", "shoestrap"),
      "id"        => "navbar_brand",
      "std"       => 1,
      "customizer"=> array(),
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("Use Logo (if available) for branding", "shoestrap"),
      "desc"      => __("If this option is OFF, or there is no logo available, then the sitename will be displayed instead. Default: ON", "shoestrap"),
      "id"        => "navbar_logo",
      "std"       => 1,
      "customizer"=> array(),
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("NavBar Background Color", "shoestrap"),
      "desc"      => __("Pick a background color for the NavBar. Default: #eeeeee.", "shoestrap"),
      "id"        => "navbar_bg",
      "std"       => "#eeeeee",
      "less"      => true,
      "customizer"=> array(),
      "type"      => "color"
    );

    $of_options[] = array(
      "name"      => __("NavBar Text Color", "shoestrap"),
      "desc"      => __("Pick a color for the NavBar text. This applies to menu items and the Sitename (if no logo is uploaded). Default: #777777.", "shoestrap"),
      "id"        => "navbar_color",
      "std"       => "#777777",
      "less"      => true,
      "customizer"=> array(),
      "type"      => "color"
    );

    $of_options[] = array(
      "name"      => __("Display social links in the Navbar.", "shoestrap"),
      "desc"      => __("Display social links in the Navbar. These can be setup in the \"Social\" section on the left. Default: OFF", "shoestrap"),
      "id"        => "navbar_social",
      "customizer"=> array(),
      "std"       => 0,
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("Search", "shoestrap"),
      "desc"      => __("Display a search form in the Navbar. Default: OFF", "shoestrap"),
      "id"        => "navbar_search",
      "customizer"=> array(),
      "std"       => 0,
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("Float menu to the right", "shoestrap"),
      "desc"      => __("Floats the primary navigation to the right. Default: OFF", "shoestrap"),
      "id"        => "navbar_nav_right",
      "std"       => 0,
      "customizer"=> array(),
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("NavBar Positioning", "shoestrap"),
      "desc"      => __("Using this option you can set the navbar to be fixed to top, fixed to bottom or normal. When you're using one of the \"fixed\" options, the navbar will stay fixed on the top or bottom of the page. Default: Normal", "shoestrap"),
      "id"        => "navbar_position",
      "std"       => 0,
      "type"      => "select",
      "customizer"=> array(),
      "options"   => array(
        0         => __( 'Normal', 'shoestrap' ),
        1         => __( 'Fixed to Top', 'shoestrap' ),
        2         => __( 'Fixed to Bottom', 'shoestrap' )
      )
    );

    $of_options[] = array(
      "name"      => __("Navbar Height", "shoestrap"),
      "desc"      => __("Select the height of the Navbar. If you're using a logo then this should be equal or greater than its height.", "shoestrap"),
      "id"        => "navbar_height",
      "std"       => 50,
      "min"       => 10,
      "step"      => 1,
      "max"       => 600,
      "less"      => true,
      "customizer"=> array(),
      "type"      => "sliderui"
    );

    // TODO: Make this a dropdown or an image control so that people can select among more than 1 styles.
    $of_options[] = array(
      "name"      => __("Alternative style for NavBars", "shoestrap"),
      "desc"      => __("You can use an alternative menu style for your NavBars. OFF by default. ", "shoestrap"),
      "id"        => "navbar_altmenu",
      "std"       => 0,
      "customizer"=> array(),
      "type"      => "switch"
    );

    // Jumbotron (Hero)
    $of_options[] = array(
      "name"      => __("Jumbotron", "shoestrap"),
      "type"      => "heading"
    );

    $of_options[] = array(
      "name"      => __("Jumbotron Background Color", "shoestrap"),
      "desc"      => __("Select the background color for your Jumbotron area. Please note that this area will only be visible if you assign a widget to the \"Jumbotron\" Widget Area. Default: #EEEEEE.", "shoestrap"),
      "id"        => "jumbotron_bg",
      "std"       => "#EEEEEE",
      "less"      => true,
      "customizer"=> array(),
      "type"      => "color"
    );

    $of_options[] = array(
      "name"      => __("Background Image", "shoestrap"),
      "desc"      => __("Upload a logo image using the media uploader, or define the URL directly. Use the shortcodes [site_url] or [site_url_secure] for setting default URLs", "shoestrap"),
      "id"        => "jumbotron_bg_img",
      "std"       => "",
      "type"      => "media"
    );

    $of_options[] = array(
      "name"      => __("Background Repeat", "shoestrap"),
      "desc"      => __("Select how (or if) the selected background should be tiled. Default: Tile", "shoestrap"),
      "id"        => "jumbotron_bg_repeat",
      "std"       => "repeat",
      "type"      => "radio",
      "options"   => array(
        'no-repeat'  => __( 'No Repeat', 'shoestrap' ),
        'repeat'     => __( 'Tile', 'shoestrap' ),
        'repeat-x'   => __( 'Tile Horizontally', 'shoestrap' ),
        'repeat-y'   => __( 'Tile Vertically', 'shoestrap' ),
      ),
    );

    $of_options[] = array(
      "name"      => __("Background Alignment", "shoestrap"),
      "desc"      => __("Select how the selected background should be horizontally aligned. Default: Left", "shoestrap"),
      "id"        => "jumbotron_bg_pos_x",
      "std"       => "repeat",
      "type"      => "radio",
      "options"   => array(
        'left'    => __( 'Left', 'shoestrap' ),
        'right'   => __( 'Right', 'shoestrap' ),
        'center'  => __( 'Center', 'shoestrap' ),
      ),
    );

    $of_options[] = array(
      "name"      => __("Jumbotron Text Color", "shoestrap"),
      "desc"      => __("Select the text color for your Jumbotron area. Please note that this area will only be visible if you assign a widget to the \"Jumbotron\" Widget Area. Default: #333333.", "shoestrap"),
      "id"        => "jumbotron_color",
      "std"       => "#333333",
      "less"      => true,
      "customizer"=> array(),
      "type"      => "color"
    );

    $of_options[] = array(
      "name"      => __("Display Jumbotron only on the Frontpage.", "shoestrap"),
      "desc"      => __("When Turned OFF, the Jumbotron area is displayed in all your pages. If you wish to completely disable the Jumbotron, then please remove the widgets assigned to its area and it will no longer be displayed. Default: ON", "shoestrap"),
      "id"        => "jumbotron_visibility",
      "customizer"=> array(),
      "std"       => 1,
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("Full-Width", "shoestrap"),
      "desc"      => __("When Turned ON, the Jumbotron is no longer restricted by the width of your page, taking over the full width of your screen. This option is useful when you have assigned a slider widget on the Jumbotron area and you want its width to be the maximum width of the screen. Default: OFF.", "shoestrap"),
      "id"        => "jumbotron_nocontainer",
      "customizer"=> array(),
      "std"       => 1,
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("Use fittext script for the title.", "shoestrap"),
      "desc"      => __("Use the fittext script to enlarge or scale-down the font-size of the widget title to fit the Jumbotron area. Default: OFF", "shoestrap"),
      "id"        => "jumbotron_title_fit",
      "customizer"=> array(),
      "std"       => 0,
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("Center-align the content.", "shoestrap"),
      "desc"      => __("Turn this on to center-align the contents of the Jumbotron area. Default: OFF", "shoestrap"),
      "id"        => "jumbotron_title_fit",
      "customizer"=> array(),
      "std"       => 0,
      "type"      => "switch"
    );

    // Header
    $of_options[] = array(
      "name"      => __("Header", "shoestrap"),
      "type"      => "heading"
    );

    $of_options[] = array(
      "name"      => __("Display the Header.", "shoestrap"),
      "desc"      => __("Turn this ON to display the header. Default: OFF", "shoestrap"),
      "id"        => "header_toggle",
      "customizer"=> array(),
      "std"       => 0,
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("Display branding on your Header.", "shoestrap"),
      "desc"      => __("Turn this ON to display branding (Sitename or Logo)on your Header. Default: ON", "shoestrap"),
      "id"        => "header_branding",
      "customizer"=> array(),
      "std"       => 1,
      "type"      => "switch"
    );

    $of_options[] = array(
      "name"      => __("Header Background Color", "shoestrap"),
      "desc"      => __("Select the background color for your header. Default: #EEEEEE.", "shoestrap"),
      "id"        => "header_bg",
      "std"       => "#EEEEEE",
      "customizer"=> array(),
      "type"      => "color"
    );

    $of_options[] = array(
      "name"      => __("Header Text Color", "shoestrap"),
      "desc"      => __("Select the text color for your header. Default: #333333.", "shoestrap"),
      "id"        => "header_color",
      "std"       => "#333333",
      "customizer"=> array(),
      "type"      => "color"
    );

    // Footer
    $of_options[] = array(
      "name"      => __("Footer", "shoestrap"),
      "type"      => "heading"
    );

    $of_options[] = array(
      "name"      => __("Footer Background Color", "shoestrap"),
      "desc"      => __("Select the background color for your footer. Default: #ffffff.", "shoestrap"),
      "id"        => "footer_bg",
      "std"       => "#ffffff",
      "customizer"=> array(),
      "type"      => "color"
    );

    $of_options[] = array(
      "name"      => __("Footer Text Color", "shoestrap"),
      "desc"      => __("Select the text color for your footer. Default: #333333.", "shoestrap"),
      "id"        => "footer_color",
      "std"       => "#333333",
      "customizer"=> array(),
      "type"      => "color"
    );

    $of_options[] = array(
      "name"      => __("Footer Text", "shoestrap"),
      "desc"      => __("The text that will be displayed in your footer. Default: your site's name.", "shoestrap"),
      "id"        => "footer_text",
      "std"       => get_bloginfo( 'name' ),
      "type"      => "text"
    );


    // Backup Options
    $of_options[] = array(
      "name"      => __("Backup Options", "shoestrap"),
      "type"      => "heading"
    );

    $of_options[] = array(
      "name"      => __("Backup and Restore Options", "shoestrap"),
      "id"        => "of_backup",
      "std"       => "",
      "type"      => "backup",
      "desc"      => __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', "shoestrap"),
    );

    $of_options[] = array(
      "name"      => __("Transfer Theme Options Data", "shoestrap"),
      "id"        => "of_transfer",
      "std"       => "",
      "type"      => "transfer",
      "desc"      => __('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', "shoestrap"),
    );
  }
}