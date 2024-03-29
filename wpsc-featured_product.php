<?php
global $post;

$image_width = sp_get_theme_init_setting('wpec_featured_product_image_size','width');
$image_height = sp_get_theme_init_setting('wpec_featured_product_image_size','height');

if (sp_isset_option( 'product_sidebar', 'boolean', 'true' )) {
	$has_sidebar = 'has_sidebar';
	$image_height = $image_height - 40;
	$image_width = $image_width - 185;
} else {
	$has_sidebar = '';
} 

foreach ( $query as $product ) :
	setup_postdata( $product );
	
	$old_post = $post;
	$post = $product;
	
?>
        <div class="featured_product_display group <?php echo $has_sidebar; ?>">
        		<?php $image_src = sp_get_image(wpsc_the_product_id()); ?>
 				<?php if ( wpsc_the_product_thumbnail ( ) && $image_src ) : ?>
                 <div class="featured_item_image">
                    
                    <?php echo get_the_post_thumbnail( $post->ID, array($image_width,$image_height), array( 'class' => 'product_image', 'id' => 'product_image_'.wpsc_the_product_id()  ) ); ?>
                </div>
				<?php else: ?>
                <div class="featured_item_image">
                    <img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" src="<?php echo sget_template_directory_uri().'/images/no-product-image.jpg'; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" />
                </div>
				<?php endif; ?>
              
                <div class="item_text group">
                    <h2><a href='<?php echo get_permalink( $product->ID ); ?>'><?php echo get_the_title( $product->ID ); ?></a></h2>

                    <div class='wpsc_description'>
                        <?php 
						echo sp_truncate(sp_wpsc_the_product_description(),sp_isset_option( 'product_page_featured_product_characters', 'value' ), sp_isset_option( 'product_page_featured_product_denote', 'value' ), true, true);
						?> 
                    </div>
                      <div class="pricedisplay featured_product_price">
						<?php echo sp_wpsc_the_product_price(false,$product->ID); ?>
                      </div><!--close pricedisplay-->
                    
       				<a href="<?php echo get_permalink( $product->ID ); ?>" title="<?php _e('More Details','sp'); ?>" class="more"><span><?php _e('More Details','sp'); ?></span></a>
                </div>
                <span class="featured-ribbon">&nbsp;</span>
        </div><!--close featured_product_display-->
    
<?php endforeach; 
$post = $old_post;
?>