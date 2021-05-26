<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;

class LoaiTinController extends Controller
{
    public function getDanhSach(){
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);

    }
    public function getThem(){
        $theloai = TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }
    public function postThem(Request $request){
           $this->validate($request,
           [
               'Ten'=>'required|unique:LoaiTin|min:1|max:100',
           ],
           [
               'Ten.required'=>'Ban chua nhap loai tin',
               'Ten.unique'=>'Ten loai tin da ton tai',
               'Ten.min'=>'Tên thể loại phải có độ dài từ 1 cho đến 100 ký tự',
               'Ten.max'=>'Tên thể loại phải có độ dài từ 1 cho đến 100 ký tự',

           ]);
           $loaitin = new LoaiTin();
           $loaitin->Ten = $request->Ten;
           $loaitin->TenKhongDau =($request->Ten);
           $loaitin->idTheloai = $request->TheLoai;
           $loaitin->save();
           return redirect('admin/loaitin/them')->with('thongbao','Thêm thành công');
    }
    public function getSua($id)
    {   $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.sua',['loaitin'=> $loaitin],['theloai'=>$theloai]);

    }
    public function postSua(Request $request,$id)
    {     $this->validate($request,
        [
            'Ten'=>'required|unique:LoaiTin|min:1|max:100',
        ],
        [
            'Ten.required'=>'Ban chua nhap loai tin',
            'Ten.unique'=>'Ten loai tin da ton tai',
            'Ten.min'=>'Tên thể loại phải có độ dài từ 1 cho đến 100 ký tự',
            'Ten.max'=>'Tên thể loại phải có độ dài từ 1 cho đến 100 ký tự',

        ]);
        $loaitin = new LoaiTin();
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau =($request->Ten);
        $loaitin->idTheLoai= $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/sua'.$id)->with('thongbao','Sửa thành công');
     }
    
    public function getXoa($id)
    {
        
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','ban da xoa thanh cong');
    }
    
}