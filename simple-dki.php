<?php
/**
 * @package simple-dki
 * @version 1.0
 */
/*
Plugin Name: Simple DKI
Plugin URI: http://github.com/nlk-plugins/simple-dki
Description: Quick and Dirty Dynamic Keyword Injection with Shortcode
Version: 1.0.1
Author: Ninthlink, Inc.
Author URI: http://www.ninthlink.com
License: GPL2
*/

function simple_dki_keyword_shortcode($atts) {
	extract( shortcode_atts( array(
		'loc' => 0,
		'case' => 'titlecase',
		'default' => ''
	), $atts ) );
	
	global $wp_query;
	$oot = '';
	if(isset($wp_query->query_vars['kw'])) {
		if($wp_query->query_vars['kw'] != '') {
			$kw = $wp_query->query_vars['kw'];
			$slashit = strpos( $kw, '/' );
			if ( $slashit ) {
				// 2 kws?
				$kwa = explode('/', $kw);
				$loc = absint($loc);
				if ( $loc > count($kwa) ) $loc = 0;
				
				$oot = str_replace('-',' ',$kwa[0]);
			} else {
				// just 1
				$oot = str_replace('-',' ',$kw);
			}
		}
	}
	if ( ( $oot == '' ) || ( $oot == 'keyword' ) ){
		$oot = $default;
	}
	
	switch ( $case ) {
		case 'upper':
		case 'uppercase':
			$oot = strtoupper($oot);
			break;
		case 'lower':
		case 'lowercase':
			$oot = strtolower($oot);
			break;
		default:
			$oot = ucwords($oot);
			break;
	}
	
	return $oot;
}
add_shortcode('keyword', 'simple_dki_keyword_shortcode');

function simple_dki_titlefix_with_id( $title, $id ) {
	global $wp_query;
  if ( is_page( $id ) ) {
    if(isset($wp_query->query_vars['kw'])) {
      $title = do_shortcode('[keyword default="Plumbing"]');//$wp_query->query_vars['kw'];
    }
  }
	return $title;
}
add_filter('the_title', 'simple_dki_titlefix_with_id', 10, 2);

function simple_dki_titlefix( $title ) {
	global $wp_query;
  if(isset($wp_query->query_vars['kw'])) {
    $title = do_shortcode('[keyword default="Plumbing"]');//$wp_query->query_vars['kw'];
  }
	return $title;
}
add_filter('aioseop_title', 'simple_dki_titlefix');
add_filter('qode_title_text', 'simple_dki_titlefix');

// Adding the id var so that WP recognizes it
function simple_dki_insertvars($vars) {
    array_push($vars, 'kw');
    array_push($vars, 'keyword');
    return $vars;
}
add_filter('query_vars','simple_dki_insertvars');

/*
// Remember to flush_rules() when adding rules
function progo_flushrules() {
	global $wp_rewrite;
   	$wp_rewrite->flush_rules();
}
add_action( 'init', 'progo_flushrules' );

// Adding a new rule
function progo_insertrules($rules) {
	$newrules = array();
	
	$stubs = array();
	
	$templates = array('page-dkippc.php');
	foreach($templates as $t) {
		$pages = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => $t
		));
		
		foreach ( $pages as $p ) {
			$stubs[] = $p->post_name;
		}
	}
	foreach ( $stubs as $s ) {
		$newrules['('. $s .'/)(.+?)$'] = 'index.php?pagename=$matches[1]&kw=$matches[2]';
		$newrules['('. $s .'/)(.+?)$'] = 'index.php?pagename=$matches[1]&keyword=$matches[2]';
	}
	
	return $newrules + $rules;
}
add_filter('rewrite_rules_array','progo_insertrules');
*/