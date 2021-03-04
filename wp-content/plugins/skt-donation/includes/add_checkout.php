<?php
if ( ! function_exists ( 'skt_donation_twocheckout_function' ) ) {
  function skt_donation_twocheckout_function(){

    if ( !isset( $_POST['add_checkoutnonce'] ) || !wp_verify_nonce($_POST['add_checkoutnonce'], 'twocheckout_nonce' ) ){    
    }else{

      global $wpdb;
      include_once( SKT_DONATIONS_DIR .'/payment-method/twocheckout/lib/Twocheckout.php');
      // Your sellerId(account number) and privateKey are required to make the Payment API Authorization call.
      if(esc_attr(get_option('skt_donation_twocheck_mode_zero_one') == 'true' )){
        $production_sandbox = "sandbox";
        $tc_sellerid = esc_attr(get_option('skt_donation_twocheck_sellerid_one'));
        $tc_username = esc_attr(get_option('skt_donation_twocheck_username'));
        $tc_password = esc_attr(get_option('skt_donation_twocheck_password'));
        $tc_publish_key = esc_attr(get_option('skt_donation_twocheck_test_publish_key'));
        $tc_private_key = esc_attr(get_option('skt_donation_twocheck_test_private_key'));
      }else{
        $production_sandbox = "production";
        $tc_sellerid = esc_attr(get_option('skt_donation_twocheck_sellerid_one'));
        $tc_username = esc_attr(get_option('skt_donation_twocheck_username'));
        $tc_password = esc_attr(get_option('skt_donation_twocheck_password'));
        $tc_publish_key = esc_attr(get_option('skt_donation_twocheck_live_publish_key'));
        $tc_private_key = esc_attr(get_option('skt_donation_twocheck_live_private_key'));
      }
      Twocheckout::privateKey($tc_private_key);
      Twocheckout::sellerId($tc_sellerid);
      // Your username and password are required to make any Admin API call.
      Twocheckout::username($tc_username);
      Twocheckout::password($tc_password);
      // If you want to turn off SSL verification (Please don't do this in your production environment)
      Twocheckout::verifySSL(false);  // this is set to true by default
      // To use your sandbox account set sandbox to true
      Twocheckout::sandbox(true);
      // All methods return an Array by default or you can set the format to 'json' to get a JSON response.
      Twocheckout::format('json');
      $site_website_name = get_bloginfo( 'name' );
      if((isset($_POST['mode'])) && (!empty($_POST['mode']))){
        $current_date = date('Y-m-d');
        $page_id = sanitize_text_field($_POST['page_id']);
        $mode_checkout = sanitize_text_field($_POST['mode_checkout']);
        $mode = sanitize_text_field($_POST['mode']);
        $twocheckout_recurring = sanitize_text_field($_POST['twocheckout_recurring']);
        $twocheckout_normal_subscription = sanitize_text_field($_POST['twocheckout_normal_subscription']);
        $twocheckout_first_name = sanitize_text_field($_POST['twocheckout_first_name']);
        $twocheckout_last_name = sanitize_text_field($_POST['twocheckout_last_name']);
        $twocheckout_email = sanitize_email($_POST['twocheckout_email']);
        $twocheckout_phone = sanitize_text_field($_POST['twocheckout_phone']);
        $twocheck_amount = sanitize_text_field($_POST['donation_amount']);
        $twocheckout_fullname = $twocheckout_first_name.' '.$twocheckout_last_name;
        $twocheckout_address = sanitize_text_field($_POST['twocheckout_address']);
        $twocheckout_city = sanitize_text_field($_POST['twocheckout_city']);
        $twocheckout_state = sanitize_text_field($_POST['twocheckout_state']);
        $twocheckout_zipCode = sanitize_text_field($_POST['twocheckout_zipCode']);
        $twocheckout_country = sanitize_text_field($_POST['twocheckout_country']);
        $payment_in_currency = sanitize_text_field($_POST['payment_in_currency']);
        if($twocheckout_email==""){
          $errorMessages ="Email is incorrect";
          $path_name = get_site_url().'/?page_id='.$page_id.'&payment_fail='.$errorMessages.'&payment_gatway=payment_fail&payment_gatway_result=result';
          echo '<script>window.location = "'.$path_name.'";</script>';
          exit();
        }
        if($twocheckout_recurring=="1 Week"){
          $duration_of_subscription ="daily";
        }elseif($twocheckout_recurring=="1 Week"){
          $duration_of_subscription ="week";
        }elseif($twocheckout_recurring=="1 Month"){
          $duration_of_subscription ="month";
        }elseif($twocheckout_recurring=="6 Month"){
          $duration_of_subscription ="six month";
        }else{
          $duration_of_subscription ="year";
        }
      }
      if((isset($_POST['token'])) && (!empty($_POST['token']))){
        if ($twocheckout_normal_subscription=="subcribe") {
          if ($mode=="twocheckout") {
            try {
                $charge = Twocheckout_Charge::auth(array(
                    "merchantOrderId" => "412123",
                    "token" => sanitize_text_field($_POST['token']),
                    "currency" => $payment_in_currency,
                    "billingAddr" => array(
                        "name" => $twocheckout_fullname,
                        "addrLine1" => $twocheckout_address,
                        "city" => $twocheckout_city,
                        "state" => $twocheckout_state,
                        "zipCode" => $twocheckout_zipCode,
                        "country" => $twocheckout_country,
                        "email" => $twocheckout_email,
                        "phoneNumber" => $twocheckout_phone
                    ),
                    "lineItems" => array(array(
                        "type" => $site_website_name,
                        "price" => $twocheck_amount,
                        "name" => $twocheckout_fullname,
                        "quantity" => "1",
                        "tangible" => "N",
                        "recurrence" => $twocheckout_recurring,
                    ))
                ), 'array');

                    $table_name = $wpdb->prefix ."skt_donation_amount"; 
                    $data_donation_amt = array(
                      'customer_firstname' => $twocheckout_first_name,
                      'customer_lastname' => $twocheckout_last_name,
                      'customer_email' => $twocheckout_email,
                      'customer_phone' => $twocheckout_phone,
                      'mode' => $mode,
                      'status' => 'paid',
                      'twocheckout_token' => sanitize_text_field($_POST['token']),
                      'donation_amount' => $twocheck_amount,
                      'payment_date' => $current_date,
                      'subscription_normal'=>'subscriptions',
                      'duration_of_subscription'=>$duration_of_subscription
                    );
                    $insert_data = $wpdb->insert( $table_name, $data_donation_amt );
                    if($insert_data){
                      /*********Email functiion start here*****/
                      $admin_email_address = esc_attr( get_option('skt_donation_skt_email_address') );
                      $email_subject = esc_attr( get_option('skt_donation_skt_email_subject') );
                      $email_message = esc_attr( get_option('skt_donation_skt_email_message') );
                      $to = $twocheckout_email;
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
                      $checkout_msg =  "Payment Sucessfully Completed.";
                      $path_name = get_site_url().'/?page_id='.$page_id.'&payment_result_success='.$checkout_msg.'&payment_gatway=payment_success&payment_gatway_result=result';
                      echo '<script>window.location = "'.$path_name.'";</script>';
                    }
              } catch (Twocheckout_Error $e) {
                $errorMessages = $e->getMessage();
                $path_name = get_site_url().'/?page_id='.$page_id.'&payment_fail='.$errorMessages.'&payment_gatway=payment_fail&payment_gatway_result=result';
               echo '<script>window.location = "'.$path_name.'";</script>';
            }
          } 
        }else{
            try {
              $charge = Twocheckout_Charge::auth(array(
                  "merchantOrderId" => "123",
                  "token" => sanitize_text_field($_POST['token']),
                  "currency" => $payment_in_currency,
                  "total" => $twocheck_amount,
                  "billingAddr" => array(
                      "name" => $twocheckout_fullname,
                      "addrLine1" => $twocheckout_address,
                      "city" => $twocheckout_city,
                      "state" => $twocheckout_state,
                      "zipCode" => $twocheckout_zipCode,
                      "country" => $twocheckout_country,
                      "email" => $twocheckout_email,
                      "phoneNumber" => $twocheckout_phone
                  ),
              ), 'array');

                    $table_name = $wpdb->prefix ."skt_donation_amount"; 
                    $data_donation_amt = array(
                      'customer_firstname' => $twocheckout_first_name,
                      'customer_lastname' => $twocheckout_last_name,
                      'customer_email' => $twocheckout_email,
                      'customer_phone' => $twocheckout_phone,
                      'mode' => $mode,
                      'status' => 'paid',
                      'twocheckout_token' => sanitize_text_field($_POST['token']),
                      'donation_amount' => $twocheck_amount,
                      'payment_date' => $current_date
                    );
                    $insert_data = $wpdb->insert( $table_name, $data_donation_amt );
                    if($insert_data){
                      /*********Email functiion start here*****/
                      $admin_email_address = esc_attr( get_option('skt_donation_skt_email_address') );
                      $email_subject = esc_attr( get_option('skt_donation_skt_email_subject') );
                      $email_message = esc_attr( get_option('skt_donation_skt_email_message') );
                      $to = $twocheckout_email;
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
                      $checkout_msg = "Payment Sucessfully Completed.";
                      $path_name =get_site_url().'/?page_id='.$page_id.'&payment_result_success='.$checkout_msg.'&payment_gatway=payment_success&payment_gatway_result=result';
                      echo '<script>window.location = "'.$path_name.'";</script>';
                    }
          } catch (Twocheckout_Error $e) {
            $errorMessages = $e->getMessage();
            $path_name =get_site_url().'/?page_id='.$page_id.'&payment_fail='.$errorMessages.'&payment_gatway=payment_fail&payment_gatway_result=result';
                echo '<script>window.location = "'.$path_name.'";</script>';
          }
        }
      }
    }
  }
}
?>