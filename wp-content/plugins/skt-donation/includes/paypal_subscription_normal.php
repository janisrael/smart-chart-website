<?php
    global $post;
    $page_id = $post->ID;
    global $wpdb;
    $file="";
    $curl = plugin_dir_url( $file ); 
    $plugin_directory = basename(dirname(__DIR__)); 
    $plugin_url = $curl.''.$plugin_directory;
    $wp_skt_choose_currency_paypal = $wpdb->prefix . "skt_choose_currency_paypal";
    $select_choose_currency_paypal = $wpdb->get_row("SELECT * FROM $wp_skt_choose_currency_paypal WHERE id='1'");
    $get_choose_stripe_count = $wpdb->num_rows;
    if ($get_choose_stripe_count <= 0) {
        $for_paypal_payment ="USD";
        $for_paypal_sign ="&#36;";
    }else{
        $type_currency_id_paypal = $select_choose_currency_paypal->type_currency_id;
        $currency_symbol_id_paypal = $select_choose_currency_paypal->currency_symbol_id;
        $skt_country_type_currency = $wpdb->prefix . "skt_country_type_currency";
        $select_type_currency_stripe = $wpdb->get_row("SELECT * FROM $skt_country_type_currency WHERE id='$type_currency_id_paypal'");
        $for_paypal_payment =  $select_type_currency_stripe->currency_stripe;
        $for_paypal_sign =  $select_type_currency_stripe->currency_sign;
    }
?>
<div class="paypal_hide_show skt_donation_box skt_donation_form">
    <div class="fgrow">
        <label><?php echo esc_attr( get_option('skt_donation_stripe_type_of_payment_label') ); ?></label>
        <select id="skt_select_plan" name="select_plan">
            <option value="Daily"><?php esc_attr_e('Normal','skt-donation');?>
            </option>
            <option value="Weekly"><?php esc_attr_e('Subscription','skt-donation');?>
            </option>
        </select>
    </div>
    <div id="skt_change_event_one">
        <form id="skt_paypal-button-container" class="slt_form_horizontal">
            <?php if(esc_attr(get_option('skt_donation_first_name_show')) !="false"){ ?>
            <label><?php echo esc_attr( get_option('skt_donation_stripe_first_name_lable') ); ?></label>
            <input type="text" name="first_name"  id="skt_fname" placeholder="<?php echo esc_attr( get_option('skt_donation_stripe_first_name') ); ?>" value="" required></br></br>
            <?php } ?>
            <?php if(esc_attr(get_option('skt_donation_last_name_show')) !="false"){ ?>
            <label><?php echo esc_attr( get_option('skt_donation_stripe_last_name_lable') ); ?></label>
            <input type="text" name="last_name" id="skt_lname" placeholder="<?php echo esc_attr( get_option('skt_donation_stripe_last_name') ); ?>" value="" required></br></br>
            <?php }?>
            <?php if(esc_attr(get_option('skt_donation_email_show')) !="false"){ ?>
            <label><?php echo esc_attr( get_option('skt_donation_stripe_email_lable') ); ?></label>
            <input type="text" name="email" id="skt_email" placeholder="<?php echo esc_attr( get_option('skt_donation_stripe_email') ); ?>" value="" required></br></br>
            <?php } ?>
            <?php if(esc_attr(get_option('skt_donation_phone_show')) !="false"){ ?>
            <label><?php echo esc_attr( get_option('skt_donation_stripe_phone_name_lable') ); ?></label>
            <input type="text" name="phone" id="skt_phone" placeholder="<?php echo esc_attr( get_option('skt_donation_stripe_phone_name') ); ?>" value="" required></br></br>
            <?php } ?>
            <label><?php echo esc_attr( get_option('skt_donation_stripe_amount_lable') ); ?></label>
            <input type="text" name="donation_amount" id="skt_donation_amount" placeholder="<?php echo esc_attr( get_option('skt_donation_stripe_amount') ); ?>" value="<?php echo esc_attr($donation_amount);?>" required></br></br>
            <input type="hidden" name="payment_in_currency" value="<?php echo esc_attr($for_paypal_payment);?>">
            <input type="text" name="currency_sign" value="<?php echo esc_attr($for_paypal_sign);?>" readonly>
        </form> 
    </div>
    <div id="skt_change_event_two">
        <form class="slt_form_horizontal" method="post" action="">
            <?php if(esc_attr(get_option('skt_donation_first_name_show')) !="false"){ ?>
            <label><?php echo esc_attr( get_option('skt_donation_stripe_first_name_lable') ); ?></label>
            <input type="text" name="first_name" placeholder="<?php echo esc_attr( get_option('skt_donation_stripe_first_name') ); ?>" value="" required></br></br>
            <?php } ?>
            <?php if(esc_attr(get_option('skt_donation_last_name_show')) !="false"){ ?>
                <label><?php echo esc_attr( get_option('skt_donation_stripe_last_name_lable') ); ?></label>
            <input type="text" name="last_name" placeholder="<?php echo esc_attr( get_option('skt_donation_stripe_last_name') ); ?>" value="" required></br></br>
            <?php }?>
            <?php if(esc_attr(get_option('skt_donation_email_show')) !="false"){ ?>
                <label><?php echo esc_attr( get_option('skt_donation_stripe_email_lable') ); ?></label>
            <input type="email" name="email" placeholder="<?php echo esc_attr( get_option('skt_donation_stripe_email') ); ?>" value="" required></br></br>
            <?php } ?>
            <?php if(esc_attr(get_option('skt_donation_phone_show')) !="false"){ ?>
                <label><?php echo esc_attr( get_option('skt_donation_stripe_phone_name_lable') ); ?></label>
            <input type="text" name="phone" placeholder="<?php echo esc_attr( get_option('skt_donation_stripe_phone_name') ); ?>" value="" required></br></br>
            <?php } ?>
            <select name="paypal_recurring" required>
                <?php 
                    if(get_option('skt_donation_day_show')=="true"){ ?>
                        <option value="Daily"><?php esc_attr_e('Daily','skt-donation');?></option>
                   <?php }
                    if(get_option('skt_donation_week_show')=="true"){?>
                        <option value="Weekly"><?php esc_attr_e('Weekly','skt-donation');?></option>
                   <?php }
                    if(get_option('skt_donation_month_show')=="true"){?>
                        <option value="Month"><?php esc_attr_e('Monthly','skt-donation');?></option>
                   <?php }
                    if(get_option('skt_donation_annual_show')=="true"){?>
                        <option value="Yearly"><?php esc_attr_e('Yearly','skt-donation');?></option>
                    <?php } 
                ?>
            </select>
            <label><?php echo esc_attr( get_option('skt_donation_stripe_amount_lable') ); ?></label>
            <input type="text" name="donation_amount" id="skt_donation_amount2" placeholder="<?php echo esc_attr( get_option('skt_donation_stripe_amount') ); ?>" value="<?php echo esc_attr($donation_amount);?>" required></br></br>
            <?php wp_nonce_field( 'paypal_subscriptionnormal', 'add_paypal_nonce' ); ?>
            <input type="hidden" name="payment_in_currency" value="<?php echo esc_attr($for_paypal_payment);?>">
            <input type="text" name="currency_sign" value="<?php echo esc_attr($for_paypal_sign);?>" readonly>
            <input type="hidden" name="page_id" value="<?php echo esc_attr($page_id);?>"/>
            <input type="hidden" name="paypal_mode_subscription" value="paypal_mode">
            <input type="submit" name="submit" value="<?php esc_attr_e('Submit','skt-donation');?>" class="button">
        </form> 
    </div>
</div>
<!-- Latest compiled JavaScript -->
<?php 
$page_id = get_queried_object_id();
$current_url =  get_site_url().'/?page_id='.$page_id; 
?>
<!--************* END FOR PAYPAL INTEGRATION JAVASCRIPT CODE *************-->
<script type="text/javascript">
jQuery(document).ready(function() {
    var selected_paypal = "selected";
    if(selected_paypal =="selected"){
        jQuery("#skt_change_event_two").hide();
        jQuery("#skt_change_event_one").show();
    }
    jQuery('#skt_select_plan').on('change', function() {
        if (this.value === 'Daily') {
            jQuery("#skt_change_event_two").hide();
            jQuery("#skt_change_event_one").show();
        } else if (this.value === 'Weekly') {
            jQuery("#skt_change_event_one").hide();
            jQuery("#skt_change_event_two").show();
        }
    });
});
</script> 
<!--************* START FOR PAYPAL INTEGRATION JAVASCRIPT CODE *************-->
<script src="<?php echo esc_url('https://www.paypalobjects.com/api/checkout.js');?>"></script>
<script type="text/javascript">
    var mode_of_paypal = "simple_paypal";
    var request_url = "<?php echo esc_attr($page_id);?>";
    var paypal_test_api = "<?php echo esc_attr($paypal_test_api);?>";
    var paypal_live_api = "<?php echo esc_attr($paypal_live_api);?>";
    var env_production_sandbox = "<?php echo esc_attr($env_production_sandbox); ?>";
    var for_paypal_payment = "<?php echo esc_attr($for_paypal_payment); ?>";
    var return_url = "<?php echo esc_url($current_url);?>";
    paypal.Button.render({
        env: env_production_sandbox, // sandbox | production
        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create
        client: {
            sandbox: paypal_test_api,
            production: paypal_live_api
        },
        // Show the buyer a 'Pay Now' button in the checkout flow
        commit: true,
        // payment() is called when the button is clicked
        payment: function(data, actions) {
            var donation_amount =jQuery("#skt_donation_amount").val();
            // Make a call to the REST api to create the payment
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: donation_amount, currency: for_paypal_payment }
                        }
                    ]
                }
            });
        },
        // onAuthorize() is called when the buyer approves the payment
        onAuthorize: function(data, actions) {  
            var first_name = jQuery("#skt_fname").val(); 
            var last_name = jQuery("#skt_lname").val();
            var email = jQuery('#skt_email').val();
            var phone = jQuery("#skt_phone").val();
            var donation_amount = jQuery("#skt_donation_amount").val();
            var request_url = "<?php echo esc_attr($page_id);?>";
            // Make a call to the REST api to execute the payment
            return actions.payment.execute().then(function() {
                window.location = return_url+"&paymentID="+data.paymentID+"&payerID="+data.payerID+"&token="+data.paymentToken+"&donation_amount="+donation_amount+"&request_url="+request_url+"&first_name="+first_name+"&last_name="+last_name+"&email="+email+"&phone="+phone+"&mode_of_paypal="+mode_of_paypal;
            });
        }
    }, '#skt_paypal-button-container');
</script>