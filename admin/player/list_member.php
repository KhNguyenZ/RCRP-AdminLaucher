<?php require_once('../../../server/config.php'); ?>
<?php require_once('../private/head.php') ?>
<?php require_once('../private/nav.php') ?>
<?php
if (isset($_POST['btnfind'])) {
    $usr = $KNCMS->anti_text($_POST['usr']);
    if (!empty($usr)) {
        $row = $KNCMS->query("SELECT * FROM `accounts` WHERE `username` = '$usr'");
        if ($row->num_rows > 0) {
            $KNCMS->msg_success("Thành Công", "$base_url/EditUser/$usr", 1000);
        } else $KNCMS->msg_error("Không tìm thấy người chơi này", "", 1000);
    } else $KNCMS->msg_error("Vui lòng nhập IC", "", 1000);
}
if(isset($_GET['kncms-controller']))
{
    if(check_rows($_GET['kncms-controller'], 'accounts', 'Username'))
    {
        $usern = $_GET['kncms-controller'];
        $delete = $KNCMS->query("DELETE FROM `accounts` WHERE `Username` = '$usern'");
        if($delete) $KNCMS->msg_success("Xóa thành công", hUrl('AdminPages/ListMembers'), 1000);
        else $KNCMS->msg_success("Xóa thành công", hUrl('AdminPages/ListMembers'), 1000);
    }
}
?>
<title>Member Panel</title>
<section class="col-lg-12 connectedSortable">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-user-edit mr-1"></i>
                CHỈNH SỬA THÀNH VIÊN
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
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="POST">
                        <div class="input-group">
                            <input name="usr" type="search" class="form-control form-control-lg" placeholder="Nhập IC người chơi">
                            <div class="input-group-append">
                                <button name="btnfind" type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="col-lg-12 connectedSortable">
    <div class="card card-primary card-outline">
        <div class="card-header ">
            <h3 class="card-title">
                <i class="fas fa-history mr-1"></i>
                NHẬT KÝ HOẠT ĐỘNG
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
                        foreach ($KNCMS->get_list("SELECT * FROM `accounts` ORDER BY id desc") as $row) {
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row['Username'] ?></a>
                                </td>
                                <td><?= $row['Email'] ?></td>
                                <td><?= $row['RegiDate'] ?></td>
                                <td>
                                    <a class="btn btn-app" href="<?= $base_url ?>/EditUser/<?= $row['Username'] ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a class="btn btn-app" href="?kncms-controller=<?= $row['Username'] ?>">
                                        <i class="fas fa-edit"></i> Delete
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