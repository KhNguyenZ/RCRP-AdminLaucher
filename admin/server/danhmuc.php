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
<title>Category Panel</title>
<section class="col-lg-12 connectedSortable">
    <div class="card card-primary card-outline">
        <div class="card-header ">
            <h3 class="card-title">
                <i class="fas fa-history mr-1"></i>
                LIST DANH MỤC
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
        <div class="card-body">
            <div class="table-responsive p-0">
                <table id="DanhMucTb" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="20%">Danh mục ID</th>
                            <th>Tên danh mục</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($KNCMS->get_list("SELECT * FROM `kncms_danhmuc` ORDER BY id desc") as $row) {
                        ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['name'] ?></a>

                                <td>
                                    <a class="btn btn-app" href="<?= hUrl('Backend/EditCategory/' . $row['detail']) ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script>
            $(document).ready(function() {
                $('#DanhMucTb').DataTable();
            });
        </script>
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
                <?php if (isset($_POST['CreateCategory'])) {
                    if (empty($_POST['category'])) $KNCMS->msg_error("Không được để trống tên danh mục", "", 1000);
                    $category = $_POST['category'];
                    $detailc = $KNCMS->to_slug($category);
                    $insert = $KNCMS->query("INSERT INTO `kncms_danhmuc` SET
                    `name` = '$category',
                    `detail` = '$detailc'");
                    if ($insert) $KNCMS->msg_success("Thêm thành công", "", 1000);
                }
                ?>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tạo danh mục mới:</label>
                        <input type="text" class="form-control" name="category" placeholder="vd: ompvn2023">
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">ĐÓNG</button>
                <button type="submit" name="CreateCategory" class="btn btn-primary">TẠO NGAY</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php require_once('../private/foot.php') ?>
