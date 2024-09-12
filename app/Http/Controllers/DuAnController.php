<?php

namespace App\Http\Controllers;
use App\Models\duan;
use App\Models\donvi;
use App\Models\giaidoan;
use App\Models\loaiduan;
use App\Models\vaitro;
use App\Models\nguoidung;
use App\Models\thanhvien;
use App\Models\thuchien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class DuAnController extends Controller
{

     //Danh sách Dự Án
     public function SoDoCongViec($id)
     {
         $title = "Sơ Đồ Công Việc";
         $SoDo = DB::select('SELECT thuchiens.* 
         FROM thuchiens 
         WHERE thuchiens.IsActive 
         AND thuchiens.MaDuAn= ? ',[$id]);
         return view('TienDoCongViec.SoDoCongViec', compact('title','SoDo'));
     }
     //Danh sách Dự Án
     public function SoDoCongViecData($id)
     {
      
         $SoDo = DB::select('SELECT congviecs.*, giaidoans.TenGiaiDoan ,thuchiens.NgayBatDau as GiaiDoanDau ,thuchiens.NgayKetThuc as GiaiDoanCuoi  ,duans.NgayBatDau AS NgayBatDauDuAn ,duans.NgayKetThuc AS NgayKetThucDuAn
         FROM giaidoans,thuchiens, congviecs ,duans
         WHERE congviecs.MaDuAn = ?
         AND congviecs.MaThucHien = thuchiens.id  
         AND congviecs.MaDuAn = duans.id  
         AND thuchiens.MaGiaiDoan = giaidoans.id
        AND congviecs.IsActive = true
        AND duans.IsActive = true
        AND thuchiens.IsActive = true
        AND giaidoans.IsActive = true',[$id]);
         return response()->json(['data' => $SoDo]);
     }
   public function listTienDoCongViec()
   {
       $title = "Danh Sách Dự Án";
       return view('TienDoCongViec.ListTienDoCongViec', compact('title'));
   }
   public function getTienDoCongViec()
   {
        $DuAn = duan::where('IsActive', 1)->get();
       return response()->json(['data' => $DuAn]);
   }
   public function listCongViecThanhVien(Request $request)
   {
       $title = "Danh Sách Công Việc Dự Án";
       $id = $request->input('id');
       return view('TienDoCongViec.ListCongViecThanhVien', compact('id','title'));
   }
   public function getCongViecThanhVien(Request $request)
    {
         $id = $request->input('id');
        
         $DuAn = DB::select('SELECT nguoidungs.*, capnhattiendos.TienDo ,capnhattiendos.id as idcapnhattiendo
        FROM giaoviecs
        JOIN nguoidungs ON giaoviecs.MaNguoiDung = nguoidungs.id
        LEFT JOIN capnhattiendos ON capnhattiendos.MaGiaoViec = giaoviecs.id
        WHERE giaoviecs.MaCongViec = ? 
        AND giaoviecs.IsActive = true 
        AND nguoidungs.IsActive = true;',[$id]);
        return response()->json(['data' => $DuAn]);
    }
    public function listThanhVien(Request $request)
    {
        $title = "Danh Sách Giai Đoạn Dự Án";
        $id = $request->input('id');
        return view('DuAn.ListDuAnThanhVien', compact('id','title'));
    }

    public function getDuAnThanhVien(Request $request)
    {
         $id = $request->input('id');
        
         $DuAn = DB::select('SELECT 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName AS user_name, 
            GROUP_CONCAT(DISTINCT vaitros.TenVaiTro) AS vaitro_names, 
            GROUP_CONCAT(DISTINCT donvis.TenDonVi) AS donvi_names 
        FROM 
            nguoidungs 
        LEFT JOIN 
            tacvus ON nguoidungs.id = tacvus.MaNguoiDung AND tacvus.IsActive = true 
        LEFT JOIN 
            vaitros ON vaitros.id = tacvus.MaVaiTro AND vaitros.IsActive = true 
        LEFT JOIN 
            phongbans ON nguoidungs.id = phongbans.MaNguoiDung AND phongbans.IsActive = true 
        LEFT JOIN 
            donvis ON donvis.id = phongbans.MaDonVi AND donvis.IsActive = true 
         LEFT JOIN 
            thanhviens ON thanhviens.MaNguoiDung = nguoidungs.id AND thanhviens.IsActive = true 
        WHERE 
            nguoidungs.Quyen IN (2, 3, 4) 
            AND nguoidungs.IsActive = true 
             AND thanhviens.MaDuAn = ?
        GROUP BY 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName;',[$id]);
        return response()->json(['data' => $DuAn]);
    }
    public function listGiaiDoan(Request $request)
    {
        $title = "Danh Sách Giai Đoạn Dự Án";
        $id = $request->input('id');
        return view('DuAn.ListDuAnGiaiDoan', compact('id','title'));
    }
    public function getDuAnGiaiDoan(Request $request)
    {
         $id = $request->input('id');
        
         $DuAn = DB::select('SELECT thuchiens.* , giaidoans.TenGiaiDoan 
         FROM duans , thuchiens , giaidoans 
         WHERE duans.id = ?
         AND duans.id= thuchiens.MaDuAn  
         AND thuchiens.MaGiaiDoan = giaidoans.id 
         AND giaidoans.IsActive = true
        AND duans.IsActive = true
        AND thuchiens.IsActive = true
       ',[$id]);
        return response()->json(['data' => $DuAn]);
    }
    public function listCongViecDuAnfile(Request $request)
    {
        $title = "Danh Sách File Công Việc";
        $id = $request->input('id');
        return view('TienDoCongViec.ListCongViecFile', compact('id','title'));
    }
    public function getCongViecDuAnfile(Request $request)
    {
         $id = $request->input('id');
        
         $DuAn = DB::select('SELECT * FROM files WHERE files.MaCapNhatTienDo = ? AND IsActive = true
       ',[$id]);
        return response()->json(['data' => $DuAn]);
    }
    public function listCongViecDuAn(Request $request)
    {
        $title = "Danh Sách Công Việc Dự Án";
        $id = $request->input('id');
        return view('TienDoCongViec.ListCongViecDuAn', compact('id','title'));
    }
    public function getCongViecDuAn(Request $request)
    {
         $id = $request->input('id');
        
         $DuAn = DB::select('SELECT * FROM congviecs WHERE congviecs.MaDuAn =? AND IsActive = true
       ',[$id]);
        return response()->json(['data' => $DuAn]);
    }
    //Danh sách Dự Án
   public function list()
   {
       $title = "Danh Sách Dự Án";
       return view('DuAn.ListDuAn', compact('title'));
   }
   public function getDuAn()
   {
        $DuAn = DB::select('SELECT duans.*,loaiduans.TenLoaiDuAn 
        FROM duans,loaiduans 
        WHERE duans.MaLoai = loaiduans.id
        AND duans.IsActive = true
        AND loaiduans.IsActive = true');
       return response()->json(['data' => $DuAn]);
   }

   public function updateviewSee($id)
   {
    $DuAn = DB::select('
                SELECT 
                    loaiduans.TenLoaiDuAn, 
                    giaidoans.TenGiaiDoan,  
                    thuchiens.NgayBatDau, 
                    thuchiens.NgayKetThuc, 
                    thuchiens.MaGiaiDoan, 
                    thuchiens.ThuGiaiDoan,  
                    duans.QuyMo, 
                    duans.NgayBatDau AS NgayBatDauDuAn,   
                    duans.NgayKetThuc AS NgayKetThucDuAn,   
                    duans.Mota,  
                    duans.TenMa,  
                    GROUP_CONCAT(thanhviens.MaNguoiDung SEPARATOR ", ") AS MaNguoiDung
                FROM 
                    loaiduans
                    JOIN duans ON duans.MaLoai = loaiduans.id
                    JOIN thuchiens ON thuchiens.MaDuAn = duans.id
                    JOIN giaidoans ON thuchiens.MaGiaiDoan = giaidoans.id
                    JOIN thanhviens ON thanhviens.MaDuAn = duans.id
                WHERE 
                    duans.id = ?
                GROUP BY 
                    loaiduans.TenLoaiDuAn, 
                    giaidoans.TenGiaiDoan, 
                    thuchiens.NgayBatDau, 
                    thuchiens.NgayKetThuc,
                    thuchiens.MaGiaiDoan,
                    thuchiens.ThuGiaiDoan,
                    duans.QuyMo, 
                    duans.NgayBatDau, 
                    duans.NgayKetThuc, 
                    duans.Mota, 
                    duans.TenMa
            ', [$id]);
            $NguoiDung = nguoidung::where('IsActive', 1)->get();
            
       return response()->json(['data' => $DuAn,'NguoiDung'=>$NguoiDung]);
   }
 
   //Thêm Dự Án
   public function addview()
   {
       $title = "Thêm Dự Án";
    $NguoiDung = DB::select('SELECT 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName AS user_name, 
            GROUP_CONCAT(DISTINCT vaitros.TenVaiTro) AS vaitro_names, 
            GROUP_CONCAT(DISTINCT donvis.TenDonVi) AS donvi_names 
        FROM 
            nguoidungs 
        LEFT JOIN 
            tacvus ON nguoidungs.id = tacvus.MaNguoiDung AND tacvus.IsActive = true 
        LEFT JOIN 
            vaitros ON vaitros.id = tacvus.MaVaiTro AND vaitros.IsActive = true 
        LEFT JOIN 
            phongbans ON nguoidungs.id = phongbans.MaNguoiDung AND phongbans.IsActive = true 
        LEFT JOIN 
            donvis ON donvis.id = phongbans.MaDonVi AND donvis.IsActive = true 
        WHERE 
            nguoidungs.Quyen IN (2, 3, 4) 
            AND nguoidungs.IsActive = true 
        GROUP BY 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName;
        ');
            $DonVi = donvi::where('IsActive', 1)->get();
            $VaiTro = vaitro::where('IsActive', 1)->get();
            $LoaiDuAn = loaiduan::where('IsActive', 1)->get();
            $GiaiDoan = giaidoan::where('IsActive', 1)->get();
       return view('DuAn.AddDuAn', compact('VaiTro','GiaiDoan','DonVi','NguoiDung','title','LoaiDuAn'));
   }
   public function getNguoiDung($id)
   {
       $NguoiDung = DB::select('SELECT 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName AS user_name, 
            GROUP_CONCAT(DISTINCT vaitros.TenVaiTro) AS vaitro_names, 
            GROUP_CONCAT(DISTINCT donvis.TenDonVi) AS donvi_names 
        FROM 
            nguoidungs 
        LEFT JOIN 
            tacvus ON nguoidungs.id = tacvus.MaNguoiDung AND tacvus.IsActive = true 
        LEFT JOIN 
            vaitros ON vaitros.id = tacvus.MaVaiTro AND vaitros.IsActive = true 
        LEFT JOIN 
            phongbans ON nguoidungs.id = phongbans.MaNguoiDung AND phongbans.IsActive = true 
        LEFT JOIN 
            donvis ON donvis.id = phongbans.MaDonVi AND donvis.IsActive = true 
        WHERE 
            nguoidungs.Quyen IN (2, 3, 4) 
            AND nguoidungs.IsActive = true 
             AND phongbans.MaDonVi = ?
        GROUP BY 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName;
            ',[$id]);
   
       return response()->json($NguoiDung);
   }
   public function add(Request $request)
    {  
        DB::beginTransaction(); // Bắt đầu giao dịch
        try {
        $existingLopHoc = duan::where('TenDuAn', $request->TenDuAn)->count();

        // Kiểm tra trước khi lưu
        if ($existingLopHoc > 0) {
            return response()->json(['success' => false, 'message' => 'Giá trị Ten Du An đã tồn tại']);
        }
            // Tạo dự án mới
            $duAn = new duan();
            $duAn->TenDuAn = $request->TenDuAn;
            $duAn->MaLoai = $request->MaLoai;
            $duAn->QuyMo = $request->QuyMo;
          
            $duAn->Mota = $request->MoTa;
            $duAn->NgayKetThuc = $request->NgayKetThucDuAn;
            $duAn->NgayBatDau = $request->NgayBatDauDuAn;
            $duAn->TrangThai = 1;
            $duAn->MaNguoiTao = 1;
            $duAn->IsActive = true;
            $duAn->save();

            $idDuAn = $duAn->id;
            $year = Carbon::now()->format('y'); // Lấy 2 số cuối của năm hiện tại
            $tenMa = 'DuAn' . $year . $idDuAn;
            $duAn->TenMa = $tenMa;
            // Lưu lại lần thứ 2 sau khi đã có TenMa
            $duAn->save();

        
            // Lấy dữ liệu từ request
            $ngayBatDaus = $request->input('NgayBatDau', []); // Ngày bắt đầu của từng giai đoạn
            $maGiaiDoans = $request->input('MaGiaiDoan', []); // Mã giai đoạn
            $ngayKetThucs = $request->input('NgayKetThuc', []); // Ngày bắt đầu của từng giai đoạn
            $thuTuGiaiDoans = $request->input('ThuTuGiaiDoan', []); // Thứ tự giai đoạn
            $MaNguoiDung = $request->input('MaNguoiDung');
            
            // Duyệt qua từng giai đoạn và lưu vào cơ sở dữ liệu
            foreach ($maGiaiDoans as $index => $maGiaiDoan) {
                $giaiDoan = new thuchien();
                $giaiDoan->MaDuAn = $duAn->id; // Liên kết với dự án vừa tạo
                $giaiDoan->MaGiaiDoan = $maGiaiDoan; // Mã giai đoạn từ form
                $giaiDoan->IsCongViec = false; // Mã giai đoạn từ form
            
                // Gán ngày bắt đầu và ngày kết thúc cho từng giai đoạn
                $ngayBatDau = $ngayBatDaus[$index]; // Ngày bắt đầu từ form của từng giai đoạn
                $giaiDoan->NgayBatDau = $ngayBatDau;
            
                $ngayKetThuc = $ngayKetThucs[$index]; // Ngày bắt đầu từ form của từng giai đoạn
                $giaiDoan->NgayKetThuc = $ngayKetThuc;
               
                $giaiDoan->ThuGiaiDoan = $thuTuGiaiDoans[$index]; // Thứ tự giai đoạn từ form
                $giaiDoan->IsActive = true;
            
                // Lưu giai đoạn vào cơ sở dữ liệu
                $giaiDoan->save();
            }
            
        
            foreach ($MaNguoiDung as $nguoiDungId) {
                // Tạo một bản ghi mới trong bảng PhongBan
                $thanhvien = new thanhvien;
                $thanhvien->MaDuAn = $duAn->id;
                $thanhvien->MaNguoiDung = $nguoiDungId; // Nếu bảng thanhvien có cột này
                $thanhvien->IsActive = true; // Nếu bảng thanhvien có cột này
                $thanhvien->save();
            }
        
            DB::commit(); // Lưu tất cả thay đổi vào cơ sở dữ liệu
        
            return response()->json(['success' => true]);
        
        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác tất cả thay đổi nếu có lỗi
        
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
     //Cập nhật Dự Án
   public function updateview($id)
   {
       $DuAn = duan::find($id);
       $title = "Cập Nhật Dự Án";
       $LoaiDuAn = loaiduan::where('IsActive', 1)->get();
       $GiaiDoan = giaidoan::where('IsActive', 1)->get();
        $CacGiaiDoan = DB::select(' SELECT *, 
                DATEDIFF(NgayKetThuc, NgayBatDau) AS SoNgayThucHienTinhToan
                FROM thuchiens
                WHERE MaDuAn = ?',[$id]);


        $ThanhVienDuAn = DB::select('SELECT 
                nguoidungs.id, 
                nguoidungs.Quyen, 
                nguoidungs.UserName AS user_name, 
                GROUP_CONCAT(DISTINCT vaitros.TenVaiTro) AS vaitro_names, 
                GROUP_CONCAT(DISTINCT donvis.TenDonVi) AS donvi_names 
            FROM 
                nguoidungs 
            LEFT JOIN 
                tacvus ON nguoidungs.id = tacvus.MaNguoiDung AND tacvus.IsActive = true 
            LEFT JOIN 
                vaitros ON vaitros.id = tacvus.MaVaiTro AND vaitros.IsActive = true 
            LEFT JOIN 
                phongbans ON nguoidungs.id = phongbans.MaNguoiDung AND phongbans.IsActive = true 
            LEFT JOIN 
                donvis ON donvis.id = phongbans.MaDonVi AND donvis.IsActive = true 
            LEFT JOIN 
                thanhviens ON nguoidungs.id = thanhviens.MaNguoiDung AND thanhviens.IsActive = true 
            WHERE 
                nguoidungs.Quyen IN (2, 3, 4) 
            AND nguoidungs.IsActive = true 
            AND thanhviens.MaDuAn = ?
            GROUP BY 
                nguoidungs.id, 
                nguoidungs.Quyen, 
                nguoidungs.UserName;
                ',[$id]);
        $idMaDonVi1= DB::select('SELECT * FROM duans WHERE id = ?;',[$id]);
        $idMaDonVi= DB::select('SELECT * FROM donvis WHERE id = ?;',[$idMaDonVi1[0]->MaDonVi]);
        $ThanhVienDonVi = DB::select('SELECT 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName AS user_name, 
            GROUP_CONCAT(DISTINCT vaitros.TenVaiTro) AS vaitro_names, 
            GROUP_CONCAT(DISTINCT donvis.TenDonVi) AS donvi_names 
        FROM 
            nguoidungs 
        LEFT JOIN 
            tacvus ON nguoidungs.id = tacvus.MaNguoiDung AND tacvus.IsActive = true 
        LEFT JOIN 
            vaitros ON vaitros.id = tacvus.MaVaiTro AND vaitros.IsActive = true 
        LEFT JOIN 
            phongbans ON nguoidungs.id = phongbans.MaNguoiDung AND phongbans.IsActive = true 
        LEFT JOIN 
            donvis ON donvis.id = phongbans.MaDonVi AND donvis.IsActive = true 
        LEFT JOIN 
            thanhviens ON nguoidungs.id = thanhviens.MaNguoiDung AND thanhviens.IsActive = true 
        WHERE 
            nguoidungs.Quyen IN (2, 3, 4) 
            AND nguoidungs.IsActive = true 
            AND donvis.id = ?
        GROUP BY 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName;',[$idMaDonVi1[0]->MaDonVi]);
       return view('DuAn.UpdateDuAn', compact('LoaiDuAn','DuAn', 'title','GiaiDoan','CacGiaiDoan','ThanhVienDuAn','ThanhVienDonVi','idMaDonVi'));
   }
   
   public function update(Request $request, $id)
   {
    DB::beginTransaction(); // Bắt đầu giao dịch
        try {
        $DuAn = duan::where('id', '!=', $id)
        ->where('TenDuAn', $request->TenDuAn)
        ->where('IsActive', true)
        ->first();

        if ($DuAn) {
            return response()->json(['success' => false, 'message' => 'Giá trị TenDuAn đã tồn tại']);
        } else {
                $DuAn = duan::find($id);
                $DuAn->TenDuAn = $request->TenDuAn;
                $DuAn->QuyMo = $request->QuyMo;
                $DuAn->MaLoai = $request->MaLoai;
                $DuAn->NgayBatDau = $request->NgayBatDauDuAn;
                $DuAn->NgayKetThuc = $request->NgayKetThucDuAn;
                $DuAn->Mota = $request->MoTa;
                $DuAn->save();
            
            // Lấy dữ liệu từ request (đảm bảo lấy đúng giá trị ngày của từng giai đoạn)
            $ngayBatDaus = $request->input('NgayBatDau', []); // Phải là mảng các ngày bắt đầu cho từng giai đoạn
            $maGiaiDoans = $request->input('MaGiaiDoan', []); // Mảng các mã giai đoạn
            $ngayKetThucs = $request->input('NgayKetThuc', []); // Mảng các ngày kết thúc cho từng giai đoạn
            $thuTuGiaiDoans = $request->input('ThuTuGiaiDoan', []); // Mảng các thứ tự giai đoạn
            
            // Duyệt qua từng giai đoạn và kiểm tra trong CSDL
            foreach ($maGiaiDoans as $index => $maGiaiDoan) {
                // Kiểm tra giai đoạn đã tồn tại hay chưa
                $existingGiaiDoan = DB::table('thuchiens')
                    ->select('id')
                    ->where('MaDuAn', $id)
                    ->where('ThuGiaiDoan', $thuTuGiaiDoans[$index])
                    ->first();
            
                // Lấy ngày bắt đầu của từng giai đoạn
                $ngayBatDau = isset($ngayBatDaus[$index]) ? $ngayBatDaus[$index] : null;
                $ngayKetThuc = isset($ngayKetThucs[$index]) ? $ngayKetThucs[$index] : null;
            
                if ($ngayBatDau === null || $ngayKetThuc === null) {
                    // Nếu không có ngày bắt đầu hoặc ngày kết thúc, bỏ qua giai đoạn này
                    continue;
                }
            
                if ($existingGiaiDoan) {
                    // Cập nhật giai đoạn nếu đã tồn tại
                    $giaiDoan = thuchien::find($existingGiaiDoan->id);
                } else {
                    // Tạo mới giai đoạn nếu chưa tồn tại
                    $giaiDoan = new thuchien();
                    $giaiDoan->MaDuAn = $id;
                    $giaiDoan->MaGiaiDoan = $maGiaiDoan;
                    $giaiDoan->IsCongViec = false; // Đặt giá trị mặc định cho IsCongViec
                }
            
                // Gán ngày bắt đầu, ngày kết thúc và thứ tự giai đoạn
                $giaiDoan->NgayBatDau = $ngayBatDau;
                $giaiDoan->NgayKetThuc = $ngayKetThuc;
                $giaiDoan->ThuGiaiDoan = $thuTuGiaiDoans[$index];
                $giaiDoan->IsActive = true; // Đặt IsActive thành true
            
                // Lưu giai đoạn vào CSDL
                $giaiDoan->save();
            }       
                // Xử lý thông tin giao việc
                $MaNguoiDung = $request->input('MaNguoiDung');
                $MaNguoiDungListDB = thanhvien::where('MaDuAn', $id)
                    ->where('IsActive', true)
                    ->pluck('MaNguoiDung')
                    ->toArray();
                $MaNguoiDungListUI = is_array($MaNguoiDung) ? $MaNguoiDung : [$MaNguoiDung];
                
                // Kiểm tra sự thay đổi dữ liệu
                $inDBNotInUI = array_diff($MaNguoiDungListDB, $MaNguoiDungListUI);
                $inUINotInDB = array_diff($MaNguoiDungListUI, $MaNguoiDungListDB);
                
               
                foreach ($inDBNotInUI as $maNguoiDung) {
                    $GiaoViec = thanhvien::where('MaDuAn', $id)
                        ->where('MaNguoiDung', $maNguoiDung)
                        ->where('IsActive', true)
                        ->first();
                    if ($GiaoViec) {
                        $GiaoViec->IsActive = false;
                        $GiaoViec->save();
                    }
                }
                
                // Thêm những người dùng mới được chọn
                foreach ($inUINotInDB as $maNguoiDung) {
                    $GiaoViec = thanhvien::where('MaDuAn', $id)
                        ->where('MaNguoiDung', $maNguoiDung)
                        ->where('IsActive', true)
                        ->first();
                    if ($GiaoViec) {
                        $GiaoViec->IsActive = true;
                        $GiaoViec->save();
                    } else {
                        $GiaoViec = new thanhvien;
                        $GiaoViec->MaDuAn = $id;
                        $GiaoViec->MaNguoiDung = $maNguoiDung;
                        $GiaoViec->IsActive = true;
                        $GiaoViec->save();
                    }
                }    

        }
        DB::commit(); // Lưu tất cả thay đổi vào cơ sở dữ liệu
        return response()->json(['success' => true]);
    
    } catch (\Exception $e) {
        DB::rollBack(); // Hoàn tác tất cả thay đổi nếu có lỗi
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
   }
   public function remove($id)
   {
       $DuAn= duan::find($id);
       $DuAn-> IsActive= false;
       $DuAn->save();
       return response()->json(['success' => true]);

   }
}
