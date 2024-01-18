<?php
require('config.php');
require('SampQueryAPI.php');

http_response_code(200);

if(isset($_GET['KNCMS_ACTION']))
{
    if($_GET['KNCMS_ACTION'] == 'ServerOnline')
    {
        if(!isset($_GET['KNCMS_PORT'])) $_GET['KNCMS_PORT'] = 7777;
        $query = new SampQueryAPI($_GET['KNCMS_SERVERIP'], $_GET['KNCMS_PORT']);
        if($query->isOnline()) echo 'Online';
        else echo 'Offline';
    }
    if($_GET['KNCMS_ACTION'] == 'ServerChecker')
    {
        $info_arr = array('ServerName' => 'NULL', 'State' => 'NULL', 'Player' => '0', 'Gamemode' => 'NULL', 'MapName' => 'NULL','MaxPlayer' => '1000');
        if (filter_var($_GET['KNCMS_SERVERIP'], FILTER_VALIDATE_IP)) {
            $query = new SampQueryAPI(gethostbyname($_GET['KNCMS_SERVERIP']));
            $info = $query->getInfo();
            if($query->isOnline()) $state = 'Online';
            else $state = 'Offline';
            if($query->isOnline()) $info_arr = array('ServerName' => $info['hostname'], 'State' => $state, 'Player' => $info['players'], 'Gamemode' => $info['gamemode'], 'MapName' => $info['mapname'], 'MaxPlayer' => $info['maxplayers']);
            
        }
        echo json_encode($info_arr);
    }
    if($_GET['KNCMS_ACTION'] == 'CheckCleo')
    {
        if(!isset($_GET['KNCMS_HASHFILE'])) return "No Hash Code !";
        if(check_rows($_GET['KNCMS_HASHFILE'], "cleo", "HashFile")) return "AllowCleo";
        else return "UnAllowCleo";

    }
}