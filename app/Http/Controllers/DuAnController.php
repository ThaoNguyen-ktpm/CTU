<?php

namespace App\Http\Controllers;
use App\Models\duan;
use App\Models\donvi;
use App\Models\giaidoan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class DuAnController extends Controller
{
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
            $DonVi = donvi::where('IsActive', 1)->get();
            $GiaiDoan = giaidoan::where('IsActive', 1)->get();
       return view('DuAn.AddDuAn', compact('GiaiDoan','DonVi','NguoiDung','title'));
   }
   public function getNguoiDung($id)
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
        WHERE 
            nguoidungs.Quyen IN (2, 3, 4) 
            AND nguoidungs.IsActive = true 
             AND phongbans.MaDonVi = ?
        GROUP BY 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.Name;
            ',[$id]);
   
       return response()->json($NguoiDung);
   }
}
