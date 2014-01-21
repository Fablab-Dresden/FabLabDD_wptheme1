<?php

$fldd = (object) array(
		'basedir'=>__DIR__.'/../twentytwelve/',
		'show_excerpts' => false
);

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


