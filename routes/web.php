<?php

use App\Http\Controllers\DonViController;
use App\Http\Controllers\GiaiDoanController;
use App\Http\Controllers\VaiTroController;
use App\Http\Controllers\PhongBanController;
use App\Http\Controllers\TacVuController;
use App\Http\Controllers\DuAnController;
use App\Http\Controllers\ThongBaoController;
use App\Http\Controllers\ThanhVienController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test;


Route::get('/admin', [Test::class,'Welcome']);
Route::get('/', [Test::class,'index']);
Route::get('/chitiet', [Test::class,'chitiet']);
Route::get('/Login', [Test::class,'Login']);
Route::get('/MaOTP', [Test::class,'MaOTP']);
Route::get('/matkhaunew', [Test::class,'matkhaunew']);



//Đăng Nhập Bằng Google
Route::get('auth/google', [UserController::class, 'redirectToGoogle'])->name('login-google');
Route::get('auth/google/callback', [UserController::class, 'handleGoogleCallback']);

// Đăng Nhập
Route::get('Login', [UserController::class,'login'])->name('Login');
Route::get('LogoutAction', [UserController::class,'logoutAction'])->name('LogoutAction');
Route::post('LoginAction', [UserController::class,'loginAction'])->name('LoginAction');
Route::post('RegisterAction', [UserController::class,'registerAction'])->name('RegisterAction');

//Quên Mật Khẩu
Route::get('ForgotPassword/addview', [UserController::class,'ForgotPasswordView']);
Route::get('ForgotPasswordNew/addview', [UserController::class,'ForgotPasswordViewNew']);
Route::post('Checkemailform', [UserController::class,'Checkemailform']); 
Route::get('verifyOtp', [UserController::class, 'verifyOtp'])->name('verifyOtp');
Route::post('CheckverifyOtp', [UserController::class, 'CheckverifyOtp']);
Route::post('CheckPasswordform', [UserController::class, 'CheckPasswordform']);



  
// Danh sách Admin
Route::get('Admin', [UserController::class,'listAdmin'])->name('Admin.listAdmin');
Route::get('Admin/data',[UserController::class,'getAdmin'])->name('Admin.data');
//Thêm Admin
Route::get('Admin/addviewAdmin', [UserController::class,'addviewAdmin'])->name('Admin.addviewAdmin');
Route::post('Admin/addAdmin', [UserController::class,'addAdmin'])->name('Admin.addAdmin');
//Cập nhật Admin
Route::get('Admin/updateview/{id}', [UserController::class,'updateviewAdmin'])->name('Admin.updateview');
Route::post('Admin/update/{id}', [UserController::class,'updateAdmin'])->name('Admin.update');

// Danh sách User
Route::get('User', [UserController::class,'listUser'])->name('User.listUser');
Route::get('User/data',[UserController::class,'getUser'])->name('User.data');
//Thêm User
Route::get('User/addview', [UserController::class,'addview'])->name('User.addview');
Route::post('User/add', [UserController::class,'add'])->name('User.add');
//Cập nhật User
Route::get('User/updateview/{id}', [UserController::class,'updateview'])->name('User.updateview');
Route::post('User/update/{id}', [UserController::class,'update'])->name('User.update');
// Xóa User
Route::get('User/remove/{id}', [UserController::class,'remove'])->name('User.remove');


// Danh sách Đơn Vị
Route::get('DonVi', [DonViController::class,'list']);
Route::get('DonVi/data',[DonViController::class,'getDonVi']);
//Thêm Đơn Vị
Route::get('DonVi/addview', [DonViController::class,'addview']);
Route::post('DonVi/add', [DonViController::class,'add']);
//Cập nhật Đơn Vị
Route::get('DonVi/updateview/{id}', [DonViController::class,'updateview']);
Route::post('DonVi/update/{id}', [DonViController::class,'update']);
// Xóa Đơn Vị
Route::get('DonVi/remove/{id}', [DonViController::class,'remove']);

// Danh sách Vai Trò
Route::get('VaiTro', [VaiTroController::class,'list']);
Route::get('VaiTro/data',[VaiTroController::class,'getVaiTro']);
//Thêm Vai Trò
Route::get('VaiTro/addview', [VaiTroController::class,'addview']);
Route::post('VaiTro/add', [VaiTroController::class,'add']);
//Cập nhật Vai Trò
Route::get('VaiTro/updateview/{id}', [VaiTroController::class,'updateview']);
Route::post('VaiTro/update/{id}', [VaiTroController::class,'update']);
// Xóa Vai Trò
Route::get('VaiTro/remove/{id}', [VaiTroController::class,'remove']);


// Danh sách Giai Đoạn
Route::get('GiaiDoan', [GiaiDoanController::class,'list']);
Route::get('GiaiDoan/data',[GiaiDoanController::class,'getGiaiDoan']);
//Thêm Giai Đoạn
Route::get('GiaiDoan/addview', [GiaiDoanController::class,'addview']);
Route::post('GiaiDoan/add', [GiaiDoanController::class,'add']);
//Cập nhật Giai Đoạn
Route::get('GiaiDoan/updateview/{id}', [GiaiDoanController::class,'updateview']);
Route::post('GiaiDoan/update/{id}', [GiaiDoanController::class,'update']);
// Xóa Giai Đoạn
Route::get('GiaiDoan/remove/{id}', [GiaiDoanController::class,'remove']);


// Danh sách Phòng Ban
Route::get('PhongBan', [PhongBanController::class,'list']);
Route::get('PhongBan/data',[PhongBanController::class,'getPhongBan']);
//Thêm Phòng Ban
Route::get('PhongBan/addview', [PhongBanController::class,'addview']);
Route::post('PhongBan/add', [PhongBanController::class,'add']);
//Cập nhật Phòng Ban
Route::get('PhongBan/updateview/{id}', [PhongBanController::class,'updateview']);
Route::post('PhongBan/update/{id}', [PhongBanController::class,'update']);
// Xóa Phòng Ban
Route::get('PhongBan/remove/{id}', [PhongBanController::class,'remove']);

// Danh sách Tác Vụ
Route::get('TacVu', [TacVuController::class,'list']);
Route::get('TacVu/data',[TacVuController::class,'getTacVu']);
//Thêm Tác Vụ
Route::get('TacVu/addview', [TacVuController::class,'addview']);
Route::post('TacVu/add', [TacVuController::class,'add']);
//Cập nhật Tác Vụ
Route::get('TacVu/updateview/{id}', [TacVuController::class,'updateview']);
Route::post('TacVu/update/{id}', [TacVuController::class,'update']);
// Xóa Tác Vụ
Route::get('TacVu/remove/{id}', [TacVuController::class,'remove']);

// Danh sách Dự Án
Route::get('DuAn', [DuAnController::class,'list']);
Route::get('DuAn/data',[DuAnController::class,'getDuAn']);
//Thêm Dự Án
Route::get('DuAn/addview', [DuAnController::class,'addview']);
Route::post('DuAn/add', [DuAnController::class,'add']);
//Cập nhật Dự Án
Route::get('DuAn/updateview/{id}', [DuAnController::class,'updateview']);
Route::post('DuAn/update/{id}', [DuAnController::class,'update']);
// Xóa Dự Án
Route::get('DuAn/remove/{id}', [DuAnController::class,'remove']);

// Danh sách Thành Viên
Route::get('ThanhVien', [ThanhVienController::class,'list']);
Route::get('ThanhVien/data',[ThanhVienController::class,'getThanhVien']);
//Thêm Thành Viên
Route::get('ThanhVien/addview', [ThanhVienController::class,'addview']);
Route::post('ThanhVien/add', [ThanhVienController::class,'add']);
//Cập nhật Thành Viên
Route::get('ThanhVien/updateview/{id}', [ThanhVienController::class,'updateview']);
Route::post('ThanhVien/update/{id}', [ThanhVienController::class,'update']);
// Xóa Thành Viên
Route::get('ThanhVien/remove/{id}', [ThanhVienController::class,'remove']);

// Danh sách Thông Báo
Route::get('ThongBao', [ThongBaoController::class,'list']);
Route::get('ThongBao/data',[ThongBaoController::class,'getThongBao']);
//Thêm Thông Báo
Route::get('ThongBao/addview', [ThongBaoController::class,'addview']);
Route::post('ThongBao/add', [ThongBaoController::class,'add']);
//Cập nhật Thông Báo
Route::get('ThongBao/updateview/{id}', [ThongBaoController::class,'updateview']);
Route::post('ThongBao/update/{id}', [ThongBaoController::class,'update']);
// Xóa Thông Báo
Route::get('ThongBao/remove/{id}', [ThongBaoController::class,'remove']);