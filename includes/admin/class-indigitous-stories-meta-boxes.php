<?php
/**
 * Meta boxes
 * 
 * @package Indigitous Stories
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class Indigitous_Stories_Meta_Boxes {

    public function __construct() {
        add_action( 'cmb2_admin_init', array( $this, 'stories_meta_boxes' ) );
    }


    public function stories_meta_boxes() {
        $prefix = 'story_';

        $cmb = new_cmb2_box( array(
            'id'            => 'story_fields',
            'title'         => __( 'Story Fields', 'indigitous-stories' ),
            'object_types'  => array( 'indigitous-story' ),
            'context'       => 'normal',
            'priority'      => 'high',
        ) );

        $cmb->add_field( array(
            'name'          => __( 'Slogan', 'indigitous-stories' ),
            'id'            => $prefix . 'slogan',
            'type'          => 'text',
        ) );

        $cmb->add_field( array(
            'name'          => __( 'Story User ID', 'indigitous-stories' ),
            'id'            => $prefix . 'user_id',
            'desc'          => __( 'User ID associated with the story', 'indigitous-stories' ),
            'type'          => 'text'
        ) );

        $cmb->add_field( array(
            'name'          => __( 'Story User First Name', 'indigitous-stories' ),
            'id'            => $prefix . 'user_first_name',
            'type'          => 'text',
        ) );

        $cmb->add_field( array(
            'name'          => __( 'Story User Last Name', 'indigitous-stories' ),
            'id'            => $prefix . 'user_last_name',
            'type'          => 'text',
        ) );

        $cmb->add_field( array(
            'name'          => __( 'Story User City', 'indigitous-stories' ),
            'id'            => $prefix . 'user_city',
            'type'          => 'text',
        ) );

        $cmb->add_field( array(
            'name'          => __( 'Story User Title', 'indigitous-stories' ),
            'id'            => $prefix . 'user_title',
            'type'          => 'text',
        ) );

        $cmb->add_field( array(
            'name'          => __( 'Story Hub ID', 'indigitous-stories' ),
            'id'            => $prefix . 'hub_id',
            'type'          => 'text'
        ) );
    }

}
return new Indigitous_Stories_Meta_Boxes;