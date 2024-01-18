<?php require_once('../../../server/config.php'); ?>
<?php require_once('../private/head.php') ?>
<?php require_once('../private/nav.php') ?>
<?php if (isset($_GET['category'])) {

    if (empty($_GET['category'])) hUrl('AdminPages');
    $name = $_GET['category'];
    $detail = $KNCMS->query("SELECT * FROM `kncms_danhmuc` WHERE `detail` = '$name'");
}
if ($detail->num_rows > 0) {
    $detail = $detail->fetch_array(); 
    $cid = $detail['id']
    ?>
    <title>Website Panel</title>
    <section class="col-lg-12 connectedSortable">
        <div class="card card-primary card-outline">
            <div class="card-header ">
                <h3 class="card-title">
                    <i class="fas fa-history mr-1"></i>
                    Quản Lí Danh Mục
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
                <?php if(isset($_POST['btnSave'])) {
                    if(empty($_POST['name'])) $KNCMS->msg_error("Tên không được để trống", "", 1000);
                    $cname = $_POST['name'];
                    $detailname = $KNCMS->to_slug($cname);
                    $update = $KNCMS->query("UPDATE `kncms_danhmuc` 
                    SET `name` = '$cname',
                    `detail` = '$detailname'
                    WHERE `id` = '$cid'");
                    if($update) $KNCMS->msg_success("Lưu thành công", hUrl('AdminPages/Category'), 1000);
                }?>
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tên Danh Mục(*)</label>
                            <input type="text" class="form-control" value="<?= $detail['name'] ?>" name="name">
                        </div>
                        <button class="btn btn-info" name="btnSave">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php } else $KNCMS->msg_error("Không tìm thấy danh mục này", hUrl('AdminPages/Category'), 1000);
require_once('../private/foot.php') ?>