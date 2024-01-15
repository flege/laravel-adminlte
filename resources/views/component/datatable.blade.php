@push('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush
@push('js')
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                searchDelay : 300,
                processing: true,
                serverSide: true,
                aaSorting: [],
                autoWidth: false,
                responsive: true,
                language: {
                    processing: "Memuat data. Silahkan tunggu ....",
                    search: '<span>Pencarian:</span> _INPUT_',
                    lengthMenu: '<span>Tampilkan:</span> _MENU_',
                    emptyTable: "Tidak ada data",
                    zeroRecords: "Tidak ada data yang sesuai",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data yang ditemukan",
                    infoFiltered: "(Disaring dari _MAX_ total data)",
                    paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
                },
                ajax: "{{$datatable['route']}}",
                columns: {!! $datatable['column'] !!},
                fnDrawCallback: function () {
                    $('[data-toggle="tooltip"]').tooltip()
                }
            });
            $('.dataTables_filter input[type=search]').attr('placeholder','Masukkan kata kunci....');
        });
    </script>
@endpush
