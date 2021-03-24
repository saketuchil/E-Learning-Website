<?php

require('config.php');
require('razorpay-php/Razorpay.php');

// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt'         => 3456,
    'amount'          => $total * 100, // 1000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}
$oid=00000;

require_once("DbInit.php");
$dbins = new DbInit();

$conn = $dbins->getConnection();

// Make sure we connected successfully
if(! $conn)
{
    die('Connection Failed'.mysql_error());
}// Selecting Database from Server


//Insert Query of SQL

$sql = "INSERT INTO `orders`(`user_id`,`raz_id`) VALUES (".$_SESSION['userid'].",'".$_SESSION['razorpay_order_id']."')";

if ($conn->query($sql) > 0)
{
    // Make sure we connected successfully
    if(! $conn)
    {
        die('Connection Failed'.mysql_error());
    }
    $sql = "SELECT * FROM orders WHERE user_id=".$_SESSION['userid']." AND raz_id='".$_SESSION['razorpay_order_id']."'";
        $result = $conn->query($sql);        
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) {
                $oid=$row['id'];
            }
        } 
}

if(! $conn)
{
    die('Connection Failed'.mysql_error());
}
// $sql = "UPDATE cart SET ord_id=".$oid." WHERE user_id=".$_SESSION['id']." AND checkout=0";
if ($conn->query($sql) == TRUE)
{

}
else {
}
$conn->close();

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "ZEAL",
    "description"       => "Order Payment",
    "prefill"           => [
    "name"              => $_SESSION['user']['name'],
    "contact"           => $_SESSION['user']['contact'],
    ],
    "notes"             => [
    "merchant_order_id" => $oid,
    ],
    "theme"             => [
    "color"             => "#f23c48"
    ],
    "order_id"          => $razorpayOrderId,];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

require("paybutton.php");
