<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= $base_url ?>public/admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>public/admin/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>public/admin/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>public/admin/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= $base_url ?>public/admin/plugins/summernote/summernote-bs4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/54b11bb8ef.js" crossorigin="anonymous"></script>
    <link rel="icon" href="<?= $knsite['Fav'] ?>" />
</head>

<style>
    body {
        background: url('img/bg.png') no-repeat !important;
        background-size: cover !important;
        background-attachment: fixed !important;
        background-repeat: no-repeat !important;
        background-position: center center !important;
        overflow-y: scroll !important;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        if (!isset($_SESSION['superadmin'])) {
            $KNCMS->msg_warning("Bug con mẹ m đỉ chó cút", "$base_url", 1000);
        }
        ?>