<?php require_once('../../../server/config.php'); ?>
<?php require_once('../private/head.php') ?>
<?php require_once('../private/nav.php') ?>
<?php if (isset($_GET['username'])) {
    $username = $KNCMS->anti_text($_GET['username']);
}
$data = $KNCMS->query("SELECT * FROM `accounts` WHERE `Username` = '$username'");
if ($data->num_rows > 0) {
    $data = $data->fetch_array();
    $uid = $data['id'];
?>
    <title>Edit User - <?= $data['Username'] ?></title>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user-edit mr-1"></i>
                                CHỈNH SỬA THÀNH VIÊN
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
                        <?php
                        if (isset($_POST['btnSaveUser'])) {
                            $email = $_POST['email'];
                            $level = ceil($_POST['level']);
                            $mkc2 = $_POST['mkc2'];
                            $update = $KNCMS->query("UPDATE `accounts` SET 
                            `Email` = '$email' ,
                            `Level` = '$level',
                            `Pin` = '$mkc2'
                            WHERE `id` = '$uid'");
                            if (!empty($_POST['password'])) {
                                $password = hash('whirlpool', $KNCMS->anti_text($_POST['password']));
                                $update1 = $KNCMS->query("UPDATE `accounts` SET 
                                `Key` = '$password' WHERE `id` = '$uid'");
                                if ($update1) {
                                    KNCMS_Log("Admin | Cập nhật mật khẩu thành công", $uid);
                                    $KNCMS->msg_success("Cập nhật mật khẩu thành công", "", 1000);
                                }
                            }
                            if ($update) {
                                KNCMS_Log("Admin | Cập nhật thông tin thành công !", $uid);
                                $KNCMS->msg_success("Cập nhật thành công !", "", 1000);
                            } else $KNCMS->msg_error("Cập nhật không thành công , vui lòng liên hệ KNCMS để fix", "", 1000);
                        }
                        ?>
                        <form action="" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Email (*)</label>
                                    <input type="email" class="form-control" value="<?= $data['Email'] ?>" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu (*)</label>
                                    <input type="text" class="form-control" placeholder="**********" name="password">
                                    <i>Nhập mật khẩu cần thay đổi, hệ thống sẽ tự động mã hoá (để trống nếu
                                        không muốn
                                        thay đổi)</i>
                                </div>
                                <div class="form-group">
                                    <label>Level (*)</label>
                                    <input type="number" class="form-control" value="<?= $data['Level'] ?>" name="level">
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu cấp 2 (*)</label>
                                    <input type="text" class="form-control" value="<?= $data['Pin'] ?>" name="mkc2" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Money</label>
                                            <input type="text" class="form-control" value="<?= $KNCMS->format_cash($data['Money']) ?> SAD" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Total Money</label>
                                            <input type="text" class="form-control" value="<?= $KNCMS->format_cash($data['Money'] + $data['Bank']) ?> SAD" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bank</label>
                                            <input type="text" class="form-control" value="<?= $KNCMS->format_cash($data['Bank']) ?> SAD" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>IP Login</label>
                                            <input type="text" class="form-control" value="<?= $data['IP'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= $knsite['PriceOOC'] ?></label>
                                            <input type="text" class="form-control" value="<?= $data['Credits'] ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Register Day</label>
                                            <input type="text" class="form-control" value="<?= $data['RegiDate'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Login</label>
                                            <input type="text" class="form-control" value="<?= $data['LastLogin'] ?>" readonly>
                                        </div>
                                    </div>
                                </div><br>
                            </div>
                            <div class="card-footer clearfix">
                                <button name="btnSaveUser" aria-label="" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </div>
                        </form>
                    </div>
                </section>
                <section class="col-lg-6 connectedSortable">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-money-bill-alt mr-1"></i>
                                CỘNG TIỀN
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
                            <?php
                            if (isset($_POST['cong_tien'])) {
                                $amount = ceil($_POST['amount']);
                                $reason = $_POST['reason'];
                                $option = $_POST['type_value'];

                                if (empty($reason)) $reason = "Admin cộng tiền";
                                if ($option == 'cash') {
                                    $cash = $data['Money'] + $amount;
                                    $update_cash = $KNCMS->query("UPDATE `accounts` SET
                                    `Money` = '$cash' WHERE `Username` = '$username'");
                                    if ($update_cash) {
                                        $amount = $KNCMS->format_cash($amount);
                                        KNCMS_Log("Admin | Cộng tiền thành công - $amount SAD", $uid);
                                        $KNCMS->msg_success("Cộng tiền thành công", "", 1000);
                                    }
                                }
                                if ($option == 'coin') {
                                    $cash = $data['Credits'] + $amount;
                                    $ooc = $knsite['PriceOOC'];
                                    $update_cash = $KNCMS->query("UPDATE `accounts` SET
                                    `Credits` = '$cash' WHERE `Username` = '$username'");
                                    if ($update_cash) {
                                        $amount = $KNCMS->format_cash($amount);
                                        KNCMS_Log("Admin | Cộng tiền thành công - $amount Coin", $uid);
                                        $KNCMS->msg_success("Cộng $ooc thành công", "", 1000);
                                    }
                                }
                                if ($option == 'bank') {
                                    $cash = $data['Bank'] + $amount;
                                    $update_cash = $KNCMS->query("UPDATE `accounts` SET
                                    `Bank` = '$cash'WHERE `Username` = '$username'");
                                    if ($update_cash) {
                                        $amount = $KNCMS->format_cash($amount);
                                        KNCMS_Log("Admin | Cộng tiền(bank) thành công - $amount SAD", $uid);
                                        $KNCMS->msg_success("Cộng tiền(bank) thành công", "", 1000);
                                    }
                                }
                            }
                            ?>
                            <form method="POST" role="form">
                                <div class="form-group">
                                    <label>Loại (*)</label>
                                    <select class="form-control select2bs4" name="type_value">
                                        <option value="cash"> CASH ( SAD )</option>
                                        <option value="coin"> <?= $knsite['PriceOOC'] ?></option>
                                        <option value="bank"> Cash ( Bank )</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Amount (*)</label>
                                    <input type="hidden" class="form-control" id="id" value="488">
                                    <input type="number" class="form-control" name="amount" placeholder="Nhập số tiền cần cộng" required>
                                </div>
                                <div class="form-group">
                                    <label>Reason (*)</label>
                                    <textarea class="form-control" name="reason" placeholder="Nhập nội dung nếu có"></textarea>
                                </div>
                                <br>
                                <button aria-label="" name="cong_tien" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-paper-plane mr-1"></i>Submit</button>
                            </form>
                        </div>
                    </div>
                </section>
                <section class="col-lg-6 connectedSortable">
                    <div class="card card-danger card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-money-bill-alt mr-1"></i>
                                TRỪ TIỀN
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
                            <?php
                            if (isset($_POST['tru_tien'])) {
                                $amount = ceil($_POST['amount']);
                                $reason = $_POST['reason'];
                                $option = $_POST['type_value'];

                                if (empty($reason)) $reason = "Admin trừ tiền";
                                if ($option == 'cash') {
                                    $cash = $data['Money'] - $amount;
                                    $update_cash = $KNCMS->query("UPDATE `accounts` SET
                                    `Money` = '$cash' WHERE `Username` = '$username'");
                                    if ($update_cash) {
                                        $amount = $KNCMS->format_cash($amount);
                                        KNCMS_Log("Admin | Trừ tiền(bank) thành công - $amount SAD", $uid);
                                        $KNCMS->msg_success("Trừ tiền thành công", "", 1000);
                                    }
                                }
                                if ($option == 'coin') {
                                    $cash = $data['Credits'] - $amount;
                                    $ooc = $knsite['PriceOOC'];
                                    $update_cash = $KNCMS->query("UPDATE `accounts` SET
                                    `Credits` = '$cash' WHERE `Username` = '$username'");
                                    if ($update_cash) {
                                        $amount = $KNCMS->format_cash($amount);
                                        KNCMS_Log("Admin | Trừ $ooc thành công - $amount Coin", $uid);
                                        $KNCMS->msg_success("Trừ $ooc thành công", "", 1000);
                                    }
                                }
                                if ($option == 'bank') {
                                    $cash = $data['Bank'] - $amount;
                                    $update_cash = $KNCMS->query("UPDATE `accounts` SET
                                    `Bank` = '$cash'WHERE `Username` = '$username'");
                                    if ($update_cash) {
                                        $amount = $KNCMS->format_cash($amount);
                                        KNCMS_Log("Admin | Trừ tiền(bank) thành công - $amount SAD", $uid);
                                        $KNCMS->msg_success("Trừ tiền(bank) thành công", "", 1000);
                                    }
                                }
                            }
                            ?>
                            <form class="" action="" method="POST" role="form">
                                <div class="form-group">
                                    <label>Loại (*)</label>
                                    <select class="form-control select2bs4" name="type_value">
                                        <option value="cash"> CASH ( SAD )</option>
                                        <option value="coin"> <?= $knsite['PriceOOC'] ?></option>
                                        <option value="bank"> Cash ( Bank )</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Amount (*)</label>
                                    <input type="hidden" class="form-control" id="id" value="488">
                                    <input type="number" class="form-control" name="amount" placeholder="Nhập số tiền cần trừ" required>
                                </div>
                                <div class="form-group">
                                    <label>Reason (*)</label>
                                    <textarea class="form-control" name="reason" placeholder="Nhập nội dung nếu có"></textarea>
                                </div>
                                <br>
                                <button aria-label="" name="tru_tien" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-paper-plane mr-1"></i>Submit</button>
                            </form>
                        </div>
                    </div>
                </section>
                <section class="col-lg-12 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header ">
                            <h3 class="card-title">
                                <i class="fas fa-history mr-1"></i>
                                NHẬT KÝ HOẠT ĐỘNG
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
                                            <th width="5%">ID</th>
                                            <th>Username</th>
                                            <th width="40%">Action</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($KNCMS->get_list("SELECT * FROM `kncms_log` WHERE `uid` = '$uid' ORDER BY id desc ") as $row) {
                                        ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $data['Username'] ?></a>
                                                </td>
                                                <td><?= $row['log'] ?></td>
                                                <td><?= $row['time'] ?></td>
                                            </tr>
                                            <?php $i++ ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
<?php } else $KNCMS->msg_error("Khong tim thay user nay", "$base_url", 1000);
require_once('../private/foot.php') ?>