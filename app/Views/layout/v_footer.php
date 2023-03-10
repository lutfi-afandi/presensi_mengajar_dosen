</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2021 <a href="#" class="text-danger">Tim IT</a>.</strong> CEFADA
</footer>
</div>

<!-- jQuery -->
<script src="<?= base_url(); ?>/template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url(); ?>/template/dist/js/demo.js"></script> -->
<!-- Select2 -->
<script src="<?= base_url(); ?>/template/plugins/select2/js/select2.full.min.js"></script>


<!-- Signature script -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script> -->
<script src="<?= base_url('template/signature/js/jquery.signature.js'); ?>"></script>
<script src="<?= base_url('template/signature/js/jquery.ui.touch-punch.min.js'); ?>"></script>

<script type="text/javascript">
    var sig = $('#sig').signature({
        syncField: '#signature',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature").val('');
    });
</script>
<script>
    $(function() {
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        })
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        })
        $('#example').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        })
    })
</script>


<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        })
    }, 2500);
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if (session()->getFlashdata('swal_icon')) { ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('swal_icon'); ?>',
            title: '<?= session()->getFlashdata('swal_title'); ?>',
            text: '<?= session()->getFlashdata('swal_text'); ?>',
            showConfirmButton: false,
            timer: 1500
        })
    <?php } ?>
</script>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>
<script type="text/javascript">
    $(document).on('change', '#tg_akhir', function() {
        var tg_awal = $("#tg_awal").val();
        var tg_akhir = $(this).val();
        if (tg_awal === "") {
            alert('silahkan pilih tanggal awal terlebih dahulu')
        } else {
            window.location.href = "?tg_awal=" + tg_awal + "&tg_akhir=" + tg_akhir;
        }
    });

    $(document).on('change', '#dosen_id', function() {
        var tg_awal = $("#tg_awal").val();
        var tg_akhir = $("#tg_akhir").val();
        var dosen_id = $(this).val();
        if (tg_awal === "" && tg_akhir === "") {
            alert('silahkan pilih rentang tanggal terlebih dahulu')
        } else {
            window.location.href = "?tg_awal=" + tg_awal + "&tg_akhir=" + tg_akhir + "&dosen_id=" + dosen_id;
        }
    });
</script>
<script>
    function btn_excel() {
        var tg_awal = $("#tg_awal").val();
        var tg_akhir = $("#tg_akhir").val();
        var dosen_id = $("#dosen_id").val();
        if (tg_awal === "" && tg_akhir === "" && dosen_id === "") {
            alert('pilih rentang atau dosen nya')
        } else {
            // kalu tidak pilih dosen
            if (dosen_id === "") {
                window.location.href = "<?= base_url('Admin/Absensi/export_excel'); ?>" + "/" + tg_awal + "/" + tg_akhir;
            } else {
                window.location.href = "<?= base_url('Admin/Absensi/export_excel'); ?>" + "/" + tg_awal + "/" + tg_akhir + "/" + dosen_id;
            }
        }
    }

    function btn_refresh() {
        window.location.href = "<?= base_url('Admin/Absensi'); ?>";
    }

    function btn_pdf() {
        var tg_awal = $("#tg_awal").val();
        var tg_akhir = $("#tg_akhir").val();
        var dosen_id = $("#dosen_id").val();
        if (tg_awal === "" && tg_akhir === "" && dosen_id === "") {
            alert('pilih rentang atau dosen nya')
        } else {
            // kalu tidak pilih dosen
            if (dosen_id === "") {
                window.location.href = "<?= base_url('Admin/Absensi/export_pdf'); ?>" + "/" + tg_awal + "/" + tg_akhir;
            } else {
                window.location.href = "<?= base_url('Admin/Absensi/export_pdf'); ?>" + "/" + tg_awal + "/" + tg_akhir + "/" + dosen_id;
            }
        }
    }
</script>
</body>

</html>