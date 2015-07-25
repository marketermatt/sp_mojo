<?php 
/* Template Name: SP Home */
get_header(); 

if ( class_exists( 'WP_eCommerce' ) )
{
	if ( sp_isset_option( 'homepage_featured_enable', 'boolean', 'true' ) ) {
		if (sp_isset_option( 'homepage_featured_category', 'isset' ) && sp_isset_option( 'homepage_featured_category', 'value' ) != '') {
			$category = sp_isset_option( 'homepage_featured_category', 'value' );
			$rand = sp_isset_option( 'homepage_featured_random', 'value' );
			$item_count = sp_isset_option( 'homepage_featured_product_count', 'value' );
			$products = sp_wpec_get_products($category, $item_count, $rand); // limit to 30 products 	
?>
                    <div id="slider-wrapper" class="group">
                        <div id="home-slider">
                        	<!--start generating slide html-->
                        	<?php 
							$count = 0;
							$image_width = 574;
							$image_height = 410;
							
							if ( is_object( $products ) && $products->have_posts() ) { 
							
								while ( $products->have_posts() ) : $products->the_post();  
		
							 ?>
                            <div class="slide">
                            	<?php
								if ( has_post_thumbnail() ) { ?>
                                <img src="<?php echo sp_get_image( get_the_ID() ); ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php the_title(); ?>" />
                                <?php } else { ?>
                                <img src="<?php echo get_template_directory_uri().'/images/no-product-image.jpg'; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php the_title(); ?>" />
                                <?php } ?>
                                <div class="textblock">
                                    <h2><?php the_title(); ?></h2>
                                    <p class="description"><?php echo sp_truncate(strip_tags( sp_wpsc_the_product_description(), '<p><a><ul><li><strong><br><em><small><div>' ), sp_isset_option( 'homepage_slider_description_characters', 'value' ), sp_isset_option( 'homepage_slider_description_denote', 'value' ), true, true); ?></p>
                                    <span class="divider">&nbsp;</span>
									<?php if (sp_isset_option( 'homepage_slider_display_price', 'boolean', 'true' )) { ?>                                                                    
										<?php if (sp_wpsc_product_on_special(get_the_ID())) { ?>
                                        <p class="oldprice"><?php echo sp_wpsc_product_normal_price( get_the_ID()); ?></p>
                                        <p class="price"><?php echo sp_wpsc_the_product_price(false, get_the_ID()); ?></p>                                    
                                        <?php } else { ?>
                                        <p class="price"><?php echo sp_wpsc_the_product_price(false, get_the_ID()); ?></p>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if (sp_isset_option( 'homepage_slider_display_link', 'boolean', 'true' )) { ?>                                    
                                    <p class="buy-button-wrapper"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Buy Now', 'sp' ); ?>" class="buy-button"><span><?php _e('Buy Now','sp'); ?></span></a></p>
                                    <?php } ?>
                                </div><!--close textblock-->
                            </div><!--close slide-->
                            <?php $count++; ?>
    						<?php endwhile; 
							} ?>
                        </div><!--close home-slider-->
                        <div class="home-slider-shadow"></div>
                        <div class="textband"></div><!--close textband-->
                        <div class="home-slider-shadow"></div>
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_interval', 'value' ); ?>" class="homepage_slider_interval" />                           
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_effects', 'value' ); ?>" class="homepage_slider_effects" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_transition', 'value' ); ?>" class="homepage_slider_transition" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_easing', 'value' ); ?>" class="homepage_slider_easing" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_pause', 'value' ); ?>" class="homepage_slider_pause" />   
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_direction', 'value' ); ?>" class="homepage_slider_direction" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_touchswipe', 'value' ); ?>" class="homepage_slider_touchswipe" />
                    </div><!--close slider-wrapper-->
                    
                <div id="carousel-wrapper" class="group">
                    <span class="carousel-arrow-left">&lt;</span>
                    <div id="carousel" class="group">
                    <?php 
							$i = 0; 
							$output = '';
							 
							if ( is_object( $products ) && $products->have_posts() ) {
								$output .= '<ul class="group">';		
								while ( $products->have_posts() ) : $products->the_post();
									$output .= '<li class="product-slide">';
									
									// Thumbnails, if required
										$output .= '<a href="#" class="products" data-rel="'.$i.'" title="'.$products->post_title.'">';
										$post_image_url = sp_get_image( get_the_ID() );
										$image_width = 200;
										$image_height = 120;
										
										if ( $post_image_url ) {
											$output .=get_the_post_thumbnail(get_the_ID(), array($image_width,$image_height), array( 'title' =>  get_the_title() ) ).$tag.'</a>';
										} else {
												$output .= '<img alt="' . get_the_title() . '" title="' . get_the_title() . '" src="'.get_template_directory_uri(). '/images/no-product-image.jpg'.'" width="'.$image_width.'" height="'.$image_height.'" />'.$tag.'</a>';
										}
									$output .= '<span class="hover_icon">&nbsp;</span></li>';
									$i++;
								endwhile;
								$output .= "</ul>";
					  		} // end have products
					  echo $output;
					  wp_reset_postdata();
                     ?>
                    </div><!--close carousel-->
                    <span class="carousel-arrow-right">&gt;</span>
                        <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_scroll_items', 'value' ); ?>" class="homepage_carousel_scroll_items" />
                        <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_interval', 'value' ); ?>" class="homepage_carousel_interval" /> 
                        <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_speed', 'value' ); ?>" class="homepage_carousel_speed" />   
                        <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_easing', 'value' ); ?>" class="homepage_carousel_easing" />
                        <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_circular', 'value' ); ?>" class="homepage_carousel_circular" /> 
                        <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_reverse', 'value' ); ?>" class="homepage_carousel_reverse" /> 
                        <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_pauseonhover', 'value' ); ?>" class="homepage_carousel_pauseonhover" /> 
                        <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_effects', 'value' ); ?>" class="homepage_carousel_effects" /> 
                        <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_autoscrolldirection', 'value' ); ?>" class="homepage_carousel_autoscrolldirection" /> 
                        <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_infinite', 'value' ); ?>" class="homepage_carousel_infinite" /> 
                        <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_touchswipe', 'value' ); ?>" class="homepage_carousel_touchswipe" /> 
                        <input type="hidden" value="<?php echo ($i > 4) ? '4' : $i; ?>" class="homepage_carousel_visible" />  
				</div><!--close carousel-wrapper-->
<?php 		} // end have items check ?>
<?php 	} // end have enable check ?>
<?php } //end wpec check ?>
<?php
if ( class_exists( 'woocommerce' ) )
{
	if ( sp_isset_option( 'homepage_featured_enable', 'boolean', 'true' ) ) 
	{
		
		if (sp_isset_option( 'homepage_featured_category', 'isset' ) && sp_isset_option( 'homepage_featured_category', 'value' ) != '') 
		{
			$category = sp_isset_option( 'homepage_featured_category', 'value' );
			$rand = sp_isset_option( 'homepage_featured_random', 'value' );
			$item_count = sp_isset_option( 'homepage_featured_product_count', 'value' );
			$products = sp_woo_get_products($category, $item_count, $rand); // limit to 30 products
		?>
            <div id="slider-wrapper" class="group">
                <div id="home-slider">
			<?php     
			
			$count = 0;   
			if ( is_object( $products ) && $products->have_posts() ) 
			{
				$image_width = 574;
				$image_height = 410;
				
				while ( $products->have_posts() ) : $products->the_post(); 
                    // if 2.0+
                    if ( function_exists( 'get_product' ) ) 
                        $product = get_product( $post->ID );
                    else
                        $product = new WC_Product( $post->ID );
				?>
                    <div class="slide">
                        <?php						
							if ( has_post_thumbnail() ) { ?>
                                
                                <img src="<?php echo sp_get_image( get_the_ID() ); ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php the_title(); ?>" />
                      <?php } else { ?>
                                <img src="<?php echo get_template_directory_uri().'/images/no-product-image.jpg'; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php the_title(); ?>" />
                      <?php } ?>
                            <div class="textblock">
                                <h2><?php the_title(); ?></h2>
                                <p class="description"><?php echo sp_truncate(do_shortcode(get_the_excerpt()), sp_isset_option( 'homepage_slider_description_characters', 'value' ), sp_isset_option( 'homepage_slider_description_denote', 'value' ), true, true); ?></p>
                                <span class="divider">&nbsp;</span>
                                <?php if (sp_isset_option( 'homepage_slider_display_price', 'boolean', 'true' )) { ?>                                                                    
                                 <p class="price"><?php echo $product->get_price_html(); ?></p>
                                <?php } ?>
                                <?php if (sp_isset_option( 'homepage_slider_display_link', 'boolean', 'true' )) { ?>                                    
                                <p class="buy-button-wrapper"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Buy Now', 'sp' ); ?>" class="buy-button"><span><?php _e('Buy Now','sp'); ?></span></a></p>
                         <?php } ?>
                            </div><!--close textblock-->
                    </div><!--close slide-->
                    <?php 
					$count++;
				endwhile;
			} // end have posts check
			?>
				</div><!--close home-slider-->
                <div class="home-slider-shadow"></div>
                <div class="textband"></div><!--close textband-->
                <div class="home-slider-shadow"></div>
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_interval', 'value' ); ?>" class="homepage_slider_interval" />                           
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_effects', 'value' ); ?>" class="homepage_slider_effects" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_transition', 'value' ); ?>" class="homepage_slider_transition" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_easing', 'value' ); ?>" class="homepage_slider_easing" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_pause', 'value' ); ?>" class="homepage_slider_pause" />   
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_direction', 'value' ); ?>" class="homepage_slider_direction" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_touchswipe', 'value' ); ?>" class="homepage_slider_touchswipe" />
                
			</div><!--close slider-wrapper-->
            
            <div id="carousel-wrapper" class="group">
                <span class="carousel-arrow-left">&lt;</span>
                <div id="carousel" class="group">
                <?php 
					$i = 0;
					$output = '';
					if ( is_object( $products ) && $products->have_posts() ) {
						$output .= '<ul class="group">';		
						while ( $products->have_posts() ) : $products->the_post(); 
							$output .= '<li class="product-slide">';
							
							// Thumbnails, if required
								$output .= '<a href="#" class="products" data-rel="'.$i.'" title="'.get_the_title().'">';
								$post_image_url = sp_get_image( $product->id );
								
								$image_width = 200;
								$image_height = 120;
					  
								if ( $post_image_url ) {
									//$output .= '<img src="' .$post_image_url.'" title="' . get_the_title() . '" alt="' . get_the_title() . '" width="'.$image_width.'" height="'.$image_height.'" />'.$tag.'<span class="hover_icon">&nbsp;</span></a>';
									$output .=get_the_post_thumbnail( $post->ID, array($image_width,$image_width), array( 'title' => get_the_title() ) ).'<span class="hover_icon">&nbsp;</span></a>';
								} else {
									$output .='<img alt="' . get_the_title() . '" title="' . get_the_title() . '" src="'.get_template_directory_uri(). '/images/no-product-image.jpg'.'" width="'.$image_width.'" height="'.$image_height.'" />';			
								$output .= '<span class="hover_icon">&nbsp;</span></a>';
								}
							$output .= '</li>';
						$i++;
						endwhile;
						$output .= "</ul>";
					}
					echo $output;
					wp_reset_postdata();
                 ?>
                </div><!--close carousel-->
                <span class="carousel-arrow-right">&gt;</span>
                <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_scroll_items', 'value' ); ?>" class="homepage_carousel_scroll_items" />
                <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_interval', 'value' ); ?>" class="homepage_carousel_interval" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_speed', 'value' ); ?>" class="homepage_carousel_speed" />   
                <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_easing', 'value' ); ?>" class="homepage_carousel_easing" />
                <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_circular', 'value' ); ?>" class="homepage_carousel_circular" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_reverse', 'value' ); ?>" class="homepage_carousel_reverse" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_pauseonhover', 'value' ); ?>" class="homepage_carousel_pauseonhover" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_effects', 'value' ); ?>" class="homepage_carousel_effects" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_autoscrolldirection', 'value' ); ?>" class="homepage_carousel_autoscrolldirection" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_infinite', 'value' ); ?>" class="homepage_carousel_infinite" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'homepage_carousel_touchswipe', 'value' ); ?>" class="homepage_carousel_touchswipe" /> 
                <input type="hidden" value="<?php echo ($i > 4) ? '4' : $i; ?>" class="homepage_carousel_visible" />  
            </div><!--close carousel-wrapper-->
        <?php    
			
		} // end check if category is set
	} // end check if enabled
} // end check for woo plugin
?>

<?php if (sp_isset_option( 'welcome_text', 'boolean', 'true' )) { ?>
<div id="home-welcome-text">
	<?php get_template_part( 'content', 'home' ); ?>
</div><!--close home-welcome-text-->
<?php }
				
if ( class_exists( 'WP_eCommerce' ) )
{
	if (sp_isset_option( 'homepage_featured_grid_enable', 'boolean', 'true' )) { ?>
        <div id="home-feature-wrapper" class="group">
            <section id="home-feature-products">
                <?php if (sp_isset_option( 'homepage_featured_grid_title', 'isset' ) && sp_isset_option( 'homepage_featured_grid_title', 'value' ) != '') { ?>
                <h2 class="homepage_featured_grid_title"><?php echo sp_isset_option( 'homepage_featured_grid_title', 'value' ); ?></h2>
                <?php } ?>
            
                <?php 
                    if (sp_isset_option( 'homepage_featured_grid_cat', 'isset' ) && sp_isset_option( 'homepage_featured_grid_cat', 'value' ) != '') {
						get_template_part( 'sp', 'wpec-home-grid' );
                    }
                ?>
            </section><!--close home-feature-products-->
        </div><!--close home-feature-wrapper-->
	<?php
    } // end grid enable check
    ?>
<?php
} // end WPEC check

if ( class_exists( 'woocommerce' ) )
{
	if (sp_isset_option( 'homepage_featured_grid_enable', 'boolean', 'true' )) { ?>
        <div id="home-feature-wrapper" class="group">
            <section id="home-feature-products">
                <?php if (sp_isset_option( 'homepage_featured_grid_title', 'isset' ) && sp_isset_option( 'homepage_featured_grid_title', 'value' ) != '') { ?>
                <h2 class="homepage_featured_grid_title"><?php echo sp_isset_option( 'homepage_featured_grid_title', 'value' ); ?></h2>
                <?php } ?>
            
                <?php get_template_part( 'sp', 'woo-home-grid' ); ?>
            </section><!--close home-feature-products-->
        </div><!--close home-feature-wrapper-->
	<?php
    } // end grid enable check
} // end WOO check
get_footer();
?>