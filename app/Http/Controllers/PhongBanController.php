<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\phongban;
use App\Models\nguoidung;
use App\Models\donvi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class PhongBanController extends Controller
{
   
    public function list()
    {
        $title = "Danh Sách Phòng Ban";
        return view('PhongBan.ListPhongBan', compact('title'));
    }
    public function getPhongBan()
    {
        $PhongBan = DB::select('SELECT phongbans.*, donvis.TenDonVi, nguoidungs.Name
        FROM donvis, phongbans,nguoidungs
        WHERE phongbans.MaNguoiDung = nguoidungs.id and phongbans.MaDonVi = donvis.id and phongbans.IsActive = true');
        return response()->json(['data' => $PhongBan]);
    }
    //Thêm Phòng Ban
    public function addview()
    {
        $title = "Thêm Phòng Ban";
        $DonVi = donvi::where('IsActive', 1)->get();
        $NguoiDung = nguoidung::where('IsActive', 1) ->whereIn('Quyen', [4, 2, 3])->get();
        return view('PhongBan.AddPhongBan', compact('NguoiDung','DonVi','title'));
    }
    public function add(Request $request)
    {
           // Lấy giá trị từ form
            $MaDonVi = $request->input('MaDonVi');
            $MaNguoiDung = $request->input('MaNguoiDung');

            foreach($MaNguoiDung as $nguoiDungId) {
                // Tạo một bản ghi mới trong bảng PhongBan
                $PhongBan = new PhongBan;
                $PhongBan->MaDonVi = $MaDonVi;
                $PhongBan->MaNguoiDung = $nguoiDungId; // Nếu bảng PhongBan có cột này
                $PhongBan->IsActive = true; // Nếu bảng PhongBan có cột này
                $PhongBan->save();
            }
                return response()->json(['success' => true]);

    }
    //Cập nhật Khóa học
    public function updateview($id)
    {
        $PhongBan = DB::select('SELECT phongbans.*, donvis.TenDonVi, nguoidungs.Name 
        FROM donvis, phongbans,nguoidungs
        WHERE phongbans.MaNguoiDung = nguoidungs.id 
        and phongbans.MaDonVi = donvis.id 
        and phongbans.IsActive = true 
        and phongbans.id =?',[$id]);
        $title = "Cập Nhật Phòng Ban";
        $DonVi = donvi::where('IsActive', 1)->get();
        return view('PhongBan.UpdatePhongBan', compact('DonVi','PhongBan', 'title'));
    }
    public function update(Request $request, $id)
    {
            $PhongBan = DB::select('SELECT * FROM phongbans
            WHERE id != ?
            AND MaDonVi = ?
            AND MaNguoiDung = ?
            AND IsActive = true
            
        ', [$id, $request->MaDonVi, $request->MaNguoiDung]);
        if ($PhongBan) {
            return response()->json(['success' => false, 'message' => 'Giá trị Phòng Ban đã tồn tại']);
        } else {
            $getPhongBan = phongban::where('id', '!=', $id)
            ->where('MaDonVi', $request->MaDonVi)
            ->where('MaNguoiDung', $request->MaNguoiDung)
            ->where('IsActive', false)
            ->get();
            if(!$getPhongBan->isEmpty()){
                $PhongBan= phongban::find($getPhongBan->first()->id);
                $PhongBan->IsActive = true;
                $PhongBan->save();

                $PhongBanold= phongban::find($id);
                $PhongBanold->IsActive = false;
                $PhongBanold->save();
                return response()->json(['success' => true]);
               
            }else {
                $PhongBan= phongban::find($id);
                $PhongBan->MaDonVi = $request->MaDonVi;
                $PhongBan->save();
                return response()->json(['success' => true]);
            }
      
        }
    }
    //Xóa Phòng Ban
    public function remove($id)
    {
        $PhongBan= phongban::find($id);
        $PhongBan->IsActive= false;
        $PhongBan->save();
        return response()->json(['success' => true]);
    }
}
