jQuery(function($){

	$(window).load(function() {
	  //$("#tour-guide").joyride();
	//$('#slider').orbit();
		//$('div.orbit-caption').wrap('<div class="caption-outer" />');
	});
/*
palm
lap
lap-and-up
portable
desk

from _var

$responsive:        true;
$lap-start:         481px;
$desk-start:        1024px;

*/
	var jRes = jRespond([
		{
			label: 'palm',
			enter: 0,
			exit: 767
		},{
			label: 'portable',
			enter: 768,
			exit: 979
		},{
			label: 'lap-and-up',
			enter: 980,
			exit: 1199
		},{
			label: 'desk',
			enter: 1200,
			exit: 10000
		}
	]);

// switchClass( "newClass", "anotherNewClass", 1000 );



	jRes.addFunc({
		breakpoint: 'palm',
		enter: function() {
			$("#menu-primary , #menu-primary-1").toggleClass('nav--block').toggleClass('nav--stacked');
			$('.callout .row > ul > li').toggleClass('one-third').toggleClass('one-whole');
		},
		exit: function() {
			console.log('<<< destroy this when exiting the DESKTOP breakpoint >>>');
			$("#menu-primary , #menu-primary-1").toggleClass('nav--block').toggleClass('nav--stacked');
			$('.callout .row > ul > li').toggleClass('one-third').toggleClass('one-whole');
		}
	});

});