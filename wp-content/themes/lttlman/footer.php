<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package lttlman
 * @since lttlman 1.0
 */
?>
	</div><!-- #main .site-main -->
	<div id="sub-site-footer"></div>
</div><!-- #page .hfeed .site -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'lttlman_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'lttlman' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'lttlman' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'lttlman' ), 'lttlman', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->


<?php wp_footer(); ?>

</body>
</html>