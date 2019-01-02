<?php
/**
 * @package Blogg
 * @subpackage Admin
 */
if ( ! class_exists( 'blogg_info_page' ) ) {
	/**
	 * Singleton class used for generating the about page of the theme.
	 */
	class blogg_info_page {
		/**
		 * Define the version of the class.
		 * @var string $version The blogg_info_page class version.
		 */
		private $version = '1.0.0';
		/**
		 * Used for loading the texts and setup the actions inside the page.
		 * @var array $config The configuration array for the theme used.
		 */
		private $config;
		/**
		 * Get the theme name using wp_get_theme.
		 * @var string $theme_name The theme name.
		 */
		private $theme_name;
		/**
		 * Get the theme slug ( theme folder name ).
		 * @var string $theme_slug The theme slug.
		 */
		private $theme_slug;
		/**
		 * The current theme object.
		 * @var WP_Theme $theme The current theme.
		 */
		private $theme;
		/**
		 * Holds the theme version.
		 * @var string $theme_version The theme version.
		 */
		private $theme_version;
		/**
		 * Define the menu item name for the page.
		 * @var string $menu_name The name of the menu name under Appearance settings.
		 */
		private $menu_name;
		/**
		 * Define the page title name.
		 * @var string $page_name The title of the About page.
		 */
		private $page_name;
		/**
		 * Define the page tabs.
		 * @var array $tabs The page tabs.
		 */
		private $tabs;
		/**
		 * Define the html notification content displayed upon activation.
		 * @var string $notification The html notification content.
		 */
		private $notification;
		/**
		 * The single instance of blogg_info_page
		 * @var blogg_info_page $instance The  blogg_info_page instance.
		 */
		private static $instance;

		/**
		 * The Main blogg_info_page instance.
		 * We make sure that only one instance of blogg_info_page exists in the memory at one time.
		 * @param array $config The configuration array.
		 */
		public static function init( $config ) {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof blogg_info_page ) ) {
				self::$instance = new blogg_info_page;
				if ( ! empty( $config ) && is_array( $config ) ) {
					self::$instance->config = $config;
					self::$instance->setup_config();
					self::$instance->setup_actions();
				}
			}

		}

		
		/**
		 * Setup the class props based on the config array.
		 */
		public function setup_config() {
			$theme = wp_get_theme();
			if ( is_child_theme() ) {
				$this->theme_name = $theme->parent()->get( 'Name' );
				$this->theme = $theme->parent();
			} else {
				$this->theme_name = $theme->get( 'Name' );
				$this->theme = $theme->parent();
			}
			$this->theme_version = $theme->get( 'Version' );
			$this->theme_slug = $theme->get_template();
			$this->menu_name = isset( $this->config['menu_name'] ) ? $this->config['menu_name'] : 'About ' . $this->theme_name;
			$this->page_name = isset( $this->config['page_name'] ) ? $this->config['page_name'] : 'About ' . $this->theme_name;
			$this->notification = isset( $this->config['notification'] ) ? $this->config['notification'] : ( '<p>' . sprintf( 'Welcome! Thank you for choosing %1$s! To get started please make sure you visit our %2$s<strong>welcome page</strong>%3$s.', $this->theme_name, '<a href="' . esc_url( admin_url( 'themes.php?page=blogg-welcome' ) ) . '">', '</a>' ) . '</p><p><a href="' . esc_url( admin_url( 'themes.php?page=blogg-welcome' ) ) . '" class="button button-primary" style="text-decoration: none;">' . sprintf( 'Get started with %s', $this->theme_name ) . '</a></p>' );
			$this->tabs  = isset( $this->config['tabs'] ) ? $this->config['tabs'] : array();

		}

		/**
		 * Setup the actions used for this page.
		 */
		public function setup_actions() {

			add_action( 'admin_menu', array( $this, 'register' ) );
			add_action( 'wp_loaded', array( $this, 'hide_notice' ) );

			/* activation notice */
			add_action( 'admin_notices', array( $this, 'activation_admin_notice' ) );
			/* enqueue script and style for about page */
			add_action( 'admin_enqueue_scripts', array( $this, 'style_and_scripts' ) );
		}

		/**
		 * Register the menu page under Appearance menu.
		 */
		function register() {
			if ( ! empty( $this->menu_name ) && ! empty( $this->page_name ) ) {
				add_theme_page( $this->menu_name, $this->page_name, 'activate_plugins', 'blogg-welcome', array(
					$this,
					'page_render',
				) );
			}
		}

		/**
		 * Adds an admin notice upon successful activation.
		 */
		public function activation_admin_notice() {
			global $pagenow;

			add_action( 'admin_notices', array( $this, 'welcome_admin_notice' ), 99 );
		}

		/**
		 * Display an admin notice linking to the about page
		 */
		public function welcome_admin_notice() {

			global $pagenow;

			if ( ! empty( $this->notification ) ) {

				// display notice if not previously dismissed
				if ( current_user_can( 'edit_theme_options' ) && !get_option( 'blogg_notice_welcome' ) && 'themes.php' == $pagenow ) {

					echo '<div class="blogg-info-about updated notice is-dismissible">';
					echo '<a class="notice-dismiss" href="' . esc_url(wp_nonce_url(remove_query_arg(array('activated'), add_query_arg('blogg-hide-notice', 'welcome')), 'blogg_hide_notices_nonce', '_blogg_notice_nonce')) . '" style="z-index: 0;padding: 10px;text-decoration: none;" >';
					echo '<span class="screen-reader-text">' . esc_html__('Dismiss this notice.', 'blogg'). '</span>';
					echo '</a>';
					echo wp_kses_post( $this->notification );
					echo '</div>';
				
				}
			}
		}

		/**
		 * Render the main content page.
		 */
		public function page_render() {

			if ( ! empty( $this->config['welcome_title'] ) ) {
				$welcome_title = $this->config['welcome_title'];
			}
			if ( ! empty( $this->config['welcome_content'] ) ) {
				$welcome_content = $this->config['welcome_content'];
			}

			if ( ! empty( $welcome_title ) || ! empty( $welcome_content ) || ! empty( $this->tabs ) ) {

				echo '<div class="wrap about-wrap epsilon-wrap">';

				if ( ! empty( $welcome_title ) ) {
					echo '<h1>';
					echo esc_html( $welcome_title );
					if ( ! empty( $this->theme_version ) ) {
						echo esc_html( $this->theme_version ) . ' </sup>';
					}
					echo '</h1>';
				}
				if ( ! empty( $welcome_content ) ) {
					echo '<div class="about-text">' . wp_kses_post( $welcome_content ) . '</div>';
				}


				/* Display tabs */
				if ( ! empty( $this->tabs ) ) {
					//$active_tab = isset( $_GET['tab'] ) ? wp_unslash( $_GET['tab'] ) : 'getting_started';
					$active_tab = isset( $_GET['tab'] ) ? sanitize_title(wp_unslash( $_GET['tab'] )) : 'getting_started';

					echo '<h2 class="nav-tab-wrapper wp-clearfix">';

					foreach ( $this->tabs as $tab_key => $tab_name ) {

						echo '<a href="' . esc_url( admin_url( 'themes.php?page=blogg-welcome' ) ) . '&tab=' . esc_attr( $tab_key ) . '" class="nav-tab ' . ( $active_tab == $tab_key ? 'nav-tab-active' : '' ) . '" role="tab" data-toggle="tab">';
						echo esc_html( $tab_name );
						echo '</a>';

					}

					echo '</h2>';

					/* Display content for current tab */
					if ( method_exists( $this, $active_tab ) ) {
						$this->$active_tab();
					}
				}

				echo '</div>';
			}
		}
		
		/**
		 * Changelog tab
		 */
		public function changelog() {
			$changelog = $this->parse_changelog();
			if ( ! empty( $changelog ) ) {
				echo '<div class="featured-section changelog">';
				foreach ( $changelog as $release ) {
					if ( ! empty( $release['title'] ) ) {
						echo '<h2>' . wp_kses_post( $release['title'] ) . ' </h2 > ';
					}
					if ( ! empty( $release['changes'] ) ) {
						echo implode( '<br/>', wp_kses_post( $release['changes'] ) );
					}
				}
				echo '</div><!-- .featured-section.changelog -->';
			}
		}

		/**
		 * Return the releases changes array.
		 * @return array The releases array.
		 */
		private function parse_changelog() {
			WP_Filesystem();
			global $wp_filesystem;
			$changelog = $wp_filesystem->get_contents( get_template_directory() . '/changelog.md' );
			if ( is_wp_error( $changelog ) ) {
				$changelog = '';
			}
			$changelog = explode( PHP_EOL, $changelog );
			$releases  = array();
			foreach ( $changelog as $changelog_line ) {
				if ( strpos( $changelog_line, '**Changes:**' ) !== false || empty( $changelog_line ) ) {
					continue;
				}
				if ( substr( $changelog_line, 0, 3 ) === '###' ) {
					if ( isset( $release ) ) {
						$releases[] = $release;
					}
					$release = array(
						'title'   => substr( $changelog_line, 3 ),
						'changes' => array(),
					);
				} else {
					$release['changes'][] = $changelog_line;
				}
			}

			return $releases;
		}
	
	
		/**
		 * Getting started tab
		 */
		public function getting_started() {

			if ( ! empty( $this->config['getting_started'] ) ) {

				$getting_started = $this->config['getting_started'];

				if ( ! empty( $getting_started ) ) {

					echo '<div id="blogg-getting-started" class="feature-section three-col">';

					foreach ( $getting_started as $getting_started_item ) {

						echo '<div class="col">';
						if ( ! empty( $getting_started_item['title'] ) ) {
							echo '<h3>' . esc_html( $getting_started_item['title'] ) . '</h3>';
						}
						if ( ! empty( $getting_started_item['text'] ) ) {
							echo '<p>' . esc_html( $getting_started_item['text'] ) . '</p>';
						}
						if ( ! empty( $getting_started_item['button_link'] ) && ! empty( $getting_started_item['button_label'] ) ) {

							echo '<p>';
							$button_class = '';
							if ( $getting_started_item['is_button'] ) {
								$button_class = 'button button-primary';
							}

                            $button_new_tab = '_self';
                            if ( isset( $getting_started_item['is_new_tab'] ) ) {
                                if ( $getting_started_item['is_new_tab'] ) {
                                    $button_new_tab = '_blank';
                                }
                            }

							echo '<a target="' . esc_attr( $button_new_tab ) . '" href="' . esc_url( $getting_started_item['button_link'] ) . '"class="' . esc_attr( $button_class ) . '">' . esc_html( $getting_started_item['button_label'] ) . '</a>';
							echo '</p>';
						}

						echo '</div>';
					}
					echo '</div>';
				}

			}
		}



		/**
		 * Support tab
		 */
		public function support_content() {
			echo '<div id="blogg-support-content" class="feature-section two-col">';

			if ( ! empty( $this->config['support_content'] ) ) {

				$support_steps = $this->config['support_content'];

				if ( ! empty( $support_steps ) ) {

					foreach ( $support_steps as $support_step ) {

						echo '<div class="col">';

						if ( ! empty( $support_step['title'] ) ) {
							echo '<h3>';
							if ( ! empty( $support_step['icon'] ) ) {
								echo '<i class="' . esc_attr( $support_step['icon'] ) . '"></i>';
							}
							echo esc_html( $support_step['title'] );
							echo '</h3>';
						}

						if ( ! empty( $support_step['text'] ) ) {
							echo '<p><i>' . esc_html( $support_step['text'] ) . '</i></p>';
						}

						if ( ! empty( $support_step['button_link'] ) && ! empty( $support_step['button_label'] ) ) {

							echo '<p>';
							$button_class = '';
							if ( $support_step['is_button'] ) {
								$button_class = 'button button-primary';
							}

							$button_new_tab = '_self';
							if ( isset( $support_step['is_new_tab'] ) ) {
								if ( $support_step['is_new_tab'] ) {
									$button_new_tab = '_blank';
								}
							}
							echo '<a target="' . esc_attr( $button_new_tab ) . '" href="' . esc_url( $support_step['button_link'] ) . '"class="' . esc_attr( $button_class ) . '">' . esc_html( $support_step['button_label'] ) . '</a>';
							echo '</p>';
						}

						echo '</div>';

					}

				}

			}

			echo '</div>';
		}

		
		/**
		 * Free vs PRO tab
		 */
		public function free_pro() {
			$free_pro = isset( $this->config['free_pro'] ) ? $this->config['free_pro'] : array();
			if ( ! empty( $free_pro ) ) {
				if ( ! empty( $free_pro['free_theme_name'] ) && ! empty( $free_pro['pro_theme_name'] ) && ! empty( $free_pro['features'] ) && is_array( $free_pro['features'] ) ) {
					echo '<div id="blogg-free-pro" class="feature-section">';
					echo '<div id="free_pro" class="">';
					echo '<table class="free-pro-table">';
					echo '<thead>';
					echo '<tr>';
					echo '<th></th>';
					echo '<th>' . esc_html( $free_pro['free_theme_name'] ) . '</th>';
					echo '<th>' . esc_html( $free_pro['pro_theme_name'] ) . '</th>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					foreach ( $free_pro['features'] as $feature ) {
						
						/* Hide feature is needed */
						if ( $feature['hidden'] == 'true' ) {
							$feature['hidden'] = ' class="hidden"';
						}

						echo '<tr' . esc_html($feature['hidden'] ) . '>';
						if ( ! empty( $feature['title'] ) || ! empty( $feature['description'] ) ) {
							echo '<td>';
							if ( ! empty( $feature['title'] ) ) {
								echo '<h3>' . wp_kses_post( $feature['title'] ) . '</h3>';
							}
							if ( ! empty( $feature['description'] ) ) {
								echo '<p>' . wp_kses_post( $feature['description'] ) . '</p>';
							}
							echo '</td>';
						}
						
						/* Add in for lite version */
						if ( ! empty( $feature['is_in_lite'] ) && ( $feature['is_in_lite'] == 'true' ) && empty( $feature['is_in_lite_text'] ) ) {
							echo '<td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>';
						} else if ( ! empty( $feature['is_in_lite_text'] ) ) {
							echo '<td class="only-lite"><span class="">' . esc_html($feature['is_in_lite_text'] ) . '</span></td>';
						} else {
							echo '<td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>';
						}

						/* Add in for pro version */
						if ( ! empty( $feature['is_in_pro'] ) && ( $feature['is_in_pro'] == 'true' ) && empty( $feature['is_in_pro_text'] ) ) {
							echo '<td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>';
						} else if ( ! empty( $feature['is_in_pro_text'] ) ) {
							echo '<td class="only-pro"><span class="">' . esc_html($feature['is_in_pro_text'] ) . '</span></td>';
						} else {
							echo '<td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>';
						}

						echo '</tr>';

					}
					if ( ! empty( $free_pro['pro_theme_link'] ) && ! empty( $free_pro['get_pro_theme_label'] ) ) {
						echo '<tr class="blogg-free-pro-button">';
						echo '<td></td>';
						echo '<td colspan="2"><a href="' . esc_url( $free_pro['pro_theme_link'] ) . '" target="_blank" class="button button-primary button-hero">' . wp_kses_post( $free_pro['get_pro_theme_label'] ) . '</a></td>';
						echo '</tr>';
					}
					echo '</tbody>';
					echo '</table>';
					echo '</div>';
					echo '</div>';

				}
			}
		}
		/**
		 * Load css and scripts for the about page
		 */
		public function style_and_scripts( $hook_suffix ) {

			global $pagenow;

			// enqueue css files
			if ( 'themes.php' === $pagenow || 'appearance_page_blogg-welcome' == $hook_suffix ) {
				wp_enqueue_style( 'blogg-about-page-css', get_template_directory_uri() . '/inc/theme-info/css/blogg-info-backend.css' );
			}

			// enqueue js files
			if ( 'appearance_page_blogg-welcome' == $hook_suffix ) {
				wp_enqueue_script( 'blogg-about-page-js', ( get_template_directory_uri() . '/inc/theme-info/js/blogg-info-backend.js' ), array( 'jquery' ), '', 'true' );
			}

		}

		/**
		 * Hide welcome notice when dismissed.
		 */
		public function hide_notice() {
			if (isset($_GET['blogg-hide-notice']) && isset($_GET['_blogg_notice_nonce'])) {
				if (!wp_verify_nonce($_GET['_blogg_notice_nonce'], 'blogg_hide_notices_nonce')) {
					wp_die(esc_html__('Action failed. Please refresh the page and retry.', 'blogg'));
				}
				if (!current_user_can('edit_theme_options')) {
					wp_die(esc_html__('You do not have the necessary permission to perform this action.', 'blogg'));
				}
				$hide_notice = sanitize_text_field( wp_unslash($_GET['blogg-hide-notice']));
				update_option('blogg_notice_' . $hide_notice, 1);
			}
		}

	}
}