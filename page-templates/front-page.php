<?php
/**
 * Template Name: Front Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<div class="fbdd-home-layout">
				<div class="fbdd-home-layout-row">
				<?php while ( have_posts() ) : ?>
					<?php 
					$post = get_post();
					
					set_post_thumbnail_size(400,400);
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),array(400,400) );
					$url = $thumb['0'];
					
					$out = print_r($thumb,1);
						
					?>
				
					<div class="fbdd-home-image"><article style="background-image:url(<?php echo $url;?>)">&nbsp;</article></div>
					
					<div class="fbdd-home-teaser">
					<?php  
						the_post();
						get_template_part( 'content', 'page' );
					?>
					</div>
				<?php endwhile; // end of the loop. ?>	
				</div>
				<div class="fbdd-home-layout-row">
					<div class="fbdd-home-events"><?php 
					
						$the_query = new WP_Query( array('pagename'=>'Home - events') );
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							get_template_part( 'content', 'page' );
						}
						

						dynamic_sidebar( 'fbdd-front-sidebar' );
							
							
					?>
					</div>
					<div class="fbdd-home-upcoming">
					<?php 
						$the_query = new WP_Query( array('cat'=>4) );
						$GLOBALS['fldd']->show_excerpts = true; # makes displaying excerpts
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							get_template_part( 'content' );
						}
						$GLOBALS['fldd']->show_excerpts = false;
					?>
					
					</div>	
				</div>
			</div>	
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>