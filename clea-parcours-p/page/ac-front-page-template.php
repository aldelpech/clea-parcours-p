<?php
/**
 * Template Name: maquette accueil PP
 */

$do_not_duplicate = array();
 
get_header(); // Loads the header.php template. ?>

	<!--  begin sidebar-before-front-page area -->
	
	<?php get_sidebar( 'before-front-page' ); // Loads the sidebar-before-front-page.php template. ?>
	
	<!--  end  sidebar-before-front-page area -->
	
	<div id="content" class="hfeed">
	<h2>Les derniers articles du blog</h2>
		<!-- Begin excerpts area. -->
		<?php $loop = new WP_Query(
			array(
				'post_type' => 'post',
				'posts_per_page' => 8,
				'tax_query' => array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array(
							'post-format-aside',
							'post-format-audio',
							'post-format-chat',
							'post-format-gallery',
							'post-format-image', 
							'post-format-link', 
							'post-format-quote',
							'post-format-status',
							'post-format-video'
						),
						'operator' => 'NOT IN'
					)
				),
				'category__not_in'	=> '72', /* exclude category "AIDE" */
				'post__not_in' => $do_not_duplicate
			)
		); ?>

		<?php if ( $loop->have_posts() ) : ?>

			<div class="content-secondary">

				<?php while ( $loop->have_posts() ) : $loop->the_post(); $do_not_duplicate[] = get_the_ID();  ?>
	
					<?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>

				<?php endwhile; ?>

			</div><!-- .content-secondary -->

		<?php endif; ?>
		<!-- End excerpts area. --->



		<?php wp_reset_query(); ?>

	</div><!-- #content -->

<?php // get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>

<?php get_footer(); // Loads the footer.php template. ?>