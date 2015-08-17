<?php
/**
 * Template Name: maquette accueil PP
 */

$do_not_duplicate = array();
 
get_header(); // Loads the header.php template. ?>

	<!-- Begin featured area. --->
	<section class="feature">
		<p>ici sera géré par une sidebar "before-front-page"</p>
		<p>Prévoir ici un texte permettant la prise de conscience de problèmes et les enjeux et renforcer cet aspect soit dans les cornerstones, soit dans des sous-pages, soit dans des articles de niveau 3</p>
	</section>
	<!-- End featured area. -->

	
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
	
					<article id="post-<?php the_ID(); ?>" class="bloc-article <?php hybrid_entry_class(); ?>">

							<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'thumbnail' ) ); ?>
							<header class="entry-header">
								<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title tag="h3"]' ); ?>
							</header><!-- .entry-header -->
							<span class="entry-summary"><?php echo(get_the_excerpt()); ?></span>
							<p class="entry-meta">
								<?php echo apply_atomic_shortcode( 'entry_byline', '<span class="entry-byline">' . __( '[entry-published] [entry-edit-link before=" | "]', 'unique' ) . '</span>' ); ?>
								<span class="categories"><?php the_category(', '); ?></span>
							</p>

					</article><!-- .hentry -->

				<?php endwhile; ?>

			</div><!-- .content-secondary -->

		<?php endif; ?>
		<!-- End excerpts area. --->



		<?php wp_reset_query(); ?>

	</div><!-- #content -->

<?php // get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>

<?php get_footer(); // Loads the footer.php template. ?>