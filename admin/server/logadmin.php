<?php require_once('../../../server/config.php'); ?>
<?php require_once('../private/head.php') ?>
<?php require_once('../private/nav.php') ?>

<title>Log thao tác admin</title>

<section class="col-lg-12 connectedSortable">
    <div class="card card-primary card-outline">
        <div class="card-header ">
            <h3 class="card-title">
                <i class="fas fa-history mr-1"></i>
                Log thao tác admin
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
                            <th>ID</th>
                            <th>Log</th>
                            <th>Admin</th>
                            <th>Cấp bậc</th>
                            <th>Trạng thái</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($KNCMS->get_list("SELECT * FROM `kncms_admin_log` ORDER BY id desc LIMIT 100") as $row) {
                            $usern = $row['admin'];
                            $adminz = $KNCMS->query("SELECT * FROM `accounts` WHERE `Username` = '$usern'")->fetch_array();
                            $i++;
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row['text'] ?></a>
                                <td><span class="badge badge-warning"><?= $row['admin'] ?></a>
                                <td><span class="badge badge-danger"><?= capbac($adminz['AdminLevel']) ?></span></a>
                                <td>
                                    <?php
                                    if ($row['status'] == 1) { ?>
                                        <span class="badge badge-success">Xác nhận</span>
                                    <?php } else { ?>
                                        <span class="badge badge-danger">Từ chối</span>
                                    <?php } ?>
                                </td>
                                <td><?= $row['time'] ?></a></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php require_once('../private/foot.php') ?>