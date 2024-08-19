<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\duan;
use App\Models\donvi;
use App\Models\giaidoan;
use App\Models\congviec;
use App\Models\giaoviec;
use App\Models\vaitro;
use App\Models\thanhvien;
use App\Models\thuchien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CongViecController extends Controller
{
     //Danh sách Công Việc
   public function list()
   {
       $title = "Danh Sách Công Việc";
       return view('CongViec.ListCongViec', compact('title'));
   }
   public function getCongViec()
   {
        $CongViec = DB::select('SELECT congviecs.* ,duans.TenDuAn , giaidoans.TenGiaiDoan 
        FROM congviecs , duans, thuchiens, giaidoans 
        WHERE congviecs.MaDuAn = duans.id 
        AND congviecs.MaThucHien = thuchiens.id 
        AND thuchiens.MaGiaiDoan = giaidoans.id
        AND congviecs.IsActive = true
        AND duans.IsActive = true
        AND thuchiens.IsActive = true
        AND giaidoans.IsActive = true');
       return response()->json(['data' => $CongViec]);
   }
    public function addview()
   {
       $title = "Thêm Công Việc";
       $NguoiDung = DB::select('SELECT 
       nguoidungs.id, 
       nguoidungs.Quyen, 
       nguoidungs.Name AS user_name, 
       GROUP_CONCAT(vaitros.TenVaiTro) AS vaitro_names, 
       GROUP_CONCAT(donvis.TenDonVi) AS donvi_names 
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
       nguoidungs.Name;
   ');
       $DuAn = duan::where('IsActive', 1)->get();
       $GiaiDoan = giaidoan::where('IsActive', 1)->get();
       $DonVi = donvi::where('IsActive', 1)->get();
       return view('CongViec.AddCongViec', compact('DonVi','NguoiDung','GiaiDoan','DuAn','title'));
   }


   public function getGiaiDoanDuAn($id)
   {
       $GiaiDoan = DB::select('
           SELECT thuchiens.* , giaidoans.TenGiaiDoan FROM thuchiens , giaidoans 
           WHERE thuchiens.MaDuAn = ? AND thuchiens.MaGiaiDoan = giaidoans.id 
           AND thuchiens.IsActive = true  
           AND giaidoans.IsActive = true
            ',[$id]);
   
       return response()->json($GiaiDoan);
   }
   public function getThoiGian($id)
   {
       $GiaiDoan = DB::select('
           SELECT thuchiens.*  FROM thuchiens 
           WHERE thuchiens.id = ? 
           AND thuchiens.IsActive = true  
            ',[$id]);
   
       return response()->json($GiaiDoan);
   }
   public function getNguoiDungCongViec($id)
   {
       $NguoiDung = DB::select('SELECT 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.Name AS user_name, 
            GROUP_CONCAT(vaitros.TenVaiTro) AS vaitro_names, 
            GROUP_CONCAT(donvis.TenDonVi) AS donvi_names 
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
            nguoidungs.Name;
            ',[$id]);
   
       return response()->json($NguoiDung);
   }
   public function listThanhVien(Request $request)
   {
       $title = "Danh Sách Thành Viên";
       $id = $request->input('id');
       return view('CongViec.ListCongViecThanhVien', compact('id','title'));
   }
   public function getCongViecThanhVien(Request $request)
   {
        $id = $request->input('id');
       
        $DuAn = DB::select('  SELECT nguoidungs.id, 
           nguoidungs.Quyen, 
           nguoidungs.Name AS user_name, 
           GROUP_CONCAT(vaitros.TenVaiTro) AS vaitro_names, 
           GROUP_CONCAT(donvis.TenDonVi) AS donvi_names 
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
           giaoviecs ON giaoviecs.MaNguoiDung = nguoidungs.id AND giaoviecs.IsActive = true 
             LEFT JOIN 
           congviecs ON congviecs.id = giaoviecs.MaCongViec AND giaoviecs.IsActive = true 
       WHERE 
           nguoidungs.Quyen IN (2, 3, 4) 
           AND nguoidungs.IsActive = true 
            AND giaoviecs.MaCongViec = ?
       GROUP BY 
           nguoidungs.id, 
           nguoidungs.Quyen, 
           nguoidungs.Name;',[$id]);
       return response()->json(['data' => $DuAn]);
   }
   public function add(Request $request)
   {  
    DB::beginTransaction(); // Bắt đầu giao dịch
    try {
        $existingCongViec = congviec::where('TenCongViec', $request->TenCongViec)->count();
    
        // Kiểm tra trước khi lưu
        if ($existingCongViec > 0) {
            return response()->json(['success' => false, 'message' => 'Giá trị Tên Công Việc đã tồn tại']);
        }
    
        // Lấy thông tin thời gian từ bảng thuchiens
        $ThoiGian = DB::select('SELECT thuchiens.* FROM thuchiens WHERE thuchiens.id = ? AND thuchiens.IsActive = true', [$request->MaGiaiDoan]);
        if (count($ThoiGian) > 0) {
            $ThoiGianBatDau = Carbon::parse($ThoiGian[0]->NgayBatDau);
            // Các bước xử lý khác
        } else {
            // Xử lý khi không có dữ liệu trong $ThoiGian
            return response()->json(['success' => false, 'message' => 'Không tìm thấy thông tin thời gian cho Mã Dự Án này']);
        }
        // Tạo công việc mới
        $CongViec = new congviec;
        $CongViec->TenCongViec = $request->TenCongViec;
        $CongViec->MoTa = $request->MoTa;
        $CongViec->MaDuAn = $request->MaDuAn;
        $CongViec->MaThucHien = $request->MaGiaiDoan;
    
        // Chuyển đổi NgayBatDau thành đối tượng Carbon và thêm số ngày thực hiện
        $ThoiGianBatDau = Carbon::parse($ThoiGian[0]->NgayBatDau);
     // Chuyển đổi $request->SoNgayThucHien thành số nguyên
        $SoNgayThucHien = (int) $request->SoNgayThucHien;

        $CongViec->NgayBatDau = $ThoiGianBatDau;
        $ngayKetThuc = date('Y-m-d', strtotime($ThoiGianBatDau . ' + ' .  $SoNgayThucHien . ' days'));
        $CongViec->NgayKetThuc = $ngayKetThuc;

        $CongViec->LinkTaiLieu = $request->LinkTaiLeiu;
        $CongViec->TrangThai = 1;
        $CongViec->MaNguoiTao = 1;
        $CongViec->IsActive = true;
        $CongViec->save();
    
        // Lưu thông tin giao việc
        $MaNguoiDung = $request->input('MaNguoiDung');
        foreach ($MaNguoiDung as $nguoiDungId) {
            $GiaoViec = new giaoviec;
            $GiaoViec->MaCongViec = $CongViec->id;
            $GiaoViec->MaNguoiDung = $nguoiDungId;
            $GiaoViec->IsActive = true;
            $GiaoViec->save();
        }
    
        DB::commit(); // Lưu tất cả thay đổi vào cơ sở dữ liệu
        return response()->json(['success' => true]);
    
    } catch (\Exception $e) {
        DB::rollBack(); // Hoàn tác tất cả thay đổi nếu có lỗi
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
    
   }
      //Cập nhật Công Việc
      public function updateview($id)
      {
        $CongViec = congviec::find($id);
        $title = "Cập Nhật Công Việc";
           // Parse ngày bắt đầu và ngày kết thúc
        $ngayBatDau = Carbon::parse($CongViec->NgayBatDau);
        $ngayKetThuc = Carbon::parse($CongViec->NgayKetThuc);

        // Tính toán số ngày giữa hai ngày, bao gồm cả ngày bắt đầu và ngày kết thúc
        $soNgayThucHien = $ngayBatDau->diffInDays($ngayKetThuc) + 1;
        $ThucHien= DB::select('SELECT thuchiens.* 
        FROM congviecs, thuchiens 
        WHERE congviecs.id = ? 
        AND congviecs.MaThucHien = thuchiens.id 
        AND congviecs.IsActive = true 
        AND thuchiens.IsActive = true ', [$id]);
    
    // Kiểm tra nếu $ThucHien có kết quả
    if (!empty($ThucHien)) {
        $ngayBatDau1 = Carbon::parse($ThucHien[0]->NgayBatDau)->format('d/m/Y'); // Định dạng ngày tháng
        $ngayKetThuc1 = Carbon::parse($ThucHien[0]->NgayKetThuc)->format('d/m/Y'); // Định dạng ngày tháng

    
        // Tính toán số ngày giữa hai ngày, bao gồm cả ngày bắt đầu và ngày kết thúc
        $soNgayThucHien1 = Carbon::parse($ThucHien[0]->NgayBatDau)->diffInDays(Carbon::parse($ThucHien[0]->NgayKetThuc)) + 1;
    } else {
        // Xử lý khi không có dữ liệu
        $soNgayThucHien1 = 0; // Hoặc giá trị mặc định khác
        $ngayBatDau1 = null;
        $ngayKetThuc1 = null;
    }

        $MaDuAn = DB::select('SELECT congviecs.MaDuAn FROM congviecs WHERE congviecs.id = ?',[$id]);


            $ThanhVienCongViec = DB::select('  SELECT nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.Name AS user_name, 
            GROUP_CONCAT(vaitros.TenVaiTro) AS vaitro_names, 
            GROUP_CONCAT(donvis.TenDonVi) AS donvi_names 
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
            giaoviecs ON giaoviecs.MaNguoiDung = nguoidungs.id AND giaoviecs.IsActive = true 
            LEFT JOIN 
            congviecs ON congviecs.id = giaoviecs.MaCongViec AND giaoviecs.IsActive = true 
        WHERE 
            nguoidungs.Quyen IN (2, 3, 4) 
            AND nguoidungs.IsActive = true 
            AND giaoviecs.MaCongViec = ?
        GROUP BY 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.Name;',[$id]);
         
         $ThanhVienDuAn = DB::select('SELECT 
         nguoidungs.id, 
         nguoidungs.Quyen, 
         nguoidungs.Name AS user_name, 
         GROUP_CONCAT(vaitros.TenVaiTro) AS vaitro_names, 
         GROUP_CONCAT(donvis.TenDonVi) AS donvi_names 
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
         nguoidungs.Name;
         ',[$MaDuAn[0]->MaDuAn]);


        return view('CongViec.UpdateCongViec', compact('ThanhVienCongViec','ThanhVienDuAn','soNgayThucHien1','soNgayThucHien', 'CongViec', 'title', 'ngayBatDau', 'ngayKetThuc', 'ngayBatDau1', 'ngayKetThuc1'));

      }


      public function update(Request $request, $id)
      {
        DB::beginTransaction(); // Bắt đầu giao dịch
        try {
            $existingCongViec = congviec::where('TenCongViec', $request->TenCongViec)
            ->where('id', '!=', $id)
            ->count();
        
            // Kiểm tra trước khi lưu
            if ($existingCongViec > 0) {
                return response()->json(['success' => false, 'message' => 'Giá trị Tên Công Việc đã tồn tại']);
            }
        

            // Tạo công việc mới
            $CongViec = congviec::find($id);
            $CongViec->TenCongViec = $request->TenCongViec;
            $CongViec->MoTa = $request->MoTa;
           
        
         // Chuyển đổi $request->SoNgayThucHien thành số nguyên
            $SoNgayThucHien =  $request->SoNgayThucHien;
            $ngayKetThuc = date('Y-m-d', strtotime($request->NgayBatDau . ' + ' . ($SoNgayThucHien - 1) . ' days'));
            $CongViec->NgayKetThuc = $ngayKetThuc;
    
            $CongViec->LinkTaiLieu = $request->LinkTaiLeiu;
            $CongViec->TrangThai = 1;
            $CongViec->MaNguoiTao = 1;
            $CongViec->IsActive = true;
            $CongViec->save();
        
            // Xử lý thông tin giao việc
            $MaNguoiDung = $request->input('MaNguoiDung');
            $MaNguoiDungListDB = giaoviec::where('MaCongViec', $CongViec->id)
                ->pluck('MaNguoiDung')
                ->toArray();
            $MaNguoiDungListUI = is_array($MaNguoiDung) ? $MaNguoiDung : [$MaNguoiDung];

            // Xóa những người dùng không còn được chọn
            $inDBNotInUI = array_diff($MaNguoiDungListDB, $MaNguoiDungListUI);
            foreach ($inDBNotInUI as $maNguoiDung) {
                $GiaoViec = giaoviec::where('MaCongViec', $CongViec->id)
                    ->where('MaNguoiDung', $maNguoiDung)
                    ->first();
                $GiaoViec->IsActive = false;
                $GiaoViec->save();
            }

            // Thêm những người dùng mới được chọn
            $inUINotInDB = array_diff($MaNguoiDungListUI, $MaNguoiDungListDB);
            foreach ($inUINotInDB as $maNguoiDung) {
                $GiaoViec = giaoviec::where('MaCongViec', $CongViec->id)
                    ->where('MaNguoiDung', $maNguoiDung)
                    ->first();
                if ($GiaoViec) {
                    $GiaoViec->IsActive = true;
                   
                    $GiaoViec->save();
                } else {
                    $GiaoViec = new giaoviec;
                    $GiaoViec->MaCongViec = $CongViec->id;
                    $GiaoViec->MaNguoiDung = $maNguoiDung;
                    $GiaoViec->IsActive = true;
                    $GiaoViec->save();
                }
            }
        
            DB::commit(); // Lưu tất cả thay đổi vào cơ sở dữ liệu
            return response()->json(['success' => true]);
        
        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác tất cả thay đổi nếu có lỗi
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
      }



}
