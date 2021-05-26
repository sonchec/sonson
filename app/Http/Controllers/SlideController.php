<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use Illuminate\Support\Str;


class SlideController extends Controller
{
    public function getDanhSach(){
        $slide= Slide::all();
        return view('admin.slide.danhsach',['slide'=>$slide]);

    }
    public function getThem(){
        
        return view('admin.slide.them');
        
    }
    public function postThem(Request $request){
        $this->validate($request,[
            'Ten'=>'required',
            'NoiDung'=>'required',
        ],[
             'Ten.required'=>'ban chua nhap ten',
             'NoiDung.required'=>'Ban chua nhap noi dung',
        ]);
        
        $slide = new Slide;
        $slide->Ten =$request->Ten;
        $slide->NoiDung= $request->NoiDung;
        if($request->has('link'))
        $slide->link = $request->link;
              
          if($request->hasfile('Hinh')){
            $file = $request->file('Hinh');
            $name =$file->getClientOriginalName();
            $Hinh = Str::random(4)."_". $name;
            while(file_exists("upload/tintuc/".$Hinh))
            {
            $Hinh = Str::random(4)."_". $name;
            }
           $file->move("upload/slide/".$Hinh);
           $slide->Hinh = $Hinh;
       }
       else{
             $slide->Hinh = "";
       }
          $slide->save();
          return redirect('admin/slide/them')->with('thongbao','them thanh cong');
    }
    public function getSua($id)
    {  
        $slide = Slide::find($id);
        return view('admin/slide/sua',['slide'=>$slide]);
    }
    public function postSua(Request $request,$id)
    {   $this->validate($request,[
        'Ten'=>'required',
        'NoiDung'=>'required',
    ],[
         'Ten.required'=>'ban chua nhap ten',
         'NoiDung.required'=>'Ban chua nhap noi dung',
    ]);
    
    $slide = Slide::find($id);
    $slide->Ten =$request->Ten;
    $slide->NoiDung= $request->NoiDung;
    if($request->has('link'))
    $slide->link = $request->link;
          
      if($request->hasfile('Hinh')){
        $file = $request->file('Hinh');
        $name =$file->getClientOriginalName();
        $Hinh = Str::random(4)."_". $name;
        while(file_exists("upload/tintuc/".$Hinh))
        {
        $Hinh = Str::random(4)."_". $name;
        }
        unlink("upload/slide/".$slide->Hinh);
       $file->move("upload/slide/".$Hinh);
       $slide->Hinh = $Hinh;
   }
  
      $slide->save();
      return redirect('admin/slide/sua')->with('thongbao','them thanh cong');
     }
    
    public function getXoa($id)
    {
      $slide = Slide::find($id);
      $slide->delete();
      return redirect('admin/slide/danhsach')->with('thongbao','xoa thanh cong');
    }
    
}