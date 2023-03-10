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


    <!-- ce -->

    <link rel="stylesheet" href="<?= base_url(); ?>/template/dist/css/skins/_all-skins.min.css">

    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>/assets/img/logo.png">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body onload="window.print()">
    <table class="table table-striped table-sm table-hover" id="example1">
        <thead class="bg-gradient-success text-nowrap text-xs">
            <tr>
                <th class="text-center">#</th>
                <th>Nama Dosen</th>
                <th>Tanggal</th>
                <th>Semester</th>
                <th>Kelas</th>
                <th>Mulai</th>
                <th>Selesai</th>
            </tr>
        </thead>
        <tbody class="">
            <?php $no = 1;
            foreach ($absensi as $key => $row) { ?>
                <tr>
                    <th><?= $no++; ?></th>
                    <td><?= $row['nama_user']; ?></td>
                    <td><?php echo strftime("%d %b %Y", strtotime($row['tanggal'])); ?></td>
                    <td> <?= $row['semester']; ?> <?= $row['ta']; ?> </td>
                    <td class="text-nowrap"><?= $row['kode_kelas']; ?> <?= $row['nama_kelas']; ?> - <?= $row['angkatan_kelas']; ?></td>
                    <td><?= date('G:i', strtotime($row['waktu_mulai'])); ?></td>
                    <td><?= date('G:i', strtotime($row['waktu_selesai'])); ?></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>


</body>

</html>