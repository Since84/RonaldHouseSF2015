<?php

class SparkTheme {
	
	function __construct() {

		//Add Actions
		add_action('init', array($this, 'initAction'));
		$this->createAdminPage();
	}

	/** FUNCTION initAction
	  * applies actions to be run at init
	**/
	function initAction(){
		// Register Post Types ( custom, nav, sidebars, etc.)
		require_once(get_template_directory().'/functions/nav.php');
		require_once(get_template_directory().'/functions/sidebars.php');
		require_once(get_template_directory().'/functions/post_types.php');
		require_once(get_template_directory().'/functions/hooks_filters.php');

		// Theme Support
		add_theme_support( 'custom-header' );
	}

	/** FUNCTION adminInitAction
	  * applies actions to be run at admin init
	**/
	function adminInitAction(){
	}

	/** FUNCTION adminMenuAction
	  * applies actions to be run at admin init
	**/
	function createAdminPage(){
		$sparkAdmin = new SparkAdminPage();
	}

	/** FUNCTION sparkEnqueueScripts
	  * applies actions to be run at admin init
	**/
	function enqueueScripts(){
		require_once(get_template_directory().'/functions/enqueue.php');
	}

	/** FUNCTION sparkCreateHomePageAdminMenu
	  * applies actions to be run at admin init
	**/
	function createHomePageAdminMenu(){
		if ( !$homeGallery = get_option( 'home_gallery' ) )
			add_option( 'home_gallery', '' );
?>
	<div class="wrap">
		<form name="form1" method="post" action="">
<?php
		settings_fields( 'home_gallery' );
		do_settings_sections( 'home_gallery' );
?>
			<div id="poststuff">
				<div id="post-body">
					<div id="postdivrich" class="postarea">
						<h3><?php _e('Content') ?></h3>
						<?php the_editor($homeGallery); ?>
						<?php wp_nonce_field( 'autosave', 'autosavenonce', false ); ?>
						<?php wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false ); ?>
						<?php wp_nonce_field( 'getpermalink', 'getpermalinknonce', false ); ?>
						<?php wp_nonce_field( 'samplepermalink', 'samplepermalinknonce', false ); ?>
						<?php submit_button(); ?>
					</div>
				</div>
			</div>
		</form>
	</div>
<?php
	}	


}