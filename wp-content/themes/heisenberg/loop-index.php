
<div class="<?php scm_main_class_filter(); ?>">

<!-- Skip Nav -->
<a id="content"></a>
	
	<!-- Start the Loop -->	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
		<!-- Begin the first article -->

		<?php scm_loop_index_content(); ?>
		
		<!-- Closes the first article -->
	
	<!-- Stop The Loop (but note the "else:" - see next line). -->
	<?php endwhile; else: ?>
	
		<!-- The very first "if" tested to see if there were any Posts to -->
		<!-- display.  This "else" part tells what do if there weren't any. -->
		<p>Sorry, no posts matched your criteria.</p>
	
	<!--End the loop -->
	<?php endif; ?>
	
	<!-- Begin Pagination -->
	<?php if (function_exists("emm_paginate")) {
	    emm_paginate();
	} ?>	        	
	<!-- End Pagination -->

</div>