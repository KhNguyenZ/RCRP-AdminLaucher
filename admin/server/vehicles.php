<?php require_once('../../../server/config.php'); ?>
<?php require_once('../private/head.php') ?>
<?php require_once('../private/nav.php') ?>

<title>Vehicles Panel</title>
<section class="col-lg-12 connectedSortable">
    <div class="card card-primary card-outline">
        <div class="card-header ">
            <h3 class="card-title">
                <i class="fas fa-history mr-1"></i>
                Quản Lí Xe
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
                <a type="button" class="btn bg-primary btn-sm" data-toggle="modal" data-target="#modal-default" class="btn btn-info">Thêm Xe Mới</a>
            </div>
        </div>
        <?php 
        if (isset($_GET['kncontrollerdelete'])) {
            $name = $_GET['kncontrollerdelete'];
            $query = $KNCMS->query("SELECT * FROM `kncms_vehs` WHERE `name` = '$name'");
            if ($query->num_rows > 0) 
            {
                $delete = $KNCMS->query("DELETE FROM `kncms_vehs` WHERE `name` = '$name'");
                if ($delete) $KNCMS->msg_success("Xóa thành công", "$admin_url/ListVehicles", 1000);
                else $KNCMS->msg_error("Xóa thất bại", "$admin_url/ListVehicles", 1000);
            } else {
                $KNCMS->msg_warning("Xe không tồn tại", "$admin_url/ListVehicles", 1000);
            }
        }
        if (isset($_GET['kncontrollerhide'])) {
            $name = $_GET['kncontrollerhide'];
            $query = $KNCMS->query("SELECT * FROM `kncms_vehs` WHERE `name` = '$name'");
            if ($query->num_rows > 0) 
            {
                $delete = $KNCMS->query("UPDATE `kncms_vehs` SET `amount` = '0' WHERE `name` = '$name'");
                if ($delete) $KNCMS->msg_success("Ẩn thành công", "$admin_url/ListVehicles", 1000);
                else $KNCMS->msg_error("Xóa thất bại", "$admin_url/ListVehicles", 1000);
            } else {
                $KNCMS->msg_warning("Xe không tồn tại", "$admin_url/ListVehicles", 1000);
            }
        }
        if (isset($_GET['kncontrollershow'])) {
            $name = $_GET['kncontrollershow'];
            $query = $KNCMS->query("SELECT * FROM `kncms_vehs` WHERE `name` = '$name'");
            if ($query->num_rows > 0) 
            {
                $delete = $KNCMS->query("UPDATE `kncms_vehs` SET `amount` = '10' WHERE `name` = '$name'");
                if ($delete) $KNCMS->msg_success("Ẩn thành công", "$admin_url/ListVehicles", 1000);
                else $KNCMS->msg_error("Xóa thất bại", "$admin_url/ListVehicles", 1000);
            } else {
                $KNCMS->msg_warning("Xe không tồn tại", "$admin_url/ListVehicles", 1000);
            }
        }
        ?>
        <div class="card-body">
            <div class="table-responsive p-0">
                <table id="datatable2" class="table table-bordered table-striped table-hover">
                    <thead>
                        <th>ID</th>
                        <th>Img</th>
                        <th>Tên</th>
                        <th>Giá OOC</th>
                        <th>Loại</th>
                        <th>Model</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($KNCMS->get_list("SELECT * FROM `kncms_vehs` ORDER BY id desc") as $vehdata) { ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><img class="card-img-top img-fluid" src="<?= $base_url ?>lib/model/vehicles/Vehicle_<?= $vehdata['model'] ?>.jpg" style="border-radius: 10px; width: 100%; height: 100px;"></td>
                                <td><?= $vehdata['name'] ?></td>
                                <td><?= $vehdata['ooc_price'] ?></td>
                                <td><?php echo getVehiclesType($vehdata['type']) ?></td>
                                <td><?= $vehdata['model'] ?></td>
                                <td><?php
                                if($vehdata['amount'] > 0)
                                {?>
                                    <span class="badge badge-success">Enable</span>
                                <?php } else { ?>
                                    <span class="badge badge-danger">Disable</span>
                                <?php } ?>
                                </td>
                                <td>
                                    <a href="?kncontrollerdelete=<?= $vehdata['name'] ?>" type="button" class="btn btn-block bg-gradient-danger">Xóa</a>
                                    <a href="?kncontrollerhide=<?= $vehdata['name'] ?>" type="button" class="btn btn-block bg-gradient-danger">Hide</a>
                                    <a href="?kncontrollershow=<?= $vehdata['name'] ?>" type="button" class="btn btn-block bg-gradient-danger">Show</a>
                                    <a href="<?=hUrl('Backend/EditShopVeh/'.$vehdata['id'])?>" type="button" class="btn btn-block bg-gradient-danger">Edit</a>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm modelid</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (isset($_POST['addveh'])) {
                    $modelid = $_POST['modelid'];
                    $price = $_POST['price'];
                    $ooc_price = ceil($_POST['ooc_price']);
                    $amount = ceil($_POST['amount']);
                    $type = $_POST['type'];
                    $vehname = getVehiclesName($modelid);
                    if (!$type || !$modelid || !$price || !$ooc_price || !$amount) $KNCMS->msg_error("Vui lòng nhập đầy đủ thông tin", "", 1000);

                    $check = $KNCMS->query("SELECT * FROM `kncms_vehs` WHERE `model` = '$modelid'");
                    if ($check->num_rows == 0) {
                        $insert_data = $KNCMS->query("INSERT INTO `kncms_vehs` SET
                        `name` = '$vehname',
                        `model` = '$modelid',
                        `price` = '$price', 
                        `ooc_price` = $ooc_price,
                        `amount` = $amount,
                        `type`= '$type'");
                        if ($insert_data) $KNCMS->msg_success("Thêm xe thành công", "$admin_url/ListVehicles", 1000);
                    } else $KNCMS->msg_error("Xe đã tồn tại", "$admin_url/ListVehicles", 1000);
                }
                ?>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Model ID:</label>
                        <input type="text" class="form-control" name="modelid" placeholder="vd: 522">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Giá (SAD):</label>
                        <input type="text" class="form-control" name="price" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Giá OOC:</label>
                        <input type="number" class="form-control" name="ooc_price" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số lượng(amount):</label>
                        <input type="number" class="form-control" name="amount" placeholder="Số lượng">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Loại:</label>
                        <select class="form-control" name="type">
                            <option>Vui lòng chọn</option>
                            <option value="car">Ô tô</option>
                            <option value="moto">Mô tô</option>
                            <option value="maybay">Máy bay</option>
                            <option value="tauthuyen">Tàu thuyền</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">ĐÓNG</button>
                <button type="submit" name="addveh" class="btn btn-primary">THÊM</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php require_once('../private/foot.php') ?>