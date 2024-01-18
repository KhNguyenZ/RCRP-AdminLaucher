<?php require_once('../../../server/config.php'); ?>
<?php require_once('../private/head.php') ?>
<?php require_once('../private/nav.php') ?>
<?php 
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
<title>Email Panel</title>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thành viên chưa xác nhận email</h3>
                    </div>

                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>UID</th>
                                    <th>Tên</th>
                                    <th>Level</th>
                                    <th>Coin</th>
                                    <th>Email</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($KNCMS->get_list("SELECT * FROM `accounts` WHERE `active_status` != 2") as $data) {
                                ?>
                                    <tr>
                                        <td><?= $data['id'] ?></td>
                                        <td><?= $data['Username'] ?></td>
                                        <td><?= $data['Level'] ?></td>
                                        <td><?= $data['Credits'] ?></td>
                                        <td><?= $data['Email'] ?></td>
                                        <td>
                                            <a href="<?= $base_url ?>Backend/Active/<?= $data['id'] ?>" class="btn btn-app bg-success">
                                                <i class="fas fa-edit"></i> Xác nhận
                                            </a>
                                            <a class="btn btn-app" href="?kncms-controller=<?= $row['Username'] ?>">
                                                <i class="fas fa-edit"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once('../private/foot.php') ?>