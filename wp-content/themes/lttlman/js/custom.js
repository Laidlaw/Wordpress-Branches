

jQuery( document ).ready( function( $ ) {

$('body').addClass('js');
  
  /*var $menu = $('#menu'),
    $menulink = $('.menu-link a'),
    $wrap = $('#wrap');
  
  $menulink.click(function() {
    $menulink.toggleClass('active');
    $wrap.toggleClass('active');
    return false;
  });
*/

$("h1.site-title a").lettering();

var title = $("h1");

$('.char2').before('<span class="inserted">i</span>');
$('.char4').after('<span class="inserted">e</span>');
 title.hover(
  function () {   
    $('.inserted').animate({
    fontSize: "1em",
    opacity: 'toggle'
  }, 500, 'swing', function() {});
    
  },
  function () {
    $('.inserted').animate({
    fontSize: "0",
    opacity: 'toggle'
  }, 500, 'swing', function() {});
    
  }
);



// WAYPOINTS.JS CODE
	$('.top').addClass('hidden');
	$.waypoints.settings.scrollThrottle = 30;
	$('#page').waypoint(function(event, direction) {
		$('.top').toggleClass('hidden', direction === "up");
	}, {
		offset: '-100%'
	}).find('.sidebar').waypoint(function(event, direction) {
		$(this).parent().toggleClass('sticky', direction === "down");
		event.stopPropagation();
	});
var sections = $("section");
var navigation_links = $("nav a");
	
	sections.waypoint({
		handler: function(event, direction) {
		
			var active_section;
			active_section = $(this);
			if (direction === "up") active_section = active_section.prev();

			var active_link = $('nav a[href="#' + active_section.attr("id") + '"]');
			navigation_links.removeClass("selected");
			active_link.addClass("selected");

		},
		offset: '25%'
	})
	
	
	navigation_links.click( function(event) {

		$.scrollTo(
			$(this).attr("href"),
			{
				duration: 200,
				offset: { 'left':0, 'top':-0.15*$(window).height() }
			}
		);
	});

// AJAXING LINKS
	$("a.ajaxed").click(function(event) {
	    event.preventDefault();     
	    $.ajax({
	        type: 'POST',
	        dataType: 'JSON',
	        url: ajax_object.ajaxurl,
	        data: ({
	            action : 'ajaxify',
	            post_id: $(this).parent().attr("id")
	            }),
	        success:function(data){
	            console.log(data);
	        }
	    });
	});
});