<?php
if ( ! function_exists ( 'skt_donation_create_menu_currency' ) ) {
add_action('admin_menu', 'skt_donation_create_menu_currency');
function skt_donation_create_menu_currency(){
	//create new top-level menu 
  add_submenu_page('skt-donations-settings', 'Manage Currency', 'Manage Currency', 'administrator', 'sktcurrency', 'skt_donation_currency_page');
	//call register settings function
	add_action( 'admin_init', 'register_skt_donation_settings' );
}
function skt_donation_currency_page() {
	if (!current_user_can('administrator')) {
      wp_die(__('You do not have sufficient permissions to access this page.'));
    }else{
	global $wpdb;
	$file="";
  	$curl = plugin_dir_url( $file ); 
  	$plugin_directory = basename(dirname(__DIR__)); 
  	$plugin_url = $curl.''.$plugin_directory;
	include "add_insert_currency.php";
	$skt_choose_currency_paypal = $wpdb->prefix . "skt_choose_currency_paypal";
 	$select_choose_currency_paypal = $wpdb->get_row("SELECT * FROM $skt_choose_currency_paypal WHERE id='1'");
 	$paypal_type_currency_id="";
 	$paypal_currency_symbol_id ="";
	if($select_choose_currency_paypal !=NULL){
	 	$paypal_type_currency_id = $select_choose_currency_paypal->type_currency_id;
	 	$paypal_currency_symbol_id = $select_choose_currency_paypal->currency_symbol_id;
	}
?>
<div class="skt_manage_currency">
	<h3><?php esc_attr_e('Select PayPal Currency','skt-donation');?></h3>
	<form method="post" action="">
		<select name="paypal_sktcurrency_id" id="paypal_sktcurrency_id">
	 		<?php
	 			$skt_country_type_currency_paypal = $wpdb->prefix . "skt_country_type_currency";
 				$get_country_type_currency_paypal = $wpdb->get_results( "SELECT * FROM $skt_country_type_currency_paypal WHERE type_mode='paypal'" );
	 			foreach ($get_country_type_currency_paypal as $get_countrycurrency_paypal) {
	 		?>
	 			<option value="<?php echo esc_attr($get_countrycurrency_paypal->id);?>" <?php if($get_countrycurrency_paypal->id==$paypal_type_currency_id){echo esc_attr("selected");}?>>
	 				<?php echo esc_attr($get_countrycurrency_paypal->currency_stripe);?>	
	 			</option>
	 		<?php } ?>
	 	</select>
	 	<?php wp_nonce_field( 'name_of_my_action', 'name_of_nonce_field' ); ?>
	 	<input type="hidden" name="mode_currency" value="<?php echo esc_attr('currency_sign_paypal');?>">
	 	<input type="submit" name="submit" value="<?php esc_attr_e('Save PayPal Currency','skt-donation');?>">
	</form>
</div>
<?php
	$skt_choose_currency_twocheckout = $wpdb->prefix . "skt_choose_currency_twocheckout";
 	$select_choose_currency_twocheckout = $wpdb->get_row("SELECT * FROM $skt_choose_currency_twocheckout WHERE id='1'");
 	$twocheck_type_currency_id="";
 	$twocheck_currency_symbol_id ="";
 	if($select_choose_currency_twocheckout !=NULL){
	 	$twocheck_type_currency_id = $select_choose_currency_twocheckout->type_currency_id;
	 	$twocheck_currency_symbol_id = $select_choose_currency_twocheckout->currency_symbol_id;
	}
?>
<div class="skt_manage_currency">
	<h3><?php esc_attr_e('Select 2Checkout Currency','skt-donation');?></h3>
	<form method="post" action="">
	 	<select name="twocheckout_sktcurrency_id" id="twocheckout_sktcurrency_id" >
	 		<?php
	 			$skt_country_type_currency_checkout = $wpdb->prefix . "skt_country_type_currency";
 				$get_country_type_currency_twocheck = $wpdb->get_results( "SELECT * FROM $skt_country_type_currency_checkout WHERE type_mode='2checkout'" );
	 			foreach ($get_country_type_currency_twocheck as $get_countrycurrencytwocheck) {
	 		?>
	 			<option value="<?php echo esc_attr($get_countrycurrencytwocheck->id);?>" <?php if($get_countrycurrencytwocheck->id==$twocheck_type_currency_id){echo esc_attr("selected");}?>>
	 				<?php echo esc_attr($get_countrycurrencytwocheck->currency_stripe);?>	
	 			</option>
	 		<?php } ?>
	 	</select>
	 	<?php wp_nonce_field( 'name_of_my_action', 'name_of_nonce_field' ); ?>
	 	<input type="hidden" name="mode_currency" value="<?php echo esc_attr('currency_sign_twocheckout');?>">
	 	<input type="submit" name="submit" value="<?php esc_attr_e('Save 2Checkout Currency','skt-donation');?>">
	</form>
</div>
<?php  } } }?>