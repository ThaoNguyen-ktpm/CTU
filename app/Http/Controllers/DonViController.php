<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\donvi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class DonViController extends Controller
{
   //Danh sách Đơn Vị
   public function list()
   {
       $title = "Danh Sách Đơn Vị";
       return view('DonVi.ListDonVi', compact('title'));
   }
   public function getDonVi()
   {
        $DonVi = donvi::where('IsActive', 1)->get();
       return response()->json(['data' => $DonVi]);
   }
   //Thêm Đơn Vị
   public function addview()
   {
       $title = "Thêm Đơn Vị";
       return view('DonVi.AddDonVi', compact('title'));
   }
   public function add(Request $request)
   {    
        $existingDonVi = donvi::where('TenDonVi', $request->TenDonVi)
        ->where('IsActive', true)
        ->count();

        if ($existingDonVi > 0) {
        return response()->json(['success' => false, 'message' => 'Giá trị TenDonVi đã tồn tại']);
        } else {
            $getDonVi = donvi::where('TenDonVi', $request->TenDonVi)
            ->where('IsActive', false)
            ->get();
            if (!$getDonVi->isEmpty()) {
                $DonVi = donvi::find($getDonVi->first()->id);
                $DonVi->IsActive = true;
               
                $DonVi->save();
                return response()->json(['success' => true]);
            }else{
                $DonVi = new donvi;
                $DonVi->TenDonVi = $request->TenDonVi;
                $DonVi->IsActive = true;
               
                $DonVi->save();
                return response()->json(['success' => true]);
            }
    
        }
   }
   //Cập nhật Đơn Vị
   public function updateview($id)
   {
       $DonVi = donvi::find($id);
       $title = "Cập Nhật Đơn Vị";
       return view('DonVi.UpdateDonVi', compact('DonVi', 'title'));
   }
   
   public function update(Request $request, $id)
   {
        $DonVi = donvi::where('id', '!=', $id)
        ->where('TenDonVi', $request->TenDonVi)
        ->where('IsActive', true)
        ->first();

        if ($DonVi) {
            return response()->json(['success' => false, 'message' => 'Giá trị TenDonVi đã tồn tại']);
        } else {
            $getDonVi = donvi::where('id', '!=', $id)
            ->where('TenDonVi', $request->TenDonVi)
            ->where('IsActive', false)
            ->get();
            if(!$getDonVi->isEmpty()){
                $DonVi = donvi::find($getDonVi->first()->id);
                $DonVi->IsActive = true;
              
                $DonVi->save();

                $DonViold = donvi::find($id);
                $DonViold->IsActive = false;
              
                $DonViold->save();

                return response()->json(['success' => true]);
            }else{
                $DonVi = donvi::find($id);
                $DonVi->TenDonVi = $request->TenDonVi;
                $DonVi->save();
                return response()->json(['success' => true]);
            }
           
        }
   }
   //Xóa Đơn Vị
   public function remove($id)
   {
       $DonVi= donvi::find($id);
       $DonVi-> IsActive= false;
       $DonVi->save();
       return response()->json(['success' => true]);

   }
}
