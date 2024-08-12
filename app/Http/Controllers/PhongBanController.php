<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\phongban;
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
        $PhongBan = DB::select('SELECT phongbans.*, donvis.TenDonVi
        FROM donvis, phongbans
        WHERE phongbans.MaDonVi = donvis.id and phongbans.IsActive = true');
        return response()->json(['data' => $PhongBan]);
    }
    //Thêm Phòng Ban
    public function addview()
    {
        $title = "Thêm Phòng Ban";
        $DonVi = donvi::where('IsActive', 1)->get();
        return view('PhongBan.AddPhongBan', compact('DonVi','title'));
    }
    public function add(Request $request)
    {
        $existingPhongBan = phongban::where('TenPhongBan', $request->TenPhongBan)
        ->where('IsActive', true)
        ->count();
       
          // Kiểm tra trước khi lưu
          if ($existingPhongBan > 0 ) {
            return response()->json(['success' => false, 'message' => 'Giá trị TenPhongBan đã tồn tại']);
        }
        else  {
            $getPhongBan = phongban::where('TenPhongBan', $request->TenPhongBan)
            ->where('IsActive', false)
            ->get();
            if(!$getPhongBan->isEmpty()){
                $PhongBan = phongban::find($getPhongBan->first()->id);
                $PhongBan->MaDonVi = $request->MaDonVi;
                $PhongBan->IsActive = true;
              
                $PhongBan->save();
                return response()->json(['success' => true]);
            }else{
                $PhongBan = new phongban;
                $PhongBan->TenPhongBan = $request->TenPhongBan;
                $PhongBan->MaDonVi = $request->MaDonVi;
                $PhongBan->IsActive = true;
            
                $PhongBan->save();
                return response()->json(['success' => true]);
            }
           
        } 
    }
    //Cập nhật Khóa học
    public function updateview($id)
    {
        $PhongBan = phongban::find($id);
        $title = "Cập Nhật khóa học";
        $DonVi = donvi::where('IsActive', 1)->get();
        return view('PhongBan.UpdatePhongBan', compact('DonVi','PhongBan', 'title'));
    }
    public function update(Request $request, $id)
    {
        $PhongBan = phongban::where('id', '!=', $id)
        ->where('TenPhongBan', $request->TenPhongBan)
        ->where('IsActive', true)
        ->first();
        if ($PhongBan) {
            return response()->json(['success' => false, 'message' => 'Giá trị TenPhongBan đã tồn tại']);
        } else {
            $getPhongBan = phongban::where('id', '!=', $id)
            ->where('TenPhongBan', $request->TenPhongBan)
            ->where('IsActive', false)
            ->get();
            if(!$getPhongBan->isEmpty()){
                $PhongBan= phongban::find($getPhongBan->first()->id);
                $PhongBan->IsActive = true;
                $PhongBan->MaDonVi = $request->MaDonVi;
                $PhongBan->save();

                $PhongBanold= phongban::find($id);
                $PhongBanold->IsActive = false;
                $PhongBanold->MaDonVi = $request->MaDonVi;
                $PhongBanold->save();
                return response()->json(['success' => true]);
               
            }else {
                $PhongBan= phongban::find($id);
                $PhongBan->TenPhongBan = $request->TenPhongBan;
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
