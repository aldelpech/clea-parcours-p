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

function clea_parcours_p_child_setup() {
	/* Register and load scripts. */
	add_action( 'wp_enqueue_scripts', 'clea_parcours_p_enqueue_scripts' );

	/* Register and load styles. */
	add_action( 'wp_enqueue_scripts', 'clea_parcours_p_enqueue_styles', 4 ); 

	/* add a class to <a> elements followed by <img> element */
	add_action( 'wp_head', 'clea_parcours_p_add_class_to_element_with_nested_img' );

	add_action( 'widgets_init', 'clea_parcours_p_register_sidebars' );
	

	
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



?>