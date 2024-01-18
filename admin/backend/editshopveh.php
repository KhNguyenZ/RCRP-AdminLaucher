<?php require_once('../../../server/config.php'); ?>
<?php require_once('../private/head.php') ?>
<?php require_once('../private/nav.php') ?>
<?php if (isset($_GET['name'])) {

    if (empty($_GET['name'])) hUrl('AdminPages');
    $name = $_GET['name'];
    $detail = $KNCMS->query("SELECT * FROM `kncms_vehs` WHERE `id` = '$name'");
}
if ($detail->num_rows > 0) {
    $detail = $detail->fetch_array();
    $cid = $detail['id'];
?>
    <title>Website Panel</title>
    <section class="col-lg-12 connectedSortable">
        <div class="card card-primary card-outline">
            <div class="card-header ">
                <h3 class="card-title">
                    <i class="fas fa-history mr-1"></i>
                    Chỉnh Sửa Xe
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
                <?php if (isset($_POST['btnSave'])) {
                    $cname = $_POST['name'];
                    $price = $_POST['price'];
                    $amount = $_POST['amount'];
                    $type = $_POST['type'];

                    $update  = $KNCMS->query("UPDATE `kncms_vehs` SET
                    `name` = '$cname', 
                    `ooc_price` = '$price',
                    `amount` = '$amount',
                    `type` = '$type' WHERE `id` = '$cid'");
                    if($update) $KNCMS->msg_success("Lưu thành công", hUrl('AdminPages/ListVehicles'), 1000);
                } ?>
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tên(*)</label>
                            <input type="text" class="form-control" value="<?= $detail['name'] ?>" name="name">
                        </div>
                        <div class="form-group">
                            <label>Giá (*)</label>
                            <input type="text" class="form-control" value="<?= $detail['ooc_price'] ?>" name="price">
                        </div>
                        <div class="form-group">
                            <label>Số lượng (*)</label>
                            <input type="text" class="form-control" value="<?= $detail['amount'] ?>" name="amount">
                        </div>
                        <div class="form-group">
                            <label>Loại (*)</label>
                            <select  class="form-control" name="type">
                                <option value="car">Ô tô</option>
                                <option value="moto">Mô tô</option>
                                <option value="maybay">Máy bay</option>
                                <option value="tauthuyen">Tàu thuyền</option>
                            </select>
                        </div>
                        <button class="btn btn-info" name="btnSave">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php } else $KNCMS->msg_error("Không tìm thấy danh mục này", hUrl('AdminPages/Category'), 1000);
require_once('../private/foot.php') ?>