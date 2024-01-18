<?php require_once('../../../server/config.php'); ?>
<?php require_once('../private/head.php') ?>
<?php require_once('../private/nav.php') ?>

<title>Log Rename</title>

<section class="col-lg-12 connectedSortable">
    <div class="card card-primary card-outline">
        <div class="card-header ">
            <h3 class="card-title">
                <i class="fas fa-history mr-1"></i>
                Lịch sử đổi tên
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
                            <th>Current Coin</th>
                            <th>New Coin</th>
                            <th>Current Name</th>
                            <th>New Name</th>
                            <th>Loại</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($KNCMS->get_list("SELECT * FROM `kncms_log_rename` WHERE `type` = 'rename' ORDER BY id desc LIMIT 100") as $row) {
                            $i++;
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row['text'] ?></a>
                                <td><span class="badge badge-warning"><?=$KNCMS->format_cash($row['cur_coins'])?> <?=$knsite['PriceOOC']?></span></td>
                                <td><span class="badge badge-danger"><?=$KNCMS->format_cash($row['new_coins'] ) ?> <?=$knsite['PriceOOC']?></span></td>
                                <td><?= $row['curname'] ?></a>
                                <td><?= $row['newname'] ?></a>
                                <td><span class="badge badge-info">Đổi tên</span></a>
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