<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\tacvu;
use App\Models\vaitro;
use App\Models\nguoidung;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class TacVuController extends Controller
{
   
    public function list()
    {
        $title = "Danh Sách Vai Trò Người Dùng";
        return view('TacVu.ListTacVu', compact('title'));
    }
    public function getTacVu()
    {
        $TacVu = DB::select('SELECT tacvus.*, vaitros.TenVaiTro, nguoidungs.Name
        FROM vaitros, tacvus , nguoidungs 
        WHERE tacvus.MaNguoiDung = nguoidungs.id and tacvus.MaVaiTro = vaitros.id and tacvus.IsActive = true');
        return response()->json(['data' => $TacVu]);
    }
    //Thêm Tác Vụ
    public function addview()
    {
        $title = "Thêm Vai Trò Người Dùng";
        $VaiTro = vaitro::where('IsActive', 1)->get();
        $NguoiDung = nguoidung::where('IsActive', 1) ->whereIn('Quyen', [4, 2, 3])->get();
        return view('TacVu.AddTacVu', compact('NguoiDung','VaiTro','title'));
    }
    public function add(Request $request)
    {
         // Lấy giá trị từ form
         $MaVaiTro = $request->input('MaVaiTro');
         $MaNguoiDung = $request->input('MaNguoiDung');

         foreach($MaNguoiDung as $nguoiDungId) {
             // Tạo một bản ghi mới trong bảng PhongBan

            $KiemTra = DB::select('SELECT *
                                    FROM  tacvus 
                                    WHERE tacvus.MaNguoiDung = ?
                                    and tacvus.MaVaiTro = ? 
                                    and tacvus.IsActive = true',[$nguoiDungId,$MaVaiTro]);
            if($KiemTra){
                return response()->json(['success' => false]);
            }        
             $TacVu = new tacvu;
             $TacVu->MaVaiTro = $MaVaiTro;
             $TacVu->MaNguoiDung = $nguoiDungId; // Nếu bảng TacVu có cột này
             $TacVu->IsActive = true; // Nếu bảng TacVu có cột này
             $TacVu->save();
         }
             return response()->json(['success' => true]);
    }
    //Cập nhật Vai Trò Người Dùng
    public function updateview($id)
    {
        $TacVu = DB::select('SELECT tacvus.*, vaitros.TenVaiTro, nguoidungs.Name 
        FROM vaitros, tacvus,nguoidungs
        WHERE tacvus.MaNguoiDung = nguoidungs.id 
        and tacvus.MaVaiTro = vaitros.id 
        and tacvus.IsActive = true 
        and tacvus.id =?',[$id]);
        $title = "Cập Nhật Vai Trò Người Dùng";
        $VaiTro = vaitro::where('IsActive', 1)->get();
        return view('TacVu.UpdateTacVu', compact('VaiTro','TacVu', 'title'));
    }
    public function update(Request $request, $id)
    {
        $TacVu = DB::select('SELECT * FROM tacvus
            WHERE id != ?
            AND MaVaiTro = ?
            AND MaNguoiDung = ?
            AND IsActive = true
        ', [$id, $request->MaVaiTro, $request->MaNguoiDung]);
        if ($TacVu) {
            return response()->json(['success' => false, 'message' => 'Giá trị Tác Vụ đã tồn tại']);
        } else {
            $getTacVu = tacvu::where('id', '!=', $id)
            ->where('MaVaiTro', $request->MaVaiTro)
            ->where('MaNguoiDung', $request->MaNguoiDung)
            ->where('IsActive', false)
            ->get();
            if(!$getTacVu->isEmpty()){
                $TacVu= tacvu::find($getTacVu->first()->id);
                $TacVu->IsActive = true;
                $TacVu->save();

                $TacVuold= tacvu::find($id);
                $TacVuold->IsActive = false;
                $TacVuold->save();
                return response()->json(['success' => true]);
               
            }else {
                $TacVu= tacvu::find($id);
                $TacVu->MaVaiTro = $request->MaVaiTro;
                $TacVu->save();
                return response()->json(['success' => true]);
            }
      
        }
    }
    //Xóa Tác Vụ
    public function remove($id)
    {
        $TacVu= tacvu::find($id);
        $TacVu->IsActive= false;
        $TacVu->save();
        return response()->json(['success' => true]);
    }
    public function getNguoiDung($id)
    {
        $existingIds = DB::table('tacvus')
        ->select('MaNguoiDung')
        ->where('MaVaiTro', $id)
        ->where('IsActive', true)
        ->pluck('MaNguoiDung');
    
         $remainingIds = DB::table('nguoidungs')
        ->select('id')
        ->where('IsActive', true)
        ->where(function($query) {
            $query->where('Quyen', 2)
                  ->orWhere('Quyen', 3)
                  ->orWhere('Quyen', 4);
        })
        ->whereNotIn('id', $existingIds)
        ->pluck('id');  // Lấy ra danh sách các MaNguoiDung còn lại
    
        $remainingUsers = DB::table('nguoidungs')
        ->whereIn('id', $remainingIds)
        ->where('IsActive', true)
        ->get();
    
        return response()->json($remainingUsers);
    }
}
