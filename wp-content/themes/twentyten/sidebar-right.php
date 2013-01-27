<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<div id="right-side" style="margin-bottom:20px;">
<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'right-widget-area' ) ) : ?>

		
				<?php dynamic_sidebar( 'right-widget-area' ); ?>
		

<?php endif; ?>
</div>