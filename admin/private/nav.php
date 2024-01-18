<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= $base_url ?>" class="nav-link">Trang chủ</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= $admin_url ?>/" class="nav-link">Trang ADMIN</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= $admin_url ?>" class="brand-link">
        <!-- <img src="<?= $base_url ?>lib/ompvn_logo.png" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">GSAMP.VN</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                <li class="nav-item">
                    <a href="<?= $admin_url ?>" class="nav-link">
                        <i class="fa-solid fa-house"></i>
                        <p> Home </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $admin_url ?>/VerifyEmail" class="nav-link">
                        <i class="fa-solid fa-envelope"></i>
                        <p> Xác nhận email </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $admin_url ?>/ListMembers" class="nav-link">
                        <i class="fa fa-user"></i>
                        <p> Chỉnh sửa thành viên </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $admin_url ?>/ListGiftocde" class="nav-link">
                        <i class="fa-solid fa-gift"></i>
                        <p> Giftcode </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $admin_url ?>/ListVehicles" class="nav-link">
                        <i class="fa-solid fa-car-side"></i>
                        <p> Vehicles </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $admin_url ?>/ListItems" class="nav-link">
                    <i class="fa-solid fa-list"></i>
                        <p> Vật Phẩm </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $admin_url ?>/ListToys" class="nav-link">
                        <i class="fa-solid fa-shirt"></i>
                        <p> Toys </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $admin_url ?>/Category" class="nav-link">
                        <i class="fa-solid fa-list"></i>
                        <p> Quản lí danh mục </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $admin_url ?>/Pages" class="nav-link">
                        <i class="fa-solid fa-list"></i>
                        <p> Quản lí danh mục con </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $admin_url ?>/WebsiteSetting" class="nav-link">
                        <i class="fa-solid fa-gear"></i>
                        <p> Website setting </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $admin_url ?>/LogRename" class="nav-link">
                        <i class="fa-solid fa-list"></i>
                        <p> Log Rename </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $admin_url ?>/LogShopVeh" class="nav-link">
                        <i class="fa-solid fa-list"></i>
                        <p> Log Vehicle </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $admin_url ?>/LogShopToys" class="nav-link">
                        <i class="fa-solid fa-list"></i>
                        <p> Log Toys </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $admin_url ?>/LogAdmin" class="nav-link">
                        <i class="fa-solid fa-list"></i>
                        <p> Log Admin </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $admin_url ?>/LogItem" class="nav-link">
                        <i class="fa-solid fa-list"></i>
                        <p> Log Vật Phẩm </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $admin_url ?>/Crash" class="nav-link">
                        <i class="fa fa-user"></i>
                        <p> Duyệt Crash </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>