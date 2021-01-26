@extends('base')
@section('title','User')
@section('user-menu','menu-open')
@section('user-header','active')
@section('user','active')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('user.index')}}">User</a></li>
                        <li class="breadcrumb-item active">Data</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (session('message'))
            <div class="alert alert-{{session('message')['color']}} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{session('message')['response']}}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <a href="{{route('user.create')}}" class="btn btn-primary float-right">Tambah Data</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="datatable table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 1px">#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th style="width: 1px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Peringatan!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan menghapus data ini?</p>
                </div>
                <form action="{{route('user.destroy')}}" method="POST">
                    @csrf
                    @method('delete')
                    <div class="modal-footer justify-content-between">
                        <input type="hidden" name="id">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
@push('js')
@include('component/datatable')
@include('component/tooltip')
<script>
    $(document).on("click", ".btn-delete", function () {
        var id = $(this).data('id');
        $("[name=id]").val(id);
    });
</script>
@endpush
