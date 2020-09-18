<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="<?= base_url() ;?>assets/css/main.css" rel="stylesheet" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets\images\favicon.ico">

    <!-- Bootstrap Css -->

    <link href="<?= base_url() ?>assets\libs\datatables\dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets\libs\datatables\responsive.bootstrap4.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets\libs\datatables\buttons.bootstrap4.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets\libs\datatables\select.bootstrap4.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets\css\bootstrap.min.css" id="bootstrap-stylesheet" rel="stylesheet"
    type="text/css">
    <!-- Icons Css -->
    <link href="<?= base_url() ?>assets\css\icons.min.css" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="<?= base_url() ?>assets\css\app.min.css" id="app-stylesheet" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets\libs\custombox\custombox.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style type="text/css">
        body{
            background-color: #F25220 !important;
        }
        body[data-topbar=dark] .navbar-custom {
            background-color: #FFF;
            color: black;
        }
        .navbar-custom .topnav-menu .nav-link{
            color: #6c757d !important;
        }

        .text-muted{
            color: #fff !important;
        }
    </style>
</head>