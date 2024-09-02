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
             AND giaoviecs.TrangThai = 1', [$userId,$id]);
    
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
            AND capnhattiendos.MaGiaoViec = giaoviecs.id', [$userId,$id]);

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
            AND giaoviecs.TrangThai = 4', [$userId,$id]);

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
            AND giaoviecs.TrangThai = 1', [$userId]);
    
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
            AND giaoviecs.TrangThai = 2;
            ', [$userId]);

        $HoanThanh= DB::select('SELECT congviecs.*  ,capnhattiendos.ThoiGian ,duans.TenDuAn
            FROM giaoviecs, congviecs ,capnhattiendos  ,duans
            WHERE giaoviecs.MaNguoiDung = ?
            AND giaoviecs.MaCongViec = congviecs.id 
             AND duans.id = congviecs.MaDuAn 
            AND giaoviecs.TrangThai = 3
            AND capnhattiendos.MaGiaoViec = giaoviecs.id', [$userId]);

        $TreHen= DB::select('SELECT congviecs.*  ,duans.TenDuAn
            FROM giaoviecs, congviecs  ,duans
            WHERE giaoviecs.MaNguoiDung = ? 
             AND duans.id = congviecs.MaDuAn
            AND giaoviecs.MaCongViec = congviecs.id 
            AND giaoviecs.TrangThai = 4', [$userId]);
        $DuAn = DB::select('SELECT duans.id 
            FROM thanhviens , duans 
            WHERE duans.id = thanhviens.MaDuAn 
            AND thanhviens.MaNguoiDung = ?',[$userId]);
        $DuAnAll = duan::where('IsActive', 1)->get();
        return view('Index.TrangChu', compact('TreHen','HoanThanh','DangThucHien', 'NhanViec','DuAn', 'title','DuAnAll'));
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
        public function CapNhatTienDoView($id, $idcapnhattiendo )
        {
            $title = "Cập Nhật Tiến Độ";
        
            if ($idcapnhattiendo  ===  'null') {
                                        
                $CongViec = DB::select('SELECT congviecs.*, duans.TenDuAn 
                FROM congviecs 
                JOIN duans ON congviecs.MaDuAn = duans.id
                WHERE congviecs.id = ?', [$id]);
            } else {
                $CongViec = DB::select('SELECT congviecs.*, duans.TenDuAn, capnhattiendos.TienDo, capnhattiendos.ThoiGian, capnhattiendos.NoiDung, files.DuongDanFile ,capnhattiendos.id as idcapnhattiendo
                                    FROM congviecs 
                                    JOIN duans ON congviecs.MaDuAn = duans.id
                                    LEFT JOIN giaoviecs ON giaoviecs.MaCongViec = congviecs.id
                                    LEFT JOIN capnhattiendos ON capnhattiendos.MaGiaoViec = giaoviecs.id
                                    LEFT JOIN files ON files.MaCapNhatTienDo = capnhattiendos.id
                                    WHERE congviecs.id = ? AND capnhattiendos.id = ?;
                                    ', [$id, $idcapnhattiendo]);

            }
    
        return view('Index.CapNhatTienDo', compact('CongViec', 'title'));
    }


    public function NhanCongViec($id)
    {
        $userId = Session::get('sessionUserId');
        $CongViecid = DB::select('SELECT giaoviecs.id FROM giaoviecs WHERE MaCongViec = ? AND MaNguoiDung= ?', [$id, $userId]);
        
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
        $CongViecid = DB::select('SELECT giaoviecs.id FROM giaoviecs WHERE MaCongViec = ? AND MaNguoiDung= ?', [$id, $userId]);
    
        try {
            $validatedData = $request->validate([
                'file_nop.*' => 'required|mimes:pdf,doc,docx,xlsx,xls,zip', // Chỉ chấp nhận các loại file nhất định với dung lượng tối đa 2MB
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Tệp không hợp lệ: ' . implode(', ', $e->errors())]);
        }


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
                $originalFileName = $file->getClientOriginalName();
                $fileName = time() . '_' . $originalFileName;
                $file->move(public_path('uploads'), $fileName);
    
                $fileRecords[] = [
                    'MaCapNhatTienDo' => $capnhattiendo->id,
                    'DuongDanFile' => 'uploads/' . $fileName,
                    'IsActive' => true,
                  
                ];
            }
    
            // Batch insert file records to reduce database queries
            DB::table('files')->insert($fileRecords);
    
            $soLuongHoanThanh = giaoviec::where('MaCongViec', $id)
                                        ->where('TrangThai', '!=', 3)
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
              $fileRecords = [];
      
              foreach ($files as $file) {
                  $originalFileName = $file->getClientOriginalName();
                  $fileName = time() . '_' . $originalFileName;
                  $file->move(public_path('uploads'), $fileName);
      
                  $fileRecords[] = [
                      'MaCapNhatTienDo' => $idcapnhattiendo,
                      'DuongDanFile' => 'uploads/' . $fileName,
                      'IsActive' => true,
                    
                  ];
              }
      
              // Batch insert file records to reduce database queries
              DB::table('files')->insert($fileRecords);
      
              $soLuongHoanThanh = giaoviec::where('MaCongViec', $id)
                                          ->where('TrangThai', '!=', 3)
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
