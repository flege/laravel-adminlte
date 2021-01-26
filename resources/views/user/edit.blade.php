@extends('base')
@section('title','User')
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
                        <li class="breadcrumb-item active">Edit</li>
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
                <form action="{{route('user.edit',$user->id_users)}}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama*</label>
                            <input type="text" name="nama" value="{{$user->nama}}" class="form-control" placeholder="..." required>
                        </div>
                        <div class="form-group">
                            <label>Email*</label>
                            <input type="email" name="email" value="{{$user->email}}" class="form-control" placeholder="..." required>
                        </div>
                        <div class="form-group">
                            <label>Username*</label>
                            <input type="text" name="username" value="{{$user->username}}" class="form-control" placeholder="..." required>
                        </div>
                        <div class="form-group custom-switch">
                            <input type="checkbox" name="change_password" class="custom-control-input" id="change_password">
                            <label class="custom-control-label" for="change_password">Tekan disini untuk mengganti password</label>
                        </div>
                        <div class="form-group form_change_password">
                            <label>Password Baru</label>
                            <input type="password" name="password_new" class="form-control" placeholder="...">
                        </div>
                        <div class="form-group form_change_password">
                            <label>Ketik Ulang Password Baru</label>
                            <input type="password" name="password_confirm" class="form-control" placeholder="...">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
    <script>
        $(document).ready(function() {
            $(".form_change_password").hide();
            $("#change_password").change(function(){
                if($(this).is(':checked')){
                    $(".form_change_password").show();
                }else{
                    $(".form_change_password").hide();
                }
            });
        });
    </script>
@endpush
