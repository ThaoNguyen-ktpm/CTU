<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\tacvu;
use App\Models\vaitro;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class TacVuController extends Controller
{
   
    public function list()
    {
        $title = "Danh Sách Tác Vụ";
        return view('TacVu.ListTacVu', compact('title'));
    }
    public function getTacVu()
    {
        $TacVu = DB::select('SELECT tacvus.*, vaitros.TenVaiTro
        FROM vaitros, tacvus
        WHERE tacvus.MaVaiTro = vaitros.id and tacvus.IsActive = true');
        return response()->json(['data' => $TacVu]);
    }
    //Thêm Tác Vụ
    public function addview()
    {
        $title = "Thêm Tác Vụ";
        $VaiTro = vaitro::where('IsActive', 1)->get();
        return view('TacVu.AddTacVu', compact('VaiTro','title'));
    }
    public function add(Request $request)
    {
        $existingTacVu = tacvu::where('TenTacVu', $request->TenTacVu)
        ->where('IsActive', true)
        ->count();
       
          // Kiểm tra trước khi lưu
          if ($existingTacVu > 0 ) {
            return response()->json(['success' => false, 'message' => 'Giá trị TenTacVu đã tồn tại']);
        }
        else  {
            $getTacVu = tacvu::where('TenTacVu', $request->TenTacVu)
            ->where('IsActive', false)
            ->get();
            if(!$getTacVu->isEmpty()){
                $TacVu = tacvu::find($getTacVu->first()->id);
                $TacVu->MaVaiTro = $request->MaVaiTro;
                $TacVu->IsActive = true;
              
                $TacVu->save();
                return response()->json(['success' => true]);
            }else{
                $TacVu = new tacvu;
                $TacVu->TenTacVu = $request->TenTacVu;
                $TacVu->MaVaiTro = $request->MaVaiTro;
                $TacVu->IsActive = true;
            
                $TacVu->save();
                return response()->json(['success' => true]);
            }
           
        } 
    }
    //Cập nhật Khóa học
    public function updateview($id)
    {
        $TacVu = tacvu::find($id);
        $title = "Cập Nhật khóa học";
        $VaiTro = vaitro::where('IsActive', 1)->get();
        return view('TacVu.UpdateTacVu', compact('VaiTro','TacVu', 'title'));
    }
    public function update(Request $request, $id)
    {
        $TacVu = tacvu::where('id', '!=', $id)
        ->where('TenTacVu', $request->TenTacVu)
        ->where('IsActive', true)
        ->first();
        if ($TacVu) {
            return response()->json(['success' => false, 'message' => 'Giá trị TenTacVu đã tồn tại']);
        } else {
            $getTacVu = tacvu::where('id', '!=', $id)
            ->where('TenTacVu', $request->TenTacVu)
            ->where('IsActive', false)
            ->get();
            if(!$getTacVu->isEmpty()){
                $TacVu= tacvu::find($getTacVu->first()->id);
                $TacVu->IsActive = true;
                $TacVu->MaVaiTro = $request->MaVaiTro;
                $TacVu->save();

                $TacVuold= tacvu::find($id);
                $TacVuold->IsActive = false;
                $TacVuold->MaVaiTro = $request->MaVaiTro;
                $TacVuold->save();
                return response()->json(['success' => true]);
               
            }else {
                $TacVu= tacvu::find($id);
                $TacVu->TenTacVu = $request->TenTacVu;
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
}
