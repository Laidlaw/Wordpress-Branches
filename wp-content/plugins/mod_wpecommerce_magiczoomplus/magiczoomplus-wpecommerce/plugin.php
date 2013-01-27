<?php
/*

Copyright 2010 MagicToolbox (email : support@magictoolbox.com)

*/

function WPEcommerce_MagicZoomPlus_activate () {

    if(!function_exists('file_put_contents')) {
        function file_put_contents($filename, $data) {
            $fp = fopen($filename, 'w+');
            if ($fp) {
                fwrite($fp, $data);
                fclose($fp);
            }
        }
    }

    //fix url's in css files
    $fileContents = file_get_contents(dirname(__FILE__) . '/core/magiczoomplus.css');
    $cssPath = preg_replace('/https?:\/\/[^\/]*/is', '', get_option("siteurl"));

    $cssPath .= '/wp-content/'.preg_replace('/^.*?\/(plugins\/.*?)$/is', '$1', str_replace("\\","/",dirname(__FILE__))).'/core';

    $pattern = '/url\(\s*(?:\'|")?(?!'.preg_quote($cssPath, '/').')\/?([^\)\s]+?)(?:\'|")?\s*\)/is';
    $replace = 'url(' . $cssPath . '/$1)';
    $fixedFileContents = preg_replace($pattern, $replace, $fileContents);
    if($fixedFileContents != $fileContents) {
        file_put_contents(dirname(__FILE__) . '/core/magiczoomplus.css', $fixedFileContents);
    }

    magictoolbox_WPEcommerce_MagicZoomPlus_init() ;
}

function WPEcommerce_MagicZoomPlus_deactivate () {
    delete_option("WPEcommerceMagicZoomPlusCoreSettings");
}


function  magictoolbox_WPEcommerce_MagicZoomPlus_init() {

    /* add filters and actions into WordPress */
    add_action("admin_menu", "magictoolbox_WPEcommerce_MagicZoomPlus_config_page_menu");

    //add_action("template_redirect", "magictoolbox_WPEcommerce_MagicZoomPlus_styles"); //load scripts and styles only for frontend
	add_action("wp_head", "magictoolbox_WPEcommerce_MagicZoomPlus_styles"); //load scripts and styles


    add_filter("the_content", "magictoolbox_WPEcommerce_MagicZoomPlus_create", 13); //filter content



    //add_filter("shopp_catalog", "magictoolbox_create", 1); //filter content for SHOPP plugin

    if(!isset($GLOBALS['magictoolbox']['WPEcommerceMagicZoomPlus'])) {
        require_once(dirname(__FILE__) . '/core/magiczoomplus.module.core.class.php');
        $coreClassName = "MagicZoomPlusModuleCoreClass";
        $GLOBALS['magictoolbox']['WPEcommerceMagicZoomPlus'] = new $coreClassName;
        $coreClass = &$GLOBALS['magictoolbox']['WPEcommerceMagicZoomPlus'];
    }
    $coreClass = &$GLOBALS['magictoolbox']['WPEcommerceMagicZoomPlus'];
    /* get current settings */
    $settings = get_option("WPEcommerceMagicZoomPlusCoreSettings");
    if($settings !== false && is_array($settings)) {
        $coreClass->params->appendArray($settings);
    } else {
        update_option("WPEcommerceMagicZoomPlusCoreSettings", $coreClass->params->getArray());
    }

    //add_option("magictoolboxURL", get_option("siteurl")."/wp-content/plugins/magictoolbox/magiczoomplus/core");
}

function WPEcommerceMagicZoomPlus_config_page() {
     magictoolbox_WPEcommerce_MagicZoomPlus_config_page('WPEcommerceMagicZoomPlus');
}

function magictoolbox_WPEcommerce_MagicZoomPlus_config_page_menu() {
    if(function_exists("add_submenu_page")) {
        //$coreClass = & $GLOBALS['magictoolbox']['WPEcommerceMagicZoomPlus'];
        $page = add_submenu_page("plugins.php", __("Magic Zoom Plus for WP e-Commerce Plugin Configuration"), __("Magic Zoom Plus for WP e-Commerce Configuration"), "manage_options", "WPEcommerceMagicZoomPlus-config-page", "WPEcommerceMagicZoomPlus_config_page");
		//add_action('admin_print_styles-'.$page,'magictoolbox_WPEcommerce_MagicZoomPlus_admin_styles');
    }
}

function  magictoolbox_WPEcommerce_MagicZoomPlus_config_page($id) {
    $settings = $GLOBALS['magictoolbox'][$id]->params->getArray();
    if(isset($_POST["submit"])) {
        /* save settings */
        foreach($settings as $name => $s) {
            if(isset($_POST["magiczoomplussettings".ucwords(strtolower($name))])) {
                $v = $_POST["magiczoomplussettings".ucwords(strtolower($name))];
                switch($s["type"]) {
                    case "num": $v = intval($v); break;
                    case "array": 
                        $v = trim($v);
                        if(!in_array($v,$s["values"])) $v = $s["default"];
                        break;
                    case "text":
                    default: $v = trim($v);
                }
                $s["value"] = $v;
                $settings[$name] = $s;                
            }
        }
        update_option($id . "CoreSettings", $settings);
        $GLOBALS['magictoolbox'][$id]->params->appendArray($settings);
    }
    
    $toolAbr = '';
    $abr = explode(" ", strtolower("Magic Zoom Plus"));
    foreach ($abr as $word) $toolAbr .= $word{0};
    
     $corePath = preg_replace('/https?:\/\/[^\/]*/is', '', get_option("siteurl"));
     $corePath .= '/wp-content/'.preg_replace('/^.*?\/(plugins\/.*?)$/is', '$1', str_replace("\\","/",dirname(__FILE__))).'/core';
    ?>
	<style>
        .<?php echo $toolAbr; ?>params { margin:20px 0; width:70%; border:1px solid #dfdfdf; }
        .<?php echo $toolAbr; ?>params .params { margin:0; width:100%;}
        .<?php echo $toolAbr; ?>params .params th { <? /*white-space:nowrap; */ ?> vertical-align:middle; border-bottom:1px solid #dfdfdf; padding:15px 5px; font-weight:bold; background:#fff; text-align:left; padding:0 20px; }
        .<?php echo $toolAbr; ?>params .params td { vertical-align:middle; border-bottom:1px solid #dfdfdf; padding:10px 5px; background:#fff; width:100%; }
        .<?php echo $toolAbr; ?>params .params tr.back th, .<?php echo $toolAbr; ?>params .params tr.back td { background:#f9f9f9; }
        .<?php echo $toolAbr; ?>params .params tr.last th, .<?php echo $toolAbr; ?>params .params tr.last td { border:none; }
        .afterText {font-size:10px;font-style:normal;font-weight:normal;}
        .settingsTitle {font-size: 1.5em;font-weight: normal;margin: 1.7em 0 1em 0;}
        input[type="checkbox"],input[type="radio"] {margin:5px;vertical-align:middle !important;}
        td img {vertical-align:middle !important; margin-right:10px;}
        td span {vertical-align:middle !important; margin-right:10px;}
		#footer {position:relative;}
    </style>
    
    <div class="icon32" id="icon-options-general"><br></div>
    <h2> Magic Zoom Plus for WP e-Commerce Plugin Settings</h2>
    <p>Learn more about the <a href="http://www.magictoolbox.com/magiczoomplus_integration/" target="_blank">customisation options</a></p>
    <form action="" method="post" id="magiczoomplus-config-form">
            <?php
                $groups = array();
                $imgArray = array('zoom & expand','yes','zoom','expand','swap images only','no','left','top left','top','top right', 'right', 'bottom right', 'bottom', 'bottom left'); //array for the images ordering

                foreach($settings as $name => $s) { 

                    if (!isset($groups[$s['group']])) {
                        $groups[$s['group']] = array();
                    }

                    $s['value'] = $GLOBALS['magictoolbox'][$id]->params->getValue($name);

                    if (strpos($s["label"],'(')) {
                        $before = substr($s["label"],0,strpos($s["label"],'('));
                        $after = ' '.str_replace(')','',substr($s["label"],strpos($s["label"],'(')+1));
                    } else {
                        $before = $s["label"];
                        $after = '';
                    }
                    if (strpos($after,'%')) $after = ' %';
                    if (strpos($after,'in pixels')) $after = ' pixels';
                    if (strpos($after,'milliseconds')) $after = ' milliseconds';

                    $html  .= '<tr>';
                    $html  .= '<th width="50%">';
                    $html  .= '<label for="magiczoomplussettings'. ucwords(strtolower($name)).'">'.$before.'</label>';

                    if(($s['type'] != 'array') && isset($s['values'])) $html .= '<br/> <span class="afterText">' . implode(', ',$s['values']).'</span>';

                    $html .= '</th>';
                    $html .= '<td width="50%">';

                    switch($s["type"]) {
                        case "array": 
                                $rButtons = array();
                                foreach($s["values"] as $p) {
                                    $rButtons[strtolower($p)] = '<label><input type="radio" value="'.$p.'"'. ($s["value"]==$p?"checked=\"checked\"":"").' name="magiczoomplussettings'.ucwords(strtolower($name)).'" id="magiczoomplussettings'. ucwords(strtolower($name)).$p.'">';
                                    $pName = ucwords($p);
                                    if(strtolower($p) == "yes")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/yes.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "no")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/no.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "left")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/left.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "right")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/right.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "top")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/top.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "bottom")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/bottom.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "bottom left")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/bottom-left.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "bottom right")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/bottom-right.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "top left")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/top-left.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "top right")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/top-right.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    else $rButtons[strtolower($p)] .= '<span>'.ucwords($p).'</span></label>';
                                }
                                foreach ($imgArray as $img){
                                    if (isset($rButtons[$img])) {
                                        $html .= $rButtons[$img];
                                        unset($rButtons[$img]);
                                    }
                                }
                                $html .= implode('',$rButtons);
                            break;
                        case "num": 
                        case "text": 
                        default:
                            if (strtolower($name) == 'message') { $width = 'style="width:95%;"';} else {$width = '';}
                            $html .= '<input '.$width.' type="text" name="magiczoomplussettings'.ucwords(strtolower($name)).'" id="magiczoomplussettings'. ucwords(strtolower($name)).'" value="'.$s["value"].'" />';
                            break;
                    }
                    $html .= '<span class="afterText">'.$after.'</span>';
                    $html .= '</td>';
                    $html .= '</tr>';
                    $groups[$s['group']][] = $html;
                    $html = '';
                }
            foreach ($groups as $name => $group) {
                $i = 0;
                $group[count($group)-1] = str_replace('<tr','<tr class="last"',$group[count($group)-1]); //set "last" class

                echo '<h3 class="settingsTitle">'.$name.'</h3>
                            <div class="'.$toolAbr.'params">
                            <table class="params" cellspacing="0">';

                foreach ($group as $g) {
                    if (++$i%2==0) { //set stripes
                        if (strpos($g,'class="last"')) {
                            $g = str_replace('class="last"','class="back last"',$g);
                        } else {
                            $g = str_replace('<tr','<tr class="back"',$g);
                        }
                    }
                    echo $g;
                }
                echo '</table> </div>';
            }
            ?>
            
            <p><input type="submit" name="submit" class="button-primary" value="Save settings" /></p>
        </form>

   
    </div>
    <?php
}

/*function  magictoolbox_WPEcommerce_MagicZoomPlus_admin_styles() {   

	$path = preg_replace('/^.*?\/plugins\/(.*?)$/is', '$1', str_replace("\\","/",dirname(__FILE__)));
	wp_enqueue_style( 'magiczoomplus-admin' , WP_PLUGIN_URL . "/{$path}/core/admin.css");

}

function  magictoolbox_WPEcommerce_MagicZoomPlus_styles() {

	$path = preg_replace('/^.*?\/plugins\/(.*?)$/is', '$1', str_replace("\\","/",dirname(__FILE__)));
	wp_enqueue_style( 'magiczoomplus' , WP_PLUGIN_URL . "/{$path}/core/magiczoomplus.css");
	wp_enqueue_script('magiczoomplus', WP_PLUGIN_URL."/{$path}/core/magiczoomplus.js");

}*/

function  magictoolbox_WPEcommerce_MagicZoomPlus_styles() {
    if(!defined('MAGICTOOLBOX_MAGICZOOMPLUS_HEADERS_LOADED')) {
		if (function_exists('plugins_url')) {
			$core_url = plugins_url();
		} else {
			$core_url = get_option("siteurl").'/wp-content/plugins';
		}


        $path = preg_replace('/^.*?\/plugins\/(.*?)$/is', '$1', str_replace("\\","/",dirname(__FILE__)));
        echo $GLOBALS['magictoolbox']['WPEcommerceMagicZoomPlus']->headers($core_url."/{$path}/core");

        define('MAGICTOOLBOX_MAGICZOOMPLUS_HEADERS_LOADED', true);
    }
}


function  magictoolbox_WPEcommerce_MagicZoomPlus_create($content) {


    $pattern = "(?:<a([^>]*)>)[^<]*<img([^>]*)(?:>)(?:[^<]*<\/img>)?(.*?)[^<]*?<\/a>";

    $content = preg_replace_callback("/{$pattern}/is","magictoolbox_WPEcommerce_MagicZoomPlus_callback",$content);

    if (count($GLOBALS['MAGICTOOLBOX_'.strtoupper('magiczoomplus').'_SELECTORS']) > 0) { //if there any additional images present
        $selectors = '<div class="MagicToolboxSelectorsContainer">'.implode($GLOBALS['MAGICTOOLBOX_'.strtoupper('magiczoomplus').'_SELECTORS']).'</div>';
        $content = str_replace('{MAGICTOOLBOX_'.strtoupper('magiczoomplus').'_SELECTORS}',$selectors,$content); // insert selectors under main image

        $contentWithGallery = $content;
        $content = preg_replace ('/<h2[^>]*>Gallery<\/h2><div[^>]*>.*?div>/is','',$content); //cut gallery div v1
        if ($content == $contentWithGallery) { 
            $content = preg_replace ('/<div[^>]*?class=\'wpcart_gallery\'[^>]*?>.*?div>/is','',$content); //cut gallery div v2
        }
    }
    $content = str_replace('{MAGICTOOLBOX_'.strtoupper('magiczoomplus').'_MAIN_IMAGE_SELECTOR}',$GLOBALS['MAGICTOOLBOX_'.strtoupper('magiczoomplus').'_MAIN_IMAGE_SELECTOR'],$content);  //add main image selector to other
    $content = str_replace('{MAGICTOOLBOX_'.strtoupper('magiczoomplus').'_SELECTORS}','',$content); //if no selectors - remove constant

    return $content;
}

function  magictoolbox_WPEcommerce_MagicZoomPlus_callback($matches) {
    $plugin = $GLOBALS['magictoolbox']['WPEcommerceMagicZoomPlus'];
    if (!WPSC_VERSION) return $matches[0];
    //$cat = !wpsc_is_in_category();
    // if (!empty($GLOBALS['wp_query']->query_vars['product_url_name']) && $GLOBALS['wp_query']->query_vars['product_url_name'] != '') {
    //if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) { // TODO: Permalinks ?
	//$cat = false;
    //} else {
	//$cat = true;
    //}
    if (WPSC_PRESENTABLE_VERSION == '3.7.6.3' || WPSC_PRESENTABLE_VERSION == '3.7.6.4' || WPSC_PRESENTABLE_VERSION == '3.7.8') {
        /*if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) { // TODO: Permalinks ?
            $cat = false;
        } else {
            $cat = true;
        }*/
        if ($GLOBALS["wpsc_title_data"]["product"]) {
            $cat = false;
        }else {
            $cat = true;
        } 
    } else if (WPSC_VERSION == '3.8') {
        if (isset($GLOBALS['wp_the_query']->query_vars['wpsc-product']) && $GLOBALS['wp_the_query']->query_vars['wpsc-product'] != '') {
            $cat = false;
        } else {
            $cat = true;
        }
    //} else if (WPSC_VERSION == '3.8.1' || WPSC_VERSION == '3.8.2' || WPSC_VERSION == '3.8.3' || WPSC_VERSION == '3.8.4' || WPSC_VERSION == '3.8.5' || WPSC_VERSION == '3.8.6' || WPSC_VERSION == '3.8.6.1') {
    } else if (WPSC_VERSION >= '3.8.1') {
            if ( $GLOBALS['wp_the_query']->is_single == '1') { /*isset($GLOBALS['wp_the_query']->is_product) && $GLOBALS['wp_the_query']->is_product == '1'*/
                $cat = false;
            } else {
                $cat = true;
            }
    } else {
        if (!empty($GLOBALS['wp_query']->query_vars['product_url_name']) && $GLOBALS['wp_query']->query_vars['product_url_name'] != '') {
            $cat = false;
        } else {
            $cat = true;
        }
    }
    
    $plugin_enabled = true;
    $is_selector = true;
    $is_main = true;

    if(!preg_match("/class\s*=\s*[\'\"]\s*(?:[^\"\'\s]*\s)*product_image(?:\s[^\"\'\s]*)*\s*[\'\"]/iUs",$matches[0])) {
        $is_main = false;
    }
    if(!preg_match("/class\s*=\s*[\'\"]\s*(?:[^\"\'\s]*\s)*thickbox(?:\s[^\"\'\s]*)*\s*[\'\"]/iUs",$matches[0])) {
        $is_selector = false;
    }
    
    if (!$is_selector && !$is_main) {
        $plugin_enabled = false;
    }

    if ($plugin_enabled) {
        if ($cat && $plugin->params->checkValue('use-effect-on-category-page','No')) return $matches[0];
        if (!$cat && $plugin->params->checkValue('use-effect-on-product-page','No')) return $matches[0];
    } else {
        return $matches[0];
    }





    //to put options in rel
    $plugin->general->params['disable-expand'] = $plugin->params->params['disable-expand'];
    $plugin->general->params['disable-zoom'] = $plugin->params->params['disable-zoom'];

    $plugin->params->set('disable-expand','Yes');
    $plugin->params->set('disable-zoom','Yes');
    if (!$plugin->params->checkValue('use-effect-on-product-page','No') && !$cat) {
        if ($plugin->params->checkValue('use-effect-on-product-page','Zoom')) {
            $plugin->params->set('disable-expand','Yes');
            $plugin->params->set('disable-zoom','No');
        } else if ($plugin->params->checkValue('use-effect-on-product-page','Expand')) {
            $plugin->params->set('disable-expand','No');
            $plugin->params->set('disable-zoom','Yes');
        } else if ($plugin->params->checkValue('use-effect-on-product-page','Swap images only')) {
            $plugin->params->set('disable-expand','Yes');
            $plugin->params->set('disable-zoom','Yes');
        } else /*if (!$plugin->params->checkValue('use-effect-on-product-page','No'))*/ {
            $plugin->params->set('disable-expand','No');
            $plugin->params->set('disable-zoom','No');
        }
    }

    if (!$plugin->params->checkValue('use-effect-on-category-page','No') && $cat) {
        if ($plugin->params->checkValue('use-effect-on-category-page','Zoom')) {
            $plugin->params->set('disable-expand','Yes');
            $plugin->params->set('disable-zoom','No');
        } else if ($plugin->params->checkValue('use-effect-on-category-page','Expand')) {
            $plugin->params->set('disable-expand','No');
            $plugin->params->set('disable-zoom','Yes');
        } else /*if (!$plugin->params->checkValue('use-effect-on-category-page','No'))*/ {
            $plugin->params->set('disable-expand','No');
            $plugin->params->set('disable-zoom','No');
        }
    }



    
    $float = preg_replace('/^.*?float:\s*(left|right|none).*$/is', '$1', $matches[2]);
    if($float == $matches[2]) {
        $float = '';
    } else {
        $float = ' float: ' . $float . ';';
    }
    
/* get needed attributes */

    $id = preg_replace("/^.*?id=\"([^\"]*?(\d+)[^\"]*)\".*$/is","$2",$matches[2]);
    if($cat && $plugin->params->checkValue('link-to-product-page', 'Yes')) {
        $link = wpsc_product_url($id);
    } else {
        $link = false;
    }
    $alt = preg_replace("/^.*?alt\s*=\s*[\"\'](.*?)[\"\'].*$/is","$1",$matches[2]);
    $img = preg_replace("/^.*?href\s*=\s*[\"\'](.*?)[\"\'].*$/is","$1",$matches[1]);
    $thumb = preg_replace("/^.*?src\s*=\s*[\"\'](.*?)[\"\'].*$/is","$1",$matches[2]);
    $title = preg_replace("/^.*?title\s*=\s*[\"\'](.*?)[\"\'].*$/is","$1",$matches[0]);
    if($title == $matches[0]) unset($title);

    $aStyles = $matches[1];
    $imgStyles = $matches[2];
    /* remove id,rel,class,href,title,rev attributes from link */
    $matches[1] = preg_replace("/^(.*?)rel\s*=\s*[\"\'].*?[\"\']/is","$1",$matches[1]);
	$matches[1] = preg_replace("/^(.*?)id\s*=\s*[\"\'].*?[\"\']/is","$1",$matches[1]);
    $matches[1] = preg_replace("/^(.*?)class\s*=\s*[\"\'].*?[\"\']/is","$1",$matches[1]);
    $matches[1] = preg_replace("/^(.*?)title\s*=\s*[\"\'].*?[\"\']/is","$1",$matches[1]);
    $matches[1] = preg_replace("/^(.*?)rev\s*=\s*[\"\'].*?[\"\']/is","$1",$matches[1]);
    $matches[1] = preg_replace("/^(.*?)href\s*=\s*[\"\'].*?[\"\']/is","$1",$matches[1]);
    /* remove src attribute from img */
    $matches[2] = preg_replace("/^(.*?)src\s*=\s*[\"\'].*?[\"\']/is","$1",$matches[2]);
    $matches[2] = preg_replace("/\/\s*$/is"," ",$matches[2]);


    $divWidth = @getimagesize($thumb);
    if ($divWidth && is_array($divWidth)) {
        $divWidth = $divWidth[0];
    } else {
        $divWidth = ''; 
    }
    $description = '';
    $additionalDescription = '';
    global $wpsc_query;

    //if (WPSC_VERSION != '3.8'  && WPSC_VERSION != '3.8.1' && WPSC_VERSION != '3.8.2' && WPSC_VERSION != '3.8.3' && WPSC_VERSION != '3.8.4' && WPSC_VERSION != '3.8.5' && WPSC_VERSION != '3.8.6' && WPSC_VERSION != '3.8.6.1') {
    if (WPSC_VERSION < '3.8') {
        foreach($wpsc_query->get_products() as $key => $curr_product) {
            if(htmlspecialchars($curr_product['name'], ENT_QUOTES) == $title) {
                $description = $wpsc_query->products[$key]['description'];
                $additionalDescription = $wpsc_query->products[$key]['additional_description'];
                break;
            }
        }
    } else {
        /*if($wpsc_query->post->post_title == $title) {
            $description = $wpsc_query->post->post_content;
            $additionalDescription = $wpsc_query->post->post_excerpt;
        }*/
        foreach ($wpsc_query->posts as $post) {
            if($post->post_title == $title) {
                $description = $post->post_content;
                $additionalDescription = $post->post_excerpt;
            }
        }
    }

    if (!$cat) { //Product page
        $divWidth = get_option('single_view_image_width');
        $id = '_Main';
    } else { //Category page
        $divWidth = get_option('product_image_width');
    }
    
    if ($is_main) { //if it is MAIN IMAGE
        $result = $plugin->template(compact('img','thumb','id','title','description','additionalDescription','link'));

        $alt = $title;
        $oldThumb = $thumb;
        $medium = str_replace('width='.get_option('wpsc_gallery_image_width').'&amp;height='.get_option('wpsc_gallery_image_height'),
                             'width='.get_option('single_view_image_width').'&amp;height='.get_option('single_view_image_height'),$thumb);
        $thumb = str_replace('width='.get_option('single_view_image_width').'&amp;height='.get_option('single_view_image_height'),
                             'width='.get_option('wpsc_gallery_image_width').'&amp;height='.get_option('wpsc_gallery_image_height'),$thumb);
		if (!$plugin->params->checkValue('create-main-image-selecor','No')) {
			$GLOBALS['MAGICTOOLBOX_'.strtoupper('magiczoomplus').'_MAIN_IMAGE_SELECTOR'] = $plugin->subTemplate(compact('alt','img','medium','thumb','id')); //save main image selector to globals
		}

        if ($oldThumb == $thumb ) { //if replaces are not effected
            $GLOBALS['MAGICTOOLBOX_'.strtoupper('magiczoomplus').'_MAIN_IMAGE_SELECTOR'] = str_replace('<img','<img style="height : '.get_option('wpsc_gallery_image_height').'px !important"',$GLOBALS['MAGICTOOLBOX_'.strtoupper('magiczoomplus').'_MAIN_IMAGE_SELECTOR']);
        }
    }
     if ($is_selector && !$is_main) { //if image is SELECTOR
        $alt = $title;

        if (WPSC_VERSION < '3.8.1') {
            $medium = str_replace('width='.get_option('wpsc_gallery_image_width').'&amp;height='.get_option('wpsc_gallery_image_height'),
                                'width='.get_option('single_view_image_width').'&amp;height='.get_option('single_view_image_height'),$thumb);
        } else {
            $medium_name = preg_replace('/^.*?\/([^\/]*?)-[0-9]+x[0-9]+\.jpg/is','$1',$thumb);
            $medium = get_product_image($medium_name);
        }

        $result = $plugin->subTemplate(compact('alt','img','medium','thumb','id'));
        if (!$GLOBALS['MAGICTOOLBOX_'.strtoupper('magiczoomplus').'_MAIN_IMAGE_SELECTOR_SET']) { 
            $prefix = '{MAGICTOOLBOX_'.strtoupper('magiczoomplus').'_MAIN_IMAGE_SELECTOR}';
            $GLOBALS['MAGICTOOLBOX_'.strtoupper('magiczoomplus').'_MAIN_IMAGE_SELECTOR_SET'] = true;
        }
    }

    $result = preg_replace("/^(.*?)<a(.*?)$/is","$1<a {$matches[1]}$2",$result);
    $result = preg_replace("/^(.*?)<img(.*?)$/is","$1<img {$matches[2]}$2",$result);
    $result = str_replace('class="attachment-gold-thumbnails"','',$result);
    
     if ($is_main) {
        $result = $prefix."<div style=\"width:{$divWidth}px;{$float}\" class=\"MagicToolboxContainer\">{$result}</div>";
        if ($plugin->params->checkValue('keep-selectors-position','No')) {//load selectors under main image
            $result = $result.'{MAGICTOOLBOX_'.strtoupper('magiczoomplus').'_SELECTORS}';
        }
    } else if ($is_selector) {
        $result = $prefix.$result;
         if ($plugin->params->checkValue('keep-selectors-position','No')) {//load selectors under main image
            $GLOBALS['MAGICTOOLBOX_'.strtoupper('magiczoomplus').'_SELECTORS'][] = $result;
            $result = $matches[0];
        }
    }

    return $result;
    //return $matches[0];
}

function get_product_image($title,$size = 'medium-single-product')  {

	global $wp_query;
    $post_id = $wp_query->post->ID;

    $args = array(
        'post_type' => 'attachment',
        'numberposts' => '-1',
        'post_status' => null,
        'post_parent' => $post_id
    );

    $attachments = get_posts($args);
    if ($attachments) {
        foreach ($attachments as $attachment) {
            if(isset($attachment->post_name) && (strtolower($attachment->post_name) == strtolower($title) || strpos(strtolower($attachment->guid),strtolower($title)))) {
                //return wp_get_attachment_image_src( $attachment->ID, $size);
                $meta = wp_get_attachment_metadata($attachment->ID);
                $src = wp_get_attachment_image_src( $attachment->ID);
                if (isset($meta['sizes'][$size]['file'])) {
                    $file = $meta['sizes'][$size]['file'];
                } else if ($size == 'full') {
					$file = preg_replace('/^*?([^\/]+.jpg).+/is','$1',$meta['file']);
				} else {
                    $file = $meta['sizes']['medium-single-product']['file'];
                }
                return preg_replace('/([^\/]*?\.jpg)/is',$file,$src[0]);
            }
        }
    }
}






?>
