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

        // Lấy sessionUserId từ session
        $userId = Session::get('sessionUserId');
    
        // Sử dụng $userId trong truy vấn
        $NhanViec = DB::select('SELECT congviecs.* 
            FROM giaoviecs, congviecs 
            WHERE giaoviecs.MaNguoiDung = ? 
            AND giaoviecs.MaCongViec = congviecs.id 
            AND congviecs.TrangThai = 1', [$userId]);
    
        $DangThucHien = DB::select('SELECT congviecs.* 
            FROM giaoviecs, congviecs 
            WHERE giaoviecs.MaNguoiDung = ? 
            AND giaoviecs.MaCongViec = congviecs.id 
            AND congviecs.TrangThai = 2', [$userId]);
    
        return view('Index.TrangChu', compact('DangThucHien', 'NhanViec', 'title'));
    }
    public function ChiTietCongViec($id)
    {
        $title = "Chi Tiết";
       $CongViec = DB::select('SELECT congviecs.* , duans.TenDuAn FROM congviecs , duans WHERE congviecs.id = ? AND congviecs.MaDuAn = duans.id',[$id]);
        return view('Index.ChiTiet', compact( 'CongViec','title'));
    }
}
