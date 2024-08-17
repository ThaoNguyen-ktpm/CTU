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

class CongViecController extends Controller
{
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

}
