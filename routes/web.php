<?php

use App\Http\Controllers\DonViController;
use App\Http\Controllers\GiaiDoanController;
use App\Http\Controllers\VaiTroController;
use App\Http\Controllers\PhongBanController;
use App\Http\Controllers\TacVuController;
use App\Http\Controllers\DuAnController;
use App\Http\Controllers\ThongBaoController;
use App\Http\Controllers\CongViecController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;





//Index
Route::get('/Index', [IndexController::class,'index'])->middleware('checkUserSession');
Route::post('NhanCongViec/{id}', [IndexController::class,'NhanCongViec'])->middleware('checkUserSession');
Route::post('NopBaoCao/{id}/{idcapnhattiendo}', [IndexController::class,'NopBaoCao'])->middleware('checkUserSession');
Route::post('ChiTiet/CongViec/{id}', [IndexController::class,'ChiTietCongViec'])->middleware('checkUserSession');
Route::post('ChiTietHoanThanh/CongViec/{id}', [IndexController::class,'ChiTietHoanThanh'])->middleware('checkUserSession');
Route::post('CapNhatTienDo/CongViec/{id}/{idcapnhattiendo}', [IndexController::class,'CapNhatTienDoView'])->middleware('checkUserSession');

Route::get('/NhanCongViec/DuAn/{id}', [IndexController::class,'NhanCongViecDuAn'])->middleware('checkUserSession');
Route::get('/DangThucHien/DuAn/{id}', [IndexController::class,'DangThucHienDuAn'])->middleware('checkUserSession');
Route::get('/HoanThanh/DuAn/{id}', [IndexController::class,'HoanThanhDuAn'])->middleware('checkUserSession');
Route::get('/TreHen/DuAn/{id}', [IndexController::class,'TreHenDuAn'])->middleware('checkUserSession');


//Đăng Nhập Bằng Google
Route::get('auth/google', [UserController::class, 'redirectToGoogle'])->name('login-google');
Route::get('auth/google/callback', [UserController::class, 'handleGoogleCallback']);

// Đăng Nhập
Route::get('/adminWelcome', [UserController::class,'Welcome'])->middleware('checkUserSession');

Route::get('/', [UserController::class,'login'])->name('Login');

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
Route::get('Admin', [UserController::class,'listAdmin'])->name('Admin.listAdmin')->middleware('checkUserSession');
Route::get('Admin/data',[UserController::class,'getAdmin'])->name('Admin.data')->middleware('checkUserSession');
//Thêm Admin
Route::get('Admin/addviewAdmin', [UserController::class,'addviewAdmin'])->name('Admin.addviewAdmin')->middleware('checkUserSession');
Route::post('Admin/addAdmin', [UserController::class,'addAdmin'])->name('Admin.addAdmin')->middleware('checkUserSession');
//Cập nhật Admin
Route::get('Admin/updateview/{id}', [UserController::class,'updateviewAdmin'])->name('Admin.updateview')->middleware('checkUserSession');
Route::post('Admin/update/{id}', [UserController::class,'updateAdmin'])->name('Admin.update')->middleware('checkUserSession');

// Danh sách User
Route::get('User', [UserController::class,'listUser'])->name('User.listUser')->middleware('checkUserSession');
Route::get('User/data',[UserController::class,'getUser'])->name('User.data')->middleware('checkUserSession');
//Thêm User
Route::get('User/addview', [UserController::class,'addview'])->name('User.addview')->middleware('checkUserSession');
Route::post('User/add', [UserController::class,'add'])->name('User.add')->middleware('checkUserSession');
//Cập nhật User
Route::get('User/updateview/{id}', [UserController::class,'updateview'])->name('User.updateview')->middleware('checkUserSession');
Route::post('User/update/{id}', [UserController::class,'update'])->name('User.update')->middleware('checkUserSession');
// Xóa User
Route::get('User/remove/{id}', [UserController::class,'remove'])->name('User.remove')->middleware('checkUserSession');

//Đổi Mật Khẩu User
Route::get('User/addview/Change/{id}', [UserController::class,'addviewChange'])->name('User.addviewChange')->middleware('checkUserSession');
Route::post('User/ChangePasswordAdmin/{id}', [UserController::class,'ChangePasswordAdmin'])->name('User.ChangePasswordAdmin')->middleware('checkUserSession');
Route::post('User/ChangePasswordUser/{id}', [UserController::class,'ChangePasswordUser'])->name('ChangePasswordUser')->middleware('checkUserSession');


// Danh sách Đơn Vị
Route::get('DonVi', [DonViController::class,'list'])->name('DonVi.listDonVi')->middleware('checkUserSession');
Route::get('DonVi/data',[DonViController::class,'getDonVi'])->name('DonVi.data')->middleware('checkUserSession');
//Thêm Đơn Vị
Route::get('DonVi/addview', [DonViController::class,'addview'])->name('DonVi.addview')->middleware('checkUserSession');
Route::post('DonVi/add', [DonViController::class,'add'])->name('DonVi.add')->middleware('checkUserSession');
//Cập nhật Đơn vị
Route::get('DonVi/updateview/{id}', [DonViController::class,'updateview'])->name('DonVi.updateview')->middleware('checkUserSession');
Route::post('DonVi/update/{id}', [DonViController::class,'update'])->name('DonVi.update')->middleware('checkUserSession');
// Xóa Đơn Vị
Route::get('DonVi/remove/{id}', [DonViController::class,'remove'])->name('DonVi.remove')->middleware('checkUserSession');


// Danh sách Vai Trò
Route::get('VaiTro', [VaiTroController::class,'list'])->name('VaiTro.listVaiTro')->middleware('checkUserSession');
Route::get('VaiTro/data',[VaiTroController::class,'getVaiTro'])->name('VaiTro.data')->middleware('checkUserSession');
//Thêm Vai Trò
Route::get('VaiTro/addview', [VaiTroController::class,'addview'])->name('VaiTro.addview')->middleware('checkUserSession');
Route::post('VaiTro/add', [VaiTroController::class,'add'])->name('VaiTro.add')->middleware('checkUserSession');
//Cập nhật Vai Trò
Route::get('VaiTro/updateview/{id}', [VaiTroController::class,'updateview'])->name('VaiTro.updateview')->middleware('checkUserSession');
Route::post('VaiTro/update/{id}', [VaiTroController::class,'update'])->name('VaiTro.update')->middleware('checkUserSession');
// Xóa Vai Trò
Route::get('VaiTro/remove/{id}', [VaiTroController::class,'remove'])->name('VaiTro.remove')->middleware('checkUserSession');


// Danh sách Đơn Vị
Route::get('GiaiDoan', [GiaiDoanController::class,'list'])->name('GiaiDoan.listGiaiDoan')->middleware('checkUserSession');
Route::get('GiaiDoan/data',[GiaiDoanController::class,'getGiaiDoan'])->name('GiaiDoan.data')->middleware('checkUserSession');
//Thêm Đơn Vị
Route::get('GiaiDoan/addview', [GiaiDoanController::class,'addview'])->name('GiaiDoan.addview')->middleware('checkUserSession');
Route::post('GiaiDoan/add', [GiaiDoanController::class,'add'])->name('GiaiDoan.add')->middleware('checkUserSession');
//Cập nhật Đơn vị
Route::get('GiaiDoan/updateview/{id}', [GiaiDoanController::class,'updateview'])->name('GiaiDoan.updateview')->middleware('checkUserSession');
Route::post('GiaiDoan/update/{id}', [GiaiDoanController::class,'update'])->name('GiaiDoan.update')->middleware('checkUserSession');
// Xóa Đơn Vị
Route::get('GiaiDoan/remove/{id}', [GiaiDoanController::class,'remove'])->name('GiaiDoan.remove')->middleware('checkUserSession');


// Danh sách Phòng Ban
Route::get('PhongBan', [PhongBanController::class,'list'])->name('PhongBan.listPhongBan')->middleware('checkUserSession');
Route::get('PhongBan/data', [PhongBanController::class, 'getPhongBan'])->name('PhongBan.data')->middleware('checkUserSession');
//Thêm Phòng Ban
Route::get('PhongBan/addview', [PhongBanController::class,'addview'])->name('PhongBan.addview')->middleware('checkUserSession');
Route::post('PhongBan/add', [PhongBanController::class,'add'])->name('PhongBan.add')->middleware('checkUserSession');
//Cập nhật Phòng Ban
Route::get('PhongBan/updateview/{id}', [PhongBanController::class,'updateview'])->name('PhongBan.updateview')->middleware('checkUserSession');
Route::post('PhongBan/update/{id}', [PhongBanController::class,'update'])->name('PhongBan.update')->middleware('checkUserSession');
// Xóa Phòng Ban
Route::get('PhongBan/remove/{id}', [PhongBanController::class,'remove'])->name('PhongBan.remove')->middleware('checkUserSession');

// Lấy người dùng theo Phòng Ban 
Route::get('/PhongBan/getNguoiDung/{id}', [PhongBanController::class,'getNguoiDung'])->middleware('checkUserSession');
 

// Danh sách Tác Vụ
Route::get('TacVu', [TacVuController::class,'list'])->name('TacVu.listTacVu')->middleware('checkUserSession');
Route::get('TacVu/data', [TacVuController::class, 'getTacVu'])->name('TacVu.data')->middleware('checkUserSession');
//Thêm Tác Vụ
Route::get('TacVu/addview', [TacVuController::class,'addview'])->name('TacVu.addview')->middleware('checkUserSession');
Route::post('TacVu/add', [TacVuController::class,'add'])->name('TacVu.add')->middleware('checkUserSession');
//Cập nhật Tác Vụ
Route::get('TacVu/updateview/{id}', [TacVuController::class,'updateview'])->name('TacVu.updateview')->middleware('checkUserSession');
Route::post('TacVu/update/{id}', [TacVuController::class,'update'])->name('TacVu.update')->middleware('checkUserSession');
// Xóa Tác Vụ
Route::get('TacVu/remove/{id}', [TacVuController::class,'remove'])->name('TacVu.remove')->middleware('checkUserSession');

// Lấy người dùng theo Tác Vụ 
Route::get('/TacVu/getNguoiDung/{id}', [TacVuController::class,'getNguoiDung'])->middleware('checkUserSession');
 


Route::get('TienDoCongViec', [DuAnController::class,'listTienDoCongViec'])->name('TienDoCongViec.listTienDoCongViec')->middleware('checkUserSession');
Route::get('TienDoCongViec/data', [DuAnController::class, 'getTienDoCongViec'])->name('TienDoCongViec.data')->middleware('checkUserSession');
Route::get('DuAn/SoDoCongViec/{id}', [DuAnController::class,'SoDoCongViec'])->name('DuAn.listSoDoCongViec')->middleware('checkUserSession');
Route::get('SoDoCongViec/data/{id}', [DuAnController::class, 'SoDoCongViecData'])->name('SoDoCongViecData')->middleware('checkUserSession');

// Danh sách Dự Án
Route::get('DuAn', [DuAnController::class,'list'])->name('DuAn.listDuAn')->middleware('checkUserSession');
Route::get('DuAn/data', [DuAnController::class, 'getDuAn'])->name('DuAn.data')->middleware('checkUserSession');
//Thêm Dự Án
Route::get('DuAn/addview', [DuAnController::class,'addview'])->name('DuAn.addview')->middleware('checkUserSession');
Route::post('DuAn/add', [DuAnController::class,'add'])->name('DuAn.add')->middleware('checkUserSession');
//Cập nhật Dự Án
Route::get('DuAn/updateview/{id}', [DuAnController::class,'updateview'])->name('DuAn.updateview')->middleware('checkUserSession');
Route::post('DuAn/update/{id}', [DuAnController::class,'update'])->name('DuAn.update')->middleware('checkUserSession');
// Xóa Dự Án
Route::get('DuAn/remove/{id}', [DuAnController::class,'remove'])->name('DuAn.remove')->middleware('checkUserSession');
// Lấy người dùng theo Đơn Vị
Route::get('/DuAn/DonVi/getNguoiDung/{id}', [DuAnController::class,'getNguoiDung'])->middleware('checkUserSession');
// Danh sách Giai Đoạn Dự Án
Route::get('DuAn/GiaiDoan', [DuAnController::class,'listGiaiDoan'])->name('DuAn.listDuAnGiaiDoan')->middleware('checkUserSession');
Route::get('DuAn/GiaiDoan/data', [DuAnController::class, 'getDuAnGiaiDoan'])->name('DuAnGiaiDoan.data')->middleware('checkUserSession');

// Danh sách Thành Viên Dự Án
Route::get('DuAn/ThanhVien', [DuAnController::class,'listThanhVien'])->name('DuAn.listDuAnThanhVien')->middleware('checkUserSession');
Route::get('DuAn/ThanhVien/data', [DuAnController::class, 'getDuAnThanhVien'])->name('DuAnThanhVien.data')->middleware('checkUserSession');

// Danh sách Công Việc
Route::get('CongViec', [CongViecController::class,'list'])->name('CongViec.listCongViec')->middleware('checkUserSession');
Route::get('CongViec/data',[CongViecController::class,'getCongViec'])->name('CongViec.data')->middleware('checkUserSession');
//Thêm Công Việc
Route::get('CongViec/addview', [CongViecController::class,'addview'])->name('CongViec.addview')->middleware('checkUserSession');
Route::get('CongViec/viewid/{id}', [CongViecController::class,'addviewid'])->name('CongViec.addviewid')->middleware('checkUserSession');

Route::post('CongViec/add', [CongViecController::class,'add'])->name('CongViec.add')->middleware('checkUserSession');
//Cập nhật Công Việc
Route::get('CongViec/updateview/{id}', [CongViecController::class,'updateview'])->name('CongViec.updateview')->middleware('checkUserSession');
Route::post('CongViec/update/{id}', [CongViecController::class,'update'])->name('CongViec.update')->middleware('checkUserSession');
// Xóa Công Việc
Route::get('CongViec/remove/{id}', [CongViecController::class,'remove'])->name('CongViec.remove')->middleware('checkUserSession');

// Lấy giai đoạn theo dự án 
Route::get('/DuAn/GiaiDoan/getGiaiDoan/{id}', [CongViecController::class,'getGiaiDoanDuAn'])->middleware('checkUserSession');
// Lấy giai đoạn theo dự án 
Route::get('/DuAn/ThoiGian/getThoiGian/{id}', [CongViecController::class,'getThoiGian'])->middleware('checkUserSession');
// Lấy người dùng theo Dự Án
Route::get('/CongViec/getNguoiDung/{id}', [CongViecController::class,'getNguoiDungCongViec'])->middleware('checkUserSession');
// Danh sách Thành Viên Dự Án
Route::get('CongViec/ThanhVien', [CongViecController::class,'listThanhVien'])->name('CongViec.listCongViecThanhVien')->middleware('checkUserSession');
Route::get('CongViec/ThanhVien/data', [CongViecController::class, 'getCongViecThanhVien'])->name('CongViecThanhVien.data')->middleware('checkUserSession');

// Danh sách Thông Báo
Route::get('ThongBao', [ThongBaoController::class,'list'])->name('ThongBao.listThongBao')->middleware('checkUserSession');
Route::get('ThongBao/data', [ThongBaoController::class, 'getThongBao'])->name('ThongBao.data')->middleware('checkUserSession');
//Thêm Thông Báo
Route::get('ThongBao/addview', [ThongBaoController::class,'addview'])->name('ThongBao.addview')->middleware('checkUserSession');
Route::post('ThongBao/add', [ThongBaoController::class,'add'])->name('ThongBao.add')->middleware('checkUserSession');
// routes/web.php
Route::post('/thongbao/{id}', [ThongBaoController::class, 'destroy'])->name('thongbao.destroy')->middleware('checkUserSession');
