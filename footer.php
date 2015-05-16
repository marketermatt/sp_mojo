	<?php if(has_nav_menu( 'footer_cat' ) && sp_isset_option( 'footer_cat_menu_enable', 'boolean', 'true' ) ) { ?> 
    <div id="footer-cat-wrapper">
    	<!--FOOTER MENU-->
        <section id="footer-menu" class="group">
			<?php wp_nav_menu( array( 'container' => 'false', 'fallback_cb' => 'footer_menu', 'theme_location' => 'footer_cat', 'depth' => 2, 'walker' => new sp_nav_walker())); ?>      
        </section><!--close footer-menu-->
        <!--END FOOTER MENU-->
   	</div><!--close footer-cat-wrapper-->     
    <?php } ?>

       <?php if (sp_isset_option( 'footer_widget', 'isset' ) && sp_isset_option( 'footer_widget', 'value' ) != '0') { ?>
       <div id="footer-widget-wrapper">
        <section id="footer-widget" class="group">
					  <?php
					  // sets an array with the number of columns to output
					  $columns = array('4' 	=> array('footer-col col4','footer-col col4','footer-col col4','footer-col col4'),
										 '3'	=> array('footer-col col3','footer-col col3','footer-col col3'),
										 '2' 	=> array('footer-col col2','footer-col col2'),
										 '1' 	=> array('') );
					  $i = 0;
					  
						if (is_array($columns[sp_isset_option( 'footer_widget', 'value' )])) {
						foreach($columns[sp_isset_option( 'footer_widget', 'value' )] as $col): 
						
								 $i++;
								 if($i == 1){ 
									  $class = "first"; 
								 } else {
									  $class = "";	
								 }
							?>
							<div class="<?php echo $col;?> <?php echo $class; ?>">
								 <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-'.$i) ) ?>
							</div>
					  <?php endforeach; 
						}
					  ?>
        </section><!--close footer-widget-->
        </div><!--close footer-widget-wrapper-->
        <?php } ?>
            <footer class="group" id="footer">
            <!--SOCIAL MEDIA-->
            <?php if (sp_isset_option( 'facebook_enable', 'boolean', 'true') || sp_isset_option( 'twitter_enable', 'boolean', 'true') || sp_isset_option( 'flickr_enable', 'boolean', 'true') || sp_isset_option( 'rss_enable', 'boolean', 'true') || sp_isset_option( 'gplus_enable', 'boolean', 'true') || sp_isset_option( 'pinterest_enable', 'boolean', 'true') || sp_isset_option( 'youtube_enable', 'boolean', 'true')) 			
			{ ?>
            <div id="social-media" class="group">
					<?php sp_social_media_script(); ?>
            </div><!--close social-media-->
            <?php } ?>
            <!--END SOCIAL MEDIA-->  
             <?php wp_nav_menu( array( 'container' => 'nav', 'container_id' => 'footer-nav', 'fallback_cb' => 'footer_menu','theme_location' => 'footer_nav', 'depth' => 1)); ?>           	
            <!--TAGLINE-->
                    <?php if (sp_isset_option( 'tagline', 'boolean', 'true' )) : ?>
                    <h1 id="tagline">
                        <?php echo bloginfo( 'description' ); ?>
                    </h1>
                    <?php endif; ?>        
            <!--END TAGLINE-->

            </footer>
          
</div><!--close wrapper-->
</div><!--close container--> 
			<!--start lightbox hidden values-->
            <input type="hidden" value="<?php echo sp_isset_option( 'lightbox_social', 'value' ); ?>" id="lightbox_social" />
            <input type="hidden" value="<?php echo sp_isset_option( 'lightbox_theme', 'value' ); ?>" id="lightbox_theme" />
            <input type="hidden" value="<?php echo sp_isset_option( 'lightbox_slideshow', 'value' ); ?>" id="lightbox_slideshow" />
            <input type="hidden" value="<?php echo sp_isset_option( 'lightbox_show_overlay_gallery', 'value' ); ?>" id="lightbox_show_overlay_gallery" />
            <input type="hidden" value="<?php echo sp_isset_option( 'lightbox_title', 'value' ); ?>" id="lightbox_title" />
            <input type="hidden" value="<?php echo sp_isset_option( 'variation_image_swap', 'value' ); ?>" id="variation_image_swap" />
            <!--end lightbox hidden values-->	
            <input type="hidden" value="true" id="quickview_enable" />
            <input type="hidden" value="<?php echo sp_isset_option( 'tabs_start_collapsed', 'value' ); ?>" id="tabs_start_collapsed" />
            
            <div class="footer-meta">
            	<div class="container">
                <p id="footer-copyright">
                    <?php if ( sp_isset_option( 'footer_copyright', 'isset' ) && sp_isset_option( 'footer_copyright', 'value' ) != '') : ?>
                        <?php echo sp_isset_option( 'footer_copyright', 'value' ); ?>
                    <?php endif; ?>
                </p>
                </div><!--close container-->
            </div><!--close footer-meta-->
</div><!--close wrap-all-->            
<?php dynamic_sidebar( 'site-bottom-widget' ); ?>
<?php wp_footer(); ?>
</body>
</html>
