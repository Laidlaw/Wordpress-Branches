<?php
if( is_admin() ) {

	if( !function_exists( 'vl_wpsc_dashboard_setup' ) ) {

		function vl_wpsc_dashboard_setup() {

			wp_add_dashboard_widget('vl_wpsc_news_widget', __( 'Plugin News - by Visser Labs','vl_wpsc' ),'vl_wpsc_news_widget');

		}
		add_action('wp_dashboard_setup', 'vl_wpsc_dashboard_setup');
	
		function vl_wpsc_news_widget() {

			include_once( ABSPATH . WPINC . '/feed.php' );

			$rss = fetch_feed( 'http://www.visser.com.au/blog/category/e-commerce/feed/' );
			$output = '<div class="rss-widget">';
			if( !is_wp_error( $rss ) ) { // Checks that the object is created correctly
				// Figure out how many total items there are, but limit it to 5.
				$maxitems = $rss->get_item_quantity(5);
				// Build an array of all the items, starting with element 0 (first element).
				$rss_items = $rss->get_items(0, $maxitems);
				$output .= '<ul>';
				foreach ( $rss_items as $item ) :
					$output .= '<li>';
					$output .= '<a href="' . $item->get_permalink() . '" title="' . 'Posted ' . $item->get_date('j F Y | g:i a') . '" class="rsswidget">' . $item->get_title() . '</a>';
					$output .= '<span class="rss-date">' . $item->get_date( 'j F, Y' ) . '</span>';
					$output .= '<div class="rssSummary">' . $item->get_description() . '</div>';
					$output .= '</li>';
				endforeach;
				$output .= '</ul>';
			} else {
				$message = 'Connection failed. Please check your network settings.';
				$output .= '<p>' . $message . '</p>';
			}

			$output .= '</div>';

			echo $output;

		}

	}

	function wpsc_cf_is_serialized($str) {

		return( $str == serialize( false ) || @unserialize( $str ) !== false );

	}

}

if( !function_exists( 'wpsc_get_major_version' ) ) {

	function wpsc_get_major_version() {

		$version = get_option( 'wpsc_version' );
		return substr( $version,0,3 );

	}

}
?>