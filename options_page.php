<?php 






function myplugin_options_page()
{
	if(get_option('myplugin_option_id')!="myplugin_option_id" && get_option('myplugin_option_name')!="myplugin_option_name" ){
		
		$script_params = array(
			'myplugin_option_id' => get_option('myplugin_option_id'),
		    'myplugin_option_name' => get_option('myplugin_option_name')
		);


	

		?>
		
		<script type="text/javascript">  
			
				(function($) {
	
				$(document).ready(function(){
					
			     $("#wpbody-content").css("background-color", "<?php echo get_option('myplugin_option_id'); ?>");
				
				});	
	
				})( jQuery ); 



  
			
		</script>
		
		
		<?php
	}
?>
  <div>
  <?php screen_icon(); ?>
  <h2>Opacity Change</h2>
  <form method="post" action="options.php">
  <?php settings_fields( 'myplugin_options_group' ); ?>
  <h3>Settings</h3>
  <p>Opacity Change is a plugin that lets you set the opacity of an element on the page.</p>
  <table>
  <tr valign="top" halign = "left">
  <th scope="row"><label for="myplugin_option_id">Enter Opacity changeable element id </label></th>
  <td><input type="text" id="myplugin_option_id" name="myplugin_option_id" value="<?php echo get_option('myplugin_option_id'); ?>" /></td>
  </tr>
  
   <tr valign="top" halign = "left">
  <th scope="row"><label for="myplugin_option_name">Enter Opacity css value 0 to 1 </label></th>
  <td><input type="text" id="myplugin_option_name" name="myplugin_option_name" value="<?php echo get_option('myplugin_option_name'); ?>" /></td>
  </tr>
  </table>
  <?php  submit_button(); ?>
  </form>
  </div>
<?php
}

function opacity_change_admin_mesage(){
	$user_id = get_current_user_id();
	if ( !get_user_meta( $user_id, 'my_plugin_notice_dismissed' ) ){
		
		 ?>
    <div class="updated notice">
        <p><?php _e( 'Opacity Change Plugin has been installed!', 'elementor-hello-world' ); ?></p>
		<button onclick = 'window.open("https://sivacreative.com/")'>Make Sure to Check Us Out Online</button>
		<button><a href="?my-plugin-dismissed">Dismiss</a></button>
    </div>
    <?php
	
		
	}
	
	
}

function my_plugin_notice_dismissed() {
    $user_id = get_current_user_id();
    if ( isset( $_GET['my-plugin-dismissed'] ) )
        add_user_meta( $user_id, 'my_plugin_notice_dismissed', 'true', true );
}

function wpdocs_theme_name_scripts() {

	if(get_option('myplugin_option_id')!="myplugin_option_id" && get_option('myplugin_option_name')!="myplugin_option_name" ){
		
		$script_params = array(
			'myplugin_option_id' => get_option('myplugin_option_id'),
		    'myplugin_option_name' => get_option('myplugin_option_name')
		);

		

	}

  
   
	wp_register_script( 'script', plugins_url( '/assets/js/opacity-change.js', __FILE__ ), array ( 'jquery' ), 1.1, true);
	
	
	wp_register_style( 'style4', plugins_url( '/assets/css/style_opacity.css', __FILE__ ));
    wp_enqueue_style( 'style4' );
	
     wp_localize_script('script', 'scriptParams', $script_params);
    wp_enqueue_script('script');
	
	wp_register_script( 'jQuery', 'https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js', null, null, true );
	wp_register_script( 'jQuery1', 'https://unpkg.com/interactjs@1.10.1/dist/interact.min.js', null, null, true );
    wp_enqueue_script('jQuery');
	 wp_enqueue_script('jQuery1');



}


 ?>