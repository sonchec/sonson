@extends('admin.layout.index')
@section('content')
    

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>{{$tintuc->TieuDe}}</small>
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
                <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="TheLoai" id="TheLoai">
                            @foreach($theloai as $tl)
                                  <option 
                                  @if($tintuc->loaitin->theloai->id == $tl->id)
                                   {{"selected"}}
                                   @endif
                            value="{{$tl->id}}">{{$tl->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label>Loại Tin</label>
                        <select class="form-control" name="LoaiTin" id="LoaiTin">
                            @foreach($loaitin as $lt)
                            <option
                             value="{{$lt->id}}">{{$lt->Ten}}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label>Tiêu Đề</label>
                        <input class="form-control" name="TieuDe" placeholder="Please Enter Category Name" />
                    </div>
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea name="TomTat" id="demo" class="ckeditor">{{$tintuc->TomTat}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea name="NoiDung" id="demo" class="ckeditor">{{$tintuc->NoiDung}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <img width="400px" src="upload/tintuc/{{$tintuc->Hinh}}">
                        <input type="file" name="Hinh">
                    </div>
                   
                    <div class="form-group">
                        <label>Nổi Bật</label>
                        <label class="radio-inline">
                            <input 
                            @if($tintuc->NoiBat ==0)
                            {{"checked"}}
                            @endif
                            name="NoiBat" value="0" checked="" type="radio">Không
                        </label>
                        <label class="radio-inline">
                            <input 
                            @if($tintuc->NoiBat ==1)
                            {{"checked"}}
                            @endif
                            name="NoiBat" value="1" type="radio">Có
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Sửa</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tuc
                    <small>Danh sach</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if(session('thongbao'))
            <div class="alert alert-success">
                {{session('thongbao')}}
            </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Nội Dung</th>
                        <th>Ngày đăng</th>
                        <th>Delete</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($tintuc->comment as $cm)
                    <tr class="odd gradeX" align="center">
                        <td>{{$cm->id}}</td>
                        <td><p>{{$cm->user->name}}</P></td>
                        <td>{{$cm->NoiDung}}</td>
                        <td>{{$cm->created_at}}</td>
                     
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>
                       
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $("#TheLoai").change(function(){
         var idTheLoai = $(this).val();
         $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
               $("#LoaiTin").html(data);
         });
        });
    });
    </script>
@endsection