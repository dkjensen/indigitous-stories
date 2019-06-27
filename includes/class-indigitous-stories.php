<?php
/**
 * Main Indigitous_Stories class file
 * 
 * @package Indigitous Stories
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class Indigitous_Stories {

    /**
	 * Plugin object
	 */
    private static $instance;


    /**
     * Insures that only one instance of Indigitous_Stories exists in memory at any one time.
     * 
     * @return Indigitous_Stories The one true instance of Indigitous_Stories
     */
    public static function instance() {
        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Indigitous_Stories ) ) {
            self::$instance = new Indigitous_Stories;
            self::$instance->includes();

            do_action_ref_array( 'indigitous_stories_loaded', self::$instance ); 
        }
        
        return self::$instance;
    }


    /**
     * Include the goodies
     *
     * @return void
     */
    public function includes() {
        require_once INDIGITOUS_STORIES_PLUGIN_DIR . 'includes/class-indigitous-stories-setup.php';

        // Single story object
        require_once INDIGITOUS_STORIES_PLUGIN_DIR . 'includes/class-indigitous-story.php';

        if ( is_admin() ) {
            require_once INDIGITOUS_STORIES_PLUGIN_DIR . 'includes/admin/class-indigitous-stories-meta-boxes.php';
        }
    }
    

    /**
     * Load a template file from the theme or fallback to the plugins default
     *
     * @param string $slug
     * @param array  $args
     * @return void
     */
    public function get_template( $slug, $args = array() ) {
        $cache_key = sanitize_key( implode( '-', array( 'template', $slug ) ) );
        $template  = (string) wp_cache_get( $cache_key, 'Indigitous_Stories' );

        if ( ! $template ) {
            if ( ! $template ) {
                $template = locate_template( array( "{$slug}.php", "indigitous-stories/{$slug}.php" ) );
            }

            if ( ! $template ) {
                $fallback = INDIGITOUS_STORIES_PLUGIN_DIR . "templates/{$slug}.php";
                $template = file_exists( $fallback ) ? $fallback : '';
            }

            wp_cache_set( $cache_key, $template, 'Indigitous_Stories' );
        }

        if ( $template ) {
            extract( $args ); // @codingStandardsIgnoreLine

            include $template;
        }
    }


    /**
     * Throw error on object clone
     *
     * @return void
     */
    public function __clone() {
        _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'indigitous-stories' ), '1.0.0' );
    }


    /**
     * Disable unserializing of the class
     * 
     * @return void
     */
    public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'indigitous-stories' ), '1.0.0' );
    }

}