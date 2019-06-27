<?php
/**
 * Story class extends WP_Post
 * 
 * @package Indigitous Stories
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class Indigitous_Story {

    /**
     * The story post ID
     *
     * @var integer
     */
    public $ID;


    public function __construct( $post_id ) {
        if ( false !== get_post_status( $post_id ) ) {
            $this->ID = $post_id;
        }
    }


    public function get_slogan() {
        return get_post_meta( $this->ID, 'story_slogan', true );
    }


    public function get_user_id() {
        return get_post_meta( $this->ID, 'story_user_id', true );
    }


    public function get_user_first_name() {
        return get_post_meta( $this->ID, 'story_user_first_name', true );
    }


    public function get_user_last_name() {
        return get_post_meta( $this->ID, 'story_user_last_name', true );
    }


    public function get_user_city() {
        return get_post_meta( $this->ID, 'story_user_city', true );
    }


    public function get_user_title() {
        return get_post_meta( $this->ID, 'story_user_title', true );
    }


    public function get_image() {
        $post_thumbnail = get_the_post_thumbnail_url( $this->ID, 'full' );

        if ( $post_thumbnail ) {
            return esc_url( $post_thumbnail );
        }

        return false;
    }

    public function get_hub_id() {
        return get_post_meta( $this->ID, 'story_hub_id', true );
    }
}