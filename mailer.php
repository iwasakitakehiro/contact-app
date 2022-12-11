<?php
//  get raw data from the request 
$json = file_get_contents('php://input');
// Converts json data into a PHP object 
$data = json_decode($json, true);
$client_name = 'たけひろのホームページ'
$client_address = "info@iwasakitakehiro.net";


$message = <<<EOT
■ お名前
  $data[name]

■ ふりがな


■ ご住所


■ 電話番号


■ メールアドレス


■ お問い合わせ内容

EOT;
    $client_message = <<<EOT

ホームページからお問い合わせがありました。
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

$message

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
$home_url
EOT;


$user_message = <<<EOT

$items[name] 様

このたびは、 $client_name にお問い合わせいただき、ありがとうございます。
近日担当者よりご連絡を差し上げますので、しばらくお待ちくださいませ。


◆お客さま情報◆
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

$message

◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆

$client_name

〒270-2232
千葉県松戸市和名ヶ谷547-10

URL https://sun-rise.biz/

◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆
EOT;
mb_language("japanese");
mb_internal_encoding("UTF-8");
mb_convert_encoding($client_address, "UTF-8");
mb_convert_encoding($client_message, "UTF-8");
$user_message = mb_convert_encoding($user_message, "UTF-8");

if (!mb_send_mail($client_address, "ホームページよりお問い合わせがありました", $client_message, "From: " . $client_address)) {
    exit("e");
}
if (!mb_send_mail($items['mail01'], "お問い合わせありがとうございました", $user_message, "From:" . mb_encode_mimeheader($client_name) . "<" . $client_address . ">")) {
    exit("e");
}

exit;