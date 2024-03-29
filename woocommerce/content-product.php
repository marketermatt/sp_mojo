<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
 
global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) 
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) 
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibilty
if ( ! $product->is_visible() ) 
	return; 

// Increase loop count
$woocommerce_loop['loop']++;
?>
<li class="product product_grid_item <?php 
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 ) 
		echo 'last'; 
	elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 ) 
		echo 'first'; 
	?>">
    
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
        <?php if($product->is_on_sale() && sp_isset_option( 'saletag', 'boolean', 'true' ) ) : ?><span class="sale"><?php _e('Sale', 'sp'); ?></span><?php endif; ?>
			<div class="item_image">                    	
            <a title="<?php the_title(); ?>" href="<?php echo the_permalink(); ?>">
			<?php do_action( 'woocommerce_before_shop_loop_item_title', 'product_grid' );  ?>
            </a>
            
			<?php if (sp_isset_option( 'quickview', 'boolean', 'true' ) ) { ?>
            <span class="quickview-over"></span>
            <span class="quickview-button"><?php _e('UICKVIEW','sp'); ?></span>
            <?php } else { ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="quickview-over"></span></a>
            <?php } ?>
            <div class="inner-container">
                <div class="grid-meta-box">
                    <span class="grid-meta-box-arrow">&nbsp;</span>
                    <div class="meta-wrap">
                    <?php if(get_option('show_images_only') != 1): ?>
                    <h2 class="prodtitle"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>	
                    <div class="price_display">
                        <?php echo $product->get_price_html(); ?>
                    </div><!--close price_display-->	
                    <?php endif; ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="more-button"><span><?php _e('More Info','sp'); ?></span></a>             
                </div><!--close meta-wrap-->       
                </div><!--close grid-meta-box-->	
            </div><!--close inner-container-->                        
             
        <input type="hidden" value="<?php echo $post->ID; ?>" class="hidden-id product-id" />
	
    <?php //do_action('woocommerce_after_shop_loop_item_title'); ?> 
    </div><!--close item_image-->
</li>