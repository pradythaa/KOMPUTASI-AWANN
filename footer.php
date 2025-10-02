<script type="text/javascript" src="assets_admin/assets/js/jquery/jquery.min.js "></script>
<script type="text/javascript" src="assets_admin/assets/js/jquery-ui/jquery-ui.min.js "></script>
<script type="text/javascript" src="assets_admin/assets/js/popper.js/popper.min.js"></script>
<script type="text/javascript" src="assets_admin/assets/js/bootstrap/js/bootstrap.min.js "></script>
<!-- waves js -->
<script src="assets_admin/assets/pages/waves/js/waves.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="assets_admin/assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- slimscroll js -->
<script src="assets_admin/assets/js/jquery.mCustomScrollbar.concat.min.js "></script>

<!-- menu js -->
<script src="assets_admin/assets/js/pcoded.min.js"></script>
<script src="assets_admin/assets/js/vertical/vertical-layout.min.js "></script>

<script type="text/javascript" src="assets_admin/assets/js/script.js "></script>

<script src="assets/build/js/custom.min.js"></script>

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">

<script>
    $(document).ready(function() {
        $('#table').DataTable();
        $('#table2').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#daftarproduk').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pdfHtml5',
                    title: 'Data Persediaan Obat',
                    orientation: 'landscape',
                    text: '<i class="fa fa-download"></i> CETAK',
                    className: 'btn btn-success btn-sm',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    customize: function(doc) {
                        doc.content[1].table.widths =
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        doc.defaultStyle.alignment = 'center';
                        doc.styles.tableHeader.alignment = 'center';
                    }

                },
                'colvis'
            ],
        });
        $('#pengeluarandaftar').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pdfHtml5',
                    title: 'Data Pengeluaran',
                    orientation: 'landscape',
                    text: '<i class="fa fa-download"></i> CETAK',
                    className: 'btn btn-success btn-sm',
                    exportOptions: {
                        columns: [0, 1, 3]
                    },
                    customize: function(doc) {
                        doc.content[1].table.widths =
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        doc.defaultStyle.alignment = 'center';
                        doc.styles.tableHeader.alignment = 'center';
                    }

                },
                'colvis'
            ],
        });
    });
</script>
</body>

</html>