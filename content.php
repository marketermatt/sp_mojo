<?php 
$image_width = get_option('thumbnail_size_w');
$image_height = get_option('thumbnail_size_h');

$days = 7;
if (sp_isset_option( 'blog_post_new_tag', 'isset' ) ) {
	$days = sp_isset_option( 'blog_post_new_tag', 'value' );	
}
$style = '';
if (strtotime(get_the_date()) >= strtotime($days.' days ago')) { 
	$style = 'new-tag-push';
}
		
?>
<?php if (sp_isset_option( 'blog_list_layout', 'isset' ) && sp_isset_option( 'blog_list_layout', 'boolean', 'grid-sliding' ) ) { ?>    
		<article id="post-<?php the_ID(); ?>" <?php post_class('group list'); ?>>
            <div class="item">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-image-link">
			<?php  
			$post_image_url = sp_get_image( $post->ID );
			if (has_post_thumbnail() && $post_image_url) {
			?>
				<img width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" class="wp-post-image" alt="<?php the_title_attribute(); ?>" src="<?php echo sp_timthumb_format( 'blog_list', $post_image_url, $image_width, $image_height ); ?>" />	
			<?php } else { ?>
            <img width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" class="wp-post-image" alt="<?php the_title_attribute(); ?>" src="<?php echo sp_timthumb_format( 'blog_list', get_template_directory_uri() . '/images/no-product-image.jpg', $image_width, $image_height ); ?>" />
            <?php } ?>
            </a>
            <span class="quickview-over"></span>
            <a href="<?php the_permalink(); ?>" title="<?php _e( 'Read More', 'sp' ); ?>" class="post-image-link"><span class="quickview-button"><?php _e('READ MORE','sp'); ?></span></a>
            
            <div class="inner-container">
                <div class="grid-meta-box">
                    <span class="grid-meta-box-arrow">&nbsp;</span>
        	<div class="post-meta">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sp' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php sp_posted_on(); ?>
			</div><!-- .entry-meta -->
	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			<div class="entry-summary">
                	<p>
                	<?php
					$count = get_post_meta($post->ID, '_sp_truncate_count', true);
					$denote = get_post_meta($post->ID, '_sp_truncate_denote', true);
					$disabled = get_post_meta($post->ID, '_sp_truncate_disabled', true);
					?>
                    <?php if ( $disabled != '1' )
					{                    
                     	sp_truncate(get_the_excerpt(), (!isset($count) || $count == null) ? 100 : $count, (!isset($denote) || $denote == null) ? '...' : $denote, get_post_meta($post->ID, '_sp_truncate_precision', true), true);
					} else {
						the_excerpt();	
					}
                    ?>
                    </p>
			</div><!-- .entry-summary -->
	<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sp' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'sp' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
	<?php endif; ?>

			<div class="entry-utility">
				<?php sp_posted_in_list(); ?>
				<span class="comments-link"><span class="comment-icon">&nbsp;</span><?php comments_popup_link('', __( '1', 'sp' ), __( '%', 'sp' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'sp' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
            </div><!--close post-meta-->
                    
                </div><!--close grid-meta-box-->	
            </div><!--close inner-container-->                        
            </div><!--close item-->
            <?php 
				if (get_post_type() != 'wpsc-product') {
				  $days = 7;
				  if (sp_isset_option( 'blog_post_new_tag', 'isset' )) {
					  $days = sp_isset_option( 'blog_post_new_tag', 'value' );	
				  }
				  
				  if (strtotime(get_the_date()) >= strtotime($days.' days ago')) { ?>
					  <span class="new-tag">&nbsp;</span>
			  <?php } 
				}
			?>
<?php } else { ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('group list traditional'); ?>>            
			<?php  
			$no_image = 'no-image';
			$post_image_url = sp_get_image( $post->ID );
			if (has_post_thumbnail() && $post_image_url) { 
				$no_image = '';
			?>
            	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-image-link">
				<img width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" class="wp-post-image" alt="<?php the_title_attribute(); ?>" src="<?php echo sp_timthumb_format( 'blog_list', $post_image_url, $image_width, $image_height ); ?>" />	
            <span class="quickview-button"><?php _e('READ MORE','sp'); ?></span>
            </a>
			<?php } ?>
            
        	<div class="post-meta <?php echo $style. " ". $no_image;?>">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sp' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php sp_posted_on(); ?>
			</div><!-- .entry-meta -->
	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			<div class="entry-summary">
                	<p>
                	<?php
					$count = get_post_meta($post->ID, '_sp_truncate_count', true);
					$denote = get_post_meta($post->ID, '_sp_truncate_denote', true);
					$disabled = get_post_meta($post->ID, '_sp_truncate_disabled', true);
					?>
                    <?php if ( $disabled != '1' )
					{                    
                     	echo sp_truncate(get_the_excerpt(), (!isset($count) || $count == null) ? 100 : $count, (!isset($denote) || $denote == null) ? '...' : $denote, get_post_meta($post->ID, '_sp_truncate_precision', true), true);
					} else {
						the_excerpt();	
					}
                    ?>
                    </p>
			</div><!-- .entry-summary -->
	<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sp' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'sp' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
	<?php endif; ?>

			<div class="entry-utility">
				<?php sp_posted_in_list(); ?>
				<span class="comments-link"><span class="comment-icon">&nbsp;</span><?php comments_popup_link('', __( '1', 'sp' ), __( '%', 'sp' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'sp' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
            </div><!--close post-meta-->
                    
            <?php 
				if (get_post_type() != 'wpsc-product') {
				  $days = 7;
				  if (sp_isset_option( 'blog_post_new_tag', 'isset' )) {
					  $days = sp_isset_option( 'blog_post_new_tag', 'value' );	
				  }
				  
				  if (strtotime(get_the_date()) >= strtotime($days.' days ago')) { ?>
					  <span class="new-tag">&nbsp;</span>
                  <?php
			  	  } 
				}
			?>
<?php } ?>            
		</article><!-- #post-## -->