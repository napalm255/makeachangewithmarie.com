<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;


/**
 * woocommerce_before_single_product hook
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );


if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class('cmsms_single_product'); ?>>
	<div class="cmsms_product_left_column">
	<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>
	</div>
	<div class="summary entry-summary cmsms_product_right_column">
	<?php 
		woocommerce_template_single_title();
		
		cmsms_woocommerce_rating('cmsms-icon-star-empty', 'cmsms-icon-star-1');
		
		woocommerce_template_single_price();
		
		woocommerce_template_single_excerpt();
		
		woocommerce_template_single_add_to_cart();
		
		woocommerce_template_single_meta();
		
		woocommerce_template_single_sharing();
	?>
	</div>
	<div class="cl"></div>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>

