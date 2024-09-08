<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\loaiduan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class LoaiDuAnController extends Controller
{
   //Danh sách Loại Dự Án
   public function list()
   {
       $title = "Danh Sách Loại Dự Án";
       return view('LoaiDuAn.ListLoaiDuAn', compact('title'));
   }
   public function getLoaiDuAn()
   {
        $LoaiDuAn = loaiduan::where('IsActive', 1)->get();
       return response()->json(['data' => $LoaiDuAn]);
   }
   //Thêm Loại Dự Án
   public function addview()
   {
       $title = "Thêm Loại Dự Án";
    
       return view('LoaiDuAn.AddLoaiDuAn', compact('title'));
   }
   public function add(Request $request)
   {    
        $existingLoaiDuAn = loaiduan::where('TenLoaiDuAn', $request->TenLoaiDuAn)
        ->where('IsActive', true)
        ->count();

        if ($existingLoaiDuAn > 0) {
        return response()->json(['success' => false, 'message' => 'Giá trị TenLoaiDuAn đã tồn tại']);
        } else {
            $getLoaiDuAn = loaiduan::where('TenLoaiDuAn', $request->TenLoaiDuAn)
            ->where('IsActive', false)
            ->get();
            if (!$getLoaiDuAn->isEmpty()) {
                $LoaiDuAn = loaiduan::find($getLoaiDuAn->first()->id);
                $LoaiDuAn->IsActive = true;
               
                $LoaiDuAn->save();
                return response()->json(['success' => true]);
            }else{
                $LoaiDuAn = new loaiduan;
                $LoaiDuAn->TenLoaiDuAn = $request->TenLoaiDuAn;
                $LoaiDuAn->IsActive = true;
               
                $LoaiDuAn->save();
                return response()->json(['success' => true]);
            }
    
        }
   }
   //Cập nhật Loại Dự Án
   public function updateview($id)
   {
       $LoaiDuAn = loaiduan::find($id);
       $title = "Cập Nhật Loại Dự Án";
       return view('LoaiDuAn.UpdateLoaiDuAn', compact('LoaiDuAn', 'title'));
   }
   
   public function update(Request $request, $id)
   {
        $LoaiDuAn = loaiduan::where('id', '!=', $id)
        ->where('TenLoaiDuAn', $request->TenLoaiDuAn)
        ->where('IsActive', true)
        ->first();

        if ($LoaiDuAn) {
            return response()->json(['success' => false, 'message' => 'Giá trị TenLoaiDuAn đã tồn tại']);
        } else {
            $getLoaiDuAn = loaiduan::where('id', '!=', $id)
            ->where('TenLoaiDuAn', $request->TenLoaiDuAn)
            ->where('IsActive', false)
            ->get();
            if(!$getLoaiDuAn->isEmpty()){
                $LoaiDuAn = loaiduan::find($getLoaiDuAn->first()->id);
                $LoaiDuAn->IsActive = true;
              
                $LoaiDuAn->save();

                $LoaiDuAnold = loaiduan::find($id);
                $LoaiDuAnold->IsActive = false;
              
                $LoaiDuAnold->save();

                return response()->json(['success' => true]);
            }else{
                $LoaiDuAn = loaiduan::find($id);
                $LoaiDuAn->TenLoaiDuAn = $request->TenLoaiDuAn;
                $LoaiDuAn->save();
                return response()->json(['success' => true]);
            }
           
        }
   }
   //Xóa Loại Dự Án
   public function remove($id)
   {
       $LoaiDuAn= loaiduan::find($id);
       $LoaiDuAn-> IsActive= false;
       $LoaiDuAn->save();
       return response()->json(['success' => true]);

   }
}
