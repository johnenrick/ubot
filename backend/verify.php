<?php
header('Content-type: application/json');

include 'db/config.php';

date_default_timezone_set('Asia/Manila');

$ref_id = $_GET['ref'];

$updated_at = date('Y-m-d H:i:s');

$result = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE ref_id = '$ref_id' LIMIT 1"));

if ($result) {

	echo json_encode(array("result" => "true"));

    mysql_query("UPDATE accounts SET status = 'done', updated_at = '$updated_at' WHERE ref_id = '$ref_id' LIMIT 1");

    $postURL  = "https://api.chatfuel.com/bots/";
    $bot_id   = "59698492e4b0fc76d43c4d6e";
    $user_id  = "1354392321342820";
    $token    = "mELtlMAHYqR0BvgEiMq8zVek3uYUK3OJMbtyrdNPTrQB9ndV0fM7lWTFZbM4MZvD";
    $block_id = "5969dc6fe4b0fc76d6300db6";

    $ch = curl_init($postURL . $bot_id . '/users/' . $user_id . '/send?chatfuel_token=' . $token . '&chatfuel_block_id=' . $block_id);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_exec($ch);
    curl_close($ch);

} else {

	echo json_encode(array("result" => "false"));

}
