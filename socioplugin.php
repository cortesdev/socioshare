<?php
 /*
    Plugin Name: SocioPlugin
    Plugin URI: http://www.ricardocortes.de
    Description: SocioPlugin displays dynamically the Facebook Page Plugin in posts, pages and widgets using [pagelike] Shortcode.
    Author: R. Cortes
    Version: 1.0
    Author URI: http://www.ricardocortes.de
*/
 
// Ceates the shortcode variable
add_shortcode('pagelike', 'create_form');

// Prints the FB-PAGE content for the Shortcode
function create_form()
{
?>  <!--Facebook Markup with options URLs-->
	<div class="fb-page" data-href="<?php echo get_option('facebook_input'); ?>" data-width="500" data-height="220" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
		<div class="fb-xfbml-parse-ignore">
			<blockquote cite="<?php echo get_option('facebook_input'); ?>"><a href="<?php echo get_option('facebook_input'); ?>">Sociomantic Labs</a></blockquote>
		</div>
	</div> 
<?php
} 

// Action Options in Admin/Settings Panel
add_action('admin_menu', 'socioplugin_admin_actions');

// Register settings
function socioplugin_admin_actions() {
	add_options_page('SocioPlugin', 'SocioPlugin', 'manage_options', __FILE__, 'socioplugin_admin');
	register_setting('socioplugin-settings', 'facebook_input');
}

// Prints Admin Settings/Options Markup
function socioplugin_admin() 
{
?>
	<div class="wrap">
		<!--icon-plugins" class="icon32" -->
		<h2>SocioPlugin Options</h2>
		<p>Plugin for displaying Facebook Page Plugin dynamically using shortcodes in posts and widgets*.</p>
		<h3>Please insert your full facebook page URL below:</h3>
		<form method="post" action="options.php">
		    <?php settings_fields('socioplugin-settings'); ?>
		    <?php do_settings_sections('socioplugin-settings'); ?>
		    <table class="form-table">
		        <tr valign="top">
		        <th scope="row">Facebook URL</th>
		        <td><input type="text" size="50" placeholder="http://www.facebook.com/..."  name="facebook_input" id="facebook_input" value="<?php echo esc_attr( get_option('facebook_input') ); ?>" /></td>
		        </tr>

		    </table>
		    <!--Instructions options page-->
			<table class="widefat">
				<thead>
					<tr>
						<th>Simply copy and paste the shortcode beside, and add Facebook page like to your posts.</th>
						<th><h4>[pagelike]</h4></th>
					</tr>
					<tr>
						<th><img src="../wp-content/plugins/socioplugin/images/post-sample.png" width="50%"/></th>
					</tr>
				</thead>
			</table>
			<h5>* To use Facebook Page Plugin on Widgets is required to install  
			the <a href="https://wordpress.org/plugins/shortcodes-in-sidebar-widgets/">shortcodes-in-sidebar-widgets</a> Plugin 
			or insert code modifications on functions.php.</h5>
		    <?php submit_button(); ?>
		</form>

	</div>

<?php
}

// Load external javascript at bottom body enclosure - Avoiding bug content tags
add_action('wp_enqueue_scripts', 'wp_add_script');   

// Registering javascript Function
function wp_add_script() {
wp_register_script('script-handle', plugins_url('js/functions.js', __FILE__ ),'','',true);
wp_enqueue_script('script-handle');
}

// Registering css Function
function wp_add_style()
{
    // Register style  
    wp_register_style( 'iframe', plugins_url( 'css/frame.css', __FILE__ ), array(), '', 'all' );
 
    // Enqueue style
    wp_enqueue_style( 'iframe' );
}
add_action( 'wp_enqueue_scripts', 'wp_add_style' );
?>


