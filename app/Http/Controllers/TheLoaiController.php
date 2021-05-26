<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use Illuminate\Support\Str;
class TheLoaiController extends Controller
{
    public function getDanhSach(){
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);

    }
    public function getThem(){
        return view('admin.theloai.them');
    }
    public function postThem(Request $request){
       $this->validate($request,
           [
              'Ten'=> 'required|min:3|max:50|',
           ],
           [
               'Ten.required'=>'Bạn chưa tên thể loại',
               'Ten.min'=>'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự',
               'Ten.max'=>'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự',
               
       ]);
       $theloai = new TheLoai();
       $theloai->Ten = $request->Ten;
       $theloai->TenKhongDau =($request->Ten);
       $theloai->save();
       return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
    }
    public function getSua($id)
    {
       $theloai = TheLoai::find($id);
       return view('admin.theloai.sua',['theloai'=>$theloai]);

    }
    public function postSua(Request $request,$id)
    {
          $theloai = TheLoai::find($id);
    //       $this->validate($request,
    //       [
    //          'Ten'=> 'required|min:3|max:50|'
    //       ],
    //       [
    //           'Ten.required'=>'Bạn chưa tên thể loại',
    //           'Ten.min'=>'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự',
    //           'Ten.max'=>'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự',
              
    //   ]);
           
           $theloai->Ten = $request->Ten;
           $theloai->TenKhongDau = Str::slug('$request->Ten','-');
           $theloai->save();
           return redirect('admin/theloai/sua'.$id)->with('thongbao','Sua thanh cong');
     }
    
    public function getXoa($id)
    {
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','ban da xoa thanh cong');
    }
    
}