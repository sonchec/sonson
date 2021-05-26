<?php

use App\Http\Controllers\TheLoaiController;
use App\TheLoai;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoaiTinController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('thu',function(){
//    return view('admin.tintuc.danhsach');
// });

// Route::group(['prefix' => 'admin'],function(){
//       Route::group(['prefix' => 'theloai',function(){
//           Route::get('danhsach','TheLoaiController@getDanhSach');
//           Route::get('sua','TheLoaiController@getSua');
//           Route::get('them','TheLoaiController@getThem');
//       }
//       ]);
// });
Route::get('admin/dangnhap',[UserController::class,'getdangnhapAdmin']);
Route::post('admin/dangnhap',[UserController::class,'postdangnhapAdmin']);
Route::get('admin/logout',[UserController::class,'getdangxuatAdmin']);

Route::prefix('admin')->middleware('adminLogin')->group(function () {
    Route::prefix('theloai')->group(function () {
        
        Route::get('/danhsach',[TheLoaiController::class,'getDanhSach']);
        Route::get('/sua/{id}',[TheLoaiController::class,'getSua']);
        Route::post('/sua/{id}',[TheLoaiController::class,'postSua']);
        Route::get('/them',[TheLoaiController::class,'getThem']);
        Route::post('/them',[TheLoaiController::class,'postThem']);
        Route::get('/xoa/{id}',[TheLoaiController::class,'getXoa']);
    });
    Route::prefix('loaitin')->group(function () {
     
        Route::get('/danhsach',[LoaiTinController::class,'getDanhSach']);
        Route::get('/sua/{id}',[LoaiTinController::class,'getSua']);
        Route::post('/sua/{id}',[LoaiTinController::class,'postSua']);
        Route::get('/them',[LoaiTinController::class,'getThem']);
        Route::post('/them',[LoaiTinController::class,'postThem']);
        Route::get('/xoa/{id}',[LoaiTinController::class,'getXoa']);
        });
    Route::prefix('tintuc')->group(function () {
       
        Route::get('/danhsach',[TinTucController::class,'getDanhSach']);
        Route::get('/sua/{id}',[TinTucController::class,'getSua']);
        Route::post('/sua/{id}',[TinTucController::class,'postSua']);
        Route::get('/them',[TinTucController::class,'getThem']);
        Route::post('/them',[TinTucController::class,'postThem']);
        Route::get('/xoa/{id}',[TinTucController::class,'getXoa']);
         });   
     Route::prefix('slide')->group(function () {
       
         Route::get('/danhsach',[SlideController::class,'getDanhSach']);
         Route::get('/sua/{id}',[SlideController::class,'getSua']);
         Route::post('/sua/{id}',[SlideController::class,'postSua']);
         Route::get('/them',[SlideController::class,'getThem']);
         Route::post('/them',[SlideController::class,'postThem']);
         Route::get('/xoa/{id}',[SlideController::class,'getXoa']);
             });     
     Route::prefix('user')->group(function () {
       
        Route::get('/danhsach',[UserController::class,'getDanhSach']);
        Route::get('/sua/{id}',[UserController::class,'getSua']);
        Route::post('/sua/{id}',[UserController::class,'postSua']);
        Route::get('/them',[UserController::class,'getThem']);
        Route::post('/them',[UserController::class,'postThem']);
        Route::get('/xoa/{id}',[UserController::class,'getXoa']);
                    });          
     Route::prefix('comment')->group(function () {
       
            Route::get('/xoa/{id}/{idTinTuc}',[CommentController::class,'getXoa']);
             });    
    Route::prefix('ajax')->group(function () {
        Route::get('loaitin/{idTheLoai}',[AjaxController::class,'getLoaiTin']);
         });
});
Route::get('trangchu',[PagesController::class,'trangchu']);
Route::get('lienhe',[PagesController::class,'lienhe']);
Route::get('loaitin/{id}/{TenKhongDau}.html',[PagesController::class,'loaitin']);