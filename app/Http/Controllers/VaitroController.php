<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\vaitro;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class VaiTroController extends Controller
{
   //Danh sách Chứng chỉ
   public function list()
   {
       $title = "Danh Sách Chứng chỉ";
       return view('VaiTro.ListVaiTro', compact('title'));
   }
   public function getVaiTro()
   {
        $VaiTro = vaitro::where('IsActive', 1)->get();
       return response()->json(['data' => $VaiTro]);
   }
   //Thêm Chứng chỉ
   public function addview()
   {
       $title = "Thêm Chứng chỉ";
    
       return view('VaiTro.AddVaiTro', compact('title'));
   }
   public function add(Request $request)
   {    
        $existingVaiTro = vaitro::where('TenVaiTro', $request->TenVaiTro)
        ->where('IsActive', true)
        ->count();

        if ($existingVaiTro > 0) {
        return response()->json(['success' => false, 'message' => 'Giá trị TenVaiTro đã tồn tại']);
        } else {
            $getVaiTro = vaitro::where('TenVaiTro', $request->TenVaiTro)
            ->where('IsActive', false)
            ->get();
            if (!$getVaiTro->isEmpty()) {
                $VaiTro = vaitro::find($getVaiTro->first()->id);
                $VaiTro->IsActive = true;
                $VaiTro->save();
                return response()->json(['success' => true]);
            }else{
                $VaiTro = new vaitro;
                $VaiTro->TenVaiTro = $request->TenVaiTro;
                $VaiTro->IsActive = true;
                $VaiTro->save();
                return response()->json(['success' => true]);
            }
    
        }
   }
   //Cập nhật Chứng chỉ
   public function updateview($id)
   {
       $VaiTro = vaitro::find($id);
       $title = "Cập Nhật Chứng chỉ";
       return view('VaiTro.UpdateVaiTro', compact('VaiTro', 'title'));
   }
   
   public function update(Request $request, $id)
   {
        $VaiTro = vaitro::where('id', '!=', $id)
        ->where('TenVaiTro', $request->TenVaiTro)
        ->where('IsActive', true)
        ->first();

        if ($VaiTro) {
            return response()->json(['success' => false, 'message' => 'Giá trị TenVaiTro đã tồn tại']);
        } else {
            $getVaiTro = vaitro::where('id', '!=', $id)
            ->where('TenVaiTro', $request->TenVaiTro)
            ->where('IsActive', false)
            ->get();
            if(!$getVaiTro->isEmpty()){
                $VaiTro = vaitro::find($getVaiTro->first()->id);
                $VaiTro->IsActive = true;
                $VaiTro->save();
                $VaiTroold = vaitro::find($id);
                $VaiTroold->IsActive = false;
                $VaiTroold->save();

                return response()->json(['success' => true]);
            }else{
                $VaiTro = vaitro::find($id);
                $VaiTro->TenVaiTro = $request->TenVaiTro;
                $VaiTro->save();
                return response()->json(['success' => true]);
            }
           
        }
   }
   //Xóa Chứng chỉ
   public function remove($id)
   {
       $VaiTro= vaitro::find($id);
       $VaiTro-> IsActive= false;
       $VaiTro->save();
       return response()->json(['success' => true]);

   }
}
