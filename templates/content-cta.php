<?php
/**
 * Grid call to action
 * 
 * @package Indigitous Stories
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

if ( isset( $post->stories_grid_cta ) && $post->stories_grid_cta ) :
?>

<div <?php post_class( 'indigitous-story-cta' ); ?>>
    <div class="story-cta-content">
        <h3><?php _e( 'Indigitous is a global community advancing God\'s Kingdom through technology.', 'indigitous-stories' ); ?></h3>
        <p><a href="#register" data-modal="true" class="button"><?php _e( 'Meet Awesome People', 'indigitous-stories' ); ?></a></p>
    </div>
</div>

<?php endif; ?>