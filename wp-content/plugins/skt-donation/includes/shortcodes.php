<?php
if ( ! function_exists ( 'skt_donation_func' ) ) {
function skt_donation_func( $atts ) {
  	ob_start();
	global $wpdb;
	$current_date = date('d-m-Y');
	function skt_donation_shortcodecss(){
?>
<style type="text/css">
/*For Users Custom*/
.skt-nav-tabs>li>a{line-height:45px;border:1px solid transparent;-webkit-border-radius:4px 4px 0 0;-moz-border-radius:4px 4px 0 0;border-radius:4px 4px 0 0; background:<?php echo esc_attr( get_option('skt_donation_fend_menu_backgroundcolor') ); ?>;}
.skt-tabnav li a:hover{text-decoration:none;background-color:<?php echo esc_attr( get_option('skt_donation_fend_menu_hover_backgroundcolor') ); ?>;}
.skt-nav-tabs li.active a:link, .skt-nav-tabs li.active a:visited { background-color:#f3f3f3; border-top:<?php echo esc_attr( get_option('skt_donation_fend_menu_hover_backgroundcolor') ); ?> solid 4px; color:#282828 !important;}
.skt-nav-tabs .active a, .skt-nav-tabs .active a:hover{color:red;background-color:#f98315;border-bottom-color:transparent;cursor:default;}
.skt_donation_form br { display:none;}
.skt_donation-plugin-container .btn,
.skt_donation-plugin-container .button,
.skt_donation_payumoney_box .payumoney_form input[type=submit],
.skt_donation_twocheckout_box .twocheckout_form input[type=submit] { background:<?php echo esc_attr( get_option('skt_donation_fend_backgroundcolor') ); ?> !important; border:none; color:#fff; padding:12px 20px; border-radius:5px; cursor:pointer;}
.skt_donation-plugin-container .btn:hover,
.skt_donation-plugin-container .button:hover,
.skt_donation_payumoney_box .payumoney_form input[type=submit]:hover,
.skt_donation_twocheckout_box .twocheckout_form input[type=submit]:hover { background:<?php echo esc_attr( get_option('skt_donation_fend_hover_backgroundcolor') ); ?> !important;}
.skt_donation_box{padding:30px;  margin-top:0; background:<?php echo esc_attr( get_option('skt_donation_fend_form_backgroundcolor') ); ?> !important;}
</style>
<?php
}
	$shortcode_css_for_custom = skt_donation_shortcodecss();
	include_once('add_paypalsubscription.php'); 
	$function_name_add_paypalsubscription = skt_donation_add_paypalsubscription_function();
	include_once('paypal_process.php'); 
	$function_name_paypal_process = skt_donation_paypal_process_function();
	include_once('add_checkout.php'); 
 	$function_name_add_checkout = skt_donation_twocheckout_function();
?>
<div class="skt_donation-plugin-container">
	<?php 
	$site_website_name = get_bloginfo( 'name' );
	$payment_gatway_result = isset($_GET['payment_gatway_result']) ? $_GET['payment_gatway_result'] : '';
	if ($payment_gatway_result !='') {
		$payment_gatway_result = $_GET['payment_gatway_result'];
	}
	if($payment_gatway_result=="result"){ 
			$payment_result_success="";
			$payment_result_success = isset($_GET['payment_result_success']) ? $_GET['payment_result_success'] : '';
			if($payment_result_success !=''){
				$payment_result_success = $_GET['payment_result_success'];
			}
			$payment_gatway="";
			$payment_gatway = isset($_GET['payment_gatway']) ? $_GET['payment_gatway'] : '';
			if($payment_gatway !=''){
				$payment_gatway = $_GET['payment_gatway'];
			}
			$paymentMessage_failed = isset($_GET['payment_fail']) ? $_GET['payment_fail'] : '';
			if($paymentMessage_failed !=''){
				$paymentMessage_failed = $_GET['payment_fail'];
			}
	    if($payment_gatway=="payment_success"){ ?>
	     	<div class="skt_paymentMessage_Successfull"> <?php echo esc_attr($payment_result_success); ?> </div>
	     <?php }?>
	     <?php	if( $payment_gatway=="payment_fail"){ ?>	
	     	<div class="skt_paymentMessage_failed"> <?php	echo esc_attr($paymentMessage_failed); ?> </div>
	    <?php }
	     } 
		$tabe_paypal_simple = isset($_GET['tabe_paypal_simple']) ? $_GET['tabe_paypal_simple'] : '';
		if($tabe_paypal_simple !=''){
			$tabe_paypal_simple = $_GET['tabe_paypal_simple'];
			$paypal_payment_id = $_GET['paypal_payment_id'];
			$paypal_payer_id = $_GET['paypal_payer_id'];
			if($tabe_paypal_simple=="paypal_success"){
				esc_attr_e("<h4>Your Transaction Success.Your Transaction ID for this transaction is ".$paypal_payment_id.".</h4>",'skt-donation');
			}
			if($tabe_paypal_simple=="paypal_faild"){
				esc_attr_e("<h4>Your Transaction Faild.Your Transaction ID for this transaction is ".$paypal_payment_id.".</h4>",'skt-donation');
			}
		}
		$paypal_subscription = isset($_GET['paypal_subscription']) ? $_GET['paypal_subscription'] : '';
		if($paypal_subscription !=''){
			$paypal_subscription = $_GET['paypal_subscription'];
			if($paypal_subscription=="subscription_success"){
				$first_name = $_GET['first_name'];
				$last_name = $_GET['last_name'];
				$email = $_GET['email'];
				$phone = $_GET['phone'];
				$donation_amount = $_GET['donation_amount'];
				$current_date = date('d-m-Y');
				$table_name = $wpdb->prefix ."skt_donation_amount"; 
				$data_donation_amt = array(
					'customer_firstname' => $first_name,
					'customer_lastname' => $last_name,
					'customer_email' => $email,
					'customer_phone' => $phone,
					'mode' => "paypal",
					'status' => 'paid',
					'donation_amount' => $donation_amount,
					'payment_date' => $current_date,
					'subscription_normal'=>'subscriptions'
				);
				$insert_data = $wpdb->insert( $table_name, $data_donation_amt );
				if($insert_data){ 
					/*********Email functiion start here*****/
			        $admin_email_address = esc_attr( get_option('skt_donation_skt_email_address') );
			        $email_subject = esc_attr( get_option('skt_donation_skt_email_subject') );
			        $email_message = esc_attr( get_option('skt_donation_skt_email_message') );
			        $to = $email;
			        // subject
			        $subject = $email_subject;
			        // compose message
			        $message = "
			        <html>
			          <head>
			            <title></title>
			          </head>
			          <body>
			            <p>".esc_attr($email_message)."</p>
			          </body>
			        </html>
			        ";
			        // To send HTML mail, the Content-type header must be set
			        $headers = "MIME-Version: 1.0" . "\r\n";
			        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			        // More headers
			        $headers .= 'From: <'.$admin_email_address.'>' . "\r\n";
			        // send email
			        mail($to, $subject, $message, $headers);
			        /*********Email functiion end here*******/ 
				?>
					<div class="skt_paymentMessage_Successfull"><?php esc_attr_e('Data saved in our system','skt-donation');?></div>
				<?php
				}else{ ?>
					<div class="skt_paymentMessage_failed"><?php esc_attr_e('Data not saved in our system','skt-donation');?></div>
				<?php 
				}
			}
			if($paypal_subscription=="subscription_fail"){ ?>
				<div class="skt_paymentMessage_failed"><?php esc_attr_e('Your transaction failed','skt-donation');?></div>
			<?php 
			}
		}
		$paypal_not_active = esc_attr(get_option('skt_donation_paypal_active_show'));
		$checkout_not_active = esc_attr(get_option('skt_donation_twocheck_active_dactive'));
		if($paypal_not_active=='' && $checkout_not_active==''){
			esc_attr_e("No payment gateway is currently active. Go to Dashboard >> SKT Donation >> Payment Gateways and set up any of the payment gateways of your choice.",'skt-donation');
		}elseif($paypal_not_active=='true' && $checkout_not_active=='true' ){
			esc_attr_e("No payment gateway is currently active. Go to Dashboard >> SKT Donation >> Payment Gateways and set up any of the payment gateways of your choice.",'skt-donation');
		}else{
	?>
  <!--Getting Api information from database-->
   <?php
		//************FOR PAYPAL API USING FOLLOWING**************
		$env_production_sandbox = "";
		$mode = esc_attr( get_option('skt_donation_paypal_mode_zero_one') );
		$paypal_test_api ="";
		$paypal_live_api ="";
		if($mode=="true"){
			$paypal_test_api = esc_attr( get_option('skt_donation_paypal_test_api'));
			$env_production_sandbox = "sandbox";
		}else{
			$paypal_live_api = esc_attr( get_option('skt_donation_paypal_live_api'));
			$env_production_sandbox = "production";
		}
		$donation_amount = esc_attr( get_option('skt_donation_amount_in_usd'));
	?>
  <div> 
 	<?php if(isset($_POST['form_mode'])!=''){?>
	 	<?php if($paymentMessageSucceesed=="payment_Succeesed"){ ?>
	     	<div class="skt_paymentMessage_Successfull"> <?php echo $paymentMessage_Succeesed; ?> </div>
	     <?php }
	     	if($paymentMessagefailed !="" || $paymentMessagefailed=="payment_failed"){ ?>
	     	<div class="skt_paymentMessage_failed"> <?php	echo $paymentMessage_failed; ?> </div>
	    <?php }
	    } ?>
	<?php 
	$payment_success = isset($_GET['payment_success']) ? $_GET['payment_success'] : '';
	if ($payment_success !='') {
		echo $payment_success = $_GET['payment_success'];	
	}	
	?>
	<ul class="skt-tabnav skt-nav-tabs" id="myTab">
		<?php if ( esc_attr(get_option('skt_donation_paypal_active_show') == 'false' ) ) { ?>
	    <li <?php if(esc_attr(get_option('skt_donation_default_gateway'))=='payPal'){  ?> class='active' <?php } ?>><a href="#skt_paypal" data-toggle="tab"><?php esc_attr_e('PayPal','skt-donation');?></a></li>
	    <?php } ?>
		<?php if ( esc_attr(get_option('skt_donation_twocheck_active_dactive') == 'false' ) ) { ?>
	    <li <?php if(esc_attr(get_option('skt_donation_default_gateway'))=='twoheckout'){  ?> class='active' <?php } ?>><a href="#skt_checkout" data-toggle="tab"><?php esc_attr_e('2Checkout','skt-donation');?></a></li>
	    <?php } ?>
	</ul>
	<div class="skt-tab-content">
		<?php if ( esc_attr(get_option('skt_donation_paypal_active_show') == 'false' ) ) { ?>
	    <div class="skt-tab-pane <?php if(esc_attr(get_option('skt_donation_default_gateway'))=='payPal'){  ?> active <?php } ?>" id="skt_paypal">
	    	<?php include_once('paypal_subscription_normal.php'); ?>
	    </div>
	    <?php } ?>
	    <?php if ( esc_attr(get_option('skt_donation_twocheck_active_dactive') == 'false' ) ) { ?>
	    <div class="skt-tab-pane <?php if(esc_attr(get_option('skt_donation_default_gateway'))=='twoheckout'){  ?> active <?php } ?>" id="skt_checkout">
	    	<?php include_once('twocheckout.php'); ?>
	    </div>
	    <?php } ?>
	</div>
	<!-- FOR PAYMENT ALERT -->
</div>
	<script type="text/javascript">
		jQuery('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
	    localStorage.setItem('activeTab', jQuery(e.target).attr('href'));
	});
	// Acá guarda el index al cual corresponde la tab. Lo podés ver en el dev tool de chrome.
	var activeTab = localStorage.getItem('activeTab');
	// En la consola te va a mostrar la pestaña donde hiciste el último click y lo
	// guarda en "activeTab". Te dejo el console para que lo veas. Y cuando refresques
	// el browser, va a quedar activa la última donde hiciste el click.
	if (activeTab) {
	   jQuery('a[href="' + activeTab + '"]').tab('show');
	}
	</script>
	<?php } ?>
</div>
<?php
  $output_string = ob_get_contents();
  ob_end_clean();
  return $output_string;
}
add_shortcode( 'skt-donation', 'skt_donation_func' );
}
?>