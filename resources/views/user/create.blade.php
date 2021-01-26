@extends('base')
@section('title','User')
@section('user-menu','menu-open')
@section('user-header','active')
@section('user-tambah','active')
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
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
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
            <div class="card card-primary">
                <!-- form start -->
                <form action="{{route('user.store')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama*</label>
                            <input type="text" name="nama" value="{{old('nama')}}" class="form-control" placeholder="..." required>
                        </div>
                        <div class="form-group">
                            <label>Username*</label>
                            <input type="text" name="username" value="{{old('username')}}" class="form-control" placeholder="..." required>
                        </div>
                        <div class="form-group">
                            <label>Email*</label>
                            <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="..." required>
                        </div>
                        <div class="form-group">
                            <label>Password*</label>
                            <input type="password" name="password" value="{{old('password')}}" class="form-control" placeholder="..." required>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('js')
@include('component/validation')
@include('component/select2')
@endpush
