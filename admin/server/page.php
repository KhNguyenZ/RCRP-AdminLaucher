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
?>
<?php if (isset($_GET['kncontrollerdelete'])) {
    $page = $KNCMS->anti_text($_GET['kncontrollerdelete']);
    if ($KNCMS->query("SELECT * FROM `kncms_pages` WHERE `page` = '$page'")->num_rows > 0) {
        if ($KNCMS->query("DELETE FROM `kncms_pages` WHERE `page` = '$page'")) $KNCMS->msg_success("Xóa thành công", hUrl('AdminPages/Pages'), 1000);
        else $KNCMS->msg_error("Xóa thất bại", hUrl('AdminPages/Pages'), 1000);
    }
}
?>
<title>Category Panel</title>

<section class="col-lg-12 connectedSortable">
    <div class="card card-primary card-outline">
        <div class="card-header ">
            <h3 class="card-title">
                <i class="fas fa-history mr-1"></i>
                LIST DANH MỤC CON
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
                <a type="button" class="btn bg-primary btn-sm" data-toggle="modal" data-target="#modal-default" class="btn btn-info">Thêm danh mục con</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive p-0">
                <table id="datatable2" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="20%">Danh mục ID</th>
                            <th>Tên danh mục</th>
                            <th>Link chuyển hướng</th>
                            <th>Icon</th>
                            <th>Danh mục mẹ</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($KNCMS->get_list("SELECT * FROM `kncms_pages` ORDER BY id desc") as $row) {
                            $pageid = $row['iddanhmuc'];
                            $category = $KNCMS->query("SELECT * FROM `kncms_danhmuc` WHERE `id` = '$pageid'");
                            if ($category->num_rows > 0) {
                                $category = $category->fetch_array();
                        ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['page'] ?></a>
                                    <td><?= $row['href'] ?></a>
                                    <td><?= $row['icon'] ?></a>
                                    <td><?= $category['name'] ?></td>
                                    <td>
                                        <a class="btn btn-app" href="<?= hUrl('Backend/EditPage/' . $row['detail']) ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
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
                <h4 class="modal-title">Thêm Danh Mục</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (isset($_POST['CreateDanhMucCon'])) {
                    if (empty($_POST['page']) || empty($_POST['href']) || empty($_POST['icon']) || $_POST['select_pageme'] == "null") $KNCMS->msg_error("Không được để trống thông tin", "", 1000);
                    $page = $_POST['page'];
                    $href = $_POST['href'];
                    $icon = $_POST['icon'];
                    $select_pageme = $_POST['select_pageme'];
                    $tpage = $KNCMS->to_slug($page);
                    $update = $KNCMS->query("INSERT INTO `kncms_pages` SET
                    `page` = '$page',
                    `href` = '$href',
                    `icon` = '$icon',
                    `iddanhmuc` = '$select_pageme',
                    `detail` = '$tpage'");
                    if ($update) $KNCMS->msg_success("Tạo thành công", hUrl('AdminPages/Pages'), 1000);
                }
                ?>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tạo danh mục con:</label>
                        <input type="text" class="form-control" name="page" placeholder="vd: ompvn2023">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Link chuyển hướng:</label>
                        <input type="text" class="form-control" name="href" placeholder="vd: ompvn2023">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Icon</label>
                        <input type="text" class="form-control" name="icon" placeholder="vd: <i class='fa-brands fa-rocketchat'></i>">
                    </div>
                    <div class="form-group">
                        <label>Danh mục mẹ (nếu không thay đổi hãy giữ nguyên</label>
                        <select class="form-control" name="select_pageme">
                            <option value="null">Chọn danh mục mẹ</option>
                            <?php foreach ($KNCMS->get_list("SELECT * FROM `kncms_danhmuc` ORDER BY id") as $edit) { ?>
                                <option value="<?= $edit['id'] ?>"><?= $edit['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">ĐÓNG</button>
                <button type="submit" name="CreateDanhMucCon" class="btn btn-primary">TẠO NGAY</button>
            </div>
            </form>
        </div>
    </div>
</div><?php require_once('../private/foot.php') ?>