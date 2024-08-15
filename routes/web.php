<?php

use App\Http\Controllers\DonViController;
use App\Http\Controllers\GiaiDoanController;
use App\Http\Controllers\VaiTroController;
use App\Http\Controllers\PhongBanController;
use App\Http\Controllers\TacVuController;
use App\Http\Controllers\DuAnController;
use App\Http\Controllers\ThongBaoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test;


Route::get('/admin', [Test::class,'Welcome']);
Route::get('/Index', [Test::class,'index']);
Route::get('/chitiet', [Test::class,'chitiet']);
Route::get('/', [Test::class,'Login']);
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

//Đổi Mật Khẩu User
Route::get('User/addview/Change/{id}', [UserController::class,'addviewChange'])->name('User.addviewChange');
Route::post('User/ChangePasswordAdmin/{id}', [UserController::class,'ChangePasswordAdmin'])->name('User.ChangePasswordAdmin');
Route::post('User/ChangePasswordUser/{id}', [UserController::class,'ChangePasswordUser'])->name('ChangePasswordUser');


// Danh sách Đơn Vị
Route::get('DonVi', [DonViController::class,'list'])->name('DonVi.listDonVi');
Route::get('DonVi/data',[DonViController::class,'getDonVi'])->name('DonVi.data');
//Thêm Đơn Vị
Route::get('DonVi/addview', [DonViController::class,'addview'])->name('DonVi.addview');
Route::post('DonVi/add', [DonViController::class,'add'])->name('DonVi.add');
//Cập nhật Đơn vị
Route::get('DonVi/updateview/{id}', [DonViController::class,'updateview'])->name('DonVi.updateview');
Route::post('DonVi/update/{id}', [DonViController::class,'update'])->name('DonVi.update');
// Xóa Đơn Vị
Route::get('DonVi/remove/{id}', [DonViController::class,'remove'])->name('DonVi.remove');


// Danh sách Vai Trò
Route::get('VaiTro', [VaiTroController::class,'list'])->name('VaiTro.listVaiTro');
Route::get('VaiTro/data',[VaiTroController::class,'getVaiTro'])->name('VaiTro.data');
//Thêm Vai Trò
Route::get('VaiTro/addview', [VaiTroController::class,'addview'])->name('VaiTro.addview');
Route::post('VaiTro/add', [VaiTroController::class,'add'])->name('VaiTro.add');
//Cập nhật Vai Trò
Route::get('VaiTro/updateview/{id}', [VaiTroController::class,'updateview'])->name('VaiTro.updateview');
Route::post('VaiTro/update/{id}', [VaiTroController::class,'update'])->name('VaiTro.update');
// Xóa Vai Trò
Route::get('VaiTro/remove/{id}', [VaiTroController::class,'remove'])->name('VaiTro.remove');


// Danh sách Đơn Vị
Route::get('GiaiDoan', [GiaiDoanController::class,'list'])->name('GiaiDoan.listGiaiDoan');
Route::get('GiaiDoan/data',[GiaiDoanController::class,'getGiaiDoan'])->name('GiaiDoan.data');
//Thêm Đơn Vị
Route::get('GiaiDoan/addview', [GiaiDoanController::class,'addview'])->name('GiaiDoan.addview');
Route::post('GiaiDoan/add', [GiaiDoanController::class,'add'])->name('GiaiDoan.add');
//Cập nhật Đơn vị
Route::get('GiaiDoan/updateview/{id}', [GiaiDoanController::class,'updateview'])->name('GiaiDoan.updateview');
Route::post('GiaiDoan/update/{id}', [GiaiDoanController::class,'update'])->name('GiaiDoan.update');
// Xóa Đơn Vị
Route::get('GiaiDoan/remove/{id}', [GiaiDoanController::class,'remove'])->name('GiaiDoan.remove');


// Danh sách Phòng Ban
Route::get('PhongBan', [PhongBanController::class,'list'])->name('PhongBan.listPhongBan');
Route::get('PhongBan/data', [PhongBanController::class, 'getPhongBan'])->name('PhongBan.data');
//Thêm Phòng Ban
Route::get('PhongBan/addview', [PhongBanController::class,'addview'])->name('PhongBan.addview');
Route::post('PhongBan/add', [PhongBanController::class,'add'])->name('PhongBan.add');
//Cập nhật Phòng Ban
Route::get('PhongBan/updateview/{id}', [PhongBanController::class,'updateview'])->name('PhongBan.updateview');
Route::post('PhongBan/update/{id}', [PhongBanController::class,'update'])->name('PhongBan.update');
// Xóa Phòng Ban
Route::get('PhongBan/remove/{id}', [PhongBanController::class,'remove'])->name('PhongBan.remove');

// Lấy người dùng theo Phòng Ban 
Route::get('/PhongBan/getNguoiDung/{id}', [PhongBanController::class,'getNguoiDung']);
 

// Danh sách Tác Vụ
Route::get('TacVu', [TacVuController::class,'list'])->name('TacVu.listTacVu');
Route::get('TacVu/data', [TacVuController::class, 'getTacVu'])->name('TacVu.data');
//Thêm Tác Vụ
Route::get('TacVu/addview', [TacVuController::class,'addview'])->name('TacVu.addview');
Route::post('TacVu/add', [TacVuController::class,'add'])->name('TacVu.add');
//Cập nhật Tác Vụ
Route::get('TacVu/updateview/{id}', [TacVuController::class,'updateview'])->name('TacVu.updateview');
Route::post('TacVu/update/{id}', [TacVuController::class,'update'])->name('TacVu.update');
// Xóa Tác Vụ
Route::get('TacVu/remove/{id}', [TacVuController::class,'remove'])->name('TacVu.remove');

// Lấy người dùng theo Tác Vụ 
Route::get('/TacVu/getNguoiDung/{id}', [TacVuController::class,'getNguoiDung']);
 

// Danh sách Dự Án
Route::get('DuAn', [DuAnController::class,'list'])->name('DuAn.listDuAn');
Route::get('DuAn/data', [DuAnController::class, 'getDuAn'])->name('DuAn.data');
//Thêm Dự Án
Route::get('DuAn/addview', [DuAnController::class,'addview'])->name('DuAn.addview');
Route::post('DuAn/add', [DuAnController::class,'add'])->name('DuAn.add');
//Cập nhật Dự Án
Route::get('DuAn/updateview/{id}', [DuAnController::class,'updateview'])->name('DuAn.updateview');
Route::post('DuAn/update/{id}', [DuAnController::class,'update'])->name('DuAn.update');
// Xóa Dự Án
Route::get('DuAn/remove/{id}', [DuAnController::class,'remove'])->name('DuAn.remove');
// Lấy người dùng theo Đơn Vị
Route::get('/DuAn/DonVi/getNguoiDung/{id}', [DuAnController::class,'getNguoiDung']);

// Danh sách Thông Báo
Route::get('ThongBao', [ThongBaoController::class,'list'])->name('ThongBao.listThongBao');
Route::get('ThongBao/data', [ThongBaoController::class, 'getThongBao'])->name('ThongBao.data');
//Thêm Thông Báo
Route::get('ThongBao/addview', [ThongBaoController::class,'addview'])->name('ThongBao.addview');
Route::post('ThongBao/add', [ThongBaoController::class,'add'])->name('ThongBao.add');