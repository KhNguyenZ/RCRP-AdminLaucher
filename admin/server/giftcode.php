<?php require_once('../../../server/config.php'); ?>
<?php require_once('../private/head.php') ?>
<?php require_once('../private/nav.php') ?>

<title>Giftcode Panel</title>
<section class="col-lg-12 connectedSortable">
    <div class="card card-primary card-outline">
        <div class="card-header ">
            <h3 class="card-title">
                <i class="fas fa-history mr-1"></i>
                Quản Lí Giftcode
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
                <a type="button" class="btn bg-primary btn-sm" data-toggle="modal" data-target="#modal-default" class="btn btn-info">Thêm Giftcode</a>
            </div>
        </div>
        <?php if (isset($_GET['kncontrollerdelete'])) {
            $giftcode = $_GET['kncontrollerdelete'];
            $query = $KNCMS->query("SELECT * FROM `kncms_giftcode` WHERE `giftcode` = '$giftcode'");
            if ($query->num_rows > 0) {
                $delete = $KNCMS->query("DELETE FROM `kncms_giftcode` WHERE `giftcode` = '$giftcode'");
                if ($delete) $KNCMS->msg_success("Xóa thành công", "$admin_url/ListGiftocde", 1000);
                else $KNCMS->msg_error("Xóa thất bại", "$admin_url/ListGiftocde", 1000);
            } else $KNCMS->msg_warning("Giftcode không tồn tại", "$admin_url/ListGiftocde", 1000);
        }
        ?>
        <div class="card-body">
            <div class="table-responsive p-0">
                <table id="datatable2" class="table table-bordered table-striped table-hover">
                    <thead>
                        <th>ID</th>
                        <th>Giftcode</th>
                        <th>Giftname</th>
                        <th>Field</th>
                        <th>Số lượng</th>
                        <th>Giới hạn</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($KNCMS->get_list("SELECT * FROM `kncms_giftcode` ORDER BY id desc") as $giftdata) { ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $giftdata['giftcode'] ?></td>
                                <td><?= $giftdata['giftname'] ?></td>
                                <td><?= $giftdata['field'] ?></td>
                                <td><?= $giftdata['amount'] ?></td>
                                <td><?= $giftdata['limit'] ?></td>
                                <?php if ($giftdata['limit'] > 0 && $giftdata['open'] == 1) { ?>
                                    <td><span class="badge badge-info">OPEN</td>
                                <?php } else { ?>
                                    <td><span class="badge badge-danger">CLOSE</td>
                                <?php } ?>
                                <td><a href="?kncontrollerdelete=<?= $giftdata['giftcode'] ?>" type="button" class="btn btn-block bg-gradient-danger">Xóa</a></td>
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
                <h4 class="modal-title">Thêm Giftcode</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (isset($_POST['createcode'])) {
                    $giftcode = $KNCMS->xoadau($_POST['giftcode']);
                    $field = $_POST['field'];
                    $limit = ceil($_POST['limit']);
                    $amount = ceil($_POST['amount']);
                    $giftname = $_POST['giftname'];
                    if (!$giftcode || !$field || !$limit || !$amount) $KNCMS->msg_error("Vui lòng nhập đầy đủ thông tin", "", 1000);

                    $check = $KNCMS->query("SELECT * FROM `kncms_giftcode` WHERE `giftcode` = '$giftcode'");
                    if ($check->num_rows == 0) {
                        $insert_data = $KNCMS->query("INSERT INTO `kncms_giftcode` SET
                        `giftcode` = '$giftcode',
                        `field` = '$field', 
                        `limit` = $limit,
                        `amount` = $amount,
                        `giftname`= '$giftname'");
                        if ($insert_data) $KNCMS->msg_success("Thêm giftcode thành công", "$admin_url/ListGiftocde", 1000);
                    } else $KNCMS->msg_error("Giftcode đã tồn tại", "$admin_url/ListGiftocde", 1000);
                }
                ?>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Giftcode:</label>
                        <input type="text" class="form-control" name="giftcode" placeholder="vd: ompvn2023">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Field:</label>
                        <input type="text" class="form-control" name="field" placeholder="vi du field: vippackge">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số lượt nhập giftcode(limit):</label>
                        <input type="number" class="form-control" name="limit" placeholder="Số lượng giftcode được nhập">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số lượng(amount):</label>
                        <input type="number" class="form-control" name="amount" placeholder="Số lượng">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên phần quà:</label>
                        <input type="text" class="form-control" name="giftname" placeholder="VD: VIP">
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">ĐÓNG</button>
                <button type="submit" name="createcode" class="btn btn-primary">TẠO NGAY</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php require_once('../private/foot.php') ?>