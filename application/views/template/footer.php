<script src="<?= base_url() ?>assets\js\vendor.min.js"></script>
<script src="<?= base_url() ?>assets\libs\jquery-knob\jquery.knob.min.js"></script>

<!--Morris Chart-->
<!-- <script src="<?= base_url() ?>assets\libs\morris-js\morris.min.js"></script>
<script src="<?= base_url() ?>assets\libs\raphael\raphael.min.js"></script> -->

<!-- Dashboard init js-->
<script src="assets/js/toastr.min.js"></script>

<script src="<?= base_url() ?>assets\js\main.js"></script>
<script src="<?= base_url() ?>assets\libs\custombox\custombox.min.js"></script>
<script src="<?= base_url()?>assets\libs\datatables\jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets\libs\datatables\dataTables.bootstrap4.js"></script>
<script src="<?= base_url()?>assets\libs\datatables\dataTables.responsive.min.js"></script>
<script src="<?= base_url()?>assets\libs\datatables\responsive.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets\libs\datatables\dataTables.buttons.min.js"></script>
<script src="<?= base_url()?>assets\libs\datatables\buttons.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets\libs\datatables\buttons.html5.min.js"></script>
<script src="<?= base_url()?>assets\libs\datatables\jszip.min.js"></script>
<script src="<?= base_url()?>assets\libs\datatables\buttons.flash.min.js"></script>
<script src="<?= base_url()?>assets\libs\datatables\buttons.print.min.js"></script>
<script src="<?= base_url()?>assets\libs\datatables\dataTables.keyTable.min.js"></script>
<script src="<?= base_url()?>assets\libs\datatables\dataTables.select.min.js"></script>
<script src="<?= base_url()?>assets\libs\pdfmake\pdfmake.min.js"></script>
<script src="<?= base_url()?>assets\libs\pdfmake\vfs_fonts.js"></script>
<!-- <script src="<?= base_url()?>assets\js\pages\datatables.init.js"></script> -->
<script src="<?= base_url()?>assets\sweetalert2.all.min.js"></script>

<!-- Custom Export DataTable -->
<script type="text/javascript">
$(document).ready(function() {
    $('#datatable').DataTable({
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, 100, -1],
            ['10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
        ],
        buttons: [
            'pageLength'
        ]
    });
});
</script>


<?php  if($this->session->flashdata('Success'))
{
    echo "<script>toastr['success']('{$this->session->flashdata('Success')}') </script>";
}
 if($this->session->flashdata('Error'))
{
    echo "<script>toastr['error']('{$this->session->flashdata('Error')}') </script>";
}
?>

</body>

</html>