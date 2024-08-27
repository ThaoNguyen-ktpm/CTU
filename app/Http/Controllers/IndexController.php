<?php

namespace App\Http\Controllers;
use App\Models\congviec;
use App\Models\capnhattiendo;
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
            AND giaoviecs.TrangThai = 1', [$userId]);
    
        $DangThucHien = DB::select('SELECT congviecs.* 
            FROM giaoviecs, congviecs 
            WHERE giaoviecs.MaNguoiDung = ? 
            AND giaoviecs.MaCongViec = congviecs.id 
            AND giaoviecs.TrangThai = 2', [$userId]);

        $HoanThanh= DB::select('SELECT congviecs.* ,capnhattiendos.TenNguoiNop, capnhattiendos.DuongDanFile ,capnhattiendos.ThoiGian
            FROM giaoviecs, congviecs ,capnhattiendos
            WHERE giaoviecs.MaNguoiDung = ?
            AND giaoviecs.MaCongViec = congviecs.id 
            AND giaoviecs.TrangThai = 3
            AND capnhattiendos.MaGiaoViec = giaoviecs.id', [$userId]);

        $TreHen= DB::select('SELECT congviecs.* 
            FROM giaoviecs, congviecs 
            WHERE giaoviecs.MaNguoiDung = ? 
            AND giaoviecs.MaCongViec = congviecs.id 
            AND giaoviecs.TrangThai = 4', [$userId]);
    
        return view('Index.TrangChu', compact('TreHen','HoanThanh','DangThucHien', 'NhanViec', 'title'));
    }
    public function ChiTietCongViec($id)
    {
        $title = "Chi Tiết Công Việc";
       $CongViec = DB::select('SELECT congviecs.* , duans.TenDuAn FROM congviecs , duans WHERE congviecs.id = ? AND congviecs.MaDuAn = duans.id',[$id]);
        return view('Index.ChiTiet', compact( 'CongViec','title'));
    }
    public function ChiTietHoanThanh($id)
    {

         // Lấy sessionUserId từ session
         $userId = Session::get('sessionUserId');
        $title = "Chi Tiết Công Việc";
       $CongViec = DB::select('SELECT congviecs.* , duans.TenDuAn,capnhattiendos.* 
       FROM congviecs , duans , capnhattiendos , giaoviecs 
       WHERE congviecs.id = ? 
       AND congviecs.MaDuAn = duans.id 
       AND congviecs.id = giaoviecs.MaCongViec 
       AND giaoviecs.TrangThai = 3   
       AND giaoviecs.MaNguoiDung = ?
       AND giaoviecs.id = capnhattiendos.MaGiaoViec',[$id,$userId]);
        return view('Index.ChiTietHoanThanh', compact( 'CongViec','title'));
    }
    public function CapNhatTienDoView($id)
    {
        $title = "Cập Nhật Tiến Độ";
       $CongViec = DB::select('SELECT congviecs.* , duans.TenDuAn FROM congviecs , duans WHERE congviecs.id = ? AND congviecs.MaDuAn = duans.id',[$id]);
        return view('Index.CapNhatTienDo', compact( 'CongViec','title'));
    }


    public function NhanCongViec($id)
    {
        $userId = Session::get('sessionUserId');
        $CongViecid = DB::select('SELECT giaoviecs.id FROM giaoviecs WHERE MaCongViec = ? AND MaNguoiDung= ?', [$id, $userId]);
        
        // Kiểm tra xem kết quả có tồn tại hay không
        if (!empty($CongViecid)) {
            // Lấy giá trị id từ đối tượng stdClass đầu tiên trong mảng
            $CongViecid = $CongViecid[0]->id;
        
            // Tìm kiếm đối tượng GiaoViec
            $GiaoViec = giaoviec::find($CongViecid);
        
            if ($GiaoViec) {
                // Cập nhật trạng thái và lưu lại
                $GiaoViec->TrangThai = 2;
                $GiaoViec->save();
        
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'GiaoViec not found']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'No record found']);
        }  
    }
    public function NopBaoCao(Request $request, $id)
    {
        $userId = Session::get('sessionUserId');
        $CongViecid = DB::select('SELECT giaoviecs.id FROM giaoviecs WHERE MaCongViec = ? AND MaNguoiDung= ?', [$id, $userId]);
        
        // Kiểm tra xem kết quả có tồn tại hay không
        if (!empty($CongViecid)) {
            // Lấy giá trị id từ đối tượng stdClass đầu tiên trong mảng
           
            // Tìm kiếm đối tượng GiaoViec
            $GiaoViec = giaoviec::find($CongViecid[0]->id);
            $GiaoViec->TrangThai = 3;
            $GiaoViec->save();
        
        
            $file = $request->file('file_nop');
          
            // Lấy tên file gốc
            $originalFileName = $file->getClientOriginalName();
            
            // Tạo tên file duy nhất để tránh bị trùng lặp
            $fileName = time() . '_' . $originalFileName;
            
            // Lưu file vào thư mục 'uploads'
            $file->move(public_path('uploads'), $fileName);
    
            // Lưu thông tin báo cáo vào bảng capnhattiendo

            $capnhattiendo = new capnhattiendo();
            $capnhattiendo ->TenNguoiNop = $request->input('TenNguoiNop');
            $capnhattiendo ->DuongDanFile= 'uploads/' . $fileName;
            $capnhattiendo ->NoiDung = $request->input('NoiDung');
            $capnhattiendo ->MaGiaoViec =  $CongViecid[0]->id;
            $capnhattiendo ->ThoiGian = now();
            $capnhattiendo ->IsActive = true;  
            $capnhattiendo->save();
        
            // Kiểm tra nếu tất cả các giao việc cho cùng công việc đã hoàn thành
            
            $soLuongHoanThanh = giaoviec::where('MaCongViec', $id)
                                        ->where('TrangThai', '!=', 3)
                                        ->count();

            if ($soLuongHoanThanh == 0) {
                // Nếu tất cả đều hoàn thành, cập nhật trạng thái công việc
                $congViec = CongViec::find($id);
                $congViec->TrangThai = 3;
                $congViec->save();
            }
                            
                return response()->json(['success' => true]);
           
        } else {
            return response()->json(['success' => false, 'message' => 'No record found']);
        }

    }
}
