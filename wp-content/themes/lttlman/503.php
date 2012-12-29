<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width" />
<meta name="description" content="Content Strategy and Responsive Writing">
<meta name="author" content="Alan Laidlaw">
<title>lttlman</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	
<style type="text/css" media="screen">
body {background:#999999; padding-top:40px}
header {background:#888;box-sizing:border-box;padding:50px ; text-align:center;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr = '#ffffff', endColorstr = '#000000');
/*INNER ELEMENTS MUST NOT BREAK THIS ELEMENTS BOUNDARIES*/
/*Element must have a height (not auto)*/
/*All filters must be placed together*/
-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr = '#ffffff', endColorstr = '#000000')";
/*Element must have a height (not auto)*/
/*All filters must be placed together*/
background-image: -moz-linear-gradient(top, #ffffff, #888);
background-image: -ms-linear-gradient(top, #ffffff, #888);
background-image: -o-linear-gradient(top, #ffffff, #888);
background-image: -webkit-gradient(linear, center top, center bottom, from(#ffffff), to(#888));
background-image: -webkit-linear-gradient(top, #ffffff, #888);
background-image: linear-gradient(top, #ffffff, #888);
/*--IE9 DOES NOT SUPPORT CSS3 GRADIENT BACKGROUNDS--*/
}
h1{
  color:#111;
  box-sizing:border-box;
  font-family:sans-serif;
  font-size:4em;
  margin:0 auto;
  text-align:center;
  text-shadow: 3px, 0, 0, 4px, #fff;

}

.char5 {
   -webkit-transition: all 0.5s ease; -moz-transition: all 0.5s ease; -o-transition: all 0.5s ease;
}
h1 span {letter-spacing:-3px;}
h1:hover .char5 {
    transform: rotate(6deg);
   // vertical-align: top;
    margin-left: 0.227em;
}
.inserted {
  display:none;
  font-size:0;
}

aside {border-top:1px solid #777; border-bottom:1px solid #777; padding:1em; line-height:0; font-style:italic; 
/*
h1:hover .char2:before {
  content:'i'; 
}
h1:hover .char4:after {
  content:'e'; 
}*/
	</style>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script src="http://alanlaidlaw.com/outside/libs/js/jquery.lettering.js"></script>
  <script>
  	$(document).ready(function() {
$("h1").lettering();
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
});
  </script>

</head>
<div id="page" class="hfeed site ">
<header>
<h1>lttlman</h1>
<aside>Tips for Responsive Writing</aside>
</header>

</div> <!-- end of page -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36763611-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
