<?php

$fldd = (object) array(
		'basedir'=>__DIR__.'/../twentytwelve/',
		'show_excerpts' => false
);

register_sidebar(array(
	'name' => __( 'FablabDD Startseiten' ),
	'id' => 'fbdd-front-sidebar',
	'description' => __( 'Widgets für die Startseite' ),
	// 'before_title' => '<article class=" page type-page status-publish hentry" >',
	// 'after_title' => '</h1>'
	'before_widget' => '<article id="%1$s" class="page type-page status-publish hentry widget %2$s">',
	'after_widget' => '</article>'
));


function new_excerpt_more( $more ) {
	return ' <br /><a class="read-more" href="'. get_permalink( get_the_ID() ) . '">Zum ganzen Beitrag</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

function fldd_metanavi() {
	
	
	
	$defaults = array(
			'theme_location'  => '',
			'menu'            => 'metanav',
			'container'       => 'div',
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
	);
	
	wp_nav_menu( $defaults );
	
	
	
	
}


/** Step 2 (from text above). */
add_action( 'admin_menu', 'fldd_plugin_menu' );

/** Step 1. */
function fldd_plugin_menu() {
	add_options_page( 'fablabdd Theme Options', 'fablabdd', 'manage_options', 'fldd-unique-identifier', 'fldd_plugin_options' );
}

/** Step 3. */
function fldd_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
}

function fldd_is_metafab() {
	
	if (is_page()) {
		
		if (is_page('metafab')) { return true; }
		
		$metafab_page = get_page_by_title('metafab' );
		$page_ids = get_ancestors(get_the_ID(),'page');
		
		foreach ($page_ids as $page_id) {
			if ($page_id == $metafab_page->ID ) { return true; }
		}
		
		return false;
	}
	
	
	$metafab_cat = get_term_by( 'name', 'metafab', 'category' );
	$metafab_cat_id = $metafab_cat->term_id;
	
	return  post_is_in_descendant_category($metafab_cat_id);
	
}
/**
 * Tests if any of a post's assigned categories are descendants of target categories
*
* @param int|array $cats The target categories. Integer ID or array of integer IDs
* @param int|object $_post The post. Omit to test the current post in the Loop or main query
* @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
* @see get_term_by() You can get a category by name or slug, then pass ID to this function
* @uses get_term_children() Passes $cats
* @uses in_category() Passes $_post (can be empty)
* @version 2.7
* @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
*/
if ( ! function_exists( 'post_is_in_descendant_category' ) ) {
	function post_is_in_descendant_category( $cats, $_post = null ) {
		foreach ( (array) $cats as $cat ) {
			// get_term_children() accepts integer ID only
			$descendants = get_term_children( (int) $cat, 'category' );
			if ( $descendants && in_category( $descendants, $_post ) )
				return true;
		}
		return false;
	}
}
