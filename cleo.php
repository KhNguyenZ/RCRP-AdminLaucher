<?php
if(isset($_GET['HashCleo']))
{

    if(check_rows($_GET['HashCleo'], "cleo", "HashFile")) echo "<br>Cleo này đã tồn tại trong cơ sở dữ liệu";
    else{
        if($KNCMS->query("INSERT INTO `cleo` SET `Name` = '$fileName', `HashFile` = '$fileHash', `UploadTime` = '$time'")) echo "<br>Đã thêm $fileName vào danh sách Allow Cleo";
    }
}
?>