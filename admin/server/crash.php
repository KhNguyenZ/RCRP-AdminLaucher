<?php require_once('../../../server/config.php'); ?>
<?php require_once('../private/head.php') ?>
<?php require_once('../private/nav.php') ?>
<?php
if(isset($_GET['kncms-controller']))
{
    if(check_rows($_GET['kncms-controller'], 'accounts', 'Username'))
    {
        $usern = $_GET['kncms-controller'];
        $delete = $KNCMS->query("UPDATE `accounts` SET `PendingCrash` = '0' WHERE `Username` = '$usern'");
        if($delete) $KNCMS->msg_success("Xóa thành công", hUrl('AdminPages/Crash'), 1000);
        else $KNCMS->msg_error("Xóa không thành công", hUrl('AdminPages/Crash'), 1000);
    }
}
if(isset($_GET['access']))
{
    if(check_rows($_GET['access'], 'accounts', 'Username'))
    {
        //1771.1667,-1901.1292,13.5553,271.5426,
        $usern = $_GET['access'];
        $delete = $KNCMS->query("UPDATE `accounts` SET 
        `SPos_x` = '1771.1667',
        `SPos_y` = '-1901.1292',
        `SPos_z` = '13.5553',
        `SPos_r` = '271.5426',
        `PendingCrash` = '0' 
        WHERE `Username` = '$usern'");
        if($delete) $KNCMS->msg_success("Duyệt thành công", hUrl('AdminPages/Crash'), 1000);
        else $KNCMS->msg_error("Duyệt không thành công", hUrl('AdminPages/Crash'), 1000);
    }
}
?>
<title>Crash Panel</title>

<section class="col-lg-12 connectedSortable">
    <div class="card card-primary card-outline">
        <div class="card-header ">
            <h3 class="card-title">
                <i class="fas fa-history mr-1"></i>
                Report Crash
            </h3>
            <div class="card-tools">
                <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>
                <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive p-0">
                <table id="datatable2" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th>Username</th>
                            <th width="40%">Action</th>
                            <th>Time</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($KNCMS->get_list("SELECT * FROM `accounts` WHERE `PendingCrash` = '1' ORDER BY id desc") as $row) {
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row['Username'] ?></a>
                                </td>
                                <td><?= $row['Email'] ?></td>
                                <td><?= $row['RegiDate'] ?></td>
                                <td>
                                    <a class="btn btn-app" href="?access=<?= $row['Username'] ?>">
                                        <i class="fas fa-edit"></i> Duyệt
                                    </a>
                                    <a class="btn btn-app" href="?kncms-controller=<?= $row['Username'] ?>">
                                        <i class="fas fa-edit"></i> Hủy
                                    </a>
                                    <?php $i++ ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php require_once('../private/foot.php') ?>