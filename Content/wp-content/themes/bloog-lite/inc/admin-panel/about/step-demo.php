<div class="feature-section import-demo-data">
<div class="warning-msg"><?php echo __('Please install Recommended Plugins for demo to be imported completely.<br /> And Make sure you download demo in a fresh install. <br /> Your Old Data might be deleted.','bloog-lite');?></div>
<?php
wp_enqueue_style( 'plugin-install' );
wp_enqueue_script( 'plugin-install' );
wp_enqueue_script( 'updates' );
$req_plugins = $this->req_plugins;

foreach($req_plugins as $slug=>$plugin) :
	if($plugin['bundled'] == false) {
		?>
		<div class="action-tab warning">
			<h3><?php printf( esc_html__("Install : %s Plugin", 'bloog-lite'), $plugin['name'] ); ?></h3>
			<p><?php echo __('Please check the plugins folder inside theme and upload the zip of plugins from plugin uploader.','bloog-lite');?></p>
		</div>
		<?php
	} else {
		$github_repo = isset($plugin['github_repo']) ? $plugin['github_repo'] : false;
		$github = false;

		if($github_repo) {
			$plugin['location'] = $this->get_local_dir_path($plugin);
			$github = true;
		}

		$status = $this->check_active($plugin);
		
		switch($status['needs']) {
			case 'install' :
			$btn_class = 'install-offline button';
			$label = esc_html__('Install and Activate', 'bloog-lite');
			$link = $plugin['location'];
			break;

			case 'deactivate' :
			$btn_class = 'button';
			$label = esc_html__('Deactivate', 'bloog-lite');
			$link = admin_url('plugins.php');
			break;

			case 'activate' :
			$btn_class = 'activate-offline button button-primary';
			$label = esc_html__('Activate', 'bloog-lite');
			$link = $plugin['location'];
			break;
		}
		?>
		<?php if(!class_exists($plugin['class'])) : ?>
			<div class="action-tab warning">
				<h3><?php printf( esc_html__("Install : %s Plugin", 'bloog-lite'), $plugin['name'] ); ?></h3>
				<p><?php echo $plugin['info']; ?></p>

				<span class="plugin-card-<?php echo esc_attr($plugin['slug']); ?>" action_button>
					<a class="<?php echo esc_attr($btn_class); ?>" data-github="<?php echo $github; ?>" data-file='<?php echo esc_attr($plugin['slug']).'/'.esc_attr($plugin['filename']); ?>' data-slug="<?php echo esc_attr($plugin['slug']); ?>" href="<?php echo esc_html($link); ?>"><?php echo $label; ?></a>
				</span>
			</div>
		<?php endif; ?>
		<?php
	}

	endforeach;
	?>

	<?php do_action('instant_demo_importer'); ?>
</div>