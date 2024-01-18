<?php
require_once('../../../server/config.php');
require_once('../private/head.php');
if(isset($_GET['uid']))
{
    $uid = $KNCMS->anti_text($_GET['uid']);
}

$query = $KNCMS->query("UPDATE `accounts` SET
`active_status` = 2,
`active_code` = ' ' WHERE `id` = '$uid'");
if($query)
{
    $KNCMS->msg_success("Xác Nhận Người Chơi Thành Công", "$admin_url", 1000);
}