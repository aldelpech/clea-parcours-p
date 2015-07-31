<?php
/**
 * Template Name: n°1 essai accueil PP
 */

$do_not_duplicate = array();

get_header(); // Loads the header.php template. ?>

	<!-- Begin featured area. --->
	<section class="feature">

		<p>Prévoir ici un texte permettant la prise de conscience de problèmes et les enjeux et renforcer cet aspect soit dans les cornerstones, soit dans des sous-pages, soit dans des articles de niveau 3</p>
	</section>
	<!-- End featured area. -->

	<section class="flexbox-horizontal">
		<h3>Les derniers articles du site, horizontal 2 colonnes</h3>	
		

		<div class="hor-masonry">
			<div class="hor-item">
				<h2>Attention</h2>
				<p>see http://w3bits.com/css-masonry/<p>
				<p>As CSS columns are supported by modern browsers only, you may also consider adding JavaScript fallbacks to make it work on older browsers. We can add a fallback to our masonry by making use of jQuery Masonry plugin.<p>

				<p>Following is the workaround to call jQuery Masonry as a fallback to our CSS masonry in IE9 or below:<p>

				<!-- will render -->
				<!--[if lte IE 9]>
				<script src="masonry.pkgd.min.js"></script>
				<![endif]-->
				<!-- used http://www.freeformatter.com/html-escape.html#ad-output -->
				<pre><code>
				&lt;!--[if lte IE 9]&gt;&lt;script src=&quot;masonry.pkgd.min.js&quot;&gt;&lt;/script&gt;&lt;![endif]--&gt;
				</code></pre>
			</div>

			<!-- voir http://demosthenes.info/blog/844/Easy-Masonry-Layout-With-Flexbox -->
				<!-- Begin excerpts area. -->
		<?php 
		// set the "paged" parameter (use 'page' if the query is on a static front page)
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

		$loop = new WP_Query(
			array(
				'post_type' => 'post',
				'posts_per_page' => 10,
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
				'post__not_in' => $do_not_duplicate,
				'paged' 			=> $paged, 
				'category__not_in'	=> '72', /* exclude category "AIDE" */
				'post_status' => 'publish', /* show only published posts */
			)
		); ?>

		<?php if ( $loop->have_posts() ) : ?>

			<?php while ( $loop->have_posts() ) : $loop->the_post(); $do_not_duplicate[] = get_the_ID();  ?>

				<div class="hor-item">
					<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'thumbnail' ) ); ?>
					<header class="entry-header">
						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title tag="h3"]' ); ?>
					</header><!-- .entry-header -->
					<span class="entry-summary"><?php echo(get_the_excerpt()); ?></span>
					<p class="entry-meta">
						<?php echo apply_atomic_shortcode( 'entry_byline', '<span class="entry-byline">' . __( '[entry-published] [entry-edit-link before=" | "]', 'unique' ) . '</span>' ); ?>
						<span class="categories"><?php the_category(', '); ?></span>
					</p>
				</div>	
				
			<?php endwhile; ?>

		<?php endif; ?>
		</div><!-- #pp-container -->

		<!-- http://wordpress.stackexchange.com/questions/174907/how-to-use-the-posts-navigation-for-wp-query-and-get-posts -->
		<?php 
		$GLOBALS['wp_query']->max_num_pages = $loop->max_num_pages;
		
		// echos the return of get_the_posts_pagination()
		the_posts_pagination( array(
			'mid_size' => 2,
			'prev_text' => __( 'Plus récents', 'clea-base' ),
			'next_text' => __( 'Plus anciens', 'clea-base' ),
			'screen_reader_text' => __( 'autres articles', 'clea-base' ),
		) ); ?>
		
		
		<?php wp_reset_query(); ?>

	</section>	
	
	
	
	<section class="flexbox-list">
		<h3>Les derniers articles du site, en colonnes</h3>	
		<div class="masonry">
			<div class="item">
				<h2>Attention</h2>
				<p>see http://w3bits.com/css-masonry/<p>
				<p>As CSS columns are supported by modern browsers only, you may also consider adding JavaScript fallbacks to make it work on older browsers. We can add a fallback to our masonry by making use of jQuery Masonry plugin.<p>

				<p>Following is the workaround to call jQuery Masonry as a fallback to our CSS masonry in IE9 or below:<p>

				<!-- will render -->
				<!--[if lte IE 9]>
				<script src="masonry.pkgd.min.js"></script>
				<![endif]-->
				<!-- used http://www.freeformatter.com/html-escape.html#ad-output -->
				<pre><code>
				&lt;!--[if lte IE 9]&gt;&lt;script src=&quot;masonry.pkgd.min.js&quot;&gt;&lt;/script&gt;&lt;![endif]--&gt;
				</code></pre>
			</div>
			<!-- voir http://demosthenes.info/blog/844/Easy-Masonry-Layout-With-Flexbox -->
				<!-- Begin excerpts area. -->
		<?php 
		// set the "paged" parameter (use 'page' if the query is on a static front page)
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

		$loop = new WP_Query(
			array(
				'post_type' => 'post',
				'posts_per_page' => 10,
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
				'post__not_in' => $do_not_duplicate,
				'paged' 			=> $paged, 
				'category__not_in'	=> '72', /* exclude category "AIDE" */
				'post_status' => 'publish', /* show only published posts */
			)
		); ?>

		<?php if ( $loop->have_posts() ) : ?>

			<?php while ( $loop->have_posts() ) : $loop->the_post(); $do_not_duplicate[] = get_the_ID();  ?>

				<div class="item">
					<figure>
						<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'medium' ) ); ?>
					</figure>
					<div class="categorie">
							<span class="categories"><?php the_category(', '); ?></span>
					</div>
					<figcaption>
						<header class="entry-header">
							<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title tag="h3"]' ); ?>
						</header><!-- .entry-header -->
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
						<p class="entry-meta">
						<span class="categories">  </span>
						<?php echo apply_atomic_shortcode( 'entry_byline', '<span class="entry-byline">' . __( '[entry-published] [entry-edit-link before=" | "]', 'unique' ) . '</span>' ); ?>
					</figcaption>
					
					<!-- <div class="clearfix"></div> -->
				</div>	
						
			<?php endwhile; ?>

		<?php endif; ?>
		</div><!-- #pp-container -->

		<!-- http://wordpress.stackexchange.com/questions/174907/how-to-use-the-posts-navigation-for-wp-query-and-get-posts -->
		<?php 
		$GLOBALS['wp_query']->max_num_pages = $loop->max_num_pages;
		
		// echos the return of get_the_posts_pagination()
		the_posts_pagination( array(
			'mid_size' => 2,
			'prev_text' => __( 'Plus récents', 'clea-base' ),
			'next_text' => __( 'Plus anciens', 'clea-base' ),
			'screen_reader_text' => __( 'autres articles', 'clea-base' ),
		) ); ?>
		
		
		<?php wp_reset_query(); ?>

	</section>

	<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>



<?php get_footer(); // Loads the footer.php template. ?>