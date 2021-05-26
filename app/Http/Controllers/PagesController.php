<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\Slide;
use App\Models\LoaiTin;
use App\Models\TinTuc;
class PagesController extends Controller
{
    function __construct()
    {
        $theloai = TheLoai::all();
        $slide = Slide::all();
        view()->share('theloai',$theloai);
        view()->share('slide',$slide);
    }
    function trangchu()
    {
        
        return view('pages.trangchu');
    }
    function lienhe()
    {
        // Slide::orderBy('id', 'desc')->take(4)->get(); 
        return view('pages.lienhe');
    }
        function loaitin($id){
            $loaitin = LoaiTin::find($id);
            $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
            return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
        }
    
}
