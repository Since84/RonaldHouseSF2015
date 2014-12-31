<?php 
/**
 * Spark Main Template
 * 
 * This is the base for all templates within spark.
 * It includes the global header and footer.
 * The home page will default to this template ( home.php ) unless otherwise configured. 
 * 
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Spark
 * @subpackage SparkFifteen
 * @since SparkFifteen 1.0
 */ 
wp_head();

$context = Timber::get_context();

//Header Section ( Using SparkHeader Class )
$sparkHeader = new SparkHeader(array(
  'showLogo'      =>  true
  ,'headerRight'  =>  'sidebars/sidebar-social.php' //Template for right side ( /views/components/... )
  ,'nav'          =>  'nav' //Menu name for nav menu
  ,'template'     =>  'header' //Name of header template
  ,'isJs'         =>  false
));

$sparkContent = new SparkContent();

/// Get Content
//Header 
$context['header'] = $sparkHeader::getView();

//Gallery Section ( Using SparkGallery shortcode )
$context['gallery'] = do_shortcode( get_option('gallery_ids') );

//Call To Action Section
$context['call_to_action'] = Timber::get_sidebar('sidebars/sidebar-action.php');

//What's Happening 
$whArgs = array( 'showposts'	=> '12' );
$context['whats_happening'] = $sparkContent::getRoll($whArgs, 'content-roll');

//Family Stories
$fsArgs = array( 'showposts'	=> '12' );
$context['family_stories'] = $sparkContent::getRoll($fsArgs, 'content-roll');

//Social
$context['social'] = Timber::get_sidebar('sidebars/sidebar-facebook.php');


///Display Page 
Timber::render('/views/templates/home.html.twig', $context);

wp_footer();
?>