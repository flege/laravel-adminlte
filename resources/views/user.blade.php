@extends('base')
@section('title','User')
@section('menuuser','active')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-dark">User</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    @foreach($errors->all() as $message)
                        <p class="m-0">{{"$message"}}</p>
                    @endforeach
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <button onclick="add()" class="btn btn-primary float-right">Tambah Data</button>
                </div>
                <div class="card-body">
                    <table class="datatable table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 1px">#</th>
                            <th style="width: 1px"></th>
                            <th>Kode Pegawai</th>
                            <th>Nama</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('user.store')}}" method="post" id="formadd">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Pegawai*</label>
                            <input type="text" name="kodepegawai" value="{{old('kodepegawai')}}" class="form-control" placeholder="..." mask-number-clean required>
                        </div>
                        <div class="form-group">
                            <label>Nama*</label>
                            <input type="text" name="nama" value="{{old('nama')}}" class="form-control" placeholder="..." required>
                        </div>
                        <div class="form-group">
                            <label>Password*</label>
                            <input type="password" name="password" value="{{old('password')}}" class="form-control" placeholder="..." required>
                        </div>
                    </div>
                    <div class="modal-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('user.update')}}" method="post" id="formedit">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Pegawai*</label>
                            <input type="text" name="kodepegawai" class="form-control" placeholder="..." mask-number-clean required>
                        </div>
                        <div class="form-group">
                            <label>Nama*</label>
                            <input type="text" name="nama" class="form-control" placeholder="..." required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak mengganti password">
                        </div>
                    </div>
                    <input type="hidden" name="id">
                    <div class="modal-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@include('component/datatable')
@include('component/tooltip')
@include('component/validation')
@include('component/inputmask')
@include('component/sweetalert')
@push('js')
<script>
    function add(){
        $('#formadd')[0].reset();
        $('#modal-add').modal('show');
    }

    function edit(id){
        $.ajax({
            url: "{{ route('user.edit', ['id' => ':id']) }}".replace(':id', id),
            method: "GET",
            dataType: 'json',
            success: function (response) {
                $('#formedit')[0].reset();
                $('[name="id"]').val(response.id);
                $('[name="kodepegawai"]').val(response.kodepegawai);
                $('[name="nama"]').val(response.nama);
                $('#modal-edit').modal('show');
            },
            error: function (err) {
                console.log(err);
            }
        })
    }

    function hapus(id){
        Swal.fire({
            title: "Hapus Data?",
            showCancelButton: true,
            confirmButtonText: "Hapus",
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('user.destroy', ['id' => ':id']) }}".replace(':id', id),
                    method: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });
                        $('.datatable').DataTable().ajax.reload();
                    },
                    error: function (err) {
                        Toast.fire({
                            icon: 'error',
                            title: err.statusText
                        });
                    }
                })
            }
        });
    }
</script>
@endpush
