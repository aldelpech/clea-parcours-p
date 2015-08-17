<?php
/**
 * Template Name: maquette accueil PP
 */

$do_not_duplicate = array();
 
get_header(); // Loads the header.php template. ?>

	<section class="note">
	<h4> essais de page d'accueil</h4>
	<ul>
	<li><a href="http://testal.parcours-performance.com/test-presentation-articles-n1/">Essai 1 avec "masonry" et gestion des pages</a></li>
	</ul>
	</section>

	<!-- Begin featured area. --->
	<section class="feature">

		<p>Prévoir également ici un texte permettant la prise de conscience de problèmes et les enjeux et renforcer cet aspect soit dans les cornerstones, soit dans des sous-pages, soit dans des articles de niveau 3</p>
		<center><h3>Organiser avec le lean - Manager autrement - En savoir plus sur Anne-Laure Delpech</h3></center>
		<center><h4>Que voulez-vous faire aujourd'hui ?</h4></center>
		<p></p>
		<center>
		<a href="http://testal.parcours-performance.com/lean-management-amelioration-continue-guide/">
			<img src="http://testal.parcours-performance.com/wp-content/uploads/2015/06/lean-amelioration-continue.png" style="height:240px; width:240px;">
		</a>
		<a href="http://testal.parcours-performance.com/mieux-manager-comment-devenir-un-meilleur-manageur/">
			<img src="http://testal.parcours-performance.com/wp-content/uploads/2015/06/manager-mieux.png" style="height:240px; width:240px;">
		</a>
		<a href="http://testal.parcours-performance.com/anne-laure-delpech/">
			<img src="http://testal.parcours-performance.com/wp-content/uploads/2015/06/a-propos.png" style="height:240px; width:240px;">
		</a>
		</center>
		
	</section>
	<!-- End featured area. -->

	
	<div id="content" class="hfeed">
	<h2>Les derniers articles du blog</h2>
		<!-- Begin excerpts area. -->
		<?php $loop = new WP_Query(
			array(
				'post_type' => 'post',
				'posts_per_page' => 4,
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
				'post__not_in' => $do_not_duplicate
			)
		); ?>

		<?php if ( $loop->have_posts() ) : ?>

			<div class="content-secondary">

				<?php while ( $loop->have_posts() ) : $loop->the_post(); $do_not_duplicate[] = get_the_ID();  ?>

					<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

							<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'thumbnail' ) ); ?>

							<header class="entry-header">
								<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title tag="h3"]' ); ?>
								<?php echo apply_atomic_shortcode( 'entry_byline', '<div class="entry-byline">' . __( 'Publié le [entry-published] [entry-edit-link before=" | "]', 'unique' ) . '</div>' ); ?>
							</header><!-- .entry-header -->

							<div class="entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->

					</article><!-- .hentry -->

				<?php endwhile; ?>

			</div><!-- .content-secondary -->

		<?php endif; ?>
		<!-- End excerpts area. --->



		<?php wp_reset_query(); ?>

	</div><!-- #content -->

<?php // get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>

<?php get_footer(); // Loads the footer.php template. ?>