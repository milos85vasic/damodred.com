<?php
/**
* About Theme
*/
class Bloog_Lite_About_Theme {
	public $req_plugins = array(); // For Storing the list of the Required Plugins
	public function __construct() {
		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'bloog_lite_welcome_register_menu' ) );
		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'bloog_lite_activation_admin_notice' ) );

		/** List of required Plugins **/
		$this->req_plugins = array(

			'instant-demo-importer' => array(
				'slug' => 'instant-demo-importer',
				'name' => __('Instant Demo Importer', 'bloog-lite'),
				'filename' =>'instant-demo-importer.php',
				'class' => 'Instant_Demo_Importer',
				'github_repo' => true,
				'bundled' => true,
				'location' => 'https://github.com/8degreethemes/instant-demo-importer/archive/master.zip',
				'info' => __('Instant Demo Importer Plugin adds the feature to Import the Demo Conent with a single click.', 'bloog-lite'),
				),
			);

		/** Plugin Installation Ajax **/
		add_action( 'wp_ajax_bloog_lite_plugin_installer', array( $this, 'bloog_lite_plugin_installer_callback' ) );

		/** Plugin Installation Ajax **/
		add_action( 'wp_ajax_bloog_lite_plugin_offline_installer', array( $this, 'bloog_lite_plugin_offline_installer_callback' ) );

		/** Plugin Activation Ajax **/
		add_action( 'wp_ajax_bloog_lite_plugin_activation', array( $this, 'bloog_lite_plugin_activation_callback' ) );

		/** Plugin Activation Ajax (Offline) **/
		add_action( 'wp_ajax_bloog_lite_plugin_offline_activation', array( $this, 'bloog_lite_plugin_offline_activation_callback' ) );
	}
	public function bloog_lite_welcome_register_menu() {
		$title = __( 'About Bloog Lite', 'bloog-lite' );

		add_theme_page( __( 'About Bloog Lite', 'bloog-lite' ), $title, 'edit_theme_options', 'bloog-lite-about', array(
			$this,
			'bloog_lite_about_theme_page'
			) );
	}
	public function bloog_lite_about_theme_page() {
		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );

		$bloog_lite      = wp_get_theme();
		$active_tab   = isset( $_GET['tab'] ) ? $_GET['tab'] : 'getting_started';
		?>

		<div class="wrap bloog-lite-wrap">

			<div class="top-wrap">
				<div class="text-wrap">
					<h1><?php echo __( 'Welcome to Bloog Lite! - Version ', 'bloog-lite' ) . esc_html( $bloog_lite['Version'] ); ?></h1>

					<div
					class="about-text"><?php echo esc_html__( 'Bloog Lite is now installed and ready to use! Get ready to build something beautiful. We hope you enjoy it! We want to make sure you have the best experience using bloog Lite and that is why we gathered here all the necessary information for you. We hope you will enjoy using bloog Lite, as much as we enjoy creating great products.', 'bloog-lite' ); ?></div>
				</div>

				<div class="logo-wrap">
					<a target="_blank" href="<?php echo esc_url('https://8degreethemes.com/wordpress-themes/bloog-pro/');?>"><img src="<?php echo esc_url('http://8degreethemes.com/demo/upgrade-bloog-lite.jpg');?>" alt="<?php echo __('UPGRADE TO Bloog PRO','bloog-lite');?>"></a>
				</div>
			</div>

			<div class="bottom-block">
				<ul class="bloog-lite-tab-wrapper wp-clearfix">
					<li><a href="<?php echo esc_url( admin_url( 'themes.php?page=bloog-lite-about&tab=getting_started' ) ); ?>"
						class="bloog-lite-tab <?php echo $active_tab == 'getting_started' ? 'bloog-lite-tab-active' : ''; ?>"><?php echo esc_html__( 'Getting Started', 'bloog-lite' ); ?>

					</a></li>
					<li><a href="<?php echo esc_url( admin_url( 'themes.php?page=bloog-lite-about&tab=recommended_plugins' ) ); ?>"
						class="bloog-lite-tab <?php echo $active_tab == 'recommended_plugins' ? 'bloog-lite-tab-active' : ''; ?> "><?php echo esc_html__( 'Recommended Plugins', 'bloog-lite' ); ?>

					</a></li>
					<li><a href="<?php echo esc_url( admin_url( 'themes.php?page=bloog-lite-about&tab=demo_import' ) ); ?>"
						class="bloog-lite-tab <?php echo $active_tab == 'demo_import' ? 'bloog-lite-tab-active' : ''; ?> "><?php echo esc_html__( 'Import Demo', 'bloog-lite' ); ?>

					</a></li>
					<li><a href="<?php echo esc_url( admin_url( 'themes.php?page=bloog-lite-about&tab=support' ) ); ?>"
						class="bloog-lite-tab <?php echo $active_tab == 'support' ? 'bloog-lite-tab-active' : ''; ?> "><?php echo esc_html__( 'Support', 'bloog-lite' ); ?>

					</a></li>
					<li><a href="<?php echo esc_url( admin_url( 'themes.php?page=bloog-lite-about&tab=changelog' ) ); ?>"
						class="bloog-lite-tab <?php echo $active_tab == 'changelog' ? 'bloog-lite-tab-active' : ''; ?> "><?php echo esc_html__( 'Changelog', 'bloog-lite' ); ?>

					</a></li>
					
					<li><a href="<?php echo esc_url( admin_url( 'themes.php?page=bloog-lite-about&tab=more_wp' ) ); ?>"
						class="bloog-lite-tab <?php echo $active_tab == 'more_wp' ? 'bloog-lite-tab-active' : ''; ?> "><?php echo esc_html__( 'More WordPress Stuff', 'bloog-lite' ); ?>

					</a></li>
				</ul>
				<div class="bloog-lite-content-wrapper">
					<?php
					switch ( $active_tab ) {
						case 'getting_started':
						require_once get_template_directory() . '/inc/admin-panel/about/step-first.php';
						break;
						case 'recommended_plugins':
						require_once get_template_directory() . '/inc/admin-panel/about/step-second.php';
						break;
						case 'support':
						require_once get_template_directory() . '/inc/admin-panel/about/step-third.php';
						break;
						case 'changelog':
						require_once get_template_directory() . '/inc/admin-panel/about/step-fourth.php';
						break;
						case 'more_wp':
						require_once get_template_directory() . '/inc/admin-panel/about/step-fifth.php';
						break;
						case 'demo_import':
						require_once get_template_directory() . '/inc/admin-panel/about/step-demo.php';
						break;
						default:
						echo "Start";
						require_once get_template_directory() . '/inc/admin-panel/about/step-first.php';
						break;
					}
					?>
				</div>
			</div>
		</div><!--/.wrap.about-wrap-->

		<?php
	}

	public function call_plugin_api( $slug ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );

		if ( false === ( $call_api = get_transient( 'bloog_lite_plugin_information_transient_' . $slug ) ) ) {
			$call_api = plugins_api( 'plugin_information', array(
				'slug'   => $slug,
				'fields' => array(
					'downloaded'        => false,
					'rating'            => false,
					'description'       => false,
					'short_description' => true,
					'donate_link'       => false,
					'tags'              => false,
					'sections'          => true,
					'homepage'          => true,
					'added'             => false,
					'last_updated'      => false,
					'compatibility'     => false,
					'tested'            => false,
					'requires'          => false,
					'downloadlink'      => false,
					'icons'             => true
					)
				) );
			set_transient( 'bloog_lite_plugin_information_transient_' . $slug, $call_api, 30 * MINUTE_IN_SECONDS );
		}

		return $call_api;
	}

	public function check_active( $slug ) {
		if(is_array($slug)){
			$slug = (isset($slug['slug']))?$slug['slug']:$slug['location'];
		}
		if ( file_exists( ABSPATH . 'wp-content/plugins/' . $slug . '/' . $slug . '.php' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			$needs = is_plugin_active( $slug . '/' . $slug . '.php' ) ? 'deactivate' : 'activate';
			$key = $slug . '/' . $slug . '.php';
			return array( 'status' => is_plugin_active( $slug . '/' . $slug . '.php' ), 'needs' => $needs, 'key'=>$key );
		}
		$all_plugins = get_plugins();
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		// echoes the main file plugin if it's active
		foreach($all_plugins as $key => $plugin) {
			$kerarr = explode('/',$key);
			if($kerarr[0]==$slug){
				if( is_plugin_active($key) ) {
					$needs = is_plugin_active( $key ) ? 'deactivate' : 'activate';
					return array( 'status' => is_plugin_active($key), 'needs' => $needs,'key'=>$key);
				}
			}
		}
		$key = $slug . '/' . $slug . '.php';
		return array( 'status' => false, 'needs' => 'install','key'=>$key );
	}

	public function check_for_icon( $arr ) {
		if ( ! empty( $arr['svg'] ) ) {
			$plugin_icon_url = $arr['svg'];
		} elseif ( ! empty( $arr['2x'] ) ) {
			$plugin_icon_url = $arr['2x'];
		} elseif ( ! empty( $arr['1x'] ) ) {
			$plugin_icon_url = $arr['1x'];
		} else {
			$plugin_icon_url = $arr['default'];
		}

		return $plugin_icon_url;
	}

	public function create_action_link( $state, $slug, $key ) {
		switch ( $state ) {
			case 'install':
			return wp_nonce_url(
				add_query_arg(
					array(
						'action' => 'install-plugin',
						'plugin' => $slug
						),
					network_admin_url( 'update.php' )
					),
				'install-plugin_' . $slug
				);
			break;
			case 'deactivate':
			return add_query_arg( array(
				'action'        => 'deactivate',
				'plugin'        => rawurlencode( $key ),
				'plugin_status' => 'all',
				'paged'         => '1',
				'_wpnonce'      => wp_create_nonce( 'deactivate-plugin_' . $key ),
				), network_admin_url( 'plugins.php' ) );
			break;
			case 'activate':
			return add_query_arg( array(
				'action'        => 'activate',
				'plugin'        => rawurlencode( $key ),
				'plugin_status' => 'all',
				'paged'         => '1',
				'_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $key ),
				), network_admin_url( 'plugins.php' ) );
			break;
		}
	}

	/**
	 * Adds an admin notice upon successful activation.
	 *
	 * @since 1.8.2.4
	 */
	public function bloog_lite_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ( 'themes.php' == $pagenow ) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'bloog_lite_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 *
	 * @since 1.8.2.4
	 */
	public function bloog_lite_welcome_admin_notice() {
		?>
		<div class="updated notice is-dismissible">
			<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing bloog lite! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'bloog-lite' ), '<a href="' . esc_url( admin_url( 'themes.php?page=bloog-lite-about' ) ) . '">', '</a>' ); ?></p>
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=bloog-lite-about' ) ); ?>" class="button"
				style="text-decoration: none;"><?php _e( 'Get started with bloog Lite', 'bloog-lite' ); ?></a></p>
			</div>
			<?php
		}

		public function get_local_dir_path($plugin) {

			$url = wp_nonce_url(admin_url('themes.php??page=bloog-lite-about&tab=demo_import'),'bloog-file-installation');
			if (false === ($creds = request_filesystem_credentials($url, '', false, false, null) ) ) {
					return; // stop processing here
				}

				if ( ! WP_Filesystem($creds) ) {
					request_filesystem_credentials($url, '', true, false, null);
					return;
				}

				global $wp_filesystem;
				$file = $wp_filesystem->get_contents( $plugin['location'] );

				$file_location = get_template_directory().'/inc/admin-panel/demo/'.$plugin['slug'].'.zip';

				$wp_filesystem->put_contents( $file_location, $file, FS_CHMOD_FILE );

				return $file_location;
			}



			/* ========== Plugin Installation Ajax =========== */
			public function bloog_lite_plugin_installer_callback(){

				if ( ! current_user_can('install_plugins') )
					wp_die( __( 'Sorry, you are not allowed to install plugins on this site.', 'bloog-lite' ) );

				$nonce = $_POST["nonce"];
				$plugin = $_POST["plugin"];
				$plugin_file = $_POST["plugin_file"];

				// Check our nonce, if they don't match then bounce!
				if (! wp_verify_nonce( $nonce, 'bloog_lite_plugin_installer_nonce' ))
					wp_die( __( 'Error - unable to verify nonce, please try again.', 'bloog-lite') );


         		// Include required libs for installation
				require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
				require_once ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
				require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';

				// Get Plugin Info
				$api = $this->bloog_lite_call_plugin_api($plugin);

				$skin     = new WP_Ajax_Upgrader_Skin();
				$upgrader = new Plugin_Upgrader( $skin );
				$upgrader->install($api->download_link);

				$plugin_file = ABSPATH . 'wp-content/plugins/'.esc_html($plugin).'/'.esc_html($plugin_file);

				if($api->name) {
					$main_plugin_file = $this->get_plugin_file($plugin);
					if($main_plugin_file){
						activate_plugin($main_plugin_file);
						echo "success";
						die();
					}
				}
				echo "fail";

				die();
			}

			/** Plugin Offline Installation Ajax **/
			public function bloog_lite_plugin_offline_installer_callback() {


				$file_location = $_POST['file_location'];
				$file = $_POST['file'];
				$github = $_POST['github'];
				$slug = $_POST['slug'];
				$plugin_directory = ABSPATH . 'wp-content/plugins/';

				$zip = new ZipArchive;
				if ($zip->open(esc_html($file_location), ZIPARCHIVE::CREATE) === TRUE) {

					$zip->extractTo($plugin_directory);
					$zip->close();

					if($github) {
						rename(realpath($plugin_directory).'/'.$slug.'-master', realpath($plugin_directory).'/'.$slug);
					}

					activate_plugin($file);
					echo "success";
					die();
				} else {
					echo 'failed';
				}

				die();
			}

			/** Plugin Offline Activation Ajax **/
			public function bloog_lite_plugin_offline_activation_callback() {

				$plugin = $_POST['plugin'];
				$plugin_file = ABSPATH . 'wp-content/plugins/'.esc_html($plugin).'/'.esc_html($plugin).'.php';

				if(file_exists($plugin_file)) {
					activate_plugin($plugin_file);
				} else {
					echo "Plugin Doesn't Exists";
				}

				die();

			}

			/** Plugin Activation Ajax **/
			public function bloog_lite_plugin_activation_callback(){

				if ( ! current_user_can('install_plugins') )
					wp_die( __( 'Sorry, you are not allowed to activate plugins on this site.', 'bloog-lite' ) );

				$nonce = $_POST["nonce"];
				$plugin = $_POST["plugin"];

				// Check our nonce, if they don't match then bounce!
				if (! wp_verify_nonce( $nonce, 'bloog_lite_plugin_activate_nonce' ))
					die( __( 'Error - unable to verify nonce, please try again.', 'bloog-lite' ) );


	         	// Include required libs for activation
				require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
				require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
				require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';


				// Get Plugin Info
				$api = $this->bloog_lite_call_plugin_api(esc_attr($plugin));


				if($api->name){
					$main_plugin_file = $this->get_plugin_file(esc_attr($plugin));
					$status = 'success';
					if($main_plugin_file){
						activate_plugin($main_plugin_file);
						$msg = $api->name .' successfully activated.';
					}
				} else {
					$status = 'failed';
					$msg = esc_html__('There was an error activating $api->name', 'bloog-lite');
				}

				$json = array(
					'status' => $status,
					'msg' => $msg,
					);

				wp_send_json($json);

			}
		}
		new Bloog_Lite_About_Theme();

		/** Initializing Demo Importer if exists **/
		if(class_exists('Instant_Demo_Importer')) :
			$demoimporter = new Instant_Demo_Importer();

		$demoimporter->demos = array(
			'bloog-lite' => array(
				'title' => __('Bloog Lite Demo', 'bloog-lite'),
				'name' => 'bloog-lite',
				'screenshot' => get_template_directory_uri().'/screenshot.png',
				'home_page' => 'home-page',
				'menus' => array(
					'Menu 1' => 'primary'
					)
				),
			);

		$demoimporter->demo_dir = get_template_directory().'/inc/admin-panel/demo/'; // Path to the directory containing demo files
		$demoimporter->options_replace_url = ''; // Set the url to be replaced with current siteurl
		$demoimporter->option_name = ''; // Set the the name of the option if the theme is based on theme option
		endif;