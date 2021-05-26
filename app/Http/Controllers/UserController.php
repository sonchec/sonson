<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use CreateUsersTable;

class UserController extends Controller
{
    public function getDanhSach(){
        $user =  User::all();
        return view('admin.user.danhsach',['user'=>$user]);

    }
    public function getThem(){
        return view('admin.user.them');
     
    }
    public function postThem(Request $request){
        $this->validate($request,[
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'min:3|max:12',
            

        ],
        [   
            'name.required'=>'Ban chua nhap ten',
            'name.min'=>'Ten nguoi dung phai co it nhat 3 ky tu',
            'email.required'=>'ban chua nhap email',
            'email.email'=>'ban chu nhap daung dinh dang email',
            'email.unique'=>'Email da ton tai',
            
            'password.min'=>'Mat khau phai co it nhat 3 ky tu',
            'password.max'=>'Mat khau phai co it nhat 12 ky tu'

        ]);
        $user = new User;
        $user->name =$request->name;
        $user->email=$request->email;
        $user->password= bcrypt($request->password);
        $user->quyen = $request->quyen;
        $user->save();
        return redirect('admin/user/them')->with('thongbao','them thanh cong');
    }
    public function getSua($id)
    {
        $user = User::find($id);
        return view('admin/user/sua',['user'=>$user]);
    }
    public function postSua(Request $request,$id){
       
        $this->validate($request,[
            'name'=>'required|min:3',
            
           

        ],
        [   
            'name.required'=>'Ban chua nhap ten',
            'name.min'=>'Ten nguoi dung phai co it nhat 3 ky tu',
         
           
        ]);
        $user =  User::find($id);
        $user->name =$request->name;
        $user->quyen = $request->quyen;
        if($request->changePassword = "on")
        {
             
        $user->password= bcrypt($request->password);
        }
        $user->save();
        return redirect('admin/user/sua'.$id)->with('thongbao','sua thanh cong');
      
       
    }
   
    
    public function getXoa($id){
     $user = User::find($id);
     $user->delete();
     return redirect('admin/user/danhsach')->with('thongbao','xoa thanh cong');
    }

    public function getdangnhapAdmin(){
        return view('admin.login');
    }
    public function postdangnhapAdmin(Request $request){
        $this->validate($request,[
           'email'=>'required',
           'password'=>'required|min:3|max:12'
        ],
    [
         'email.required'=>'ban chua nhap email',
         'password.required'=>'Ban chua nhap mat khau',
         'password.min'=>'Mat khau phai co it nhat 3 ky tu',
         'password.max'=>'Mat khau phai co it nhat 12 ky tu'
    ]);
    if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
    {
        return redirect('admin/theloai/danhsach');
    }
    else
    {
        return  redirect('admin/dangnhap')->with('thongbao','dang nhap khong thanh cong');
    }
    }
    public function getdangxuatAdmin()
    {
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
