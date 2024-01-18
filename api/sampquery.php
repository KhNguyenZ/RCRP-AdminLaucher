<?php
require_once('SampQueryAPI.php');
if(isset($_GET['KNCMS_SERVERIP']))
{
    $query = new SampQueryAPI($_GET['KNCMS_SERVERIP'], '7777');
    if($_GET['KNCMS_SERVERIP'] == "Status")
    {
        if($query->isOnline()) echo "Online";
        else echo "Offline";
    }
    if($query->isOnline())
    {
    	$aInformation = $query->getInfo();
    	$aServerRules = $query->getRules();
    	echo $aInformation['players'].' / '.$aInformation['maxplayers'];
    }
    else echo "Offline";
}
?>
