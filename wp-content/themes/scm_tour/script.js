jQuery(function($){

	$(window).load(function() {
	  $("#tour-guide").joyride();

		$('#slider').orbit({
			animation: 'fade',
			animationSpeed: 2200,
			advanceSpeed: 8000,
		});

		$('#slider img').show();

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


/* THIS SEEMS TO BE CAUSING PAGE LOAD LAG.KILLING IT UNTIL I CAN LOOK INTO IT.
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

*/
});