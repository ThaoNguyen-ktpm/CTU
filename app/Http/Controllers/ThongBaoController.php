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
       $title = "Danh Sách Thông Báo";
       return view('ThongBao.ListThongBao', compact('title'));
   }
   public function getThongBao()
   {
        $ThongBao = DB::select('SELECT thongbaos.* , nguoidungs.UserName AS Name
                                FROM thongbaos ,nguoidungs
                                WHERE thongbaos.MaNguoiDung = nguoidungs.id
                                AND thongbaos.IsActive = true
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
           $ThongBao =DB::select('SELECT * FROM thongbaos WHERE thongbaos.MaNguoiDung = ? AND  IsSee = false',[$userId]);
           Session::put('ThongBao', $ThongBao);
           return response()->json(['success' => true]);
       }

       return response()->json(['success' => false, 'message' => 'Thông báo không tồn tại'], 404);
   }
}
