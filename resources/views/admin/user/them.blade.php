@extends('admin.layout.index')
@section('content')
    

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                           {{$err}}<br>
                    @endforeach
                @endif
                @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
                @endif
                <form action="admin/user/them" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        @csrf
                        
                    <div class="form-group">
                        <label>Họ Tên</label>
                        <input class="form-control" name="name" placeholder="Nhập Tên" />
                    </div>
    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Nhập Tên" />
                    </div>
                    
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    
                    <div class="form-group">
                        <label> Nhập lại Password</label>
                        <input type="passwordAgain" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label>Quyền người dùng</label>
                        <label class="radio-inline">
                            <input name="quyen" value="1" checked="" type="radio">Admin
                        </label>
                        <label class="radio-inline">
                            <input name="quyen" value="0" type="radio">Thường
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-default">Thêm</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection