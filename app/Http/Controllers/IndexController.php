<?php

namespace App\Http\Controllers;
use App\Models\congviec;
use App\Models\capnhattiendo;
use App\Models\duan;
use App\Models\file;
use App\Models\giaoviec;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class IndexController extends Controller
{



    public function NhanCongViecDuAn($id)
    {
         // Lấy sessionUserId từ session
         $userId = Session::get('sessionUserId');
    
         // Sử dụng $userId trong truy vấn
         $NhanViec = DB::select('SELECT congviecs.* ,duans.TenDuAn
            FROM giaoviecs, congviecs ,duans
            WHERE giaoviecs.MaNguoiDung = ? 
            AND congviecs.MaDuAn = ?
            AND duans.id = congviecs.MaDuAn 
            AND giaoviecs.MaCongViec = congviecs.id 
            AND giaoviecs.TrangThai = 1
            AND congviecs.IsActive = true
            AND duans.IsActive = true
            AND giaoviecs.IsActive = true
          ', [$userId,$id]);
    
        return response()->json($NhanViec);
    }

    public function DangThucHienDuAn($id)
    {
         // Lấy sessionUserId từ session
         $userId = Session::get('sessionUserId');
    
         // Sử dụng $userId trong truy vấn
         $DangThucHien = DB::select('SELECT 
                congviecs.*, 
                capnhattiendos.ThoiGian, 
                duans.TenDuAn, 
                capnhattiendos.id AS idcapnhattiendo, 
                capnhattiendos.TienDo
            FROM 
                giaoviecs
            JOIN 
                congviecs ON giaoviecs.MaCongViec = congviecs.id 
            JOIN 
                duans ON duans.id = congviecs.MaDuAn 
            LEFT JOIN 
                capnhattiendos ON capnhattiendos.MaGiaoViec = giaoviecs.id
            WHERE 
                giaoviecs.MaNguoiDung = ? 
                AND congviecs.MaDuAn = ?
                AND giaoviecs.TrangThai = 2
                AND duans.IsActive = true
                AND giaoviecs.IsActive = true   
            ', [$userId,$id]);
    
        return response()->json($DangThucHien);
    }
    public function HoanThanhDuAn($id)
    {
         // Lấy sessionUserId từ session
         $userId = Session::get('sessionUserId');
    
         // Sử dụng $userId trong truy vấn
         $HoanThanh= DB::select('SELECT congviecs.*  ,capnhattiendos.ThoiGian ,duans.TenDuAn
            FROM giaoviecs, congviecs ,capnhattiendos ,duans
            WHERE giaoviecs.MaNguoiDung = ?
            AND giaoviecs.MaCongViec = congviecs.id 
            AND giaoviecs.TrangThai = 3
            AND duans.id = congviecs.MaDuAn 
            AND congviecs.MaDuAn = ?
            AND capnhattiendos.MaGiaoViec = giaoviecs.id
            AND duans.IsActive = true
            AND giaoviecs.IsActive = true', [$userId,$id]);

        return response()->json($HoanThanh);
    }
    public function TreHenDuAn($id)
    {
         // Lấy sessionUserId từ session
         $userId = Session::get('sessionUserId');
    
         // Sử dụng $userId trong truy vấn
         $TreHen= DB::select('SELECT congviecs.* ,duans.TenDuAn
            FROM giaoviecs, congviecs ,duans
            WHERE giaoviecs.MaNguoiDung = ? 
            AND congviecs.MaDuAn =  ? 
            AND duans.id = congviecs.MaDuAn 
            AND giaoviecs.MaCongViec = congviecs.id 
            AND giaoviecs.TrangThai = 4
            AND duans.IsActive = true
            AND giaoviecs.IsActive = true', [$userId,$id]);

        return response()->json($TreHen);
    }

    public function index()
    {
        $title = "Trang Chủ";

        // Lấy sessionUserId từ session
        $userId = Session::get('sessionUserId');
    
        // Sử dụng $userId trong truy vấn
        $NhanViec = DB::select('SELECT congviecs.* ,duans.TenDuAn
            FROM giaoviecs, congviecs ,duans
            WHERE giaoviecs.MaNguoiDung = ? 
            AND giaoviecs.MaCongViec = congviecs.id 
            AND duans.id = congviecs.MaDuAn 
            AND giaoviecs.TrangThai = 1
            AND duans.IsActive = true
            AND giaoviecs.IsActive = true', [$userId]);
    
        $DangThucHien = DB::select('SELECT congviecs.*, 
                capnhattiendos.ThoiGian, 
                duans.TenDuAn, 
                capnhattiendos.id AS idcapnhattiendo, 
                capnhattiendos.TienDo
            FROM giaoviecs
            JOIN congviecs ON giaoviecs.MaCongViec = congviecs.id 
            JOIN duans ON duans.id = congviecs.MaDuAn 
            LEFT JOIN capnhattiendos ON capnhattiendos.MaGiaoViec = giaoviecs.id
            WHERE giaoviecs.MaNguoiDung = ?
            AND giaoviecs.TrangThai = 2
            AND duans.IsActive = true
            AND giaoviecs.IsActive = true;
            ', [$userId]);

        $HoanThanh= DB::select('SELECT congviecs.*  ,capnhattiendos.ThoiGian ,duans.TenDuAn
            FROM giaoviecs, congviecs ,capnhattiendos  ,duans
            WHERE giaoviecs.MaNguoiDung = ?
            AND giaoviecs.MaCongViec = congviecs.id 
             AND duans.id = congviecs.MaDuAn 
            AND giaoviecs.TrangThai = 3
            AND capnhattiendos.MaGiaoViec = giaoviecs.id
            AND duans.IsActive = true
            AND giaoviecs.IsActive = true', [$userId]);

        $TreHen= DB::select('SELECT congviecs.*  ,duans.TenDuAn
            FROM giaoviecs, congviecs  ,duans
            WHERE giaoviecs.MaNguoiDung = ? 
             AND duans.id = congviecs.MaDuAn
            AND giaoviecs.MaCongViec = congviecs.id 
            AND giaoviecs.TrangThai = 4
            AND duans.IsActive = true
            AND giaoviecs.IsActive = true', [$userId]);
        $DuAn = DB::select('SELECT DISTINCT duans.id
            FROM congviecs
            JOIN giaoviecs ON giaoviecs.MaCongViec = congviecs.id
            JOIN duans ON duans.id = congviecs.MaDuAn
            WHERE giaoviecs.MaNguoiDung = ?
            AND duans.IsActive = true
            AND giaoviecs.IsActive = true',[$userId]);
        $DuAnAll = duan::where('IsActive', 1)->get();
        return view('Index.TrangChu', compact('TreHen','HoanThanh','DangThucHien', 'NhanViec','DuAn', 'title','DuAnAll'));
    }
    public function ChiTietCongViec($id)
    {
        $title = "Chi Tiết Công Việc";
       $CongViec = DB::select('SELECT congviecs.* , duans.TenDuAn 
            FROM congviecs , duans 
            WHERE congviecs.id = ? 
            AND congviecs.MaDuAn = duans.id
            AND duans.IsActive = true',[$id]);
        return view('Index.ChiTiet', compact( 'CongViec','title'));
    }
    public function ChiTietHoanThanh($id)
    {

         // Lấy sessionUserId từ session
         $userId = Session::get('sessionUserId');
        $title = "Chi Tiết Công Việc";
       $CongViec = DB::select('SELECT congviecs.* , duans.TenDuAn,capnhattiendos.* ,files.*
       FROM congviecs , duans , capnhattiendos , giaoviecs ,files
       WHERE congviecs.id = ?
       AND congviecs.MaDuAn = duans.id 
       AND congviecs.id = giaoviecs.MaCongViec 
       AND capnhattiendos.id = files.MaCapNhatTienDo 
       AND giaoviecs.TrangThai = 3   
       AND giaoviecs.MaNguoiDung = ?
       AND giaoviecs.id = capnhattiendos.MaGiaoViec
        AND duans.IsActive = true
        AND giaoviecs.IsActive = true',[$id,$userId]);
        return view('Index.ChiTietHoanThanh', compact( 'CongViec','title'));
    }
        public function CapNhatTienDoView($id, $idcapnhattiendo )
        {
            $title = "Cập Nhật Tiến Độ";
        
            if ($idcapnhattiendo  ===  'null') {
                                        
                $CongViec = DB::select('SELECT congviecs.*, duans.TenDuAn 
                FROM congviecs 
                JOIN duans ON congviecs.MaDuAn = duans.id
                WHERE congviecs.id = ?
                AND duans.IsActive = true
                AND congviecs.IsActive = true', [$id]);
            } else {
                $CongViec = DB::select('SELECT congviecs.*, duans.TenDuAn, capnhattiendos.TienDo, capnhattiendos.ThoiGian, capnhattiendos.NoiDung, files.DuongDanFile , files.TenFile ,capnhattiendos.id as idcapnhattiendo
                FROM congviecs 
                JOIN duans ON congviecs.MaDuAn = duans.id
                LEFT JOIN giaoviecs ON giaoviecs.MaCongViec = congviecs.id
                LEFT JOIN capnhattiendos ON capnhattiendos.MaGiaoViec = giaoviecs.id
                LEFT JOIN files ON files.MaCapNhatTienDo = capnhattiendos.id
                WHERE congviecs.id = ? 
                AND capnhattiendos.id = ?
                AND duans.IsActive = true
                AND giaoviecs.IsActive = true;
                ', [$id, $idcapnhattiendo]);

            }
    
        return view('Index.CapNhatTienDo', compact('CongViec', 'title'));
    }


    public function NhanCongViec($id)
    {
        $userId = Session::get('sessionUserId');
        $CongViecid = DB::select('SELECT giaoviecs.id 
        FROM giaoviecs 
        WHERE MaCongViec = ? 
        AND MaNguoiDung= ?
        AND giaoviecs.IsActive = true'
        , [$id, $userId]);
        
        // Kiểm tra xem kết quả có tồn tại hay không
        if (!empty($CongViecid)) {
            // Lấy giá trị id từ đối tượng stdClass đầu tiên trong mảngs
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
    public function NopBaoCao(Request $request, $id, $idcapnhattiendo)
    {
        $userId = Session::get('sessionUserId');
        $CongViecid = DB::select('SELECT giaoviecs.id FROM giaoviecs WHERE MaCongViec = ? AND MaNguoiDung= ? AND giaoviecs.IsActive = true', [$id, $userId]);
       
        if ( $idcapnhattiendo  ===  'null') {
           // Tạo bản ghi cập nhật tiến độ
            $capnhattiendo = new capnhattiendo();
            $capnhattiendo->NoiDung = $request->input('NoiDung');
            $capnhattiendo->MaGiaoViec = $CongViecid[0]->id;
            $capnhattiendo->ThoiGian = now();
            $capnhattiendo->TienDo = $request->input('TienDo');
            $capnhattiendo->IsActive = true;
            $capnhattiendo->save();

            // Kiểm tra giá trị tiến độ và cập nhật trạng thái công việc
            if ($capnhattiendo->TienDo == 100) {
                $GiaoViec = giaoviec::find($CongViecid[0]->id);
                if ($GiaoViec) {
                    $GiaoViec->TrangThai = 3;
                    $GiaoViec->save();
                }
            }

            $files = $request->file('file_nop');
            $fileRecords = [];

            foreach ($files as $file) {
                // Lấy tên file gốc
                $originalFileName = $file->getClientOriginalName();

                // Tạo tên file mới dựa trên thời gian
                $fileName = time() . '_' . $originalFileName;

                // Di chuyển file vào thư mục uploads
                $file->move(public_path('uploads'), $fileName);

                // Tạo mảng chứa các bản ghi để lưu vào cơ sở dữ liệu
                $fileRecords[] = [
                    'MaCapNhatTienDo' => $capnhattiendo->id,
                    'DuongDanFile' => 'uploads/' . $fileName,
                    'IsActive' => true,
                    'ThoiGianNop' => now(), // Lưu thời gian nộp hiện tại
                    'TenFile' => $originalFileName, // Lưu tên file gốc
                ];
            }

            // Thực hiện batch insert để giảm số lượng query
            DB::table('files')->insert($fileRecords);

    
            $soLuongHoanThanh = giaoviec::where('MaCongViec', $id)
                                        ->where('TrangThai', '!=', 3)
                                        ->where('IsActive', true)
                                        ->count();
    
            if ($soLuongHoanThanh == 0) {
                $congViec = congviec::find($id);
                $congViec->TrangThai = 3;
                $congViec->save();
            }
    
            return response()->json(['success' => true]);
        } else {
              // Tạo bản ghi cập nhật tiến độ
              $capnhattiendo = capnhattiendo::find($idcapnhattiendo);
              $capnhattiendo->NoiDung = $request->input('NoiDung');
              $capnhattiendo->MaGiaoViec = $CongViecid[0]->id;
              $capnhattiendo->ThoiGian = now();
              $capnhattiendo->TienDo = $request->input('TienDo');
              $capnhattiendo->IsActive = true;
              $capnhattiendo->save();
  
              // Kiểm tra giá trị tiến độ và cập nhật trạng thái công việc
              if ($capnhattiendo->TienDo == 100) {
                  $GiaoViec = giaoviec::find($CongViecid[0]->id);
                  if ($GiaoViec) {
                      $GiaoViec->TrangThai = 3;
                      $GiaoViec->save();
                  }
              }
              $files = $request->file('file_nop');
              if ($files && is_array($files)) {
                  $fileRecords = [];
              
                  foreach ($files as $file) {
                      if ($file) {
                          // Lấy tên file gốc
                          $originalFileName = $file->getClientOriginalName();
              
                          // Tạo tên file mới dựa trên thời gian
                          $fileName = time() . '_' . $originalFileName;
              
                          // Di chuyển file vào thư mục uploads
                          $file->move(public_path('uploads'), $fileName);
              
                          // Tạo mảng chứa các bản ghi để lưu vào cơ sở dữ liệu
                          $fileRecords[] = [
                              'MaCapNhatTienDo' => $capnhattiendo->id,
                              'DuongDanFile' => 'uploads/' . $fileName,
                              'IsActive' => true,
                              'ThoiGianNop' => now(), // Lưu thời gian nộp hiện tại
                              'TenFile' => $originalFileName, // Lưu tên file gốc
                          ];
                      }
                  }
              
                  // Thực hiện batch insert để giảm số lượng query
                  DB::table('files')->insert($fileRecords);
              }
              
      
              $soLuongHoanThanh = giaoviec::where('MaCongViec', $id)
                                          ->where('TrangThai', '!=', 3)
                                        ->where('IsActive', true)
                                          ->count();
      
              if ($soLuongHoanThanh == 0) {
                  $congViec = CongViec::find($id);
                  $congViec->TrangThai = 3;
                  $congViec->save();
              }
            return response()->json(['success' => true]);
        }
        

    }


   
}
