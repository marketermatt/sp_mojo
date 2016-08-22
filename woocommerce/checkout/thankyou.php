<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */
 
global $woocommerce;
?>
<div class="thankyou">

<?php if ($order) : ?>
	<?php if (in_array($order->status, array('failed'))) : ?>
				
		<h3><?php _e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'sp'); ?></h3>

		<p><?php
			if (is_user_logged_in()) :
				_e('Please attempt your purchase again or go to your account page.', 'sp');
			else :
				_e('Please attempt your purchase again.', 'sp');
			endif;
		?></p>
				
		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e('Pay', 'sp') ?></a>
			<?php if (is_user_logged_in()) : ?>
			<a href="<?php echo esc_url( get_permalink(woocommerce_get_page_id('myaccount')) ); ?>" class="button pay"><?php _e('My Account', 'sp'); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>
	<script type="text/javascript">
	jQuery(window).load(function() {
			jQuery(".progress_wrapper .indicator").animate({ left: '539px'},600);
	});
	</script>

<div class="progress_wrapper">
    <span class="icons">&nbsp;</span>
    <span class="indicator">&nbsp;</span>
    <span class="icon-stages">&nbsp;</span>
</div><!--close progress_wrapper-->
		<h3><?php _e('Thank you. Your order has been received.', 'sp'); ?></h3>
				
		<ul class="order_details group">
			<li class="order">
				<?php _e('Order:', 'sp'); ?>
				<strong><?php echo $order->get_order_number(); ?></strong>
			</li>
			<li class="date">
				<?php _e('Date:', 'sp'); ?>
				<strong><?php echo date_i18n(get_option('date_format'), strtotime($order->order_date)); ?></strong>
			</li>
			<li class="total">
				<?php _e('Total:', 'sp'); ?>
				<strong><?php echo $order->get_formatted_order_total(); ?></strong>
			</li>
			<?php if ($order->payment_method_title) : ?>
			<li class="method">
				<?php _e('Payment method:', 'sp'); ?>
				<strong><?php 
					echo $order->payment_method_title;
				?></strong>
			</li>
			<?php endif; ?>
		</ul>
				
	<?php endif; ?>
		
	<div class="order-instruction"><?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?></div>
	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>
<div id="status-bg">
	<span class="cart active"><span><?php _e('Your Cart','sp'); ?></span></span>
    <span class="info active"><span><?php _e('Info','sp'); ?></span></span>
    <span class="final active"><span><?php _e('Final','sp'); ?></span></span>
</div><!--close status-bg-->
	
	<h3><?php _e('Thank you. Your order has been received.', 'sp'); ?></h3>
<?php endif; ?>
</div><!--close thankyou-->	
