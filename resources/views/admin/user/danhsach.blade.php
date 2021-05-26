@extends('admin.layout.index')
@section('content')
    

<!-- Page Content -->
 <div id="page-wrapper">
   <div class="container-fluid">
       <div class="row">
           <div class="col-lg-12">
               <h1 class="page-header">User
                   <small>danh sách</small>
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
                       <th>Name</th>
                       <th>Email</th>
                       <th>Level</th>
                       <th>Delete</th>
                       <th>Edit</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach($user as $u)
                   <tr class="odd gradeX" align="center">
                       <td>{{$u->id}}</td>
                       <td>{{$u->name}}</td>
                       <td>{{$u->email}}</td>
                       <td>
                        @if($u->quyen == 1)
                        {{"Admin"}}
                        @else
                        ({{"Thường"}})
                            
                        @endif
                        </td>
                       
                       <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/user/xoa/{{$u->id}}"> Delete</a></td>
                       <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/user/sua/{{$u->id}}">Edit</a></td>
                   </tr>
                   @endforeach
               </tbody>
           </table>
       </div>
       <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<script type="text/javascript">
   document.addEventListener('DOMContentLoaded', evt => {
       $('.fa fa-pencil fa-fw').click(function (e) {
           if (confirm('Are you sure ???')) {
               $.ajax({
                   url: '/posts/' + $(this).data('id'),
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   type: 'DELETE',
                   success: function(result){
                       location.reload();
                   }
               });
           }
       });
   })
</script>
@endsection