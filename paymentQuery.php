  <?php

  $consumerKey = 'ZLUcK8SxpZ5m3v16wGG7lURSyA0FEHtj'; //Fill with your app Consumer Key
  $consumerSecret = 'QrYZiSAqd8ceeKdY'; // Fill with your app Secret
  $headers = ['Content-Type:application/json; charset=utf8'];
  $access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $curl = curl_init($access_token_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;
//  echo $access_token;

  curl_close($curl);

  $BusinessShortCode = 174379;
  $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);
  $Timestamp = date('YmdHis'); 
  $CheckoutRequestID = 01;
  $Passkey = '233a74d185676294dedc53cb86622896f3c02b9c659465582bcda7f88a73c1b5';



  $Query_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
  
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $Query_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header
  
  
  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'CheckoutRequestID' => $CheckoutRequestID
  );
  
  $data_string = json_encode($curl_post_data);
  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  
  $curl_response = curl_exec($curl);
  print_r($curl_response);
  
  echo $curl_response;
  ?>
  