<?php
header('Content-type: application/json');

include 'db/config.php';

date_default_timezone_set('Asia/Manila');

$account_number = $_REQUEST['account_number'];
$account_name   = mysql_real_escape_string($_REQUEST['account_name']);
$amount         = mysql_real_escape_string($_REQUEST['amount']);

$created_at = date('Y-m-d H:i:s');

$ref_id = mt_rand(100000,999999);

mysql_query("INSERT INTO accounts (account_number, account_name, amount, ref_id, status, created_at) 
                 VALUES ('$account_number','$account_name','$amount','$ref_id','in_process','$created_at')");

echo '[
    {
    "attachment": {
      "type": "template",
      "payload": {
        "template_type": "button",
        "text": "Here is your Reference ID: ' . $ref_id . '",
        "buttons": [
          {
            "type": "show_block",
            "block_name": "Find Branches",
            "title": "Find Branches"
          },
          {
            "type": "show_block",
            "block_name": "Deposit",
            "title": "Deposit"
          }
        ]
      }
    }
  }
  ]';
