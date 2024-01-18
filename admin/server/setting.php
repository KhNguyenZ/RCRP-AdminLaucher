<?php require_once('../../../server/config.php'); ?>
<?php require_once('../private/head.php') ?>
<?php require_once('../private/nav.php') ?>

<title>Website Panel</title>
<section class="col-lg-12 connectedSortable">
    <div class="card card-primary card-outline">
        <div class="card-header ">
            <h3 class="card-title">
                <i class="fas fa-history mr-1"></i>
                Quản Lí Website
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
        if(isset($_POST['btnSaveSetting']))
        {
            $Logo = $_POST['Logo'];
            $Title = $_POST['Title'];
            $Owner = $_POST['Owner'];
            $Fav = $_POST['Fav'];
            $Copyright = $_POST['Copyright'];
            $TokenMomo = $_POST['TokenMomo'];
            $SDTMOMO = $_POST['SDTMOMO'];
            $OwnerMOMO = $_POST['OwnerMOMO'];
            $APIKey = $_POST['APIKey'];
            $APIID = $_POST['APIID'];
            $PriceRename = $_POST['PriceRename'];
            $iframePage = $_POST['iframePage'];
            $iframeDiscord = $_POST['iframeDiscord'];
            $sqlquery = "UPDATE `kncms_settings` SET
            `Logo` = '$Logo', 
            `Title` = '$Title', 
            `Owner` = '$Owner', 
            `Fav` = '$Fav', 
            `Copyright` = '$Copyright',
            `TokenMomo` = '$TokenMomo', 
            `SDTMOMO` = '$SDTMOMO', 
            `OwnerMOMO` = '$OwnerMOMO', 
            `APIKey` = '$APIKey', 
            `APIID` = '$APIID', 
            `PriceRename` = '$PriceRename', 
            `iframePage` = '$iframePage', 
            `PriceRename` = '$PriceRename', 
            `iframeDiscord` = '$iframeDiscord'
            ";
            $update = $KNCMS->query($sqlquery);
            if($update) $KNCMS->msg_success("Lưu thành công", "", 1000);
            else $KNCMS->msg_warning("Lưu thất bại | ".$sqlquery, "", 10000);
        }
        ?>
        <div class="card-body">
            <form action="" method="POST">
                <div class="card-body">
                <div class="form-group">
                    <div class="form-group">
                        <label>Logo (*)</label>
                        <input type="text" class="form-control" value="<?= $knsite['Logo'] ?>" name="Logo" required>
                    </div>
                    <div class="form-group">
                        <label>Tên Website (*)</label>
                        <input type="text" class="form-control" value="<?= $knsite['Title'] ?>" name="Title">
                    </div>
                    <div class="form-group">
                        <label>Chủ (*)</label>
                        <input type="text" class="form-control" value="<?= $knsite['Owner'] ?>" name="Owner">
                    </div>
                    <div class="form-group">
                        <label>Fav (*)</label>
                        <input type="text" class="form-control" value="<?= $knsite['Fav'] ?>" name="Fav">
                    </div>
                    <div class="form-group">
                        <label>Copyright (*)</label>
                        <input type="text" class="form-control" value="<?= $knsite['Copyright'] ?>" name="Copyright">
                    </div>
                    <div class="form-group">
                        <label>Token MOMO - Lấy token tại <a href="https://api.sieuthicode.net">API.SIEUTHICODE</a>(*)</label>
                        <input type="text" class="form-control" value="<?= $knsite['TokenMomo'] ?>" name="TokenMomo">
                    </div>
                    <div class="form-group">
                        <label>STK Momo (*)</label>
                        <input type="text" class="form-control" value="<?= $knsite['SDTMOMO'] ?>" name="SDTMOMO">
                    </div>
                    <div class="form-group">
                        <label>Chủ TK (*)</label>
                        <input type="text" class="form-control" value="<?= $knsite['OwnerMOMO'] ?>" name="OwnerMOMO">
                    </div>
                    <div class="form-group">
                        <label>API Key - Lấy API tại <a href="https://doithe1s.vn">DOITHE1S.VN</a> (*)</label>
                        <input type="text" class="form-control" value="<?= $knsite['APIKey'] ?>" name="APIKey">
                    </div>
                    <div class="form-group">
                        <label>API ID - Lấy API tại <a href="https://doithe1s.vn">DOITHE1S.VN</a> (*)</label>
                        <input type="text" class="form-control" value="<?= $knsite['APIID'] ?>" name="APIID">
                    </div>
                    <div class="form-group">
                        <label>Giá đổi tên(*)</label>
                        <input type="text" class="form-control" value="<?= $knsite['PriceRename'] ?>" name="PriceRename">
                    </div>
                    <div class="form-group">
                        <label>Code iframe Page Server - Lấy code tại <a href="https://developers.facebook.com/docs/plugins/page-plugin/?locale=vi_VN">Đây</a></label>
                        <textarea class="form-control" rows="3" name="iframePage" placeholder="Code iframe Pages"><?=$knsite['iframePage']?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Code iframe Discord</label>
                        <textarea class="form-control" rows="3" name="iframeDiscord" placeholder="Code iframe Discord"><?=$knsite['iframeDiscord']?></textarea>
                    </div>
                    <div class="card-footer clearfix">
                        <button name="btnSaveSetting" aria-label="" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Lưu Ngay</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php require_once('../private/foot.php') ?>