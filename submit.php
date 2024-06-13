<?php

if (session_id() === "") {
    session_start();
}
?>

<?php


?>


<?php
//$priceSum = $_SESSION['priceSum'];
if (!$priceSum) {
    echo "<h4>Order Already Submitted</h4>";
    exit;
}


//print_r('hi g this is submit.php ');
//check whether stripe token is not empty
if(!empty($_SESSION['stripeToken'])){
    //print_r("theres a token");
    //get token, card and user info from the form
    $token  = $_SESSION['stripeToken'];
    $name = $_SESSION['Name'];
    $email = $_SESSION['Email'];
    $card_num = $_SESSION['card_num'];
    $card_cvc = $_SESSION['cvc'];
    $card_exp_month = $_SESSION['exp_month'];
    $card_exp_year = $_SESSION['exp_year'];
    
    //include Stripe PHP library
    require_once("stripe-php/init.php");
    //set api key
    $stripeKeys = array(
      "secret_key"      =>                                                                                                  "sk_test_51K3FIuE3QizePBpfyEYIPLUGt4kqRbUevD9RIEd90UEt3kfEfEFtkaaaHxviH9bUD6dcdjiMs2FlyWLZYUm8cvvP00sUxEkJaN",
      "publishable_key" =>                                                                                                  "pk_test_51K3FIuE3QizePBpf0DwNYsjqAhY6Y2NvKLarC75WS3mzNU4rkpoFnMhzyEaFfCcAk31NIEFap3xBDCDX4rP9nU0P00dXSf5sb7"
    );

    \Stripe\Stripe::setApiKey($stripeKeys['secret_key']);
    
    
   $stripe = new \Stripe\StripeClient(
        $stripeKeys['secret_key']
    );
    
    
    $priceDollars = intval($priceSum);
    $priceCents = $priceSum - $priceDollars;
    $priceCents = round($priceCents, 2);
    $priceCents = substr((string)$priceCents, 2);
    //print_r("$priceDollars and $priceCents");
    $priceDollars=(string)$priceDollars;
    $priceCents=(string)$priceCents;
    $price = $priceDollars.$priceCents;
    $price = (int)$price;
    
    /**
     * echo "<h2> price sum = $priceSum</h2><br>";
    echo "<h2> price = $price</h2>";
    $sessionPrice = $_SESSION['priceSum'];
    echo "<h2> session price = $sessionPrice </h2>";
    */
    
    //$chargePrice = (intval)$priceSum;

$charge = \Stripe\Charge::create([
  'amount' => $price,
  'currency' => 'aud',
  'description' => 'Example charge',
  'source' => $token,
]);
//print_r("Charge created. Amount: {$charge['amount']} {$charge['currency']}");
    
    
    //check payment status
    //include("webhook.php");



    $status = $charge['status'];

    echo $status;




    $itemName = "CHANGE THIS TO BE AN ITEM LIST";
    $itemNumber = 1234;
    
    
    
    
    //print_r($charge);
    
    //echo "<br>";
    
    

    //check whether the charge is successful
    if($charge['amount_refunded'] == 0 && empty($charge
['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1){

        //order details 
        $amount = $charge['amount'];
        $balance_transaction = $charge['balance_transaction'];
        $currency = $charge['currency'];
        $date = date("Y-m-d H:i:s");
        
        //include database config file
        include_once("htaccess/databaseconnect.php");

        //insert tansaction data into the database
        $sql = 
"INSERT INTO orders(name,email,card_num,card_cvc,card_exp_month,card_exp_year,
item_name,item_number,item_price,item_price_currency,paid_amount,
paid_amount_currency,txn_id,payment_status,created,modified) VALUES
('".$name."','".$email."',".$card_num.",".$card_cvc.",".$card_exp_month.",
".$card_exp_year.",'".$itemName."','".$itemNumber."',".$price.",'".$currency."',
".$amount.",'".$currency."','".$balance_transaction."'
,'".$status."','".$date."','".$date."')";

        $insert = $conn->query($sql);
        $last_insert_id = $conn->insert_id;
        
        //if order inserted successfully
        if($last_insert_id && $status == 'succeeded'){
            $statusMsg = "<h2>Transaction Successful.</h2>
            <h4>Amount Paid = ".'$'."$priceSum AUD</h4>
            <h4>Order ID: {$last_insert_id}</h4>";




            //include("sendOrderToMe.php");








            
            //CLear from session
            unset($priceSum);
            echo "<script>window.sessionStorage.removeItem('cart');</script>";
        }else{
            $statusMsg = "Payment worked, but error inserting into database";
        }
    }else{
        $statusMsg = "Transaction has failed";
    }
}else{
    $statusMsg = "Form submission error.......";
}

//show success or error message
echo $statusMsg;