<?php
/**
 * Stories grid
 * 
 * @package Indigitous Stories
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $stories && $stories->have_posts() ) :
?>

    <div class="indigitous-stories-grid">

    <?php while( $stories->have_posts() ) : $stories->the_post(); ?>

        <?php Indigitous_Stories()->get_template( 'content-story' ); ?>

        <?php Indigitous_Stories()->get_template( 'content-cta' ); ?>

    <?php endwhile; ?>

    </div>

<?php endif;