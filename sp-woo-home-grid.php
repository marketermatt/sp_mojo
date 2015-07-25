<?php
global $woocommerce, $post;

if (sp_isset_option( 'homepage_featured_grid_cat', 'isset' ) && sp_isset_option( 'homepage_featured_grid_cat', 'value' ) != '') {
	$grid_cat = sp_isset_option( 'homepage_featured_grid_cat', 'value' );
	$grid_rand = sp_isset_option( 'homepage_featured_grid_random', 'value' );
	$product_count = sp_isset_option( 'homepage_featured_grid_product_count', 'value' );
	$products = sp_woo_get_products($grid_cat, $product_count, $grid_rand); // limit to 30 products
?>
<div id="grid_view_products_page_container_home">	
	<div class="product_grid_display group">
		<?php
			do_action('woocommerce_before_shop_loop');
			if ( is_object( $products ) && $products->have_posts() ) 
			{				
                // if less than 2.0
                if ( version_compare( WOOCOMMERCE_VERSION, '2.0', '<' ) ) {
                    $image_width = wc_get_image_size( 'shop_catalog_image_width' );
                    $image_height = wc_get_image_size( 'shop_catalog_image_height' );
                } else {                    
                    $catalog_sizes = wc_get_image_size( 'shop_catalog' );
                    $image_width = $catalog_sizes['width'];
                    $image_height = $catalog_sizes['height'];                    
                }
				$count = 1;

				while ( $products->have_posts() ) : $products->the_post(); 
                    // if 2.0+
                    if ( function_exists( 'get_product' ) ) 
                        $product = get_product( $post->ID );
                    else
                        $product = new WC_Product( $post->ID );
					if ( ! $product->is_visible() ) 
						continue; 
					
				?>

			<div class="product_grid_item product_view_<?php echo $post->ID; ?>">
                        <?php if($product->is_on_sale() && sp_isset_option( 'saletag', 'boolean', 'true' ) ) : ?><span class="sale"><?php _e('Sale', 'sp'); ?></span><?php endif; ?>
					<div class="item_image">                    	
						<?php if(has_post_thumbnail()) :?> 	   
						<a href="<?php the_permalink(); ?>">
						<?php echo get_the_post_thumbnail( $post->ID, array($image_width,$image_height), array( 'class' => 'product_image' ) ); ?>
						</a>
                        <?php if (sp_isset_option( 'quickview', 'boolean', 'true' ) ) { ?>
                        <span class="quickview-over"></span>
                        <span class="quickview-button"><?php _e('UICKVIEW','sp'); ?></span>
                        <?php } else { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="quickview-over"></span></a>
						<?php } ?>
                        <input type="hidden" value="<?php echo $post->ID; ?>" class="hidden-id" />
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
				<?php else: ?> 
						<a href="<?php the_permalink(); ?>">
						<img alt="<?php the_title(); ?>" title="<?php the_title(); ?>" src="<?php echo get_template_directory_uri().'/images/no-product-image.jpg'; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" />
						</a>
                        <?php if (sp_isset_option( 'quickview', 'boolean', 'true' ) ) { ?>
                        <span class="quickview-over"></span>
                        <span class="quickview-button"><?php _e('UICKVIEW','sp'); ?></span>
                        <?php } else { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="quickview-over"></span></a>
						<?php } ?>
                        <input type="hidden" value="<?php echo $post->ID; ?>" class="hidden-id" /> 
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
				<?php endif; ?> 	
					</div><!--close item_no_image-->
                					
			</div><!--close product_grid_item-->
	<?php
				endwhile;
			} // end have posts
			wp_reset_postdata();
	?>                    
	</div><!--close product_grid_display-->

        <!--BEGIN QUICKVIEW CONTAINER-->
        <?php if (sp_isset_option('quickview', 'boolean', 'true')) { ?>
        <div class="quickview_product_display group">
        <?php
        if ( is_object( $products ) && $products->have_posts()) : 
			while ( $products->have_posts() ) : $products->the_post(); 
                    // if 2.0+
                    if ( function_exists( 'get_product' ) ) 
                        $product = get_product( $post->ID );
                    else
                        $product = new WC_Product( $post->ID );
                    
				if ( ! $product->is_visible() ) 
					continue; 
            ?>                
            <div id="product-<?php echo $post->ID; ?>" class="product_item product product_view_<?php echo $post->ID; ?> group" style="display:none" itemtype="http://schema.org/Product" itemscope="">   
                            
                        <div class="imagecol images">
                            <div class="meta">
                                <h2 class="prodtitle entry-title"><?php the_title(); ?></h2>   
                            </div><!--close meta-->
                            <?php if(has_post_thumbnail()) :
                                $sizes = sp_quickview_image_size( sp_get_image($post->ID) );
                                $image_width = $sizes['image_width'];
                                $image_height = $sizes['image_height'];
                                ?>
                                <a data-rel="prettyPhoto[<?php echo $post->ID; ?>]" title="<?php the_title(); ?>" href="<?php echo sp_get_image($post->ID); ?>" class="zoom thickbox preview_link" onclick="return false;" data-id="<?php echo $post->ID; ?>">
                                               
                            <?php echo get_the_post_thumbnail( $post->ID, array($image_width,$image_height), array( 'class' => 'product_image' ) ); ?>
                                <?php if($product->is_on_sale() && sp_isset_option( 'saletag', 'boolean', 'true' ) ) : ?><span class="sale"><?php _e('Sale', 'sp'); ?></span><?php endif; ?>               
                                <img title="Loading" alt="Loading" src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" class="load loading-<?php echo $post->ID; ?>" />          
                                </a>
                            <?php else: 
                                $image_width = '347';
                                $image_height = '347';
                            ?>
                                <a data-rel="prettyPhoto[<?php echo $post->ID; ?>]" title="<?php the_title(); ?>" href="<?php echo get_template_directory_uri(); ?>/images/no-product-image.jpg" class="zoom thickbox preview_link" onclick="return false;" data-id="<?php echo $post->ID; ?>">
                                    <img class="no-image" alt="No Image" title="<?php the_title(); ?>" src="<?php echo get_template_directory_uri().'/images/no-product-image.jpg'; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" />
                                <?php if($product->is_on_sale() && sp_isset_option( 'saletag', 'boolean', 'true' ) ) : ?><span class="sale"><?php _e('Sale', 'sp'); ?></span><?php endif; ?>
                                <img title="Loading" alt="Loading" src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" class="load loading-<?php echo $post->ID; ?>" /> 
                                </a>
                            <?php endif; ?>
                            <?php	
								global $main_image_height; 
								$main_image_height = $image_height; 							
                                do_action('woocommerce_product_thumbnails');
                            ?>
                            
                        </div><!--close imagecol-->
                        <div class="productcol group">	
                            <div class="meta">		
                            <?php 
							if ( sp_isset_option( 'product_rating_stars', 'boolean', 'true' ) )
								echo sp_get_star_rating(); 
							?>			
                            <ul class="social group">
							<?php if (sp_isset_option( 'gplusone_button', 'boolean', 'true' )) : ?>
                            <li>
                            
                                  <?php if (sp_isset_option( 'gplusone_counter', 'value' ) == '' || ! sp_isset_option( 'gplusone_counter', 'isset' )) {
                                        $counter = 'false';	
                                    } else {
                                        $counter = 'true';	
                                    }
                                echo sp_gplusonebutton_shortcode(array('url' => 'post','size' => sp_isset_option( 'gplusone_size', 'value' ), 'count' => $counter)); ?>
                            </li>
                            <?php endif; ?>
                            <?php if (sp_isset_option('facebook_like_button', 'boolean', 'true')) : ?>
                            <li>                                                
                                <div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
                            </li>  
                            <?php endif; ?>                          
                            </ul>
                            </div><!--close meta-->
                            <div class="woo_description">
                                <?php echo the_content(); ?>
                            </div><!--close woo_description-->
                            <?php if ($product->get_price_html()) { ?>
                            <p class="price"><?php echo $product->get_price_html(); ?></p>
                            <?php } ?>
                            <?php 
                            switch($product->product_type) :
                                case 'simple' : 
                                    woocommerce_simple_add_to_cart();
                                break;
                                
                                case 'variable' :
                                    woocommerce_variable_add_to_cart();
                                break;
                                                            
                                case 'grouped' :
                                    woocommerce_grouped_add_to_cart();
                                break;
                                
                                case 'external' :
                                    woocommerce_external_add_to_cart();
                                break;
                            endswitch;
                            
                            ?>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="more"><?php _e('More Info', 'sp'); ?></a>
                    </div><!--close productcol-->
                <a href="#" title="<?php _e('Close','sp'); ?>" class="close"><?php _e('Close', 'sp'); ?></a>
            </div><!--close product_item-->        
        <?php endwhile; endif;
		wp_reset_postdata();
        ?>
        </div><!--close quickview_product_display-->
        <?php } ?>
    <input type="hidden" value="<?php echo sp_isset_option( 'quickview', 'value' ); ?>" class="quickview_enabled" />
    </div><!--close grid_view_products_page_container_home-->
<?php } // end grid category set ?>