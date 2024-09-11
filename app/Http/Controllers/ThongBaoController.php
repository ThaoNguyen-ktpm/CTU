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
   
     //Danh sách Công Việc
   public function listTreHen()
   {
       $title = "Danh Sách Công Việc Trễ Hẹn";
       return view('TreHen.ListTreHen', compact('title'));
   }
   public function getTreHen()
   {
        $CongViec = DB::select('SELECT congviecs.* ,duans.TenDuAn , duans.TenMa, giaidoans.TenGiaiDoan 
        FROM congviecs , duans, thuchiens, giaidoans 
        WHERE congviecs.MaDuAn = duans.id 
        AND congviecs.MaThucHien = thuchiens.id 
        AND thuchiens.MaGiaiDoan = giaidoans.id
        AND congviecs.TrangThai = 4
        AND congviecs.IsActive = true
        AND duans.IsActive = true
        AND thuchiens.IsActive = true
        AND giaidoans.IsActive = true');
       return response()->json(['data' => $CongViec]);
   }


   //Danh sách THông Báo
   public function list()
   {
       $title = "Danh Sách Thông Báo";
       return view('ThongBao.ListThongBao', compact('title'));
   }
   public function getThongBao()
   {
        $ThongBao = DB::select('SELECT thongbaos.* , nguoidungs.UserName AS Name
                                FROM thongbaos ,nguoidungs
                                WHERE thongbaos.MaNguoiDung = nguoidungs.id
                                AND thongbaos.IsActive = true
                                AND nguoidungs.IsActive = true
                                ');
       return response()->json(['data' => $ThongBao]);
   }
   //Thêm THông Báo
   public function addview()
   {
       $title = "Thêm Thông Báo";
       $NguoiDung = nguoidung::where('IsActive', 1) ->whereIn('Quyen', [4, 2, 3])->get();
       return view('ThongBao.AddThongBao', compact('NguoiDung','title'));
   }
   public function add(Request $request)
   {    
    $NoiDung = $request->input('NoiDung');
    $MaNguoiDung = $request->input('MaNguoiDung');
    $SendEmail = $request->input('SendEmail'); // Get the value of the checkbox

    // Lấy email của người dùng
    $Email = DB::table('nguoidungs')
        ->where('id', $MaNguoiDung)
        ->where('IsActive', true)
        ->value('Email'); // Trả về giá trị email trực tiếp

    if ($Email) {
        // Lưu thông báo vào bảng thongbaos
        DB::table('thongbaos')->insert([
            'NoiDung' => $NoiDung,
            'MaNguoiDung' => $MaNguoiDung,
            'IsActive' => true,
            'IsSee' => false,
            'ThoiGian' => now(),
        ]);

        // Gửi email nếu cần thiết
        if ($SendEmail) {
            Mail::send('Email.ThongBaoemail', [
                'OTP' => $NoiDung,
                'Email' => $Email // Truyền biến Email vào view
            ], function ($message) use ($Email) {
                $message->to($Email);
                $message->subject('Thông Báo');
            });
        }

        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false, 'message' => 'No active user found with the provided ID']);
    }
    
    
   }
  
   public function destroy($id)
   {
       // Tìm thông báo theo ID và xóa nó
       $thongbao = Thongbao::find($id);
       if ($thongbao) {
           $thongbao->IsSee = true;
           $thongbao->save();
           $userId = Session::get('sessionUserId');
           $ThongBao =DB::select('SELECT * FROM thongbaos WHERE thongbaos.MaNguoiDung = ? AND  IsSee = false AND  IsActive = true',[$userId]);
           Session::put('ThongBao', $ThongBao);
           return response()->json(['success' => true]);
       }

       return response()->json(['success' => false, 'message' => 'Thông báo không tồn tại'], 404);
   }
}
