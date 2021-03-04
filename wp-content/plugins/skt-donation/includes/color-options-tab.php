<?php
  function sktdonation_color_optiontab(){
?>
<div id="skt-donations-tab-2" class="skt-donations-tab-content <?php if ( esc_attr(get_option('skt_donation_active_tab') == 'tab2' ) ) { ?> skt-donations-current <?php } ?>">
  <table class="skt-donations-form">
    <!--PayPal Form Start Here-->
    <tr>
      <td><h3><?php esc_attr_e('Default Gateway:','skt-donation');?></h3></td>
      <td> 
        <select name="skt_donation_default_gateway" id="skt_payment_gateway_id">
          <?php if ( esc_attr(get_option('skt_donation_paypal_active_show') == 'false' ) ) { ?>
            <option value="payPal" <?php if ( esc_attr(get_option('skt_donation_default_gateway') == 'payPal' ) ) { ?> selected <?php } ?>><?php esc_attr_e('PayPal','skt-donation');?></option>
          <?php }?>
          <?php if ( esc_attr(get_option('skt_donation_twocheck_active_dactive') == 'false' ) ) { ?>
          <option value="twoheckout" <?php if ( esc_attr(get_option('skt_donation_default_gateway') == 'twoheckout' ) ) { ?> selected <?php } ?>><?php esc_attr_e('2Checkout','skt-donation');?></option>
          <?php }?>
        </select>
      </td>
    </tr>
    <tr>
      <td><h3><?php esc_attr_e('Donation Amount :','skt-donation');?></h3></td>
      <td> 
        <input type="text" name="skt_donation_amount_in_usd" value="<?php echo esc_attr( get_option('skt_donation_amount_in_usd') ); ?>">
      </td>
    </tr>
    </table>
    <div class="skt-donation-accordion">
    <div class="skt-donation-accordion-tab">
      <input type="checkbox" class="skt_activate" id="accordion-1" name="accordion-1">
      <label for="accordion-1" class="skt-donation-accordion-title"><?php esc_attr_e('PayPal','skt-donation');?></label>
      <div class="skt-donation-accordion-content">
          <div class="skt_donation_payment_gateway">
            <span> <?php esc_attr_e('PayPal Activate/Deactivate :','skt-donation');?> </span>
            <span> 
              <input id="radio_paypal" type="radio" name="skt_donation_paypal_active_show" value="true" <?php if ( esc_attr(get_option('skt_donation_paypal_active_show') == 'true' ) || esc_attr(get_option('skt_donation_paypal_active_show') == '' ) ) { ?> checked <?php } ?>><?php esc_attr_e('Deactivate','skt-donation');?>
              <input type="radio" name="skt_donation_paypal_active_show" value="false"  <?php if ( esc_attr(get_option('skt_donation_paypal_active_show') == 'false' ) ) { ?> checked <?php } ?>><?php esc_attr_e('Activate','skt-donation');?>
            </span>
          </div>
          <div class="skt_donation_payment_gateway">
            <span><?php esc_attr_e('Mode:','skt-donation');?></span>
            <span>
              <select id="paypay_event_radio_paypal" name="skt_donation_paypal_mode_zero_one">
                <option <?php if ( esc_attr(get_option('skt_donation_paypal_mode_zero_one') == 'true' ) ) { ?> selected <?php } ?> value="true"><?php esc_attr_e('Sandbox','skt-donation');?></option>

                <option <?php if ( esc_attr(get_option('skt_donation_paypal_mode_zero_one') == 'false' ) ) { ?> selected <?php } ?> value="false"><?php esc_attr_e('Live','skt-donation');?></option>

              </select>
            </span>
          </div>
          <div id="skt_change_paypal_one">
            <div class="skt_donation_payment_gateway">
              <span><?php esc_attr_e('Sandbox API:','skt-donation');?> </span>
              <span><input type="text" name="skt_donation_paypal_test_api" placeholder="<?php esc_attr_e('Enter Sandbox API','skt-donation');?>" value="<?php echo esc_attr( get_option('skt_donation_paypal_test_api') ); ?>" /> </span>
            </div>
            <div>
              <span><?php esc_attr_e('Sandbox PayPal Business Email:','skt-donation');?></span>
              <span><input type="text" name="skt_donation_test_paypal_business_email" placeholder="<?php esc_attr_e('Enter Sandbox PayPal Business Email','skt-donation');?>" value="<?php echo esc_attr( get_option('skt_donation_test_paypal_business_email') ); ?>" /> </span>
            </div>
             <a href="<?php echo esc_url('https://www.sandbox.paypal.com/us/signin');?>" class="button" target="blank"><?php esc_attr_e('Click Here To Generate Paypal Sandbox API Key','skt-donation');?></a>
          </div>
          <div id="skt_change_paypal_two">
            <div class="skt_donation_payment_gateway">
              <span class="skt_donation_payment_gateway_passage"><?php esc_attr_e('Live API:','skt-donation');?></span>
              <span class="skt_donation_payment_gateway_input">
                <input type="text" name="skt_donation_paypal_live_api" placeholder="<?php esc_attr_e('Enter Live API','skt-donation');?>" value="<?php echo esc_attr( get_option('skt_donation_paypal_live_api') ); ?>" /> </span>
            </div>
            <div class="skt_donation_payment_gateway">
              <span class="skt_donation_payment_gateway_passage"><?php esc_attr_e('Live PayPal Business Email:','skt-donation');?></span>
              <span class="skt_donation_payment_gateway_input"><input type="text" name="skt_donation_live_paypal_business_email" placeholder="<?php esc_attr_e('Enter Live PayPal Business Email','skt-donation');?>" value="<?php echo esc_attr( get_option('skt_donation_live_paypal_business_email') ); ?>" /> </span>
            </div>
            <a href="<?php echo esc_url('https://www.paypal.com/signin?returnUri=https%3A%2F%2Fdeveloper.paypal.com%2Fdeveloper%2Fapplications');?>" class="button" target="blank"><?php esc_attr_e('Click Here To Generate Paypal Live API Key','skt-donation');?></a>
          </div>
      </div>
    </div>
    <!--PayPal Form End Here-->
    <!--2Checkout form start here-->
    <div class="skt-donation-accordion-tab">
      <input type="checkbox" class="skt_activate" id="accordion-3" name="accordion-3">
      <label for="accordion-3" class="skt-donation-accordion-title"><?php esc_attr_e('2Checkout','skt-donation');?></label>
      <div class="skt-donation-accordion-content">
      <table class="skt-donations-form">
        <div class="skt_donation_payment_gateway">
          <span><?php esc_attr_e('2Checkout Activate/Deactivate :','skt-donation');?></span>
          <span>
            <input id="radio_checkout" type="radio" name="skt_donation_twocheck_active_dactive" value="true" <?php if ( esc_attr(get_option('skt_donation_twocheck_active_dactive') == 'true' )|| esc_attr(get_option('skt_donation_twocheck_active_dactive') == '' ) ) { ?> checked <?php } ?>><?php esc_attr_e('Deactivate','skt-donation');?>
            <input type="radio" name="skt_donation_twocheck_active_dactive" value="false"  <?php if ( esc_attr(get_option('skt_donation_twocheck_active_dactive') == 'false' ) ) { ?> checked <?php } ?>><?php esc_attr_e('Activate','skt-donation');?>
          </span>
        </div>
        <div class="skt_donation_payment_gateway">
          <span><?php esc_attr_e('Mode:','skt-donation');?></span>
          <span>
            <select id="skt_donation_twocheckout_change" name="skt_donation_twocheck_mode_zero_one">
              <option <?php if ( esc_attr(get_option('skt_donation_twocheck_mode_zero_one') == 'true' ) ) { ?> selected <?php } ?> value="true"><?php esc_attr_e('Sandbox','skt-donation');?></option>
              <option <?php if ( esc_attr(get_option('skt_donation_twocheck_mode_zero_one') == 'false' ) ) { ?> selected <?php } ?> value="false"><?php esc_attr_e('Live','skt-donation');?></option>
            </select>
          </span>
        </div>
        <div class="skt_donation_payment_gateway">
          <span><?php esc_attr_e('Sellerid/Account Number:','skt-donation');?></span>
          <span>
            <input type="text" name="skt_donation_twocheck_sellerid_one" placeholder="<?php esc_attr_e('Enter Seller Id/Account Name','skt-donation');?>" value="<?php echo esc_attr( get_option('skt_donation_twocheck_sellerid_one') ); ?>" />
          </span>
        </div>
        <div class="skt_donation_payment_gateway">
          <span><?php esc_attr_e('Username','skt-donation');?></span>
          <span>
            <input type="text" name="skt_donation_twocheck_username" placeholder="<?php esc_attr_e('Enter Username','skt-donation');?>" value="<?php echo esc_attr( get_option('skt_donation_twocheck_username') );?>" />
          </span>
        </div>
        <div class="skt_donation_payment_gateway">
          <span><?php esc_attr_e('Password:','skt-donation');?></span>
          <span>
            <input type="text" name="skt_donation_twocheck_password" placeholder="<?php esc_attr_e('Enter Password:','skt-donation');?>" value="<?php echo esc_attr( get_option('skt_donation_twocheck_password') ); ?>" />
          </span>
        </div>
      <div id="skt_change_twocheck_one">
        <div class="skt_donation_payment_gateway">
          <span><?php esc_attr_e('Sandbox Publishable Key:','skt-donation');?></span>
          <span><input type="text" name="skt_donation_twocheck_test_publish_key" placeholder="<?php esc_attr_e('Enter Sandbox Publishable Key','skt-donation');?>" value="<?php echo esc_attr( get_option('skt_donation_twocheck_test_publish_key') ); ?>" /></span>
        </div>
        <div class="skt_donation_payment_gateway">
          <span><?php esc_attr_e('Sandbox Private Key:','skt-donation');?></span>
          <span><input type="text" name="skt_donation_twocheck_test_private_key" placeholder="<?php esc_attr_e('Enter Sandbox Private Key','skt-donation');?>" value="<?php echo esc_attr( get_option('skt_donation_twocheck_test_private_key') ); ?>" /></span>
        </div>
        <a href="<?php echo esc_url('https://sandbox.2checkout.com/sandbox');?>" class="button" target="blank"><?php esc_attr_e('Click Here To Generate 2Checkout Sandbox API Keyx Private Key','skt-donation');?></a>
      </div>
      <div id="skt_change_twocheck_two">
        <div class="skt_donation_payment_gateway">
          <span><?php esc_attr_e('Live Publishable Key:','skt-donation');?></span>
          <span><input type="text" name="skt_donation_twocheck_live_publish_key" placeholder="<?php esc_attr_e('Enter Live Publishable Key','skt-donation');?>" value="<?php echo esc_attr( get_option('skt_donation_twocheck_live_publish_key') ); ?>" /></span>
        </div>
        <div class="skt_donation_payment_gateway">
          <span><?php esc_attr_e('Live Private Key:','skt-donation');?> </span>
          <span><input type="text" name="skt_donation_twocheck_live_private_key" placeholder="<?php esc_attr_e('Enter Live Publishable Key','skt-donation');?>" value="<?php echo esc_attr( get_option('skt_donation_twocheck_live_private_key') ); ?>" /></span>
        </div>
        <a href="<?php echo esc_url('https://www.2checkout.com/payment-api/');?>" class="button" target="blank"><?php esc_attr_e('Click Here To Generate 2Checkout Live API Key','skt-donation');?></a>
      </div>
    </table>
    </div>
    </div>
    <!--2Checkout form end here-->
</div>
</div>
<script type="text/javascript">
  jQuery(document).ready(function() {
    var get_paypal_selected = "<?php echo esc_attr(get_option('skt_donation_paypal_mode_zero_one'));?>";
    if(get_paypal_selected=='true'){
      jQuery("#skt_change_paypal_two").hide();
      jQuery("#skt_change_paypal_one").show();
    }else{
      jQuery("#skt_change_paypal_one").hide();
      jQuery("#skt_change_paypal_two").show();
    }
    jQuery('#paypay_event_radio_paypal').on('change', function() {
      if (this.value === 'true') {
        jQuery("#skt_change_paypal_two").hide();
        jQuery("#skt_change_paypal_one").show();
      } else if (this.value === 'false') {
        jQuery("#skt_change_paypal_one").hide();
        jQuery("#skt_change_paypal_two").show();
      }
    });
    // For 2Checkout Change event
    var get_twocheck_selected = "<?php echo esc_attr(get_option('skt_donation_twocheck_mode_zero_one'));?>"
    if(get_twocheck_selected=='true'){
      jQuery("#skt_change_twocheck_two").hide();
      jQuery("#skt_change_twocheck_one").show();
    }else{
      jQuery("#skt_change_twocheck_one").hide();
      jQuery("#skt_change_twocheck_two").show();
    }
    jQuery('#skt_donation_twocheckout_change').on('change', function() {
      if (this.value === 'true') {
        jQuery("#skt_change_twocheck_two").hide();
        jQuery("#skt_change_twocheck_one").show();
      } else if (this.value === 'false') {
        jQuery("#skt_change_twocheck_one").hide();
        jQuery("#skt_change_twocheck_two").show();
      }
    });
  });
  jQuery(document).ready(function(){
    var payment_gateway_id = document.getElementById("skt_payment_gateway_id");
    var payment_gateway_id_value = payment_gateway_id.options[payment_gateway_id.selectedIndex].value;
    jQuery("#radio_paypal").click(function(){
      var check_paypal = "payPal";
      if(payment_gateway_id_value==check_paypal){
        alert("Please Change the default payment gateway");
      }
    });
    jQuery("#radio_checkout").click(function(){
      var check_twoheckout = "twoheckout";
      if(payment_gateway_id_value==check_twoheckout){
        alert("Please Change the default payment gateway");
      }
    });
  });
</script>
<?php } 
  $sktdonation_color_optiontab =sktdonation_color_optiontab();
?>