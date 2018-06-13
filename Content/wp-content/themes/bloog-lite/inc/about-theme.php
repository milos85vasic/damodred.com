<?php
/**
* About Theme
*/
class Bloog_Lite_About_Theme {
	public function __construct() {
		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'bloog_lite_welcome_register_menu' ) );
		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'bloog_lite_activation_admin_notice' ) );
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
					<li><a href="<?php echo esc_url( admin_url( 'themes.php?page=bloog-lite-about&tab=support' ) ); ?>"
						class="bloog-lite-tab <?php echo $active_tab == 'support' ? 'bloog-lite-tab-active' : ''; ?> "><?php echo esc_html__( 'Support', 'bloog-lite' ); ?>

					</a></li>
					<li><a href="<?php echo esc_url( admin_url( 'themes.php?page=bloog-lite-about&tab=changelog' ) ); ?>"
						class="bloog-lite-tab <?php echo $active_tab == 'changelog' ? 'bloog-lite-tab-active' : ''; ?> "><?php echo esc_html__( 'Changelog', 'bloog-lite' ); ?>

					</a></li>
					<li><a target="_blank" href="<?php echo esc_url('https://wpall.club/'); ?>"
						class="bloog-lite-tab more-wp"><?php echo esc_html__( 'WordPress Resources', 'bloog-lite' ); ?>

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
		if ( file_exists( ABSPATH . 'wp-content/plugins/' . $slug . '/' . $slug . '.php' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			$needs = is_plugin_active( $slug . '/' . $slug . '.php' ) ? 'deactivate' : 'activate';

			return array( 'status' => is_plugin_active( $slug . '/' . $slug . '.php' ), 'needs' => $needs );
		}

		return array( 'status' => false, 'needs' => 'install' );
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

	public function create_action_link( $state, $slug ) {
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
				'plugin'        => rawurlencode( $slug . '/' . $slug . '.php' ),
				'plugin_status' => 'all',
				'paged'         => '1',
				'_wpnonce'      => wp_create_nonce( 'deactivate-plugin_' . $slug . '/' . $slug . '.php' ),
				), network_admin_url( 'plugins.php' ) );
			break;
			case 'activate':
			return add_query_arg( array(
				'action'        => 'activate',
				'plugin'        => rawurlencode( $slug . '/' . $slug . '.php' ),
				'plugin_status' => 'all',
				'paged'         => '1',
				'_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $slug . '/' . $slug . '.php' ),
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
	}
	new Bloog_Lite_About_Theme();