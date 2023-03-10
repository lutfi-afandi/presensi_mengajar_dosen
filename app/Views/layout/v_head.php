<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Absensi | <?= $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/dist/css/adminlte.min.css">

  <!-- signatur -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

  <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">

  <!-- ce -->

  <link rel="stylesheet" href="<?= base_url(); ?>/template/dist/css/skins/_all-skins.min.css">

  <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>/assets/img/logo.png">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

  <!-- SweetAlert -->

  <link rel="stylesheet" href="<?= base_url(); ?>/template/vendor/package/dist/sweetalert2.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    @media (min-width: 992px) {
      .kbw-signature {
        width: 50%;
        height: 250px;
      }

      #sig canvas {
        width: 100% !important;
        height: auto;
      }
    }

    @media (max-width: 992px) {
      .kbw-signature {
        width: 100%;
        height: 200px;
      }

      #sig canvas {
        width: 100% !important;
        height: auto;
      }
    }
  </style>
</head>