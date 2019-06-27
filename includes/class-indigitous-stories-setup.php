<?php
/**
 * Setup
 * 
 * @package Indigitous Stories
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class Indigitous_Stories_Setup {

    public function __construct() {
        add_action( 'init', array( $this, 'post_types' ) );

        // Shortcode
        add_shortcode( 'indigitous-stories', array( $this, 'shortcode' ) );

        add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
        add_filter( 'the_content', array( $this, 'single_story_content' ) );
        add_action( 'the_post', array( $this, 'stories_grid_cta' ), 10, 2 );
    }


    /**
     * Register post types
     *
     * @return void
     */
    public function post_types() {
        $args = array(
            'labels'             => array(
                'name'               => _x( 'Stories', 'post type general name', 'indigitous-stories' ),
                'singular_name'      => _x( 'Story', 'post type singular name', 'indigitous-stories' ),
                'menu_name'          => _x( 'Stories', 'admin menu', 'indigitous-stories' ),
                'name_admin_bar'     => _x( 'Story', 'add new on admin bar', 'indigitous-stories' ),
                'add_new'            => _x( 'Add New', 'story', 'indigitous-stories' ),
                'add_new_item'       => __( 'Add New Story', 'indigitous-stories' ),
                'new_item'           => __( 'New Story', 'indigitous-stories' ),
                'edit_item'          => __( 'Edit Story', 'indigitous-stories' ),
                'view_item'          => __( 'View Story', 'indigitous-stories' ),
                'all_items'          => __( 'All Stories', 'indigitous-stories' ),
                'search_items'       => __( 'Search Stories', 'indigitous-stories' ),
                'parent_item_colon'  => __( 'Parent Stories:', 'indigitous-stories' ),
                'not_found'          => __( 'No stories found.', 'indigitous-stories' ),
                'not_found_in_trash' => __( 'No stories found in Trash.', 'indigitous-stories' )
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'has_archive'        => false,
            'rewrite'            => array( 'slug' => 'story' ),
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-book-alt',
            'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
        );
    
        register_post_type( 'indigitous-story', $args );
    }


    /**
     * Grid templates
     *
     * @param  array $atts
     * @param  string $content
     * @return string
     */
    public function shortcode( $atts, $content = '' ) {
        $atts = shortcode_atts( array(
            'per_page'          => 12
        ), $atts, 'indigitous-stories' );

        $stories = new WP_Query( array(
            'post_type'             => 'indigitous-story',
            'posts_per_page'        => $atts['per_page'],
            'post_status'           => 'publish',
        ) );

        ob_start();

        Indigitous_Stories()->get_template( 'stories-grid', array( 'stories' => $stories ) );

        return ob_get_clean();
    }


    /**
     * Enqueue scripts
     *
     * @return void
     */
    public function scripts() {
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '.min' : '';

        wp_enqueue_style( 'indigitous-stories', INDIGITOUS_STORIES_PLUGIN_URL . 'assets/css/frontend' . $suffix . '.css', array(), INDIGITOUS_STORIES_VER );
    }


    public function single_story_content( $content ) {
        if ( is_singular( 'indigitous-story' ) && is_main_query() && ! is_admin() ) {
            ob_start();

            Indigitous_Stories()->get_template( 'single-story', array( 'content' => $content ) );

            return ob_get_clean();
        }

        return $content;
    }


    public function stories_grid_cta( $post, $query ) {
        if ( ! is_admin() && $query->get( 'post_type' ) == 'indigitous-story' ) {
            $position = defined( 'INDIGITOUS_STORIES_CTA_POSITION' ) ? (int) defined( 'INDIGITOUS_STORIES_CTA_POSITION' ) : 10;

            if ( $query->found_posts <= $position && $query->current_post + 1 >= $query->found_posts ) {
                $post->stories_grid_cta = true;
            }elseif ( $query->found_posts > $position && $query->current_post + 1 == $position ) {
                $post->stories_grid_cta = true;
            }elseif ( $position < 1 && $query->current_post == 0 ) {
                $post->stories_grid_cta = true;
            }
        }
    }

}
return new Indigitous_Stories_Setup;