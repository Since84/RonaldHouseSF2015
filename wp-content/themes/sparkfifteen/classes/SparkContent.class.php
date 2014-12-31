<?php 
/*
	CLASS SparkContent
	Contains all functions for this component
	Includes all dependencies
*/

	class SparkContent {
		private static $spark_options = array(
			'context'		=> false,
			'template'		=> 'content'
		);

		function __construct($options=false) {
			// Set Options
			self::$spark_options = ( $options ? $options : self::$spark_options );

			//Add Actions
			add_action('init', array($this, 'initAction'));
			add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));

		}

		/** FUNCTION initAction
		  * applies actions to be run at init
		**/
		function initAction(){

		}

		/** FUNCTION adminInitAction
		  * applies actions to be run at admin init
		**/
		function adminInitAction(){

		}

		/** FUNCTION sparkEnqueueScripts
		  * applies actions to be run at admin init
		**/
		function enqueueScripts(){
			wp_enqueue_script( 'content-script', get_template_directory_uri().'/classes/components/content/content.spark.js', array('jquery'),'',true );
			wp_enqueue_style( 'content-style', get_template_directory_uri().'/classes/components/content/content.spark.css' );
		}

		/** FUNCTION getOptions
		  * applies actions to be run at admin init
		**/
		public static function getOptions(){
	       return self::$spark_options;
		}	

		public static function getContext(){
			  $context 	= ( self::$spark_options['context'] ? self::$spark_options['context'] : Timber::get_context() );

			  return $context;
		}

		/** FUNCTION getRoll 
		  * returns string of HTML Slides
		**/
		public static function getRoll( $args=null, $temp=null ){
			$posts=Timber::get_posts($args);
			$context = Timber::get_context();
			$context['roll'] = $posts;

			$template = $temp ? $temp : 'content-roll';

			return self::getView( $context, $template );
		}

		/** FUNCTION getView
		  * returns TIMBER template.
		**/
		public static function getView( $context=null, $template ){
			return Timber::compile( 
				'/classes/components/content/views/' 
				. ( $template ? $template : self::$spark_options['template'] )
				.'.html.twig', 
				$context ? $context : self::getContext() );
		}

	}




