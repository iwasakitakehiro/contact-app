<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type: application/json; charset=UTF-8");
//  get raw data from the request 
$json = file_get_contents('php://input');
// Converts json data into a PHP object 
$data = json_decode($json, true);
$client_name = '株式会社ヒューマンシスコム';
$client_address = "info@iwasakitakehiro.net";


$message = <<<EOT
■ お名前
  $data[name]

■ ふりがな
  $data[ruby]

■ ご住所
  $data[address]

■ 電話番号
  $data[tel]

■ メールアドレス
$data[email]

■ お問い合わせ内容
  $data[note]
EOT;
$client_message = <<<EOT

ホームページからお問い合わせがありました。
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

$message

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
$home_url
EOT;


$user_message = <<<EOT

$data[name] 様

このたびは、 $client_name にお問い合わせいただき、ありがとうございます。
近日担当者よりご連絡を差し上げますので、しばらくお待ちくださいませ。


◆お客さま情報◆
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

$message

◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆

$client_name

〒000-0000
千葉県千葉市美浜区

URL https://www.humansyscom.jp/

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
if (!mb_send_mail($data['email'], "お問い合わせありがとうございました", $user_message, "From:" . mb_encode_mimeheader($client_name) . "<" . $client_address . ">")) {
  exit("e");
}

exit;
