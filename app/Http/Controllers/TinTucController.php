<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\TinTuc;
use App\Models\LoaiTin;
use App\Models\Comment;
use Illuminate\Support\Str;
class TinTucController extends Controller
{
    public function getDanhSach(){
        $tintuc = TinTuc::all();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);

    }
    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them',['theloai'=>$theloai],['loaitin'=>$loaitin]);
    }
    public function postThem(Request $request){
    //   $this->validate($request,
    //       [
    //         'LoaiTin'=>'required',
    //         'TieuDe'=>'required|min:3|max:50|unique:TinTuc,TieuDe',
    //         'TomTat'=>'required',
    //         'NoDung'=>'required',
    //       ],
    //       [     
    //           'LoaiTin.required'=>'Ban chua chon loaitin',
    //           'TieuDe.required'=>'Ban chua nhap tieu de',
    //           'TieuDe.min'=>'Tieu de phai it nhat 3 ky tu',
    //           'TieuDe.unique'=>'Tieu de da ton tai',
    //           'TomTat.required'=>'Ban chua nhap tom tat',
    //           'NoiDung.required'=>'Ban chua nhap noi dung',

    //       ]);
          $tintuc = new TinTuc();
          $tintuc ->TieuDe = $request->TieuDe;
          $tintuc ->TieuDeKhongDau = $request->TieuDe;
          $tintuc ->idLoaiTin = $request->LoaiTin;
          $tintuc ->TomTat = $request ->TomTat;
          $tintuc ->NoiDung = $request->NoiDung;
          $tintuc ->SoLuotXem = 0;
           
          if($request->hasfile('Hinh')){
               $file = $request->file('Hinh');
               $name =$file->getClientOriginalName();
               $Hinh = Str::random(4)."_". $name;
               while(file_exists("upload/tintuc/".$Hinh))
               {
               $Hinh = Str::random(4)."_". $name;
               }
              $file->move("upload/tintuc/".$Hinh);
              $tintuc->Hinh = $Hinh;
          }
          else{
                $tintuc->Hinh = "";
          }
          $tintuc->save();
          return redirect('admin/tintuc/them')->with('thongbao','them tin thanh cong');
    }
    public function getSua($id)
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);
        return view('admin.tintuc.sua',['tintuc'=>$tintuc],['theloai'=>$theloai],['loaitin'=>$loaitin]);
    }
    public function postSua(Request $request,$id){
        $tintuc = TinTuc::find($id);
        $tintuc ->TieuDe = $request->TieuDe;
        $tintuc ->TieuDeKhongDau = $request->TieuDe;
        $tintuc ->TomTat = $request ->TomTat;
        $tintuc ->NoiDung = $request->NoiDung;
        
         
        if($request->hasfile('Hinh')){
             $file = $request->file('Hinh');
             $name =$file->getClientOriginalName();
             $Hinh = Str::random(4)."_". $name;
             while(file_exists("upload/tintuc/".$Hinh))
             {
             $Hinh = Str::random(4)."_". $name;
             }
            $file->move("upload/tintuc/".$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }
       
        $tintuc->save();
        return redirect('admin/tintuc/sua'.$id)->with('thongbao','sua thanh cong');
    }
   
    
    public function getXoa($id){
       $tintuc =TinTuc::find($id);
       $tintuc->delete();
       return redirect('admin/tintuc/danhsach')->with('thongbao','ban da xoa thanh cong');
    }

    
}