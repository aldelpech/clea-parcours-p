<?php
/**
 * 
 * this file is designed to provide specific functions for the child theme
 *
 * @package    clea-base
 * @subpackage Functions
 * @version    0.1.0
 * @since      0.1.0
 * @author     Anne-Laure Delpech <ald.kerity@gmail.com>  
 * @copyright  Copyright (c) 2015 Anne-Laure Delpech
 * @link       
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* setup the child theme */ 
add_action( 'after_setup_theme', 'clea_parcours_p_child_setup', 11 );

/* support thumbnails for LearnDash contents */ 
add_action( 'init', 'clea_learndash_featured_thumbnail' );


function clea_parcours_p_child_setup() {
	/* Register and load scripts. */
	add_action( 'wp_enqueue_scripts', 'clea_parcours_p_enqueue_scripts' );

	/* Register and load styles. */
	add_action( 'wp_enqueue_scripts', 'clea_parcours_p_enqueue_styles', 4 ); 

	/* add a class to <a> elements followed by <img> element */
	add_action( 'wp_head', 'clea_parcours_p_add_class_to_element_with_nested_img' );

	add_action( 'widgets_init', 'clea_parcours_p_register_sidebars' );
	
	// add featured images to rss feed
	add_filter('the_excerpt_rss', 'clea_parcours_p_featuredtoRSS');
	add_filter('the_content_feed', 'clea_parcours_p_featuredtoRSS');

	# Change Read More link in automatic Excerpts
	remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	add_filter('get_the_excerpt', 'wpse_custom_wp_trim_excerpt');

	add_theme_support( 'post-thumbnails' ); 	
}

function clea_learndash_featured_thumbnail() {
	add_theme_support( 'post-thumbnails', array( 
		'sfwd-certificates', 
		'sfwd-courses', 
		'sfwd-lessons', 
		'sfwd-topic', 
		'sfwd-quiz', 
		'sfwd-assignment', 
		'sfwd-essays' ) 
	);
}

function clea_parcours_p_enqueue_styles() {

	// feuille de style pour l'impression
	wp_enqueue_style( 'print', get_stylesheet_directory_uri() . '/css/print.css', array(), false, 'print' );
	
	if ( is_page_template( 'page/ac-front-page-template.php' ) ) {
		wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css' , array( '25px' ) );
	}
	
	/* if ( is_page_template( 'page/pp-front-page-test1.php' ) ) {
		wp_enqueue_style( 'test1-masonry', get_stylesheet_directory_uri() . '/css/test1.css' );
	} */
	
}

function clea_parcours_p_enqueue_scripts() {
	
	/* Enqueue the 'flexslider' script. */
	if ( is_page_template( 'page/pp-front-page-template.php' ) ) {
		wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/flexslider/flexslider.min.js' , array( 'jquery' ), '20120713', true );
	}
	
	/* if ( is_page_template( 'page/pp-front-page-test1.php' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	} */
}

/******************************************************************
* add a class to <a> elements followed by <img> element
* see the test here http://codepen.io/aldelpech/pen/jPoMeZ
* 
* so that a[target="_blank"]::after may have a specific icon 
* while the same a[target="_blank"] with an <img> does not
*
******************************************************************/

function clea_parcours_p_add_class_to_element_with_nested_img() { 

		?>
		<script>
		jQuery(document).ready(function() {
			jQuery("a:has(img)").addClass("img-inside");
			jQuery("figure:has(a.img-inside)").addClass("external");
		});
		</script>
		<?php 

}

/* register a before-front-page sidebar */
function clea_parcours_p_register_sidebars() {
	/* see http://justintadlock.com/archives/2010/11/08/sidebars-in-wordpress */
	/* Register the 'primary' sidebar. */
	register_sidebar(
		array(
			'id' => 'before-front-page',
			'name' => __( "Avant le contenu de page d'accueil" ),
			'description' => __( 'Pour insérer un contenu juste sous le menu' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
	
	/* Now you just create a sidebar-new-name.php template
	* and use it somewhere with 
	* <?php get_sidebar( 'new-name' ); // Loads the sidebar-new-name.php template. ?>
	*/
	
}

function clea_parcours_p_featuredtoRSS( $content ) {
	// https://woorkup.com/show-featured-image-wordpress-rss-feed/
	
	global $post;
	if ( has_post_thumbnail( $post->ID ) ){
		$content = '<div>' . get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
	}
	
	return $content;
}

function wpse_allowedtags() {
    // Add custom tags to this string
	// <a>,<img>,<video>,<script>,<style>,<audio> are not in
    return '<br>,<em>,<i>,<ul>,<ol>,<li>,<p>'; 
}

if ( ! function_exists( 'wpse_custom_wp_trim_excerpt' ) ) : 

    function wpse_custom_wp_trim_excerpt($wpse_excerpt) {
		$raw_excerpt = $wpse_excerpt;
		
		// text for the "read more" link
				
		$rm_text = __( ' Lire l\'article', 'stargazer' ) ;
		$excerpt_end = ' <a class="read-more" href="'. esc_url( get_permalink() ) . '">' . $rm_text . '</a>';
		
        if ( '' == $wpse_excerpt ) {  

            $wpse_excerpt = get_the_content('');
            $wpse_excerpt = strip_shortcodes( $wpse_excerpt );
            $wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
            $wpse_excerpt = str_replace(']]>', ']]&gt;', $wpse_excerpt);
            $wpse_excerpt = strip_tags($wpse_excerpt, wpse_allowedtags()); /*IF you need to allow just certain tags. Delete if all tags are allowed */

            //Set the excerpt word count and only break after sentence is complete.
                $excerpt_word_count = 75;
                $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
                $tokens = array();
                $excerptOutput = '';
                $count = 0;

                // Divide the string into tokens; HTML tags, or words, followed by any whitespace
                preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens);

                foreach ($tokens[0] as $token) { 

                    if ($count >= $excerpt_length && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) { 
                    // Limit reached, continue until , ; ? . or ! occur at the end
                        $excerptOutput .= trim($token);
                        break;
                    }

                    // Add words to complete sentence
                    $count++;

                    // Append what's left of the token
                    $excerptOutput .= $token;
                }

            $wpse_excerpt = trim(force_balance_tags($excerptOutput));
		   
				// $wpse_excerpt .= $excerpt_end ;
				$excerpt_more = apply_filters( 'excerpt_more', ' ' . $excerpt_end ); 

                $pos = strrpos($wpse_excerpt, '</');
                if ($pos !== false) {
					// Inside last HTML tag
					$wpse_excerpt = substr_replace($wpse_excerpt, $excerpt_end, $pos, 0); // Add read more next to last word 
				} else {
					// After the content
					$wpse_excerpt .= $excerpt_more; //Add read more in new paragraph 
				}
                
            return $wpse_excerpt;   

        } 
		
		// add read more link to the manual extract
		$wpse_excerpt .= $excerpt_end ;
		// return the manual extract
		// DELETE the 'AAAA !' . before $wpse_excerpt : it's used to show the manual extracts for debugging. 
        return apply_filters('wpse_custom_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt);
    }
  
endif;  


?>