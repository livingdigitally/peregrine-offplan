<?php

// Make default admin page the property listing
function loginRedirect( $redirect_to, $request, $user ){
    if( is_array( $user->roles ) ) { // check if user has a role
        $home = "http://" . $_SERVER['SERVER_NAME'];
        $server_port = $_SERVER['SERVER_PORT'];
        $home .= ($server_port ? ":$server_port" : NULL);
        $home .= "/peregrine-offplan/wordpress";
        return $home;
    }
}
add_filter("login_redirect", "loginRedirect", 10, 3);

// Remove the Dashboard from the admin
add_action( 'admin_menu', 'Wps_remove_tools', 99 );
function Wps_remove_tools(){

  remove_menu_page( 'index.php' ); //dashboard

}

// Remove the Wordpress logo from the admin
function annointed_admin_bar_remove() {
        global $wp_admin_bar;

        $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

// Remove footer from admin
if (! function_exists('dashboard_footer ') ){
function dashboard_footer () {
}
}
add_filter('admin_footer_text', 'dashboard_footer ');

// Remove wordpress version from footer
function my_footer_shh() {
    remove_filter( 'update_footer', 'core_update_footer' ); 
}

add_action( 'admin_menu', 'my_footer_shh' );

/*-----------------------------------------------------------------------------------*/
/*	Enqueue Styles in Child Theme
/*-----------------------------------------------------------------------------------*/
if (!function_exists('inspiry_enqueue_child_styles')) {
    function inspiry_enqueue_child_styles(){
        if ( !is_admin() ) {
            // dequeue and deregister parent default css
            wp_dequeue_style( 'parent-default' );
            wp_deregister_style( 'parent-default' );

            // dequeue parent custom css
            wp_dequeue_style( 'parent-custom' );

            // parent default css
            wp_enqueue_style( 'parent-default', get_template_directory_uri().'/style.css' );

            // parent custom css
            wp_enqueue_style( 'parent-custom' );

            // child default css
            wp_enqueue_style('child-default', get_stylesheet_uri(), array('parent-default'), '1.0', 'all' );

            // child custom css
            wp_enqueue_style('child-custom',  get_stylesheet_directory_uri() . '/child-custom.css', array('child-default'), '1.0', 'all' );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'inspiry_enqueue_child_styles', PHP_INT_MAX );

