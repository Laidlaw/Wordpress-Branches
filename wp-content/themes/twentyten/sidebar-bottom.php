<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<center><div id="dots-border" style="margin-bottom:20px; width:95%; margin-right: 15px;"></center>
<div id="bottom-side" style="margin-bottom:20px; width:880px; padding-left:40px;">
<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'bottom-widget-area' ) ) : ?>

		
				<?php dynamic_sidebar( 'bottom-widget-area' ); ?>
		

<?php endif; ?>
</div>
<center><div id="dots-border" style="margin-bottom:20px; width:95%; margin-right: 15px;"></center>

