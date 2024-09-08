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
       $DuAn = duan::where('IsActive', 1)->get();
       // Mảng lưu trữ các dự án chưa đủ công việc
    //     $DuAn = [];

    //     foreach ($duAnList as $duAn) {
    //         // Đếm số lượng bảng thực hiện liên quan đến dự án
    //         $soLuongThucHien = thuchien::where('MaDuAn', $duAn->id)->count();

    //         // Đếm số lượng công việc đã tạo theo MaDuAn
    //         $soLuongCongViec = congviec::where('MaDuAn', $duAn->id)->count();

    //         // Kiểm tra nếu số lượng công việc chưa đủ theo bảng thực hiện
    //         if ($soLuongCongViec < $soLuongThucHien) {
    //             $DuAn[] = $duAn;
    //     }
    // }
       $GiaiDoan = giaidoan::where('IsActive', 1)->get();
       $DonVi = donvi::where('IsActive', 1)->get();
       return view('CongViec.AddCongViec', compact('DonVi','NguoiDung','GiaiDoan','DuAn','title'));
   }


   public function addviewid($id)
   {
            $title = "Thêm Công Việc";
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
            $DuAn = duan::where('IsActive', 1)->where('duans.id',[$id])->get();
            // Mảng lưu trữ các dự án chưa đủ công việc
        //     $DuAn = [];

        //     foreach ($duAnList as $duAn) {
        //         // Đếm số lượng bảng thực hiện liên quan đến dự án
        //         $soLuongThucHien = thuchien::where('MaDuAn', $duAn->id)->count();

        //         // Đếm số lượng công việc đã tạo theo MaDuAn
        //         $soLuongCongViec = congviec::where('MaDuAn', $duAn->id)->count();

        //         // Kiểm tra nếu số lượng công việc chưa đủ theo bảng thực hiện
        //         if ($soLuongCongViec < $soLuongThucHien) {
        //             $DuAn[] = $duAn;
        //     }
        // }
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
           SELECT thuchiens.* ,duans.NgayBatDau AS NgayBatDauDuAn , duans.NgayKetThuc AS NgayKetThucDuAn FROM thuchiens ,duans
           WHERE thuchiens.id = ?
           AND thuchiens.IsActive = true 
           AND thuchiens.MaDuAn = duans.id 
            ',[$id]);
   
       return response()->json($GiaiDoan);
   }
   public function getNguoiDungCongViec($id)
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
           nguoidungs.UserName;',[$id]);
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

        $CongViec->NgayBatDau = $request->NgayBatDau;
        $CongViec->NgayKetThuc = $request->NgayKetThuc;

       

        $CongViec->LinkTaiLieu = $request->LinkTaiLieu;
        $CongViec->TrangThai = 1;
        $CongViec->MaNguoiTao = 1;
        $CongViec->IsActive = true;
        $CongViec->save();
    

        
        $ThucHien = thuchien::find($request->MaGiaiDoan);
        $ThucHien->IsCongViec = true;
        $ThucHien->save();

        // Lưu thông tin giao việc
        $MaNguoiDung = $request->input('MaNguoiDung');
        foreach ($MaNguoiDung as $nguoiDungId) {
            $GiaoViec = new giaoviec;
            $GiaoViec->MaCongViec = $CongViec->id;
            $GiaoViec->MaNguoiDung = $nguoiDungId;
            $GiaoViec->TrangThai = 1;
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
        $CongViec = DB::select('SELECT  congviecs.*,duans.NgayBatDau AS NgayBatDauDuAn, duans.NgayKetThuc AS NgayKetThucDuAn 
        FROM congviecs , duans  
        WHERE congviecs.MaDuAn = duans.id 
        AND congviecs.id = ?',[$id]);
        $title = "Cập Nhật Công Việc";
           // Parse ngày bắt đầu và ngày kết thúc
        $ngayBatDau = Carbon::parse($CongViec[0]->NgayBatDau);
        $ngayKetThuc = Carbon::parse($CongViec[0]->NgayKetThuc);

      
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
        $ngayBatDau2 = Carbon::parse($ThucHien[0]->NgayBatDau)->format('Y-m-d');
    
       
    } else {
        // Xử lý khi không có dữ liệu
        $soNgayThucHien1 = 0; // Hoặc giá trị mặc định khác
        $ngayBatDau1 = null;
        $ngayKetThuc1 = null;
    }

        $MaDuAn = DB::select('SELECT congviecs.MaDuAn FROM congviecs WHERE congviecs.id = ?',[$id]);


            $ThanhVienCongViec = DB::select('  SELECT nguoidungs.id, 
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
            nguoidungs.UserName;',[$id]);
         
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
         ',[$MaDuAn[0]->MaDuAn]);


        return view('CongViec.UpdateCongViec', compact('ThanhVienCongViec','ThanhVienDuAn', 'CongViec', 'title', 'ngayBatDau', 'ngayKetThuc', 'ngayBatDau1', 'ngayKetThuc1'));

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
        
            $CongViec->NgayBatDau = $request->NgayBatDau;
            $CongViec->NgayKetThuc = $request->NgayKetThuc;
            $CongViec->LinkTaiLieu = $request->LinkTaiLieu;
            $CongViec->TrangThai = 1;
            $CongViec->MaNguoiTao = 1;
            $CongViec->IsActive = true;
            $CongViec->save();
        

            $changeStatus = 1;
         // Xử lý thông tin giao việc
            $MaNguoiDung = $request->input('MaNguoiDung');
            $MaNguoiDungListDB = giaoviec::where('MaCongViec', $CongViec->id)
                ->where('IsActive',true)
                ->pluck('MaNguoiDung')
                ->toArray();
            $MaNguoiDungListUI = is_array($MaNguoiDung) ? $MaNguoiDung : [$MaNguoiDung];

            // Kiểm tra sự thay đổi dữ liệu
            $inDBNotInUI = array_diff($MaNguoiDungListDB, $MaNguoiDungListUI);
            $inUINotInDB = array_diff($MaNguoiDungListUI, $MaNguoiDungListDB);


            if (!collect($inDBNotInUI)->isEmpty() || !collect($inUINotInDB)->isEmpty()) {
                // Xóa những người dùng không còn được chọn
                $changeStatus = 2;

                // Kiểm tra thời gian sau khi có sự thay đổi
                $now = Carbon::now()->format('Y-m-d');
                $ngayKetThuc = Carbon::parse($request->NgayKetThuc)->format('Y-m-d');

                if ($changeStatus == 2 && $now >= $request->NgayBatDau && $now <= $ngayKetThuc) {
                    return response()->json(['time' => false, 'message' => 'Đang Thực hiện']);
                }
                
            }
                foreach ($inDBNotInUI as $maNguoiDung) {
                    $GiaoViec = giaoviec::where('MaCongViec', $CongViec->id)
                        ->where('MaNguoiDung', $maNguoiDung)
                        ->first();
                    if ($GiaoViec) {
                        $GiaoViec->IsActive = false;
                        $GiaoViec->save();
                    }
                }

                // Thêm những người dùng mới được chọn
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
                        $GiaoViec->TrangThai = 1;
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
