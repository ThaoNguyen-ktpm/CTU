<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\giaidoan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class GiaiDoanController extends Controller
{
   //Danh sách Giai Đoạn
   public function list()
   {
       $title = "Danh Sách Giai Đoạn";
       return view('GiaiDoan.ListGiaiDoan', compact('title'));
   }
   public function getGiaiDoan()
   {
        $GiaiDoan = giaidoan::where('IsActive', 1)->get();
       return response()->json(['data' => $GiaiDoan]);
   }
   //Thêm Giai Đoạn
   public function addview()
   {
       $title = "Thêm Giai Đoạn";
    
       return view('GiaiDoan.AddGiaiDoan', compact('title'));
   }
   public function add(Request $request)
   {    
        $existingGiaiDoan = giaidoan::where('TenGiaiDoan', $request->TenGiaiDoan)
        ->where('IsActive', true)
        ->count();

        if ($existingGiaiDoan > 0) {
        return response()->json(['success' => false, 'message' => 'Giá trị TenGiaiDoan đã tồn tại']);
        } else {
            $getGiaiDoan = giaidoan::where('TenGiaiDoan', $request->TenGiaiDoan)
            ->where('IsActive', false)
            ->get();
            if (!$getGiaiDoan->isEmpty()) {
                $GiaiDoan = giaidoan::find($getGiaiDoan->first()->id);
                $GiaiDoan->IsActive = true;
               
                $GiaiDoan->save();
                return response()->json(['success' => true]);
            }else{
                $GiaiDoan = new giaidoan;
                $GiaiDoan->TenGiaiDoan = $request->TenGiaiDoan;
                $GiaiDoan->IsActive = true;
               
                $GiaiDoan->save();
                return response()->json(['success' => true]);
            }
    
        }
   }
   //Cập nhật Giai Đoạn
   public function updateview($id)
   {
       $GiaiDoan = giaidoan::find($id);
       $title = "Cập Nhật Giai Đoạn";
       return view('GiaiDoan.UpdateGiaiDoan', compact('GiaiDoan', 'title'));
   }
   
   public function update(Request $request, $id)
   {
        $GiaiDoan = giaidoan::where('id', '!=', $id)
        ->where('TenGiaiDoan', $request->TenGiaiDoan)
        ->where('IsActive', true)
        ->first();

        if ($GiaiDoan) {
            return response()->json(['success' => false, 'message' => 'Giá trị TenGiaiDoan đã tồn tại']);
        } else {
            $getGiaiDoan = giaidoan::where('id', '!=', $id)
            ->where('TenGiaiDoan', $request->TenGiaiDoan)
            ->where('IsActive', false)
            ->get();
            if(!$getGiaiDoan->isEmpty()){
                $GiaiDoan = giaidoan::find($getGiaiDoan->first()->id);
                $GiaiDoan->IsActive = true;
              
                $GiaiDoan->save();

                $GiaiDoanold = giaidoan::find($id);
                $GiaiDoanold->IsActive = false;
              
                $GiaiDoanold->save();

                return response()->json(['success' => true]);
            }else{
                $GiaiDoan = giaidoan::find($id);
                $GiaiDoan->TenGiaiDoan = $request->TenGiaiDoan;
                $GiaiDoan->save();
                return response()->json(['success' => true]);
            }
           
        }
   }
   //Xóa Giai Đoạn
   public function remove($id)
   {
       $GiaiDoan= giaidoan::find($id);
       $GiaiDoan-> IsActive= false;
       $GiaiDoan->save();
       return response()->json(['success' => true]);

   }
}
