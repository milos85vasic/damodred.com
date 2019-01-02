<?php
/**
* The template for displaying the footer
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package GalleryWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

</div><!--/#gallerywp-content-wrapper -->
</div><!--/#gallerywp-wrapper -->

<?php if ( !(gallerywp_get_option('hide_footer_widgets')) ) { ?>
<?php if ( is_active_sidebar( 'gallerywp-footer-1' ) || is_active_sidebar( 'gallerywp-footer-2' ) || is_active_sidebar( 'gallerywp-footer-3' ) || is_active_sidebar( 'gallerywp-footer-4' ) ) : ?>
<div class='clearfix' id='gallerywp-footer-blocks' itemscope='itemscope' itemtype='http://schema.org/WPFooter' role='contentinfo'>
<div class='gallerywp-container clearfix'>

<div class='gallerywp-footer-block-1'>
<?php dynamic_sidebar( 'gallerywp-footer-1' ); ?>
</div>

<div class='gallerywp-footer-block-2'>
<?php dynamic_sidebar( 'gallerywp-footer-2' ); ?>
</div>

<div class='gallerywp-footer-block-3'>
<?php dynamic_sidebar( 'gallerywp-footer-3' ); ?>
</div>

<div class='gallerywp-footer-block-4'>
<?php dynamic_sidebar( 'gallerywp-footer-4' ); ?>
</div>

</div>
</div><!--/#gallerywp-footer-blocks-->
<?php endif; ?>
<?php } ?>


<div class='clearfix' id='gallerywp-footer'>
<div class='gallerywp-foot-wrap gallerywp-container'>
<?php if ( gallerywp_get_option('footer_text') ) : ?>
  <p class='gallerywp-copyright'><?php echo esc_html(gallerywp_get_option('footer_text')); ?></p>
<?php else : ?>
  <p class='gallerywp-copyright'><?php /* translators: %s: Year and site name. */ printf( esc_html__( 'Copyright &copy; %s', 'gallerywp' ), esc_html(date_i18n(__('Y','gallerywp'))) . ' ' . esc_html(get_bloginfo( 'name' ))  ); ?></p>
<?php endif; ?>
<p class='gallerywp-credit'><a href="<?php echo esc_url( 'https://themesdna.com/' ); ?>"><?php /* translators: %s: Theme author. */ printf( esc_html__( 'Design by %s', 'gallerywp' ), 'ThemesDNA.com' ); ?></a></p>
</div>
</div><!--/#gallerywp-footer -->

</div>
</div>

<?php wp_footer(); ?>
</body>
</html>