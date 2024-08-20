<?php

namespace App\Http\Controllers;
use App\Models\congviec;
use App\Models\giaoviec;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $title = "Trang Chủ";
        $NhanViec = DB::select('SELECT congviecs.* 
        FROM giaoviecs,congviecs 
        WHERE giaoviecs.MaNguoiDung = 5 
        AND giaoviecs.MaCongViec = congviecs.id 
        AND congviecs.TrangThai = 1');
         $DangThucHien = DB::select('SELECT congviecs.* 
         FROM giaoviecs,congviecs 
         WHERE giaoviecs.MaNguoiDung = 5 
         AND giaoviecs.MaCongViec = congviecs.id 
         AND congviecs.TrangThai = 2');
        return view('Index.TrangChu', compact('DangThucHien','NhanViec','title'));
    }
    public function NhanCongViec($id)
    {
        $NhanCongViec = congviec::find($id);
        $NhanCongViec -> TrangThai = 2 ;
        $NhanCongViec->save();
        return response()->json(['success' => true, 'message' => 'Công việc đã được nhận thành công!']);
    }
}
