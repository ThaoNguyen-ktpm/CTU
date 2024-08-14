<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\thongbao;
use App\Models\nguoidung;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class ThongBaoController extends Controller
{
   //Danh sách THông Báo
   public function list()
   {
       $title = "Danh Sách THông Báo";
       return view('ThongBao.ListThongBao', compact('title'));
   }
   public function getThongBao()
   {
        $ThongBao = ThongBao::where('IsActive', 1)->get();
       return response()->json(['data' => $ThongBao]);
   }
   //Thêm THông Báo
   public function addview()
   {
       $title = "Thêm THông Báo";
       $NguoiDung = nguoidung::where('IsActive', 1) ->whereIn('Quyen', [4, 2, 3])->get();
       return view('ThongBao.AddThongBao', compact('NguoiDung','title'));
   }
   public function add(Request $request)
   {    
            $NoiDung = $request->input('NoiDung');
            $MaNguoiDung = $request->input('MaNguoiDung');

            $Email = DB::select('SELECT nguoidungs.Email
            FROM  nguoidungs
            WHERE nguoidungs.id = ?
            and nguoidungs.IsActive = true',[$MaNguoiDung]);
            Mail::send('Email.OTPemail', ['OTP' => $NoiDung,'Email'=>$Email], function ($email) use ($Email, $NoiDung) {
                $email->to($Email);
                $email->subject('Your OTP Code');
            });  
            $ThongBao = new thongbao;
            $ThongBao->NoiDung = $NoiDung;
            $ThongBao->MaNguoiDung =  $MaNguoiDung; // Nếu bảng ThongBao có cột này
            $ThongBao->IsActive = true; // Nếu bảng ThongBao có cột này
            $ThongBao->ThoiGian = DB::raw('NOW()'); // Nếu bảng ThongBao có cột này
            $ThongBao->save();
            return response()->json(['success' => true]);
   }
  
}
