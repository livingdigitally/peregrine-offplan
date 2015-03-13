<?php
/*-----------------------------------------------------------------------------------*/
/*  location select field's names array
/*-----------------------------------------------------------------------------------*/
$location_select_names = array( 'location', 'child-location', 'grandchild-location', 'great-grandchild-location' );


/*-----------------------------------------------------------------------------------*/
/*	Basic Theme Setup
/*-----------------------------------------------------------------------------------*/
if (!function_exists('inspiry_theme_setup')) {
    function inspiry_theme_setup(){

        /*	Load Text Domain */
        $languages_dir = get_template_directory() . '/languages';
        if ( file_exists( $languages_dir ) ) {
            load_theme_textdomain( 'framework', $languages_dir );
        } else {
            load_theme_textdomain( 'framework' );
        }

        /* Add Theme Support - Custom background */
        add_theme_support( 'custom-background' );

        /*	Add Automatic Feed Links Support */
        add_theme_support('automatic-feed-links');

        /* Add Post Formats Support */
        add_theme_support( 'post-formats', array( 'image', 'video', 'gallery' ) );

        /* Add Menu Support */
        add_theme_support('menus');
        register_nav_menus(
            array(
                'main-menu' => __( 'Main Menu', 'framework' )
            )
        );


        /* Add Post Thumbnails Support and Related Image Sizes */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 150, 150 );                            // default Post Thumbnail dimensions
        add_image_size( 'partners-logo', 200, 58, true);                // For partner carousel logos
        add_image_size( 'post-featured-image', 830, 323, true);         // For Standard Post Thumbnails
        add_image_size( 'gallery-two-column-image', 536, 269, true);    // For Gallery Two Column property Thumbnails
        add_image_size( 'property-thumb-image', 244, 163, true);        // For Home page posts thumbnails/Featured Properties carousels thumb
        add_image_size( 'property-detail-slider-image', 770, 386, true);// For Property detail page slider image
        add_image_size( 'property-detail-slider-image-two', 830, 460, true); // For Property detail page slider image
        add_image_size( 'property-detail-slider-thumb', 82, 60, true);  // For Property detail page slider thumb
        add_image_size( 'property-detail-video-image', 818, 417, true); // For Property detail page video image
        add_image_size( 'agent-image', 210, 210, true);                 // For Agent Picture
        add_image_size( 'grid-view-image', 246, 162, true);             // For Property Listing Grid view,  image

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );
    }
}
add_action( 'after_setup_theme', 'inspiry_theme_setup' );



/*-----------------------------------------------------------------------------------*/
/*	TGM Plugin Activation Class and related code to get the plugins installed and activated
/*-----------------------------------------------------------------------------------*/
    require_once( get_template_directory() . '/tgm/class-tgm-plugin-activation.php' );
    require_once( get_template_directory() . '/tgm/plugins-list.php' );



/*-----------------------------------------------------------------------------------*/
/*	Include Theme Options Framework
/*-----------------------------------------------------------------------------------*/
    require_once(get_template_directory() . '/framework/admin/admin-functions.php');
    require_once(get_template_directory() . '/framework/admin/admin-interface.php');
    require_once(get_template_directory() . '/framework/admin/theme-settings.php');



/*-----------------------------------------------------------------------------------*/
/*	Include Theme Functions for Various Important Features
/*-----------------------------------------------------------------------------------*/
    require_once(get_template_directory() . '/framework/functions/contact_form_handler.php');
    require_once(get_template_directory() . '/framework/functions/theme_comment.php');



/*-----------------------------------------------------------------------------------*/
/*	Include Meta Box
/*-----------------------------------------------------------------------------------*/
    require_once( get_template_directory() . '/framework/meta-box/config-meta-boxes.php' );
    require_once( get_template_directory() . '/framework/include/additional-details-metabox.php' );



/*-----------------------------------------------------------------------------------*/
//	Shortcodes
/*-----------------------------------------------------------------------------------*/
    require_once( get_template_directory() . '/framework/include/shortcodes/columns.php' );
    require_once( get_template_directory() . '/framework/include/shortcodes/elements.php' );



/*-----------------------------------------------------------------------------------*/
/*	Include Custom Post Types
/*-----------------------------------------------------------------------------------*/
    require_once ( get_template_directory() . '/framework/include/agent-post-type.php' );
    require_once ( get_template_directory() . '/framework/include/property-post-type.php' );
    require_once ( get_template_directory() . '/framework/include/partners-post-type.php' );
    require_once ( get_template_directory() . '/framework/include/slide-post-type.php' );


/*-----------------------------------------------------------------------------------*/
//	Dynamic CSS
/*-----------------------------------------------------------------------------------*/
    require_once( get_template_directory() . '/css/dynamic-css.php' );



/*-----------------------------------------------------------------------------------*/
/*	Enables Widget Sidebars
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'inspiry_theme_sidebars' ) ) {
    function inspiry_theme_sidebars( ) {

        // Location: Default Sidebar
        register_sidebar(array(
            'name'=>__('Default Sidebar','framework'),
            'id' => 'default-sidebar',
            'description' => __('Widget area for default sidebar on news and post pages.','framework'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="title">',
            'after_title' => '</h3>'
        ));

        // Location: Sidebar Pages
        register_sidebar(array(
            'name'=>__('Pages Sidebar','framework'),
            'id' => 'default-page-sidebar',
            'description' => __('Widget area for default page template sidebar.','framework'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="title">',
            'after_title' => '</h3>'
        ));

        // Location: Sidebar for contact page
        register_sidebar(array(
            'name'=>__('Contact Sidebar','framework'),
            'id' => 'contact-sidebar',
            'description' => __('Widget area for contact page sidebar.','framework'),
            'before_widget' => '<section class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="title">',
            'after_title' => '</h3>'
        ));

        // Location: Sidebar Property
        register_sidebar(array(
            'name'=>__('Property Sidebar','framework'),
            'id' => 'property-sidebar',
            'description' => __('Widget area for property detail page sidebar.','framework'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="title">',
            'after_title' => '</h3>'
        ));

        // Location: Sidebar Properties Listing
        register_sidebar(array(
            'name'=>__('Property Listing Sidebar','framework'),
            'id' => 'property-listing-sidebar',
            'description' => __('Widget area for property listing template sidebar.','framework'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="title">',
            'after_title' => '</h3>'
        ));

        // Location: Sidebar dsIDX
        register_sidebar(array(
            'name'=>__('dsIDX Sidebar','framework'),
            'id' => 'dsidx-sidebar',
            'description' => __('Widget area for dsIDX related pages.','framework'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="title">',
            'after_title' => '</h3>'
        ));

        // Location: Footer First Column
        register_sidebar(array(
            'name'=>__('Footer First Column','framework'),
            'id' => 'footer-first-column',
            'description' => __('Widget area for first column in footer.','framework'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="title">',
            'after_title' => '</h3>'
        ));

        // Location: Footer Second Column
        register_sidebar(array(
            'name'=>__('Footer Second Column','framework'),
            'id' => 'footer-second-column',
            'description' => __('Widget area for second column in footer.','framework'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="title">',
            'after_title' => '</h3>'
        ));

        // Location: Footer Third Column
        register_sidebar(array(
            'name'=>__('Footer Third Column','framework'),
            'id' => 'footer-third-column',
            'description' => __('Widget area for third column in footer.','framework'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="title">',
            'after_title' => '</h3>'
        ));

        // Location: Footer Fourth Column
        register_sidebar(array(
            'name'=>__('Footer Fourth Column','framework'),
            'id' => 'footer-fourth-column',
            'description' => __('Widget area for fourth column in footer.','framework'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="title">',
            'after_title' => '</h3>'
        ));


        // Location: Sidebar Agent
        register_sidebar(array(
            'name'=>__('Agent Sidebar','framework'),
            'id'=> 'agent-sidebar',
            'description'=>__('Sidebar widget area for agent detail page.','framework'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="title">',
            'after_title' => '</h3>'
        ));

        // Location: Home Search Area
        register_sidebar(array(
            'name'=>__('Home Search Area','framework'),
            'id'=> 'home-search-area',
            'description'=>__('Widget area for only IDX Search Widget. Using this area means you want to display IDX search form instead of default search form.','framework'),
            'before_widget' => '<section id="home-idx-search" class="clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="home-widget-label">',
            'after_title' => '</h3>'
        ));

        // Location: Property Search Template
        register_sidebar( array(
            'name' => __('Property Search Sidebar','framework'),
            'id' => 'property-search-sidebar',
            'description' => __('Widget area for property search template with sidebar.','framework'),
            'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="title">',
            'after_title' => '</h3>'
        ));

        // Create additional sidebar to use with visual composer if needed
        if ( class_exists('Vc_Manager') ) {

            // Additional Sidebars
            register_sidebars(4, array(
                'name' => __('Additional Sidebar %d', 'framework'),
                'description' => __('An extra sidebar to use with Visual Composer if needed.', 'framework'),
                'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h3 class="title">',
                'after_title' => '</h3>'
            ));

        }

    }
}
add_action( 'widgets_init', 'inspiry_theme_sidebars' );


/*-----------------------------------------------------------------------------------*/
//	Widgets
/*-----------------------------------------------------------------------------------*/
    require_once( get_template_directory() . '/widgets/' . 'featured-properties-widget.php');
    require_once( get_template_directory() . '/widgets/' . 'property-types-widget.php');
    require_once( get_template_directory() . '/widgets/' . 'advance-search-widget.php');
    require_once( get_template_directory() . '/widgets/' . 'agent-properties-widget.php');
    require_once( get_template_directory() . '/widgets/' . 'agent-featured-properties-widget.php');


/*-----------------------------------------------------------------------------------*/
//	Register Widgets
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'register_theme_widgets' ) ){
    function register_theme_widgets() {
        register_widget( 'Featured_Properties_Widget' );
        register_widget( 'Property_Types_Widget' );
        register_widget( 'Advance_Search_Widget' );
        register_widget( 'Agent_Properties_Widget' );
        register_widget( 'Agent_Featured_Properties_Widget' );
    }
}

add_action( 'widgets_init', 'register_theme_widgets' );



/*-----------------------------------------------------------------------------------*/
//	Property Submit Handler
/*-----------------------------------------------------------------------------------*/
    require_once( get_template_directory() . '/framework/functions/' . 'property-submit-handler.php' );



/*-----------------------------------------------------------------------------------*/
//	Edit Profile Handler
/*-----------------------------------------------------------------------------------*/
    require_once( get_template_directory() . '/framework/functions/' . 'edit-profile-handler.php' );



/*-----------------------------------------------------------------------------------*/
/*	Content Width
/*-----------------------------------------------------------------------------------*/
    if ( ! isset( $content_width ) ) $content_width = 828;



/*-----------------------------------------------------------------------------------*/
//	Theme Pagination Method
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'theme_pagination' ) ){
    function theme_pagination($pages = ''){
        global $paged;

        if(is_page_template('template-home.php')){
            $paged = intval(get_query_var( 'page' ));
        }

        if(empty($paged))$paged = 1;

        $prev = $paged - 1;
        $next = $paged + 1;
        $range = 2; // only change it to show more links
        $showitems = ($range * 2)+1;

        if($pages == ''){
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages){
                $pages = 1;
            }
        }


        if(1 != $pages){
            echo "<div class='pagination'>";
            echo ($paged > 2 && $paged > $range+1 && $showitems < $pages)? "<a href='".get_pagenum_link(1)."' class='real-btn'>&laquo; ".__('First', 'framework')."</a> ":"";
            echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."' class='real-btn' >&laquo; ". __('Previous', 'framework')."</a> ":"";

            for ($i=1; $i <= $pages; $i++){
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                    echo ($paged == $i)? "<a href='".get_pagenum_link($i)."' class='real-btn current' >".$i."</a> ":"<a href='".get_pagenum_link($i)."' class='real-btn'>".$i."</a> ";
                }
            }

            echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."' class='real-btn' >". __('Next', 'framework') ." &raquo;</a> " :"";
            echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."' class='real-btn' >". __('Last', 'framework') ." &raquo;</a> ":"";
            echo "</div>";
        }
    }
}




/*-----------------------------------------------------------------------------------*/
/*	Get list of Gallery Images
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'list_gallery_images' ) ){
    function list_gallery_images($size = 'post-featured-image'){
        global $post;

        $gallery_images = rwmb_meta( 'REAL_HOMES_gallery', 'type=plupload_image&size='.$size, $post->ID );

        if( !empty($gallery_images) ){
            foreach( $gallery_images as $gallery_image ){
                $caption = ( !empty($gallery_image['caption']) ) ? $gallery_image['caption'] : $gallery_image['alt'];
                echo '<li><a href="'.$gallery_image['full_url'].'" title="'.$caption.'" class="'.get_lightbox_plugin_class() .'">';
                echo '<img src="'.$gallery_image['url'].'" alt="'.$gallery_image['title'].'" />';
                echo '</a></li>';
            }
        }
        else if( has_post_thumbnail($post->ID)){
            echo '<li><a href="'.get_permalink().'" title="'.get_the_title().'" >';
            the_post_thumbnail($size);
            echo '</a></li>';
        }
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Custom Excerpt Method
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'framework_excerpt' ) ){
    function framework_excerpt($len=15, $trim="&hellip;"){
        echo get_framework_excerpt($len,$trim);
    }
}

if( !function_exists( 'get_framework_excerpt' ) ){
    function get_framework_excerpt($len=15, $trim="&hellip;"){
        $limit = $len+1;
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        $num_words = count($excerpt);
        if($num_words >= $len){
            $last_item=array_pop($excerpt);
        }
        else{
            $trim="";
        }
        $excerpt = implode(" ",$excerpt)."$trim";
        return $excerpt;
    }
}

if( !function_exists( 'comment_custom_excerpt' ) ){
    function comment_custom_excerpt($len=15, $comment_content = "" , $trim="&hellip;"){
        $limit = $len+1;
        $excerpt = explode(' ', $comment_content , $limit);
        $num_words = count($excerpt);
        if($num_words >= $len){
            $last_item = array_pop($excerpt);
        }
        else {
            $trim = "";
        }
        $excerpt = implode(" ",$excerpt)."$trim";
        echo $excerpt;
    }
}

if( !function_exists( 'get_framework_custom_excerpt' ) ){
    function get_framework_custom_excerpt( $contents="" , $len=15, $trim="&hellip;" ){
        $limit = $len+1;
        $excerpt = explode(' ', $contents, $limit);
        $num_words = count($excerpt);
        if( $num_words >= $len ){
            $last_item = array_pop($excerpt);
        }else{
            $trim="";
        }
        $excerpt = implode(" ",$excerpt)."$trim";
        return $excerpt;
    }
}




/*-----------------------------------------------------------------------------------*/
/*	Register and load admin javascript
/*-----------------------------------------------------------------------------------*/
    if( !function_exists( 'admin_js' ) ){
        function admin_js($hook){
            if ($hook == 'post.php' || $hook == 'post-new.php'){
                wp_register_script('admin-script', get_template_directory_uri() . '/js/admin.js', 'jquery');
                wp_enqueue_script('admin-script');
            }
        }
        add_action('admin_enqueue_scripts','admin_js',10,1);
    }



/*-----------------------------------------------------------------------------------*/
/*	Disable Post Format UI in WordPress 3.6 and Keep the Old One Working
/*-----------------------------------------------------------------------------------*/
    add_filter( 'enable_post_format_ui', '__return_false' );



/*-----------------------------------------------------------------------------------*/
/*	Load Required CSS Styles
/*-----------------------------------------------------------------------------------*/
    if(!function_exists('load_theme_styles')){
        function load_theme_styles(){
            if (!is_admin()){

                // enqueue required fonts
                $protocol = is_ssl() ? 'https' : 'http';
                wp_enqueue_style( 'theme-roboto', "$protocol://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic&subset=latin,cyrillic" );
                wp_enqueue_style( 'theme-lato', "$protocol://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" );

                // register styles
                wp_register_style('bootstrap-css',  get_template_directory_uri() . '/css/bootstrap.css', array(), '2.2.2', 'all');
                wp_register_style('responsive-css',  get_template_directory_uri() . '/css/responsive.css', array(), '2.2.2', 'all');
                wp_register_style('awesome-font-css',  get_template_directory_uri() . '/css/font-awesome.min.css', array(), '3.0.2', 'all');
                wp_register_style('pretty-photo-css',  get_template_directory_uri() . '/js/prettyphoto/css/prettyPhoto.css', array(), '3.1.5', 'all');
                wp_register_style('swipebox-css',  get_template_directory_uri() . '/js/swipebox/swipebox.css', array(), '3.1.4', 'all');
                wp_register_style('flexslider-css',  get_template_directory_uri() . '/js/flexslider/flexslider.css', array(), '2.1', 'all');
                wp_register_style('main-css',  get_template_directory_uri() . '/css/main.css', array(), '1.3.3', 'all');
                wp_register_style('rtl-main-css',  get_template_directory_uri() . '/css/rtl-main.css', array(), '1.3.3', 'all');
                wp_register_style('custom-responsive-css',  get_template_directory_uri() . '/css/custom-responsive.css', array(), '1.3.3', 'all');
                wp_register_style('rtl-custom-responsive-css',  get_template_directory_uri() . '/css/rtl-custom-responsive.css', array(), '1.3.3', 'all');
                wp_register_style('vc-css',  get_template_directory_uri() . '/css/visual-composer.css', array(), '1.0', 'all');
                wp_register_style('parent-default', get_stylesheet_uri(), array(), '1.0', 'all');
                wp_register_style('parent-custom',  get_template_directory_uri() . '/css/custom.css', array(), '1.0', 'all');

                // enqueue bootstrap styles
                wp_enqueue_style('bootstrap-css');

                $disable_responsive_styles = get_option('theme_disable_responsive');
                if($disable_responsive_styles != "true"){
                    // enqueue bootstrap responsive styles
                    wp_enqueue_style('responsive-css');
                }

                // Awesome font css
                wp_enqueue_style('awesome-font-css');

                // Flex Slider
                wp_enqueue_style('flexslider-css');

                // enqueue Pretty Photo styles
                wp_enqueue_style('pretty-photo-css');

                // enqueue Swipe Box styles
                wp_enqueue_style('swipebox-css');

                // enqueue Main styles
                wp_enqueue_style('main-css');

                // if rtl is enabled
                if ( is_rtl() ) {
                    wp_enqueue_style('rtl-main-css');
                }

                if( $disable_responsive_styles != "true" ){
                    // enqueue custom responsive styles
                    wp_enqueue_style('custom-responsive-css');
                    if ( is_rtl() ) {
                        wp_enqueue_style('rtl-custom-responsive-css');
                    }
                }

                if ( class_exists('Vc_Manager') ) {
                    // it means Visual Composer Plugin is Installed
                    wp_enqueue_style('vc-css');
                }

                // default css
                wp_enqueue_style('parent-default');

                // parent theme custom css
                wp_enqueue_style('parent-custom');

            }
        }
    }
    add_action('wp_enqueue_scripts', 'load_theme_styles');



/*-----------------------------------------------------------------------------------*/
/*	Add Disable Responsive Class to Body
/*-----------------------------------------------------------------------------------*/
if(!function_exists( 'add_disable_responsive_class') ){
    function add_disable_responsive_class( $classes ){
        $disable_responsive_styles = get_option('theme_disable_responsive');
        if( $disable_responsive_styles == "true" ){
            $classes[] = 'disable-responsive';
        }
        return $classes;
    }
}
add_filter('body_class','add_disable_responsive_class');


/*-----------------------------------------------------------------------------------*/
/*	Check if google map script is needed
/*-----------------------------------------------------------------------------------*/
if(!function_exists( 'google_map_needed') ){
    function google_map_needed(){
        if( is_page_template('template-contact.php') && ( get_option('theme_show_contact_map') == 'true' ) ){
            return true;
        } else if( is_page_template('template-map-based-listing.php') || is_page_template('template-submit-property.php') ){
            return true;
        } else if( is_singular('property') && ( get_option('theme_display_google_map') == 'true' ) ){
            return true;
        } else if( is_page_template('template-home.php')  ){
            $theme_homepage_module = get_option('theme_homepage_module');
            if(isset($_GET['module'])){
                $theme_homepage_module = $_GET['module'];
            }
            if( $theme_homepage_module == 'properties-map' ){
                return true;
            }
        } else if( is_page_template('template-search.php') && ( get_option('theme_search_module') == 'properties-map' ) ){
            return true;
        } else if( is_page_template('template-search-sidebar.php') && ( get_option('theme_search_module') == 'properties-map' ) ){
            return true;
        } else if( is_page_template('template-property-listing.php') || is_page_template('template-property-grid-listing.php') || is_tax('property-city') || is_tax('property-status') || is_tax('property-type') || is_tax('property-feature') ){
            /* Theme Listing Page Module */
            $theme_listing_module = get_option('theme_listing_module');
            /* Only for demo purpose only */
            if(isset($_GET['module'])){
                $theme_listing_module = $_GET['module'];
            }
            if( $theme_listing_module == 'properties-map' ){
                return true;
            }
        }
        return false;
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Load Required JS Scripts
/*-----------------------------------------------------------------------------------*/
    if(!function_exists('load_theme_scripts')){
        function load_theme_scripts(){
            if (!is_admin()) {

                // Defining scripts directory url
                $java_script_url = get_template_directory_uri().'/js/';

                // Registering Scripts
                wp_register_script('flexslider', $java_script_url.'flexslider/jquery.flexslider-min.js', array('jquery'), '2.1', false);
                wp_register_script('easing', $java_script_url.'elastislide/jquery.easing.1.3.js', array('jquery'), '1.3', false);
                wp_register_script('elastislide', $java_script_url.'elastislide/jquery.elastislide.js', array('jquery'), false);
                wp_register_script('pretty-photo', $java_script_url.'prettyphoto/jquery.prettyPhoto.js', array('jquery'), '3.1.5', false);
                wp_register_script('isotope', $java_script_url.'jquery.isotope.min.js', array('jquery'), '1.5.25', false);
                wp_register_script('jcarousel', $java_script_url.'jquery.jcarousel.min.js', array('jquery'), '0.2.9', false);
                wp_register_script('jqvalidate', $java_script_url.'jquery.validate.min.js', array('jquery'), '1.11.1', false);
                wp_register_script('jqform', $java_script_url.'jquery.form.js', array('jquery'), '3.40', false);
                wp_register_script('selectbox', $java_script_url.'jquery.selectbox.js', array('jquery'), '1.2', false);
                wp_register_script('jqtransit', $java_script_url.'jquery.transit.min.js', array('jquery'), '0.9.9', false);
                wp_register_script('bootstrap', $java_script_url.'bootstrap.min.js', array('jquery'), false);
                wp_register_script('swipebox', $java_script_url.'swipebox/jquery.swipebox.min.js', array('jquery'),'1.2.1', false);

                // Custom Script
                wp_register_script( 'custom', $java_script_url.'custom.js', array('jquery'), '1.0', true );

                // Enqueue Scripts that are needed on all the pages
                wp_enqueue_script('jquery');
                wp_enqueue_script('jquery-ui-core');
                wp_enqueue_script('jquery-ui-autocomplete');
                wp_enqueue_script('flexslider');
                wp_enqueue_script('easing');
                wp_enqueue_script('elastislide');
                wp_enqueue_script('pretty-photo');
                wp_enqueue_script('swipebox');
                wp_enqueue_script('isotope');
                wp_enqueue_script('jcarousel');
                wp_enqueue_script('jqvalidate');
                wp_enqueue_script('jqform');
                wp_enqueue_script('selectbox');
                wp_enqueue_script('jqtransit');
                wp_enqueue_script('bootstrap');

                if( google_map_needed() ){
                    wp_register_script('google-map-api', '//maps.google.com/maps/api/js?sensor=true', array(), '', false);
                    wp_register_script( 'google-map-info-box', $java_script_url . 'infobox.js', array( 'google-map-api' ), '1.1.9', false );
                    wp_register_script( 'google-map-marker-clusterer', $java_script_url . 'markerclusterer.js', array( 'google-map-api' ), '2.1.1', false );
                    wp_enqueue_script('google-map-api');
                    wp_enqueue_script('google-map-info-box');
                    wp_enqueue_script('google-map-marker-clusterer');
                }

                // Property submit and edit template
                if ( is_page_template( 'template-submit-property.php' ) ) {
                    wp_enqueue_script( 'plupload' );
                    wp_enqueue_script( 'jquery-ui-sortable' );
                    // Property Submit Script
                    wp_register_script( 'property-submit', $java_script_url.'property-submit.js', array( 'jquery', 'jquery-ui-sortable', 'plupload' ), '1.0', true );
                    $property_submit_data = array(
                        'ajaxURL' => admin_url( 'admin-ajax.php' ),
                        'uploadNonce' => wp_create_nonce ( 'inspiry_allow_upload' ),
                        'fileTypeTitle' => __( 'Valid file formats', 'framework' ),
                    );
                    wp_localize_script( 'property-submit', 'propertySubmit', $property_submit_data );
                    wp_enqueue_script( 'property-submit' );
                }

                // Edit profile template
                if ( is_page_template( 'template-edit-profile.php' ) ) {
                    wp_enqueue_script( 'plupload' );
                    wp_register_script( 'edit-profile', $java_script_url.'edit-profile.js', array( 'jquery', 'plupload' ), '1.0', true );
                    $edit_profile_data = array(
                        'ajaxURL' => admin_url( 'admin-ajax.php' ),
                        'uploadNonce' => wp_create_nonce ( 'inspiry_allow_upload' ),
                        'fileTypeTitle' => __( 'Valid file formats', 'framework' ),
                    );
                    wp_localize_script( 'edit-profile', 'editProfile', $edit_profile_data );
                    wp_enqueue_script( 'edit-profile' );
                }

                if(is_singular('post') || is_page()){
                    wp_enqueue_script( 'comment-reply' );
                }

                wp_enqueue_script('custom');

                // Responsive Navigation Title Translation Support - Ref : http://codex.wordpress.org/Function_Reference/wp_localize_script
                $localized_array = array(
                    'nav_title' => __('Go to...','framework')
                );

                $rent_slug = get_option('theme_status_for_rent');
                if(!empty( $rent_slug )){
                    $localized_array['rent_slug'] = $rent_slug;
                }

                wp_localize_script( 'custom', 'localized', $localized_array );
            }
        }
    }
    add_action('wp_enqueue_scripts', 'load_theme_scripts');


/*-----------------------------------------------------------------------------------*/
/*	Load Location Related Script
/*-----------------------------------------------------------------------------------*/
if(!function_exists('load_location_script')){
    function load_location_script(){

        if ( ! is_admin() ) {

            /* all property city terms */
            $all_locations = get_terms('property-city',array(
                'hide_empty' => false,
                'orderby' => 'count',
                'order' => 'desc',
            ));

            /* select boxes names */
            global $location_select_names;

            /* number of select boxes based on theme option */
            $location_select_count = intval( get_option( 'theme_location_select_number' ) );
            if( ! ( $location_select_count > 0 && $location_select_count < 5) ){
                $location_select_count = 1;
            }

            /* location parameters in request, if any */
            $locations_in_params = array();
            foreach ( $location_select_names as $location_name ) {
                if( isset( $_GET[ $location_name ] ) ) {
                    $locations_in_params[ $location_name ] = $_GET[ $location_name ];
                }
            }

            /* combine all data into one */
            $location_data_array = array(
                'any' => __('Any','framework'),
                'all_locations' => $all_locations,
                'select_names' => $location_select_names,
                'select_count' => $location_select_count,
                'locations_in_params' => $locations_in_params,
            );

            /* provide location data array before custom script */
            wp_localize_script( 'custom', 'locationData', $location_data_array );

        }
    }
}
add_action('after_location_fields', 'load_location_script');


/*-----------------------------------------------------------------------------------*/
/*	Get Currency
/*-----------------------------------------------------------------------------------*/
if(!function_exists('get_theme_currency')){
    function get_theme_currency(){
        $currency = get_option( 'theme_currency_sign' );
        if(!empty($currency)){
            return $currency;
        }
        return __('$','framework');
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Property Price Format
/*-----------------------------------------------------------------------------------*/
if(!function_exists('get_property_price')){
    function get_property_price(){
        global $post;
        $price_digits = doubleval(get_post_meta($post->ID, 'REAL_HOMES_property_price', true));
        if($price_digits){
            $currency = get_theme_currency();
            $price_post_fix = get_post_meta($post->ID, 'REAL_HOMES_property_price_postfix', true);
            $decimals = intval(get_option( 'theme_decimals'));
            $decimal_point = get_option( 'theme_dec_point' );
            $thousands_separator = get_option( 'theme_thousands_sep' );
            $currency_position = get_option( 'theme_currency_position' );
            $formatted_price = number_format($price_digits,$decimals, $decimal_point, $thousands_separator);
            if($currency_position == 'after'){
                return $formatted_price . $currency. ' ' . $price_post_fix;
            }else{
                return $currency . $formatted_price . ' ' . $price_post_fix;
            }
        }else{
            return no_price_text();
        }
    }
}

if(!function_exists('property_price')){
    function property_price(){
        echo get_property_price();
    }
}

if(!function_exists('get_custom_price')){
    function get_custom_price($amount){
        $amount = doubleval($amount);
        if($amount){
            $currency = get_theme_currency();
            $decimals = intval(get_option( 'theme_decimals'));
            $decimal_point = get_option( 'theme_dec_point' );
            $thousands_separator = get_option( 'theme_thousands_sep' );
            $currency_position = get_option( 'theme_currency_position' );
            $formatted_price = number_format($amount,$decimals, $decimal_point, $thousands_separator);
            if($currency_position == 'after'){
                return $formatted_price . $currency;
            }else{
                return $currency . $formatted_price;
            }
        } else {
            return false;
        }
    }
}

if(!function_exists('no_price_text')){
    function no_price_text(){
        /* You can modify text to display when no price is provided, From Theme Options > Price Format */
        $no_price_text = get_option( 'theme_no_price_text' );
        return $no_price_text;
    }
}

/*-----------------------------------------------------------------------------------*/
// Advance search options (List boxes listing in advance-search.php)
/*-----------------------------------------------------------------------------------*/
if(!function_exists('advance_search_options')){
    function advance_search_options($taxonomy_name){
        $taxonomy_terms = get_terms($taxonomy_name);
        $searched_term = '';

        if($taxonomy_name == 'property-city'){
            if(!empty($_GET['location'])){
                $searched_term = $_GET['location'];
            }
        }

        if($taxonomy_name == 'property-type'){
            if(!empty($_GET['type'])){
                $searched_term = $_GET['type'];
            }
        }

        if($taxonomy_name == 'property-status'){
            if(!empty($_GET['status'])){
                $searched_term = $_GET['status'];
            }
        }

        if(!empty($taxonomy_terms)){
            foreach($taxonomy_terms as $term){
                if($searched_term == $term->slug){
                    echo '<option value="'.$term->slug.'" selected="selected">'.$term->name.'</option>';
                }else{
                    echo '<option value="'.$term->slug.'">'.$term->name.'</option>';
                }
            }
        }

        if($searched_term == 'any' || empty($searched_term)){
            echo '<option value="any" selected="selected">'.__( 'Any', 'framework').'</option>';
        } else {
            echo '<option value="any">'.__( 'Any', 'framework').'</option>';
        }
    }
}

/*-----------------------------------------------------------------------------------*/
// Advance hierarchical options
/*-----------------------------------------------------------------------------------*/
if(!function_exists('advance_hierarchical_options')){
    function advance_hierarchical_options($taxonomy_name){
        $taxonomy_terms = get_terms($taxonomy_name,array(
                                                        'hide_empty' => false,
                                                        'parent' => 0
                                                    ));
        $searched_term = '';

        if( $taxonomy_name == 'property-city' ){
            if(!empty($_GET['location'])){
                $searched_term = $_GET['location'];
            }
        }

        if($taxonomy_name == 'property-type'){
            if(!empty($_GET['type'])){
                $searched_term = $_GET['type'];
            }
        }

        // Generate options
        generate_hirarchical_options($taxonomy_name, $taxonomy_terms, $searched_term);

        if($searched_term == 'any' || empty($searched_term)){
            echo '<option value="any" selected="selected">'.__( 'Any', 'framework').'</option>';
        } else {
            echo '<option value="any">'.__( 'Any', 'framework').'</option>';
        }
    }
}

/*-----------------------------------------------------------------------------------*/
// Generate Hirarchical Options
/*-----------------------------------------------------------------------------------*/
if(!function_exists('generate_hirarchical_options')){
    function generate_hirarchical_options($taxonomy_name, $taxonomy_terms, $searched_term, $prefix = " " ){
        if (!empty($taxonomy_terms)) {
            foreach ($taxonomy_terms as $term) {
                if ($searched_term == $term->slug) {
                    echo '<option value="' . $term->slug . '" selected="selected">' . $prefix . $term->name . '</option>';
                } else {
                    echo '<option value="' . $term->slug . '">' . $prefix . $term->name . '</option>';
                }
                $child_terms = get_terms($taxonomy_name, array(
                    'hide_empty' => false,
                    'parent' => $term->term_id
                ));

                if (!empty($child_terms)) {
                    /* Recursive Call */
                    generate_hirarchical_options( $taxonomy_name, $child_terms, $searched_term, "- ".$prefix );
                }
            }
        }
    }
}

/*-----------------------------------------------------------------------------------*/
// Generate ID Based Hirarchical Options
/*-----------------------------------------------------------------------------------*/
if(!function_exists('generate_id_based_hirarchical_options')){
    function generate_id_based_hirarchical_options($taxonomy_name, $taxonomy_terms, $target_term_id, $prefix = " " ){
        if (!empty($taxonomy_terms)) {
            foreach ($taxonomy_terms as $term) {
                if ($target_term_id == $term->term_id) {
                    echo '<option value="' . $term->term_id . '" selected="selected">' . $prefix . $term->name . '</option>';
                } else {
                    echo '<option value="' . $term->term_id . '">' . $prefix . $term->name . '</option>';
                }
                $child_terms = get_terms($taxonomy_name, array(
                    'hide_empty' => false,
                    'parent' => $term->term_id
                ));

                if (!empty($child_terms)) {
                    /* Recursive Call */
                    generate_id_based_hirarchical_options( $taxonomy_name, $child_terms, $target_term_id, "- ".$prefix );
                }
            }
        }
    }
}



/*-----------------------------------------------------------------------------------*/
// Numbers loop
/*-----------------------------------------------------------------------------------*/
if(!function_exists('numbers_list')){
    function numbers_list($numbers_list_for){
        $numbers_array = array(1,2,3,4,5,6,7,8,9,10);
        $searched_value = '';

        if($numbers_list_for == 'bedrooms'){
            if(isset($_GET['bedrooms'])){
                $searched_value = $_GET['bedrooms'];
            }
        }

        if($numbers_list_for == 'bathrooms'){
            if(isset($_GET['bathrooms'])) {
                $searched_value = $_GET['bathrooms'];
            }
        }

        if(!empty($numbers_array)){
            foreach($numbers_array as $number){
                if($searched_value == $number){
                    echo '<option value="'.$number.'" selected="selected">'.$number.'</option>';
                }else {
                    echo '<option value="'.$number.'">'.$number.'</option>';
                }
            }
        }

        if($searched_value == 'any' || empty($searched_value)) {
            echo '<option value="any" selected="selected">'.__( 'Any', 'framework').'</option>';
        } else {
            echo '<option value="any">'.__( 'Any', 'framework').'</option>';
        }
    }
}


/*-----------------------------------------------------------------------------------*/
// Minimum Prices
/*-----------------------------------------------------------------------------------*/
if(!function_exists('min_prices_list')){
    function min_prices_list(){
        $min_price_array = array( 1000, 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000 );

        /* Get values from theme options and convert them to an integer array */
        $minimum_price_values = get_option('theme_minimum_price_values');
        if(!empty($minimum_price_values)){
            $min_prices_string_array = explode(',',$minimum_price_values);
            if(is_array($min_prices_string_array) && !empty($min_prices_string_array)){
                $new_min_prices_array = array();
                foreach($min_prices_string_array as $string_price){
                    $integer_price = doubleval($string_price);
                    if($integer_price > 1){
                        $new_min_prices_array[] = $integer_price;
                    }
                }
                if(!empty($new_min_prices_array)){
                    $min_price_array = $new_min_prices_array;
                }
            }
        }

        $minimum_price = '';
        if(isset($_GET['min-price'])){
            $minimum_price = doubleval($_GET['min-price']);
        }

        if(!empty($min_price_array)){
            foreach($min_price_array as $price){
                if($minimum_price == $price){
                    echo '<option value="'.$price.'" selected="selected">'.get_custom_price($price).'</option>';
                }else {
                    echo '<option value="'.$price.'">'.get_custom_price($price).'</option>';
                }
            }
        }

        if($minimum_price == 'any' || empty($minimum_price)) {
            echo '<option value="any" selected="selected">'.__( 'Any', 'framework').'</option>';
        } else {
            echo '<option value="any">'.__( 'Any', 'framework').'</option>';
        }

    }
}


/*-----------------------------------------------------------------------------------*/
// Minimum Prices For Rent Only
/*-----------------------------------------------------------------------------------*/
if(!function_exists('min_prices_for_rent_list')){
    function min_prices_for_rent_list(){
        $min_price_for_rent_array = array( 500, 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000 );

        /* Get values from theme options and convert them to an integer array */
        $minimum_price_values_for_rent = get_option('theme_minimum_price_values_for_rent');
        if(!empty($minimum_price_values_for_rent)){
            $min_prices_string_array = explode(',',$minimum_price_values_for_rent);
            if(is_array($min_prices_string_array) && !empty($min_prices_string_array)){
                $new_min_prices_array = array();
                foreach($min_prices_string_array as $string_price){
                    $integer_price = doubleval($string_price);
                    if($integer_price > 1){
                        $new_min_prices_array[] = $integer_price;
                    }
                }
                if(!empty($new_min_prices_array)){
                    $min_price_for_rent_array = $new_min_prices_array;
                }
            }
        }

        $minimum_price = '';
        if(isset($_GET['min-price'])){
            $minimum_price = doubleval($_GET['min-price']);
        }

        if(!empty($min_price_for_rent_array)){
            foreach($min_price_for_rent_array as $price){
                if($minimum_price == $price){
                    echo '<option value="'.$price.'" selected="selected">'.get_custom_price($price).'</option>';
                }else {
                    echo '<option value="'.$price.'">'.get_custom_price($price).'</option>';
                }
            }
        }

        if($minimum_price == 'any' || empty($minimum_price)) {
            echo '<option value="any" selected="selected">'.__( 'Any', 'framework').'</option>';
        } else {
            echo '<option value="any">'.__( 'Any', 'framework').'</option>';
        }

    }
}



/*-----------------------------------------------------------------------------------*/
// Maximum Prices
/*-----------------------------------------------------------------------------------*/
if(!function_exists('max_prices_list')){
    function max_prices_list(){

        $max_price_array = array( 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000, 10000000 );

        /* Get values from theme options and convert them to an integer array */
        $maximum_price_values = get_option('theme_maximum_price_values');
        if(!empty($maximum_price_values)){
            $max_prices_string_array = explode(',',$maximum_price_values);
            if(is_array($max_prices_string_array) && !empty($max_prices_string_array)){
                $new_max_prices_array = array();
                foreach($max_prices_string_array as $string_price){
                    $integer_price = doubleval($string_price);
                    if($integer_price > 1){
                        $new_max_prices_array[] = $integer_price;
                    }
                }
                if(!empty($new_max_prices_array)){
                    $max_price_array = $new_max_prices_array;
                }
            }
        }

        $maximum_price = '';
        if(isset($_GET['max-price'])){
            $maximum_price = doubleval($_GET['max-price']);
        }

        if(!empty($max_price_array)){
            foreach($max_price_array as $price){
                if($maximum_price == $price){
                    echo '<option value="'.$price.'" selected="selected">'.get_custom_price($price).'</option>';
                }else {
                    echo '<option value="'.$price.'">'.get_custom_price($price).'</option>';
                }
            }
        }

        if($maximum_price == 'any' || empty($maximum_price)) {
            echo '<option value="any" selected="selected">'.__( 'Any', 'framework').'</option>';
        } else {
            echo '<option value="any">'.__( 'Any', 'framework').'</option>';
        }
    }
}


/*-----------------------------------------------------------------------------------*/
// Maximum Price For Rent Only
/*-----------------------------------------------------------------------------------*/
if(!function_exists('max_prices_for_rent_list')){
    function max_prices_for_rent_list(){

        $max_price_for_rent_array = array( 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000, 150000 );

        /* Get values from theme options and convert them to an integer array */
        $maximum_price_for_rent_values = get_option('theme_maximum_price_values_for_rent');
        if(!empty($maximum_price_for_rent_values)){
            $max_prices_string_array = explode(',',$maximum_price_for_rent_values);
            if(is_array($max_prices_string_array) && !empty($max_prices_string_array)){
                $new_max_prices_array = array();
                foreach($max_prices_string_array as $string_price){
                    $integer_price = doubleval($string_price);
                    if($integer_price > 1){
                        $new_max_prices_array[] = $integer_price;
                    }
                }
                if(!empty($new_max_prices_array)){
                    $max_price_for_rent_array = $new_max_prices_array;
                }
            }
        }

        $maximum_price = '';
        if(isset($_GET['max-price'])){
            $maximum_price = doubleval($_GET['max-price']);
        }

        if(!empty($max_price_for_rent_array)){
            foreach($max_price_for_rent_array as $price){
                if($maximum_price == $price){
                    echo '<option value="'.$price.'" selected="selected">'.get_custom_price($price).'</option>';
                }else {
                    echo '<option value="'.$price.'">'.get_custom_price($price).'</option>';
                }
            }
        }

        if($maximum_price == 'any' || empty($maximum_price)) {
            echo '<option value="any" selected="selected">'.__( 'Any', 'framework').'</option>';
        } else {
            echo '<option value="any">'.__( 'Any', 'framework').'</option>';
        }
    }
}



/*-----------------------------------------------------------------------------------*/
/*	Get Default Banner
/*-----------------------------------------------------------------------------------*/
if(!function_exists('get_default_banner')){
    function get_default_banner(){
        $banner_image_path = get_option('theme_general_banner_image');
        return empty($banner_image_path)? get_template_directory_uri().'/images/banner.jpg' :$banner_image_path;
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Properties Search Filter
/*-----------------------------------------------------------------------------------*/
if(!function_exists('real_homes_search')){
    function real_homes_search($search_args){

        /* taxonomy query and meta query arrays */
        $tax_query = array();
        $meta_query = array();

        /* Keyword Based Search */
        if( isset ( $_GET['keyword'] ) ) {
            $keyword = trim( $_GET['keyword'] );
            if ( ! empty( $keyword ) ) {
                $search_args['s'] = $keyword;
            }
        }

        /* property type taxonomy query */
        if( (!empty($_GET['type'])) && ( $_GET['type'] != 'any') ){
            $tax_query[] = array(
                'taxonomy' => 'property-type',
                'field' => 'slug',
                'terms' => $_GET['type']
            );
        }

        /* property location taxonomy query */
        global $location_select_names;
        $locations_count = count( $location_select_names );
        for ( $l = $locations_count - 1; $l >= 0; $l-- ) {
            if( isset( $_GET[ $location_select_names[$l] ] ) ){
                $current_location = $_GET[ $location_select_names[$l] ];
                if( ( ! empty ( $current_location ) ) && ( $current_location != 'any' ) ){
                    $tax_query[] = array (
                        'taxonomy' => 'property-city',
                        'field' => 'slug',
                        'terms' => $current_location
                    );
                    break;
                }
            }
        }

        /* property feature taxonomy query */
        if ( isset( $_GET['features'] ) ) {
            $required_features_slugs = $_GET['features'];
            if ( is_array ( $required_features_slugs ) ) {

                $slugs_count = count ( $required_features_slugs );
                if ( $slugs_count > 0 ) {

                    /* build an array of existing features slugs to validate required feature slugs */
                    $existing_features_slugs = array();
                    $existing_features = get_terms( 'property-feature', array( 'hide_empty' => false ) );
                    $existing_features_count = count ( $existing_features );
                    if ( $existing_features_count > 0 ) {
                        foreach ($existing_features as $feature) {
                            $existing_features_slugs[] = $feature->slug;
                        }
                    }

                    foreach ( $required_features_slugs as $feature_slug ) {
                        if( in_array( $feature_slug, $existing_features_slugs ) ){  // validate slug
                            $tax_query[] = array (
                                'taxonomy' => 'property-feature',
                                'field' => 'slug',
                                'terms' => $feature_slug
                            );
                        }
                    }
                }
            }

        }

        /* property status taxonomy query */
        if((!empty($_GET['status'])) && ( $_GET['status'] != 'any' ) ){
            $tax_query[] = array(
                'taxonomy' => 'property-status',
                'field' => 'slug',
                'terms' => $_GET['status']
            );
        }

        /* Property Bedrooms Parameter */
        if((!empty($_GET['bedrooms'])) && ( $_GET['bedrooms'] != 'any' ) ){
            $meta_query[] = array(
                'key' => 'REAL_HOMES_property_bedrooms',
                'value' => $_GET['bedrooms'],
                'compare' => '>=',
                'type'=> 'DECIMAL'
            );
        }

        /* Property Bathrooms Parameter */
        if((!empty($_GET['bathrooms'])) && ( $_GET['bathrooms'] != 'any' ) ){
            $meta_query[] = array(
                'key' => 'REAL_HOMES_property_bathrooms',
                'value' => $_GET['bathrooms'],
                'compare' => '>=',
                'type'=> 'DECIMAL'
            );
        }

        /* Property ID Parameter */
        if( isset($_GET['property-id']) && !empty($_GET['property-id'])){
            $property_id = trim($_GET['property-id']);
            $meta_query[] = array(
                'key' => 'REAL_HOMES_property_id',
                'value' => $property_id,
                'compare' => 'LIKE',
                'type'=> 'CHAR'
            );
        }

        /* Logic for Min and Max Price Parameters */
        if( isset($_GET['min-price']) && ($_GET['min-price'] != 'any') && isset($_GET['max-price']) && ($_GET['max-price'] != 'any') ){
            $min_price = doubleval($_GET['min-price']);
            $max_price = doubleval($_GET['max-price']);
            if( $min_price >= 0 && $max_price > $min_price ){
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_price',
                    'value' => array( $min_price, $max_price ),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN'
                );
            }
        }elseif( isset($_GET['min-price']) && ($_GET['min-price'] != 'any') ){
            $min_price = doubleval($_GET['min-price']);
            if( $min_price > 0 ){
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_price',
                    'value' => $min_price,
                    'type' => 'NUMERIC',
                    'compare' => '>='
                );
            }
        }elseif( isset($_GET['max-price']) && ($_GET['max-price'] != 'any') ){
            $max_price = doubleval($_GET['max-price']);
            if( $max_price > 0 ){
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_price',
                    'value' => $max_price,
                    'type' => 'NUMERIC',
                    'compare' => '<='
                );
            }
        }


        /* Logic for Min and Max Area Parameters */
        if( isset($_GET['min-area']) && !empty($_GET['min-area']) && isset($_GET['max-area']) && !empty($_GET['max-area']) ){
            $min_area = intval($_GET['min-area']);
            $max_area = intval($_GET['max-area']);
            if( $min_area >= 0 && $max_area > $min_area ){
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_size',
                    'value' => array( $min_area, $max_area ),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN'
                );
            }
        }elseif( isset($_GET['min-area']) && !empty($_GET['min-area']) ){
            $min_area = intval($_GET['min-area']);
            if( $min_area > 0 ){
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_size',
                    'value' => $min_area,
                    'type' => 'NUMERIC',
                    'compare' => '>='
                );
            }
        }elseif( isset($_GET['max-area']) && !empty($_GET['max-area']) ){
            $max_area = intval($_GET['max-area']);
            if( $max_area > 0 ){
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_size',
                    'value' => $max_area,
                    'type' => 'NUMERIC',
                    'compare' => '<='
                );
            }
        }


        /* if more than one taxonomies exist then specify the relation */
        $tax_count = count( $tax_query );
        if( $tax_count > 1 ){
            $tax_query['relation'] = 'AND';
        }

        /* if more than one meta query elements exist then specify the relation */
        $meta_count = count( $meta_query );
        if( $meta_count > 1 ){
            $meta_query['relation'] = 'AND';
        }

        if( $tax_count > 0 ){
            $search_args['tax_query'] = $tax_query;
        }

        /* if meta query has some values then add it to base home page query */
        if( $meta_count > 0 ){
            $search_args['meta_query'] = $meta_query;
        }

        /* Sort By Price */
        if( (isset($_GET['min-price']) && ($_GET['min-price'] != 'any')) || ( isset($_GET['max-price']) && ($_GET['max-price'] != 'any') ) ){
            $search_args['orderby'] = 'meta_value_num';
            $search_args['meta_key'] = 'REAL_HOMES_property_price';
            $search_args['order'] = 'ASC';
        }

        return $search_args;
    }
}
add_filter('real_homes_search_parameters','real_homes_search');



/*-----------------------------------------------------------------------------------*/
/*	Remove rel attribute from the category list
/*-----------------------------------------------------------------------------------*/
if(!function_exists('remove_category_list_rel')){
    function remove_category_list_rel($output)
    {
        $output = str_replace(' rel="tag"', '', $output);
        $output = str_replace(' rel="category"', '', $output);
        $output = str_replace(' rel="category tag"', '', $output);
        return $output;
    }
}
add_filter('wp_list_categories', 'remove_category_list_rel');
add_filter('the_category', 'remove_category_list_rel');



/*-----------------------------------------------------------------------------------*/
/*	Get Lightbox Plugin Class
/*-----------------------------------------------------------------------------------*/
if(!function_exists('get_lightbox_plugin_class')){
    function get_lightbox_plugin_class(){
        $lightbox_plugin_class = get_option('theme_lightbox_plugin');
        if($lightbox_plugin_class){
            return $lightbox_plugin_class;
        }else{
            return 'swipebox';
        }
    }
}



/*-----------------------------------------------------------------------------------*/
/*	Generate Gallery Attribute
/*-----------------------------------------------------------------------------------*/
if(!function_exists('generate_gallery_attribute')){
    function generate_gallery_attribute(){
        $lightbox_plugin_class = get_lightbox_plugin_class();
        if($lightbox_plugin_class == 'pretty-photo'){
            return 'data-rel="prettyPhoto[real_homes]"';
        }
        return '';
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Current Page URL
/*-----------------------------------------------------------------------------------*/
if(!function_exists('custom_taxonomy_page_url')){
    function custom_taxonomy_page_url() {
        $pageURL = 'http';
        if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on"){
            $pageURL .= "s";
        }

        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }

        if($_SERVER['QUERY_STRING']){
            $pos = strpos($pageURL,'view');
            if($pos){
                $pageURL = substr($pageURL,0,$pos - 1);
            }
        }

        return $pageURL;
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Add http:// in url if not exists
/*-----------------------------------------------------------------------------------*/
if(!function_exists('addhttp')){
    function addhttp($url) {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Output Quick CSS Fix
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'output_quick_css' ) ){
    function output_quick_css(){
        // Quick CSS from Theme Options
        $quick_css = stripslashes(get_option('theme_quick_css'));

        if(!empty($quick_css)){
            echo "<style type='text/css' id='quick-css'>\n\n";
            echo $quick_css . "\n\n";
            echo "</style>";
        }
    }
}

add_action('wp_head','output_quick_css');


/*-----------------------------------------------------------------------------------*/
/*	Output Analytics Script
/*-----------------------------------------------------------------------------------*/
if( ! function_exists( 'output_analytics_script' ) ){
    function output_analytics_script(){
        echo stripslashes( get_option( 'theme_google_analytics' ) );
    }
}
add_action('wp_head','output_analytics_script');


/*-----------------------------------------------------------------------------------*/
/*	Insert Attachment Method for Property Submit Template
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'insert_attachment' ) ){
    function insert_attachment( $file_handler, $post_id, $setthumb = false ){

        // check to make sure its a successful upload
        if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');

        $attach_id = media_handle_upload( $file_handler, $post_id );

        if ($setthumb){
            update_post_meta($post_id,'_thumbnail_id',$attach_id);
        }

        return $attach_id;
    }
}



/*-----------------------------------------------------------------------------------*/
/*	Update Taxonomy Pagination Based on Number of Properties Provided in Theme Options
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'update_taxonomy_pagination' ) ) {
    function update_taxonomy_pagination( $query ) {
        if ( is_tax( 'property-type' ) || is_tax( 'property-status' ) || is_tax( 'property-city' ) || is_tax( 'property-feature' ) ) {
            if ( $query->is_main_query() ) {
                $number_of_properties = intval(get_option('theme_number_of_properties'));
                if(!$number_of_properties){
                    $number_of_properties = 6;
                }
                $query->set('posts_per_page', $number_of_properties );
            }
        }
    }
}
add_action( 'pre_get_posts', 'update_taxonomy_pagination' );



/*-----------------------------------------------------------------------------------*/
/*	Customize Login Page
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'custom_login_logo_url' ) ) {
    function custom_login_logo_url() {
        return home_url();
    }
}
add_filter( 'login_headerurl', 'custom_login_logo_url' );

if ( ! function_exists( 'custom_login_logo_url_title' ) ) {
    function custom_login_logo_url_title() {
        return get_bloginfo('name');
    }
}
add_filter( 'login_headertitle', 'custom_login_logo_url_title' );

if ( ! function_exists( 'custom_login_style' ) ) {
    function custom_login_style() {
        wp_enqueue_style( 'login-style', get_template_directory_uri()."/css/login-style.css", false );
    }
}
add_action( 'login_enqueue_scripts', 'custom_login_style' );


/*-----------------------------------------------------------------------------------*/
// Propert Edit Form Taxonomy Options
/*-----------------------------------------------------------------------------------*/
if(!function_exists('edit_form_taxonomy_options')){
    function edit_form_taxonomy_options( $property_id, $taxonomy_name ){

        $existing_term_id = 0;
        $tax_terms = get_the_terms( $property_id, $taxonomy_name );
        if( !empty($tax_terms) ){
            foreach( $tax_terms as $tax_term ){
                $existing_term_id = $tax_term->term_id;
                break;
            }
        }

        $existing_term_id = intval($existing_term_id);

        if( $existing_term_id == 0 || empty($existing_term_id) ){
            echo '<option value="-1" selected="selected">'.__( 'None', 'framework').'</option>';
        } else {
            echo '<option value="-1">'.__( 'None', 'framework').'</option>';
        }

        $taxonomy_terms = get_terms(array(
                                $taxonomy_name
                            ),
                            array(
                                'orderby'       => 'name',
                                'order'         => 'ASC',
                                'hide_empty'    => false
                            ));

        if(!empty($taxonomy_terms)){
            foreach($taxonomy_terms as $term){
                if( $existing_term_id == intval($term->term_id) ){
                    echo '<option value="'.$term->term_id.'" selected="selected">'.$term->name.'</option>';
                }else{
                    echo '<option value="'.$term->term_id.'">'.$term->name.'</option>';
                }
            }
        }
    }
}

/*-----------------------------------------------------------------------------------*/
// Propert Edit Form Hierarchichal Taxonomy Options
/*-----------------------------------------------------------------------------------*/
if(!function_exists('edit_form_hierarchichal_options')){
    function edit_form_hierarchichal_options( $property_id, $taxonomy_name ){

        $existing_term_id = 0;
        $tax_terms = get_the_terms( $property_id, $taxonomy_name );
        if( !empty($tax_terms) ){
            foreach( $tax_terms as $tax_term ){
                $existing_term_id = $tax_term->term_id;
                break;
            }
        }

        $existing_term_id = intval($existing_term_id);
        if( $existing_term_id == 0 || empty($existing_term_id) ){
            echo '<option value="-1" selected="selected">'.__( 'None', 'framework').'</option>';
        } else {
            echo '<option value="-1">'.__( 'None', 'framework').'</option>';
        }

        $top_level_terms = get_terms(
            array(
                $taxonomy_name
            ),
            array(
                'orderby'       => 'name',
                'order'         => 'ASC',
                'hide_empty'    => false,
                'parent' => 0
            )
        );
        generate_id_based_hirarchical_options( $taxonomy_name, $top_level_terms, $existing_term_id );

    }
}


/*-----------------------------------------------------------------------------------*/
// Alert
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'alert' ) ){
    function alert( $heading = '', $message = '' ){
        echo '<div class="inspiry-message">';
        echo '<strong>'.$heading.'</strong> <span>'.$message.'</span>';
        echo '</div>';
    }
}


/*-----------------------------------------------------------------------------------*/
// Real Homes PayPal Payments List - Display Payments
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'display_properties_payments' ) ){
    function display_properties_payments(){
        ?>
        <table id="payments-table" cellpadding="10px">
            <tr>
                <th><?php _e('Transaction ID','framework');?></th>
                <th><?php _e('Payment Date','framework');?></th>
                <th><?php _e('First Name','framework');?></th>
                <th><?php _e('Last Name','framework');?></th>
                <th><?php _e('Payer Email','framework');?></th>
                <th><?php _e('Payment Status','framework');?></th>
                <th><?php _e('Amount','framework');?></th>
                <th><?php _e('Currency','framework');?></th>
                <th><?php _e('Property ID','framework');?></th>
                <th><?php _e('Property Status','framework');?></th>
                <th><?php _e('Action','framework');?></th>
            </tr>
            <?php
            // determine page (based on <_GET>)
            $page_number = isset($_GET['page_number']) ? ((int) $_GET['page_number']) : 1;
            $number_of_properties = 20;

            $paid_props_args = array(
                                    'post_type' => 'property',
                                    'posts_per_page' => $number_of_properties,
                                    'paged' => $page_number,
                                    'meta_query' => array(
                                        array(
                                            'key' => 'payment_status',
                                            'value' => 'Completed'
                                        )
                                    )
                                );

            $paid_props_query = new WP_Query($paid_props_args);

            if( $paid_props_query->have_posts() ){
                $total_found_posts = $paid_props_query->found_posts;
                while( $paid_props_query->have_posts() ){
                    $paid_props_query->the_post();
                    global $post;
                    $values = get_post_custom( $post->ID );
                    $not_available  = __('Not Available','framework');

                    $txn_id         = isset( $values['txn_id'] ) ? esc_attr( $values['txn_id'][0] ) : $not_available;
                    $payment_date   = isset( $values['payment_date'] ) ? esc_attr( $values['payment_date'][0] ) : $not_available;
                    $payer_email    = isset( $values['payer_email'] ) ? esc_attr( $values['payer_email'][0] ) : $not_available;
                    $first_name     = isset( $values['first_name'] ) ? esc_attr( $values['first_name'][0] ) : $not_available;
                    $last_name      = isset( $values['last_name'] ) ? esc_attr( $values['last_name'][0] ) : $not_available;
                    $payment_status = isset( $values['payment_status'] ) ? esc_attr( $values['payment_status'][0] ) : $not_available;
                    $payment_gross  = isset( $values['payment_gross'] ) ? esc_attr( $values['payment_gross'][0] ) : $not_available;
                    $payment_currency  = isset( $values['mc_currency'] ) ? esc_attr( $values['mc_currency'][0] ) : $not_available;
                    ?>
                    <tr>
                        <td><?php echo $txn_id; ?></td>
                        <td><?php echo $payment_date; ?></td>
                        <td><?php echo $first_name; ?></td>
                        <td><?php echo $last_name; ?></td>
                        <td><?php echo $payer_email; ?></td>
                        <td><?php echo $payment_status; ?></td>
                        <td><?php echo $payment_gross; ?></td>
                        <td><?php echo $payment_currency; ?></td>
                        <td><?php echo $post->ID; ?></td>
                        <td><?php echo $post->post_status; ?></td>
                        <td><a href="<?php echo get_edit_post_link( $post->ID ); ?>"><?php _e('Edit Property','framework'); ?></a></td>
                    </tr>
                    <?php
                }

                if( $total_found_posts > $number_of_properties ){
                    ?>
                    <tr>
                        <td colspan="11">
                            <?php
                            require_once(get_template_directory() . '/framework/functions/Pagination.class.php');

                            // instantiate; set current page; set number of records
                            $pagination = (new Pagination());
                            $pagination->setCurrent($page_number);
                            $pagination->setTotal($total_found_posts);

                            // grab rendered/parsed pagination markup
                            echo $pagination->parse();
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                wp_reset_query();
            }else{
                ?>
                <tr>
                    <td colspan="11"><?php _e('No Completed Payment Found!','framework'); ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Register and load admin styles
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'realhomes_admin_styles' ) ){
    function realhomes_admin_styles($hook){
        wp_register_style( 'realhomes-admin-styles', get_template_directory_uri() . '/css/realhomes-admin-styles.css' );
        wp_enqueue_style('realhomes-admin-styles');
    }
}
add_action('admin_enqueue_scripts','realhomes_admin_styles');



/*-----------------------------------------------------------------------------------*/
// Real Homes PayPal Payments List - Register Sub Menu
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'register_properties_payments_page' ) ){
    function register_properties_payments_page(){
        add_submenu_page(
            'edit.php?post_type=property'
            , __('Property Payments','framework')
            , __('Property Payments','framework')
            , 'manage_options'
            , 'properties-payments'
            , 'display_properties_payments'
        );
    }
}
add_action('admin_menu', 'register_properties_payments_page');


/*-----------------------------------------------------------------------------------*/
// Add Additional Contact Info to User Profile Page
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'modify_user_contact_methods' ) ){
    function modify_user_contact_methods($user_contactmethods)
    {
        $user_contactmethods['mobile_number'] = __('Mobile Number','framework');
        $user_contactmethods['office_number'] = __('Office Number','framework');
        $user_contactmethods['fax_number'] = __('Fax Number','framework');

        return $user_contactmethods;
    }
}
add_filter('user_contactmethods', 'modify_user_contact_methods');


/*-----------------------------------------------------------------------------------*/
/*	Output recaptcha related JavaScript
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'output_recaptcha_js' ) ){
    function output_recaptcha_js(){
        $show_reCAPTCHA = get_option('theme_show_reCAPTCHA');
        $reCAPTCHA_public_key = get_option('theme_recaptcha_public_key');
        $reCAPTCHA_private_key = get_option('theme_recaptcha_private_key');

        if(!empty($reCAPTCHA_public_key) && !empty($reCAPTCHA_private_key) && $show_reCAPTCHA == 'true' ){
            ?>
            <script type="text/javascript">
                var RecaptchaOptions = {
                    theme : 'custom',
                    custom_theme_widget: 'recaptcha_widget'
                };
            </script>
            <?php
        }
    }
}
add_action('wp_head','output_recaptcha_js');

/*-----------------------------------------------------------------------------------*/
/*	Properties sorting
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'sort_properties' ) ){
    /**
     * @param $property_query_args
     * @return mixed
     */
    function sort_properties($property_query_args){
        if (isset($_GET['sortby'])) {
            $orderby = $_GET['sortby'];
            if ($orderby == 'price-asc') {
                $property_query_args['orderby'] = 'meta_value_num';
                $property_query_args['meta_key'] = 'REAL_HOMES_property_price';
                $property_query_args['order'] = 'ASC';
            } else if ($orderby == 'price-desc') {
                $property_query_args['orderby'] = 'meta_value_num';
                $property_query_args['meta_key'] = 'REAL_HOMES_property_price';
                $property_query_args['order'] = 'DESC';
            } else if ($orderby == 'date-asc') {
                $property_query_args['orderby'] = 'date';
                $property_query_args['order'] = 'ASC';
            } else if ($orderby == 'date-desc') {
                $property_query_args['orderby'] = 'date';
                $property_query_args['order'] = 'DESC';
            }
        }
        return $property_query_args;
    }
}

/*-----------------------------------------------------------------------------------*/
//	Generate posts list
/*-----------------------------------------------------------------------------------*/
if(!function_exists('generate_posts_list')){
    function generate_posts_list($post_args, $selected = 0) {

        $defaults = array( 'posts_per_page' => -1 );

        if(is_array($post_args)){
            $post_args = wp_parse_args( $post_args, $defaults );
        } else {
            $post_args = wp_parse_args(array('post_type' => $post_args),$defaults);
        }

        $posts = get_posts( $post_args );
        foreach ( $posts as $post ) :
            ?><option value="<?php echo $post->ID; ?>" <?php if( isset($selected) && ($selected == $post->ID ) ){ echo "selected"; } ?>><?php echo $post->post_title; ?></option><?php
        endforeach;
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Add to favorite
/*-----------------------------------------------------------------------------------*/
add_action('wp_ajax_add_to_favorite', 'add_to_favorite');

if( !function_exists( 'add_to_favorite' ) ){
    function add_to_favorite(){
        if( isset($_POST['property_id']) && isset($_POST['user_id']) ){
            $property_id = intval($_POST['property_id']);
            $user_id = intval($_POST['user_id']);
            if( $property_id > 0 && $user_id > 0 ){
                if( add_user_meta($user_id,'favorite_properties', $property_id ) ){
                    _e('Added to Favorites', 'framework');
                }else{
                    _e('Failed!', 'framework');
                }
            }
        }else{
            _e('Invalid Paramenters!', 'framework');
        }
        die;
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Already added to favorite
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'is_added_to_favorite' ) ){
    function is_added_to_favorite( $user_id, $property_id ){
        global $wpdb;
        $results = $wpdb->get_results( "SELECT * FROM $wpdb->usermeta WHERE meta_key='favorite_properties' AND meta_value=".$property_id." AND user_id=". $user_id );
        if( isset($results[0]->meta_value) && ($results[0]->meta_value == $property_id) ){
            return true;
        }else{
            return false;
        }
    }
}


/*-----------------------------------------------------------------------------------*/
// Remove from favorites
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_ajax_remove_from_favorites', 'remove_from_favorites' );

if( !function_exists( 'remove_from_favorites' ) ){
    function remove_from_favorites(){
        if( isset($_POST['property_id']) && isset($_POST['user_id']) ){
            $property_id = intval($_POST['property_id']);
            $user_id = intval($_POST['user_id']);
            if( $property_id > 0 && $user_id > 0 ){
                if( delete_user_meta( $user_id, 'favorite_properties', $property_id ) ){
                    echo 3;
                    /* Removed successfully! */
                }else{
                    echo 2;
                    /* Failed to remove! */
                }
            }else{
                echo 1;
                /* Invalid parameters! */
            }
        }else{
            echo 1;
            /* Invalid parameters! */
        }
        die;
    }
}


/*-----------------------------------------------------------------------------------*/
// Fontawsome icon based on file extension
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'get_icon_for_extension' ) ){
    function get_icon_for_extension($ext){
        switch($ext){
            /* PDF */
            case 'pdf':
                return '<i class="fa fa-file-pdf-o"></i>';

            /* Images */
            case 'jpg':
            case 'png':
            case 'gif':
            case 'bmp':
            case 'jpeg':
            case 'tiff':
            case 'tif':
                return '<i class="fa fa-file-image-o"></i>';

            /* Text */
            case 'txt':
            case 'log':
            case 'tex':
                return '<i class="fa fa-file-text-o"></i>';

            /* Documents */
            case 'doc':
            case 'odt':
            case 'msg':
            case 'docx':
            case 'rtf':
            case 'wps':
            case 'wpd':
            case 'pages':
                return '<i class="fa fa-file-word-o"></i>';

            /* Spread Sheets */
            case 'csv':
            case 'xlsx':
            case 'xls':
            case 'xml':
            case 'xlr':
                return '<i class="fa fa-file-excel-o"></i>';

            /* Zip */
            case 'zip':
            case 'rar':
            case '7z':
            case 'zipx':
            case 'tar.gz':
            case 'gz':
            case 'pkg':
                return '<i class="fa fa-file-zip-o"></i>';

            /* Audio */
            case 'mp3':
            case 'wav':
            case 'm4a':
            case 'aif':
            case 'wma':
            case 'ra':
            case 'mpa':
            case 'iff':
            case 'm3u':
                return '<i class="fa fa-file-audio-o"></i>';

            /* Video */
            case 'avi':
            case 'flv':
            case 'm4v':
            case 'mov':
            case 'mp4':
            case 'mpg':
            case 'rm':
            case 'swf':
            case 'wmv':
                return '<i class="fa fa-file-video-o"></i>';

            /* Others */
            default:
                return '<i class="fa fa-file-o"></i>';
        }
    }
}



/*-----------------------------------------------------------------------------------*/
// Open Graph Meta Tags
/*-----------------------------------------------------------------------------------*/
if( 'true' == get_option('theme_add_meta_tags') ){

    //Adding the Open Graph in the Language Attributes
    if( !function_exists( 'add_opengraph_doctype' ) ){
        function add_opengraph_doctype( $output ) {
            if( is_singular('property') ){
                return $output . '
                xmlns:og="http://opengraphprotocol.org/schema/"
                xmlns:fb="http://www.facebook.com/2008/fbml"';
            }
        }
    }
    add_filter('language_attributes', 'add_opengraph_doctype');

    //Adding the Open Graph Meta Info
    if( !function_exists( 'insert_og_in_head' ) ){
        function insert_og_in_head() {
            if( is_singular('property') ){
                global $post;
                if ( has_excerpt( $post->ID ) ) {
                    $description = strip_tags( get_the_excerpt() );
                } else {
                    $description = str_replace( "\r\n", ' ' , substr( strip_tags( strip_shortcodes( $post->post_content ) ), 0, 160 ) );
                }
                if(empty($description)) {
                    $description = get_bloginfo( 'description' );
                }

                echo '<meta property="og:title" content="' . get_the_title() . '"/>';
                echo '<meta property="og:description" content="'. $description .'" />';
                echo '<meta property="og:type" content="article"/>';
                echo '<meta property="og:url" content="' . get_permalink() . '"/>';
                echo '<meta property="og:site_name" content="' .  get_bloginfo('name') . '"/>';
                if(has_post_thumbnail( $post->ID )) {
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                    echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
                }
            }
        }
    }
    add_action( 'wp_head', 'insert_og_in_head', 5 );
}

/*-----------------------------------------------------------------------------------*/
// Display figcaption based on property statuses
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'display_figcaption' ) ){
    function display_figcaption( $post_id ){
        $status_terms = get_the_terms( $post_id, "property-status" );
        if( !empty( $status_terms ) ){
            $status_classes = '';
            $status_names = '';
            $status_count = 0;
            foreach( $status_terms as $term ){
                if( $status_count > 0 ){
                    $status_names .= ', ';  /* add comma before the term namee of 2nd and any later term */
                    $status_classes .= ' ';
                }
                $status_names .= $term->name;
                $status_classes .= $term->slug;
                $status_count++;
            }
            if( !empty( $status_names) ){
                echo '<figcaption class="'.$status_classes.'">'.$status_names.'</figcaption>';
            }
        }
    }
}


/*-----------------------------------------------------------------------------------*/
// Featured image place holder
/*-----------------------------------------------------------------------------------*/
if( !function_exists('inspiry_image_placeholder')){
    function inspiry_image_placeholder( $image_size ){

        global $_wp_additional_image_sizes;

        $holder_width = 0;
        $holder_height = 0;
        $holder_text = get_bloginfo('name');

        if ( in_array( $image_size , array( 'thumbnail', 'medium', 'large' ) ) ) {

            $holder_width = get_option( $image_size . '_size_w' );
            $holder_height = get_option( $image_size . '_size_h' );

        } elseif ( isset( $_wp_additional_image_sizes[ $image_size ] ) ) {

            $holder_width = $_wp_additional_image_sizes[ $image_size ]['width'];
            $holder_height = $_wp_additional_image_sizes[ $image_size ]['height'];

        }

        if( intval($holder_width) > 0 && intval($holder_height) > 0 ) {
            echo '<img src="http://placehold.it/' . $holder_width . 'x' . $holder_height . '&text=' . urlencode($holder_text) . '" />';
        }
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Homepage Properties Based on Selection
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'selection_based_properties' ) ) {
    function selection_based_properties( $properties_args ){

        $types_for_homepage = get_option('theme_types_for_homepage');
        $statuses_for_homepage = get_option('theme_statuses_for_homepage');
        $cities_for_homepage = get_option('theme_cities_for_homepage');

        $tax_query = array();

        if(!empty($types_for_homepage) && is_array($types_for_homepage)){
            $tax_query[] = array(
                'taxonomy' => 'property-type',
                'field' => 'slug',
                'terms' => $types_for_homepage
            );
        }

        if(!empty($statuses_for_homepage) && is_array($statuses_for_homepage)){
            $tax_query[] = array(
                'taxonomy' => 'property-status',
                'field' => 'slug',
                'terms' => $statuses_for_homepage
            );
        }

        if(!empty($cities_for_homepage) && is_array($cities_for_homepage)){
            $tax_query[] = array(
                'taxonomy' => 'property-city',
                'field' => 'slug',
                'terms' => $cities_for_homepage
            );
        }

        $tax_count = count( $tax_query );   // count number of taxonomies
        if( $tax_count > 1 ){
            $tax_query['relation'] = 'AND';  // add OR relation if more than one
        }

        if( $tax_count > 0 ){
            $properties_args['tax_query'] = $tax_query;   // add taxonomies query to home query arguments
        }

        return $properties_args;

    }
}


/*-----------------------------------------------------------------------------------*/
/*	 Featured Properties on Homepage
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'only_featured_properties' ) ) {
    function only_featured_properties( $properties_args ){

        $properties_args['meta_query'] = array(
            array(
                'key' => 'REAL_HOMES_featured',
                'value' => 1,
                'compare' => '=',
                'type'  => 'NUMERIC'
            ));

        return $properties_args;

    }
}
add_filter( 'real_homes_only_featured_properties', 'only_featured_properties' );


/*-----------------------------------------------------------------------------------*/
/*	 Homepage Properties
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'homepage_properties' ) ) {
    function homepage_properties( $properties_args ){

        /* Modify home query arguments based on theme options */
        $home_properties = get_option('theme_home_properties');
        if( !empty($home_properties) && ($home_properties == 'based-on-selection') ){

            /* Properties Based on Selection from Theme Options */
            $properties_args = selection_based_properties( $properties_args );

        } elseif ( !empty($home_properties) && ($home_properties == 'featured') ) {

            /* Featured Properties on Homepage */
            $properties_args = apply_filters('real_homes_only_featured_properties', $properties_args);

        } else {

            /* Exclude Featured Properties If Enabled */
            $featured_properties = get_option('theme_exclude_featured_properties');
            if(!empty($featured_properties) && $featured_properties == 'true'){
                $properties_args['meta_query'] = array(
                    array(
                        'key' => 'REAL_HOMES_featured',
                        'value' => 0,
                        'compare' => '=',
                        'type'  => 'NUMERIC'
                    ));
            }

        }

        return $properties_args;

    }
}
add_filter( 'real_homes_homepage_properties', 'homepage_properties' );


/*-----------------------------------------------------------------------------------*/
/*	 Inspiry log
/*-----------------------------------------------------------------------------------*/
if(!function_exists('inspiry_log')){
    function inspiry_log( $message ) {
        if( WP_DEBUG === true ){
            if( is_array( $message ) || is_object( $message ) ){
                error_log( print_r( $message, true ) );
            } else {
                error_log( $message );
            }
        }
    }
}


?>