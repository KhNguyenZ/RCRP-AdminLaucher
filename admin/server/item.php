<?php require_once('../../../server/config.php'); ?>
<?php require_once('../private/head.php') ?>
<?php require_once('../private/nav.php') ?>

<title>Items Panel</title>
<section class="col-lg-12 connectedSortable">
    <div class="card card-primary card-outline">
        <div class="card-header ">
            <h3 class="card-title">
                <i class="fas fa-history mr-1"></i>
                Quản Lí Vật Phẩm
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
                <a type="button" class="btn bg-primary btn-sm" data-toggle="modal" data-target="#modal-default" class="btn btn-info">Thêm Item Mới</a>
            </div>
        </div>
        <?php if (isset($_GET['kncontrollerdelete'])) {
            $name = $_GET['kncontrollerdelete'];
            $query = $KNCMS->query("SELECT * FROM `kncms_item` WHERE `name` ='$name'");
            if ($query->num_rows > 0) {
                $delete = $KNCMS->query("DELETE FROM `kncms_item` WHERE `name` = '$name'");
                if ($delete) $KNCMS->msg_success("Xóa thành công", "$admin_url/ListItems", 1000);
                else $KNCMS->msg_error("Xóa thất bại", "$admin_url/ListItems", 1000);
            } else $KNCMS->msg_warning("Toy không tồn tại", "$admin_url/ListItems", 1000);
        }
        if (isset($_GET['kncontrollerhide'])) {
            $name = $_GET['kncontrollerhide'];
            $query = $KNCMS->query("SELECT * FROM `kncms_item` WHERE `name` = '$name'");
            if ($query->num_rows > 0) 
            {
                $delete = $KNCMS->query("UPDATE `kncms_item` SET `amount` = '0' WHERE `name` = '$name'");
                if ($delete) $KNCMS->msg_success("Ẩn thành công", "$admin_url/ListItems", 1000);
                else $KNCMS->msg_error("Xóa thất bại", "$admin_url/ListItems", 1000);
            } else {
                $KNCMS->msg_warning("Xe không tồn tại", "$admin_url/ListItems", 1000);
            }
        }
        if (isset($_GET['kncontrollershow'])) {
            $name = $_GET['kncontrollershow'];
            $query = $KNCMS->query("SELECT * FROM `kncms_item` WHERE `name` = '$name'");
            if ($query->num_rows > 0) 
            {
                $delete = $KNCMS->query("UPDATE `kncms_item` SET `amount` = '10' WHERE `name` = '$name'");
                if ($delete) $KNCMS->msg_success("Ẩn thành công", "$admin_url/ListItems", 1000);
                else $KNCMS->msg_error("Xóa thất bại", "$admin_url/ListItems", 1000);
            } else {
                $KNCMS->msg_warning("Xe không tồn tại", "$admin_url/ListItems", 1000);
            }
        }
        if (isset($_GET['kncontrollerhide'])) {
            $name = $_GET['kncontrollerhide'];
            $query = $KNCMS->query("SELECT * FROM `kncms_item` WHERE `name` = '$name'");
            if ($query->num_rows > 0) 
            {
                $delete = $KNCMS->query("UPDATE `kncms_item` SET `amount` = '0' WHERE `name` = '$name'");
                if ($delete) $KNCMS->msg_success("Ẩn thành công", "$admin_url/ListItems", 1000);
                else $KNCMS->msg_error("Xóa thất bại", "$admin_url/ListItems", 1000);
            } else {
                $KNCMS->msg_warning("Xe không tồn tại", "$admin_url/ListItems", 1000);
            }
        }
        if (isset($_GET['kncontrollershow'])) {
            $name = $_GET['kncontrollershow'];
            $query = $KNCMS->query("SELECT * FROM `kncms_item` WHERE `name` = '$name'");
            if ($query->num_rows > 0) 
            {
                $delete = $KNCMS->query("UPDATE `kncms_item` SET `amount` = '10' WHERE `name` = '$name'");
                if ($delete) $KNCMS->msg_success("Ẩn thành công", "$admin_url/ListItems", 1000);
                else $KNCMS->msg_error("Xóa thất bại", "$admin_url/ListItems", 1000);
            } else {
                $KNCMS->msg_warning("Xe không tồn tại", "$admin_url/ListItems", 1000);
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
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($KNCMS->get_list("SELECT * FROM `kncms_item` ORDER BY id desc") as $toydata) { ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><img class="card-img-top img-fluid" src="<?= $toydata['img'] ?>" style="border-radius: 10px; width: 50%; height: 100px;"></td>
                                <td><?= $toydata['name'] ?></td>
                                <td><?= $toydata['price'] ?></td>
                                <td><?php
                                if($toydata['amount'] > 0)
                                {?>
                                    <span class="badge badge-success">Mở</span>
                                <?php } else { ?>
                                    <span class="badge badge-danger">Đóng</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="?kncontrollerdelete=<?= $toydata['name'] ?>" type="button" class="btn btn-block bg-gradient-danger">Xóa</a>
                                    <a href="?kncontrollerhide=<?= $toydata['name'] ?>" type="button" class="btn btn-block bg-gradient-danger">Hide</a>
                                    <a href="?kncontrollershow=<?= $toydata['name'] ?>" type="button" class="btn btn-block bg-gradient-danger">Show</a>
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
                <h4 class="modal-title">Thêm toys mới</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (isset($_POST['addtoys'])) {
                    $name = $_POST['name'];
                    $link = $_POST['link'];
                    $ooc_price = $_POST['ooc_price'];
                    $amount = $_POST['amount'];

                    if (empty($name) || empty($link) || empty($ooc_price) || empty($amount)) $KNCMS->msg_error("Vui lòng nhập đầy đủ thông tin", "", 1000);
                    $namez = $KNCMS->xoadau($KNCMS->anti_text($name));
                    $check = $KNCMS->query("SELECT * FROM `kncms_item` WHERE `model` = '$modelid'");
                    if ($check->num_rows == 0) {
                        $insert_data = $KNCMS->query("INSERT INTO `kncms_item` SET
                        `name` = '$name',
                        `img` = '$link',
                        `price` = '$ooc_price',
                        `amount` = '$amount',
                        `detail` = '$namez'
                        ");
                        if ($insert_data) $KNCMS->msg_success("Thêm item thành công", "$admin_url/ListItems", 1000);
                    } else $KNCMS->msg_error("Item đã tồn tại", "$admin_url/ListItems", 1000);
                }
                ?>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên:</label>
                        <input type="text" class="form-control" name="name" placeholder="vd: Kính">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Link hinh anh:</label>
                        <input type="text" class="form-control" name="link" placeholder='vd: https://files.prineside.com/gtasa_samp_model_id/blue/2226_b.jpg'>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Giá OOC:</label>
                        <input type="number" class="form-control" name="ooc_price" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số lượng(amount):</label>
                        <input type="number" class="form-control" name="amount" placeholder="Số lượng">
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">ĐÓNG</button>
                <button type="submit" name="addtoys" class="btn btn-primary">THÊM</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php require_once('../private/foot.php') ?>