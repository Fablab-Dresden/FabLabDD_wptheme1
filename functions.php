<?php

$fldd = (object) array(
		'basedir'=>__DIR__.'/../twentytwelve/'
);


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