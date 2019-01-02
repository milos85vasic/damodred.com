<?php
/**
 * Welcome Page Class
 *
 * @package Kale
 */
if ( ! class_exists( 'Kale_Welcome_Page' ) ) {

	/**
	 * Singleton class used for generating Welcome page for the theme.
	 */
	class Kale_Welcome_Page {
		/**
		 * Used for loading the texts and setup the actions inside the page.
		 *
		 * @var array $config The configuration array for the theme used.
		 */
		private $config;
		/**
		 * Get the theme name using wp_get_theme.
		 *
		 * @var string $theme_name The theme name.
		 */
		private $theme_name;
		/**
		 * Get the theme slug (theme folder name).
		 *
		 * @var string $theme_slug The theme slug.
		 */
		private $theme_slug;
		/**
		 * The current theme object.
		 *
		 * @var WP_Theme $theme The current theme.
		 */
		private $theme;
		/**
		 * Theme version.
		 *
		 * @var string $theme_version The theme version.
		 */
		private $theme_version;
		/**
		 * Menu item label.
		 *
		 * @var string $menu_label Appearance submenu item label.
		 */
		private $menu_label;
		/**
		 * Page title.
		 *
		 * @var string $page_title The title of the Welcome page.
		 */
		private $page_title;
		/**
		 * Tabs.
		 *
		 * @var array $tabs Array of tabs slugs and titles.
		 */
		private $tabs;
		/**
		 * Define the html notification content displayed upon activation.
		 *
		 * @var string $notification The html notification content.
		 */
		private $notification;
		/**
		 * The single instance of Kale_Welcome_Page
		 *
		 * @var Kale_Welcome_Page $instance The  Kale_Welcome_Page instance.
		 */
		private static $instance;

		/**
		 * The Main Kale_Welcome_Page instance.
		 *
		 * Make sure that only one instance of
		 * Kale_Welcome_Page exists at one time.
		 *
		 * @param array $config The configuration array.
		 */
		public static function init( $config ) {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Kale_Welcome_Page ) ) :
				self::$instance = new Kale_Welcome_Page;

				if ( ! empty( $config ) && is_array( $config ) ) :
					self::$instance->config = $config;
					self::$instance->setup_config();
					self::$instance->setup_actions();
				endif; // ! empty( $config ) && is_array( $config )
			endif; //! isset( self::$instance )
		}

		/**
		 * Setup the class props based on the config array.
		 */
		public function setup_config() {
			// Theme info.
			$theme = wp_get_theme();
			if ( is_child_theme() ) :
				$this->theme_name = $theme->parent()->get( 'Name' );
				$this->theme_uri  = $theme->parent()->get( 'ThemeURI' );
				$this->theme      = $theme->parent();
			else :
				$this->theme_name = $theme->get( 'Name' );
				$this->theme_uri  = $theme->get( 'ThemeURI' );
				$this->theme      = $theme->parent();
			endif; // is_child_theme()
			$this->theme_version = $theme->get( 'Version' );
			$this->theme_slug    = $theme->get_template();

			// More theme info.
			$this->theme_pro_uri  = 'https://www.lyrathemes.com/kale-pro/';
			$this->theme_demo_uri = 'http://www.lyrathemes.com/preview/?theme=kale';

			// Welcome page info.
			$this->default_title = sprintf( esc_html__( 'About %', 'kale' ), $this->theme_name );
			$this->menu_label = isset( $this->config['menu_label'] ) ? $this->config['menu_label'] : $this->default_title;
			$this->page_title = isset( $this->config['page_title'] ) ? $this->config['page_title'] : $this->default_title;
			$this->welcome_title = isset( $this->config['welcome_title'] ) ? $this->config['welcome_title'] : sprintf( esc_html__( 'Welcome to %', 'kale' ), $this->theme_name );
			$this->welcome_content = isset( $this->config['welcome_content'] ) ? $this->config['welcome_content'] : $theme->get( 'Description' );

			// Notification content.
			$this->notification_welcome = sprintf( esc_html__( 'Welcome! Thank you for choosing %s! ', 'kale' ), $this->theme_name );
			$this->notification_welcome .= esc_html__( 'To fully take advantage of the best our theme can offer please make sure you visit our ', 'kale' );
			$this->notification_welcome .= '<a href="' . esc_url( admin_url( 'themes.php?page=' . $this->theme_slug . '-welcome' ) ) . '">' . esc_html__( 'welcome page', 'kale' ) . '</a>!';
			$this->notification_get_started = '<a href="' . esc_url( admin_url( 'themes.php?page=' . $this->theme_slug . '-welcome' ) ) . '" class="button" style="text-decoration: none;">' . sprintf( esc_html__( 'Get started with %s', 'kale' ), $this->theme_name ) . '</a>';

			// Notification on theme activation.
			$this->notification  = isset( $this->config['notification'] ) ? $this->config['notification'] : ( '<p>' . $this->notification_welcome . '</p><p>' . $this->notification_get_started . '</p>' );

			// Tabs.
			$this->tabs = isset( $this->config['tabs'] ) ? $this->config['tabs'] : array();
		}

		/**
		 * Hooks used for Welcome page.
		 */
		public function setup_actions() {
			/* Register Welcome page - add_theme_page. */
			add_action( 'admin_menu', array( $this, 'register_welcome_page' ) );
			/* Activation notice. */
			add_action( 'load-themes.php', array( $this, 'theme_activation_admin_notice' ) );
			/* Enqueue scripts and styles for Welcome page. */
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_style_and_scripts' ) );
		}

		/**
		 * Register the menu page under Appearance menu.
		 */
		function register_welcome_page() {
			if ( ! empty( $this->menu_label ) && ! empty( $this->page_title ) ) :
				add_theme_page(
					$this->menu_label,
					$this->page_title,
					'edit_theme_options',
					$this->theme_slug . '-welcome',
					array( $this, 'welcome_page_render' )
				);
			endif;
		}

		/**
		 * Adds an admin notice upon successful activation.
		 */
		public function theme_activation_admin_notice() {
			global $pagenow;
			if ( is_admin() && ( 'themes.php' == $pagenow ) && isset( $_GET['activated'] ) ) :
				add_action( 'admin_notices', array( $this, 'kale_welcome_page_admin_notice' ), 99 );
			endif;
		}

		/**
		 * Display an admin notice linking to the about page
		 */
		public function kale_welcome_page_admin_notice() {
			if ( ! empty( $this->notification ) ) :
				echo '<div class="updated notice is-dismissible">';
				echo wp_kses_post( $this->notification );
				echo '</div>';
			endif;
		}

		/**
		 * Helper function for adding 'target'
		 * attribute to external links.
		 *
		 * @param  bool $bool   Whether link is external or not.
		 *
		 * @return string       Returns 'target' attribute or empty string.
		 */
		public function new_tab( $bool ) {
			if ( $bool ) :
				$attr = 'target="_blank"';
			else :
				$attr = '';
			endif;

			return $attr;
		}

		/**
		 * Render the main content page.
		 */
		public function welcome_page_render() {
			if ( ! empty( $this->welcome_title ) || ! empty( $this->welcome_content ) || ! empty( $this->tabs ) ) :
				$output = '<div class="wrap welcome-wrap">';
					// Page title.
					$output .= '<h1>';
						$output .= esc_html( $this->welcome_title );
						if ( ! empty( $this->theme_version ) ) :
							$output .= esc_html( $this->theme_version );
						endif; // ! empty( $this->theme_version )
					$output .= '</h1>';
					// Page intro.
					$output .= '<div class="welcome-intro">';
						$output .= '<a href="https://lyrathemes.com/" target="_blank" class="welcome-screenshot"><img src="' . get_template_directory_uri() . '/screenshot.png" ></a>';

						if ( ! empty( $this->welcome_content ) ) :
							$output .= '<p class="welcome-description">';
							$output .= wp_kses_post( $this->welcome_content );
							$output .= '<br /><br /><a class="button button-primary button-large" href="' . esc_url( $this->theme_uri ) . '" target="_blank"> ' . esc_html__( 'More Details', 'kale' ) . '</a>';
							$output .= '&nbsp;&nbsp;<a class="button button-primary button-large" href="' . esc_url( $this->theme_demo_uri ) . '" target="_blank"> ' . esc_html__( 'View Demo', 'kale' ) . '</a>';
							$output .= '&nbsp;&nbsp;<a class="button button-primary button-large" href="' . esc_url( $this->theme_pro_uri ) . '" target="_blank">&raquo; ' . esc_html__( 'Pro Version', 'kale' ) . ' &laquo;</a>';
							$output .= '</p>';
						endif; // ! empty( $this->welcome_content )
					$output .= '</div><!-- welcome-intro -->';

					// Tabs.
					if ( ! empty( $this->tabs ) ) :
						$active_tab = isset( $_GET['tab'] ) ? wp_unslash( $_GET['tab'] ) : 'getting_started';
						// Tabs navigation
						$output .= '<h2 class="nav-tab-wrapper wp-clearfix">';

						foreach ( $this->tabs as $key => $value ) :
							$output .= '<a href="' . esc_url( admin_url( 'themes.php?page=' . $this->theme_slug . '-welcome' ) ) . '&tab=' . $key . '" class="nav-tab ' . ( $active_tab == $key ? 'nav-tab-active' : '' ) . '" role="tab" data-toggle="tab">';
							$output .= esc_html( $value );
							$output .= '</a>';
						endforeach; // $this->tabs as $key => $value

						$output .= '</h2>';

						// Tabs content
						if ( method_exists( $this, $active_tab ) ) :
							$output .= $this->$active_tab();
						endif; // method_exists( $this, $active_tab )
					endif; // ! empty( $this->tabs )

				$output .= '</div><!-- wrap -->';

				echo $output;
			endif; // ! empty( $this->welcome_title ) || ! empty( $this->welcome_content ) || ! empty( $this->tabs )
		}

		/**
		 * Getting started tab
		 */
		public function getting_started() {
			$output = '';
			$tab_content = $this->config['getting_started'];

			if ( is_array( $tab_content ) && ! empty( $tab_content ) ) :
				$output = '<div class="welcome-section welcome-section-getting-started">';

				// Tab content
				if ( is_array( $tab_content['cards'] ) && ! empty( $tab_content['cards'] ) ) :
					$output .= '<div class="kale-welcome-cards">';

					foreach ( $tab_content['cards'] as $card ) :
						$output .= '<div class="kale-welcome-card">';
						if ( $card['title'] ) :
							$output .= '<h3>' .  $card['title']  . '</h3>';
						endif;
						if ( $card['description'] ) :
							$output .= '<p>' .  $card['description']  . '</p>';
						endif;
						if ( $card['btn_label'] && $card['btn_url'] ) :
							$output .= '<a href="' .  $card['btn_url']  . '" class="button button-primary button-large" ' . $this->new_tab( $card['new_tab'] ) . '>' . $card['btn_label'] . '</a>';
						endif;
						$output .= '</div><!-- kale-welcome-card -->';
					endforeach;

					$output .= '</div><!-- kale-welcome-cards -->';
				endif; // is_array( $tab_content['cards'] ) && ! empty( $tab_content['cards'] )

				$output .= '</div><!-- welcome-section -->';
			endif; // is_array( $tab_content ) && ! empty( $tab_content )

			return $output;
		}

		/**
		 * Support tab
		 */
		public function support() {
			$output = '';
			$tab_content = $this->config['support'];

			if ( is_array( $tab_content ) && ! empty( $tab_content ) ) :
				$output = '<div class="welcome-section welcome-section-support">';

				// Tab content
				if ( is_array( $tab_content['cards'] ) && ! empty( $tab_content['cards'] ) ) :
					$output .= '<div class="kale-welcome-cards">';

					foreach ( $tab_content['cards'] as $card ) :
						$output .= '<div class="kale-welcome-card">';
						if ( $card['title'] ) :
							$output .= '<h3>' .  $card['title']  . '</h3>';
						endif;
						if ( $card['description'] ) :
							$output .= '<p>' .  $card['description']  . '</p>';
						endif;
						if ( $card['btn_label'] && $card['btn_url'] ) :
							$output .= '<a href="' .  $card['btn_url']  . '" class="button button-primary button-large" ' . $this->new_tab( $card['new_tab'] ) . '>' . $card['btn_label'] . '</a>';
						endif;
						$output .= '</div><!-- kale-welcome-card -->';
					endforeach;

					$output .= '</div><!-- kale-welcome-cards -->';
				endif; // is_array( $tab_content['cards'] ) && ! empty( $tab_content['cards'] )

				$output .= '</div><!-- welcome-section -->';
			endif; // is_array( $tab_content ) && ! empty( $tab_content )

			return $output;
		}

		/**
		 * Recommended Plugins tab
		 */
		public function recommended() {
			$output = '';
			$tab_content = $this->config['recommended'];

			if ( is_array( $tab_content ) && ! empty( $tab_content ) ) :
				$output = '<div class="welcome-section welcome-section-recommended">';

				// Tab content
				if ( is_array( $tab_content['cards'] ) && ! empty( $tab_content['cards'] ) ) :
					$output .= '<div class="kale-welcome-cards">';

					foreach ( $tab_content['cards'] as $card ) :
						$output .= '<div class="kale-welcome-card">';
						if ( $card['title'] ) :
							$output .= '<h3>' .  $card['title']  . '</h3>';
						endif;
						if ( $card['description'] ) :
							$output .= '<p>' .  $card['description']  . '</p>';
						endif;
						if ( $card['btn_label'] && $card['btn_url'] ) :
							$output .= '<a href="' .  $card['btn_url']  . '" class="button button-primary button-large" ' . $this->new_tab( $card['new_tab'] ) . '>' . $card['btn_label'] . '</a>';
						endif;
						$output .= '</div><!-- kale-welcome-card -->';
					endforeach;

					$output .= '</div><!-- kale-welcome-cards -->';
				endif; // is_array( $tab_content['cards'] ) && ! empty( $tab_content['cards'] )

				$output .= '</div><!-- welcome-section -->';
			endif; // is_array( $tab_content ) && ! empty( $tab_content )

			return $output;
		}

		/**
		 * Free vs Pro tab
		 */
		public function free_vs_pro() {
			$output = '';
			$tab_content = $this->config['free_vs_pro'];

			if ( is_array( $tab_content ) && ! empty( $tab_content ) ) :
				$output = '<div class="welcome-section welcome-section-free-vs-pro">';

					if ( $tab_content['pro'] && $tab_content['pro_url'] ) :
						$output .= '<a href="' . $tab_content['pro_url'] . '" class="button button-primary button-large" target="_blank">' . sprintf( esc_html__( 'Upgrade to %s', 'kale' ), $tab_content['pro'] ) . '</a>';
						$output .= '&nbsp;&nbsp;<a href="' . $tab_content['compare_url'] . '" class="button button-primary button-large" target="_blank">' . esc_html__( 'Review Full Comparison', 'kale' ) . '</a>';
					endif;

					$output .= '<div class="kale-features-table">';

					if ( $tab_content['free'] || $tab_content['pro'] ) :
						$output .= '<div class="kale-feature-item kale-feature-item-heading"><strong>' . esc_html__( 'Features', 'kale' ) . '</strong></div>';
						if ( $tab_content['free'] ) :
							$output .= '<div class="kale-feature-item-is kale-feature-item-heading"><strong>' . $tab_content['free'] . '</strong></div>';
						endif;
						if ( $tab_content['pro'] ) :
							$output .= '<div class="kale-feature-item-is kale-feature-item-heading"><strong>' . $tab_content['pro'] . '</strong></div>';
						endif;
					endif;

					/**
					 * Get features list
					 */
					$feature_list = $tab_content['features_list'];
					$feature_free = $tab_content['features_free'];
					$feature_pro  = $tab_content['features_pro'];
					$values       = array( $feature_list, $feature_free, $feature_pro );
					// Get keys to be used as indexes for our new array.
					$keys = array_keys( $feature_list );
					$result = array();
					// Set new multidimensional array
					foreach ( $keys as $index => $key ) :
						$feature = array();
						/**
						 * Run through each feature and add
						 * free and pro bool to its array
						 */
						foreach ( $values as $value ) :
							$feature[] = $value[$index];
						endforeach; // $values as $value
						/**
						 * Get each feature array and add it to
						 * our new multidimensional array.
						 */
						$result[$key] = $feature;
					endforeach; // $keys as $index => $key

					if ( ! empty( $result ) ) :
						foreach ( $result as $feature ) :
							if ( $feature[0] ) :
								$output .= '<div class="kale-feature-item"><strong>' . $feature[0] . '</strong></div>';
							endif;
							if ( $feature[1] ) :
								$output .= '<div class="kale-feature-item-is"><span class="dashicons dashicons-yes"></span></div>';
							else :
								$output .= '<div class="kale-feature-item-is"><span class="dashicons dashicons-no-alt"></span></div>';
							endif;
							if ( $feature[2] ) :
								$output .= '<div class="kale-feature-item-is"><span class="dashicons dashicons-yes"></span></div>';
							else :
								$output .= '<div class="kale-feature-item-is"><span class="dashicons dashicons-no-alt"></span></div>';
							endif;
						endforeach;
					endif;

					$output .= '</div><!-- kale-features-table -->';

					if ( $tab_content['pro'] && $tab_content['pro_url'] ) :
						$output .= '<a href="' . $tab_content['pro_url'] . '" class="button button-primary button-large" target="_blank">' . sprintf( esc_html__( 'Upgrade to %s', 'kale' ), $tab_content['pro'] ) . '</a>';
						$output .= '&nbsp;&nbsp;<a href="' . $tab_content['compare_url'] . '" class="button button-primary button-large" target="_blank">' . esc_html__( 'Review Full Comparison', 'kale' ) . '</a>';
					endif;

				$output .= '</div><!-- welcome-section -->';
			endif; // is_array( $tab_content ) && ! empty( $tab_content )

			return $output;
		}

		/**
		 * Load css and scripts for the about page
		 */
		public function enqueue_style_and_scripts( $hook_suffix ) {
			wp_enqueue_style( 'welcome-page-css', get_template_directory_uri() . '/welcome-page/css/welcome-page.css', array(), $this->theme_version );
		}
	}
}
