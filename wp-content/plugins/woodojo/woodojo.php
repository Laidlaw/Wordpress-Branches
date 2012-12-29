<?php
/*
Plugin Name: WooDojo
Plugin URI: http://woothemes.com/
Description: WooDojo is a powerful collection of WooThemes features to enhance your website.
Version: 1.1.1
Author: WooThemes
Author URI: http://woothemes.com/
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/
/*  Copyright 2012  WooThemes  (email : info@woothemes.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
	
	require_once( 'classes/woodojo.class.php' );

	global $woodojo;

	$woodojo = new WooDojo( __FILE__ );
	$woodojo->version = '1.1.1';

    if ( apply_filters( 'wootransmitter_enable', true ) == true ) {
        require_once( 'wootransmitter/wootransmitter.php' );
        global $wootransmitter;
        $wootransmitter->add_app_key( 'aa627bbb-a54b-4b0d-b154-c1c6ce3679b0', esc_attr( $woodojo->version ) );
    }
?>