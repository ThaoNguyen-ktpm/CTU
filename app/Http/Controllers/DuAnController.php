<?php

namespace App\Http\Controllers;
use App\Models\duan;
use App\Models\donvi;
use App\Models\giaidoan;
use App\Models\vaitro;
use App\Models\thanhvien;
use App\Models\thuchien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class DuAnController extends Controller
{
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
         AND giaidoans.IsActive = true',[$id]);
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
        $DuAn = duan::where('IsActive', 1)->get();
       return response()->json(['data' => $DuAn]);
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
            $GiaiDoan = giaidoan::where('IsActive', 1)->get();
       return view('DuAn.AddDuAn', compact('VaiTro','GiaiDoan','DonVi','NguoiDung','title'));
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
            $duAn->Mota = $request->MoTa;
            $duAn->TrangThai = 1;
            $duAn->MaNguoiTao = 1;
            $duAn->IsActive = true;
            $duAn->save();
        
            // Lấy dữ liệu từ request
            $ngayBatDau = $request->input('NgayBatDau'); // Ngày bắt đầu của giai đoạn 1
            $maGiaiDoans = $request->input('MaGiaiDoan', []); // Mã giai đoạn
            $soNgayThucHiens = $request->input('SoNgayThucHien', []); // Số ngày thực hiện của từng giai đoạn
            $thuTuGiaiDoans = $request->input('ThuTuGiaiDoan', []); // Thứ tự giai đoạn
            $MaNguoiDung = $request->input('MaNguoiDung');
        
            // Biến lưu ngày kết thúc của giai đoạn trước
            $ngayKetThucTruoc = null;
        
            // Duyệt qua từng giai đoạn và lưu vào cơ sở dữ liệu
            foreach ($maGiaiDoans as $index => $maGiaiDoan) {
                $giaiDoan = new thuchien();
                $giaiDoan->MaDuAn = $duAn->id; // Liên kết với dự án vừa tạo
                $giaiDoan->MaGiaiDoan = $maGiaiDoan; // Mã giai đoạn từ form
        
                // Gán ngày bắt đầu và ngày kết thúc cho giai đoạn
                if ($index == 0) {
                    // Giai đoạn 1 có ngày bắt đầu từ form
                    $giaiDoan->NgayBatDau = $ngayBatDau;
                } else {
                    // Giai đoạn 2 trở đi có ngày bắt đầu từ ngày kết thúc của giai đoạn trước
                    $giaiDoan->NgayBatDau = $ngayKetThucTruoc;
                }
        
                // Tính toán ngày kết thúc dựa trên số ngày thực hiện
                $soNgayThucHien = $soNgayThucHiens[$index];
                $ngayKetThuc = date('Y-m-d', strtotime($giaiDoan->NgayBatDau . ' + ' . $soNgayThucHien . ' days'));
                $giaiDoan->NgayKetThuc = $ngayKetThuc;
        
                $giaiDoan->ThuGiaiDoan = $thuTuGiaiDoans[$index]; // Thứ tự giai đoạn từ form
                $giaiDoan->IsActive = true;
        
                // Lưu giai đoạn vào cơ sở dữ liệu
                $giaiDoan->save();
        
                // Cập nhật ngày kết thúc của giai đoạn hiện tại để dùng cho giai đoạn kế tiếp
                $ngayKetThucTruoc = $ngayKetThuc;
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
       return view('DuAn.UpdateDuAn', compact('DuAn', 'title'));
   }
   
   public function update(Request $request, $id)
   {
        $DuAn = duan::where('id', '!=', $id)
        ->where('TenDuAn', $request->TenDuAn)
        ->where('IsActive', true)
        ->first();

        if ($DuAn) {
            return response()->json(['success' => false, 'message' => 'Giá trị TenDuAn đã tồn tại']);
        } else {
            
                $DuAn = duan::find($id);
                $DuAn->TenDuAn = $request->TenDuAn;
                $DuAn->Mota = $request->MoTa;
                $DuAn->save();
                return response()->json(['success' => true]);
            
           
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
