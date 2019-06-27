<?php
/**
 * Single post story
 * 
 * @package Indigitous Stories
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$story = new Indigitous_Story( get_the_ID() );

$story_user = get_userdata( $story->get_user_id() );
?>

<div <?php post_class( 'indigitous-story single-story' ); ?>>
    <div class="story-header" <?php if ( $story->get_image() ) : ?> style="background-image: url('<?php print $story->get_image(); ?>');"<?php endif; ?>>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-content">
                        <div class="story-user-city"><?php esc_html_e( $story->get_user_city(), 'indigitous-stories' ); ?>:</div>
                        <div class="story-slogan"><?php esc_html_e( $story->get_slogan(), 'indigitous-stories' ); ?></div>
                        <div class="story-user-name"><?php esc_html_e( implode( ' ', array_filter( array( $story->get_user_first_name(), $story->get_user_last_name() ) ) ), 'indigitous-stories' ); ?></div>
                        <div class="story-user-title"><?php esc_html_e( $story->get_user_title(), 'indigitous-stories' ); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="story-content">
                <?php print $content; ?>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="story-sidebar">

                <?php if ( $story_user ) : ?>

                <div class="contact-story-user sidebar-section">
                    <a href="<?php print wp_nonce_url( add_query_arg( array( 'r' => $story_user->user_nicename ), bp_loggedin_user_domain() . bp_get_messages_slug() . '/compose/' ) ); ?>" class="button full"><?php printf( __( 'Contact %s', 'indigitous-stories' ), $story->get_user_first_name() ); ?></a>
                </div>

                <?php endif; ?>

                <?php if ( $story->get_hub_id() ) : ?>

                <div class="hub-story-user sidebar-section">
                    <a href="<?php print get_permalink( $story->get_hub_id() ); ?>" class="button full"><?php _e( 'Join My Hub', 'indigitous-stories' ); ?></a>
                </div>

                <?php endif; ?>

                <?php if ( $story_user && function_exists( 'get_user_projects_joined' ) && get_user_projects_joined( $story->get_user_id() ) ) : ?>

                <div class="hub-story-user-projects sidebar-section">
                    <a href="<?php print esc_url( home_url( '/members/' . $story_user->user_nicename . '/projects/' ) ) ?>" class="button full"><?php _e( 'My Projects', 'indigitous-stories' ); ?></a>
                </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>