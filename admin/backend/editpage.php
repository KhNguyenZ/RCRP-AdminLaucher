<?php require_once('../../../server/config.php'); ?>
<?php require_once('../private/head.php') ?>
<?php require_once('../private/nav.php') ?>
<?php if (isset($_GET['page'])) {

    if (empty($_GET['page'])) hUrl('AdminPages');
    $name = $_GET['page'];
    $detail = $KNCMS->query("SELECT * FROM `kncms_pages` WHERE `detail` = '$name'");
}
if ($detail->num_rows > 0) {
    $detail = $detail->fetch_array();
    $cid = $detail['id'];
    $pageid = $detail['iddanhmuc'];
    $pageme = $KNCMS->query("SELECT * FROM `kncms_danhmuc` WHERE `id` = '$pageid'")->fetch_array();
?>
    <title>Website Panel</title>
    <section class="col-lg-12 connectedSortable">
        <div class="card card-primary card-outline">
            <div class="card-header ">
                <h3 class="card-title">
                    <i class="fas fa-history mr-1"></i>
                    Quản Lí Danh Mục Con
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
                    if (empty($_POST['page'])) $KNCMS->msg_error("Tên không được để trống", "", 1000);
                    $cname = $_POST['page'];
                    $href = $_POST['href'];
                    $icon = $_POST['icon'];
                    $page_me = $_POST['select_pageme'];
                    $tname = $KNCMS->to_slug($cname);
                    $update = $KNCMS->query("UPDATE `kncms_pages` SET
                    `page` = '$cname',
                    `href` = '$href',
                    `icon` ='$icon',
                    `iddanhmuc` = '$page_me',
                    `detail` = '$tname' WHERE `id` = '$cid'");
                    if($update) $KNCMS->msg_success("Lưu thành công", hUrl('AdminPages/Pages'), 1000);
                } ?>
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tên Danh Mục Con(*)</label>
                            <input type="text" class="form-control" value="<?= $detail['page'] ?>" name="page">
                        </div>
                        <div class="form-group">
                            <label>Link chuyển hướng (href) (*)</label>
                            <input type="text" class="form-control" value="<?= $detail['href'] ?>" name="href">
                        </div>
                        <div class="form-group">
                            <label>Icon - Lấy icon tại <a href="fontawesome.com">fontawesome.com</a></label>
                            <textarea class="form-control" rows="1" name="icon" placeholder="Code icon"><?= $detail['icon'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Danh mục mẹ (nếu không thay đổi hãy giữ nguyên</label>
                            <select class="form-control" name="select_pageme">
                                <option value="<?=$detail['iddanhmuc']?>"><?=$pageme['name']?></option>
                                <?php foreach ($KNCMS->get_list("SELECT * FROM `kncms_danhmuc` ORDER BY id") as $edit) { ?>
                                    <option value="<?= $edit['id'] ?>"><?= $edit['name'] ?></option>
                                <?php } ?>
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