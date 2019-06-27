<?php
/**
 * Single grid story
 * 
 * @package Indigitous Stories
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$story = new Indigitous_Story( get_the_ID() );

?>

<div <?php post_class( 'indigitous-story' ); ?><?php if ( $story->get_image() ) : ?> style="background-image: url('<?php print $story->get_image(); ?>');"<?php endif; ?>>
    <a href="<?php the_permalink(); ?>">
        <div class="story-content">
            <h4 class="story-slogan"><?php esc_html_e( $story->get_slogan(), 'indigitous-stories' ); ?></h4>
            <div class="story-meta">
                <?php esc_html_e( implode( ', ', array_filter( array( $story->get_user_first_name(), $story->get_user_city() ) ) ), 'indigitous-stories' ); ?>
            </div>
        </div>
    </a>
</div>