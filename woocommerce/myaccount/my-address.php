<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
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
 * @version 2.6.0
 */
 
global $woocommerce;

$customer_id = get_current_user_id();
?>

<?php if (get_option('woocommerce_ship_to_billing_address_only')=='no') : ?>

	<div class="col2-set addresses group">
	
		<div class="col-1">
	
<?php endif; ?>
	
			<header class="title">				
				<h3><?php _e('Billing Address', 'sp'); ?></h3>
				<a href="<?php echo esc_url( add_query_arg('address', 'billing', get_permalink(woocommerce_get_page_id('edit_address'))) ); ?>" class="edit"><?php _e('Edit', 'sp'); ?></a>	
			</header>
			<address>
				<?php
					$address = array(
						'first_name' 	=> get_user_meta( $customer_id, 'billing_first_name', true ),
						'last_name'		=> get_user_meta( $customer_id, 'billing_last_name', true ),
						'company'		=> get_user_meta( $customer_id, 'billing_company', true ),
						'address_1'		=> get_user_meta( $customer_id, 'billing_address_1', true ),
						'address_2'		=> get_user_meta( $customer_id, 'billing_address_2', true ),
						'city'			=> get_user_meta( $customer_id, 'billing_city', true ),			
						'state'			=> get_user_meta( $customer_id, 'billing_state', true ),
						'postcode'		=> get_user_meta( $customer_id, 'billing_postcode', true ),
						'country'		=> get_user_meta( $customer_id, 'billing_country', true )
					);
	
					$formatted_address = $woocommerce->countries->get_formatted_address( $address );
					
					if (!$formatted_address) _e('You have not set up a billing address yet.', 'sp'); else echo $formatted_address;
				?>
			</address>


<?php if (get_option('woocommerce_ship_to_billing_address_only')=='no') : ?>
	
		</div><!-- /.col-1 -->
		
		<div class="col-2">
		
			<header class="title">
				<h3><?php _e('Shipping Address', 'sp'); ?></h3>
				<a href="<?php echo esc_url( add_query_arg('address', 'shipping', get_permalink(woocommerce_get_page_id('edit_address'))) ); ?>" class="edit"><?php _e('Edit', 'sp'); ?></a>
			</header>
			<address>
				<?php
					$address = array(
						'first_name' 	=> get_user_meta( $customer_id, 'shipping_first_name', true ),
						'last_name'		=> get_user_meta( $customer_id, 'shipping_last_name', true ),
						'company'		=> get_user_meta( $customer_id, 'shipping_company', true ),
						'address_1'		=> get_user_meta( $customer_id, 'shipping_address_1', true ),
						'address_2'		=> get_user_meta( $customer_id, 'shipping_address_2', true ),
						'city'			=> get_user_meta( $customer_id, 'shipping_city', true ),			
						'state'			=> get_user_meta( $customer_id, 'shipping_state', true ),
						'postcode'		=> get_user_meta( $customer_id, 'shipping_postcode', true ),
						'country'		=> get_user_meta( $customer_id, 'shipping_country', true )
					);
	
					$formatted_address = $woocommerce->countries->get_formatted_address( $address );
					
					if (!$formatted_address) _e('You have not set up a shipping address yet.', 'sp'); else echo $formatted_address;
				?>
			</address>
		
		</div><!-- /.col-2 -->
	
	</div><!-- /.col2-set -->

<?php endif; ?>