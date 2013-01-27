<?php

require( dirname( __FILE__ ) . '/style.php' );
?>

<h1  style="visibility:visible;">Lightbox Pop (V 1.1)</h1>
Lightbox Pop is a simple, attractive, non-annoying, extremely fast and light-weight lightbox for your WordPress blog. It allows you to edit your lightbox content using  WordPress content editor and supports various display mechanisms and custom design options. Lightbox Pop is developed and maintained by <a target="_blank" href="http://xyzscripts.com">xyzscripts</a> 

   
    <br />
     <div style="float: left;">
<h2>Features (free & premium versions)</h2>
   
      <p></p>
      <ul>
        <li>Full control on lightbox content</li> 
 <li>Standard WordPress content editor</li>
  <li>Supports shortcodes in lightbox content</li>
 <li>Lightbox position settings</li>
<li>Lightbox dimension control</li>

 <li> </li>
 
<li>Timer based display</li>
 <li>Display based on browsed number of pages</li>
    <li>Configure lightbox content as iframe or inline </li>
	<li>Enable/disable close button</li>
    <li>Configurable repeat interval in hrs/min</li>
      
  <li> </li>
 
<li>Lightbox color settings</li>
<li>Lightbox border settings</li>
<li>Advanced css settings</li>

          <li> </li>
          
   <li>Shortcode for lightbox display in specific pages</li>      
     
   
      </ul>

      <p></p>
    </div>
<div style="float: left;padding-left:30px">
<h2>Features (premium version only)</h2>
 
      <p></p>
      <ul>
      <li>Attach lightbox to onclick event</li>
          <li>&nbsp; </li>
      <li>Configurable close button position and image</li>
          <li>&nbsp; </li>
      <li>Display close button after timeout</li>
          <li>&nbsp; </li>
      
 <li>Selective display on pages,posts,homepage </li>
          <li>&nbsp; </li>
      <li>Lightbox overlay background image settings</li>
          <li>&nbsp; </li>
        <li>Create and manage multiple lightboxes for different pages</li>
          <li>&nbsp; </li>
        
        <li>Professional support from our team</li>       
   
      </ul>

      <p></p>
    </div>

    <div style="clear:both;"></div>

	
<div id="lightbox-pop-about">
<h2>Lightbox Pop Premium</h2>
Did you like Lightbox Pop ? Want more from this plugin ? Learn more about the  <a target="_blank" href="http://xyzscripts.com/wordpress-plugins/lightbox-pop/">premium version</a>. You can get the premium version with all the aforementioned features for just 29 USD. 
<a target="_blank" href="http://xyzscripts.com/members/product/purchase/XYZWPLB">Get Premium Version Now</a>. If you have any question about premium version, contact our <a target="_blank" href="http://xyzscripts.com/support/">support desk</a>.
<p></p>
<h3> <blink>Limited Period Offer</blink></h3> 

Subscribe to our newsletter and get <b style="color: #21759B ">10 USD off</b> on premium edition.

<p style="clear: both;"></p>
<script language="javascript">
function check_email(emailString)
{
    var mailPattern = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var matchArray = emailString.match(mailPattern);
    if (emailString.length == 0)
    return false;
       
    if (matchArray == null)    {
    return false;
    }else{
    return true;
    }
}

   
function verify_lists(form)
{
   
    var total=0;
    var checkBox=form['chk[]'];
   
    if(checkBox.length){
   
    for(var i=0;i<checkBox.length;i++){
    checkBox[i].checked?total++:null;
    }
    }else{
       
    checkBox.checked?total++:null;
       
    }
    if(total>0){
    return true;
    }else{
    return false;
    }

}
   
function verify_fields()
{

    if(check_email(document.email_subscription.email.value) == false){
    alert("Please check whether the email is correct.");
    document.email_subscription.email.select();
    return false;
    }else if(verify_lists(document.email_subscription)==false){
    alert("Select atleast one list.");
    }
    else{
    document.email_subscription.submit();
    }

}
</script>

<form action=http://xyzscripts.com/newsletter/index.php?page=list/subscribe method="post" name="email_subscription" id="email_subscription" >
<input type="hidden" name="fieldNameIds" value="1,">
<input type="hidden" name="redirActive" value="http://xyzscripts.com/subscription/pending/XYZWPLB">
<input type="hidden" name="redirPending" value="http://xyzscripts.com/subscription/active/XYZWPLB">
<input type="hidden" name="mode" value="1">
<table border="0" style=" width: 100%; border: 1px solid #FFFFFF; color: black;">
<tr>
<td colspan="3">
<span style="font-size:14px;"><b>Field marked <font style="color:#FF0000">*</font> are mandatory </b></span>
</td>
</tr>
   
<tr><td colspan="3"> </td></tr>
   

<tr>
<td id="align" width="120px">Name</td>
<td id="align" width="20px"> : </td>
<td id="align">
<input style="border: 1px solid #3fafe3; margin-right:10px;" type="text" name="field1" ></td>
</tr>
<tr >
<td >Email Address</td><td > : </td>
<td >
<input style="border: 1px solid #3fafe3;" name="email"
type="text" /><span style="color:#FF0000">*</span>           
</td>
</tr>
<tr><td colspan="3" > </td></tr>

<input type="hidden" name="listName" value="1,2,">

<tr>
<td> </td><td> </td>
<td >
<input type="submit" value="subscribe" name="Submit"  onclick="javascript: if(!verify_fields()) return false; " />
</td>
<td> </td>
</tr>
<tr>
<td colspan="3" > </td>
</tr>
</table>
</form>
<p></p>
 <style>
    .xyz_feedback{
    background: #CEEAF7; /* Old browsers */
border: 1px solid #64cfe8;
width: 98%;    
    padding-left: 10px;
    }
    
    .xyz_feedback ul{
    font-weight: bold;
    }
    
    </style>

<div class="xyz_feedback">
    <h2>Feedback</h2>

   Your feedback and suggestions are our inspiration for the betterment of this plugin. You can provide your feedback using any of the options below.
   <p></p> 
   <ul style="float: left;">
   
   <li><a target="_blank" href="http://xyzscripts.com/donate/1" target="_blank">Donate a dollar</a></li>
   <li><a target="_blank" href="http://wordpress.org/extend/plugins/lightbox-pop/">Rate this plugin on wordpress</a></li>
   <li><a target="_blank" href="http://xyzscripts.com/support/">Send your suggestions</a></li>
   </ul>
   
   <ul style="float: left;padding-left: 30px">
   <li><a target="_blank" href="http://facebook.com/xyzscripts" class="xyz_fbook">Like us on facebook</a></li>
   <li><a target="_blank" href="http://twitter.com/xyzscripts" class="xyz_twitt">Follow us on twitter</a></li>
   <li><a target="_blank" href="https://plus.google.com/101215320403235276710/" class="xyz_gplus">+1 us on Google+</a></li>
   
   </ul>
   <p style="clear: both;"></p> 
   
    </div>

</div>


<h2>More Plugins</h2>
    <div >
      <p></p>
      <ul>
        <li><a target="_blank" href="http://wordpress.org/extend/plugins/newsletter-manager/">Newsletter Manager</a> : A handy plugin to create and send html or plain text email newsletters to your subscribers.</li>
   
      </ul>

      <p></p>
    </div>
