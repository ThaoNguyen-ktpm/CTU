<?php

namespace App\Http\Controllers;
use App\Models\duan;
use App\Models\donvi;
use App\Models\giaidoan;
use App\Models\loaiduan;
use App\Models\vaitro;
use App\Models\nguoidung;
use App\Models\thanhvien;
use App\Models\thuchien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;


use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PHPExcel_Style_NumberFormat;
use DateTime;

use function Laravel\Prompts\select;

class DuAnController extends Controller
{

     //Danh sách Dự Án
     public function SoDoCongViec($id)
     {
         $title = "Sơ Đồ Công Việc";
         $SoDo = DB::select('SELECT thuchiens.* 
         FROM thuchiens 
         WHERE thuchiens.IsActive 
         AND thuchiens.MaDuAn= ? ',[$id]);
         return view('TienDoCongViec.SoDoCongViec', compact('title','SoDo'));
     }
     //Danh sách Dự Án
     public function SoDoCongViecData($id)
     {
      
         $SoDo = DB::select('SELECT 
                            congviecs.*, 
                            giaidoans.TenGiaiDoan,
                            thuchiens.NgayBatDau AS GiaiDoanDau,
                            thuchiens.NgayKetThuc AS GiaiDoanCuoi,
                            duans.NgayBatDau AS NgayBatDauDuAn,
                            duans.NgayKetThuc AS NgayKetThucDuAn
                        FROM 
                            giaidoans,
                            thuchiens, 
                            congviecs,
                            duans
                        WHERE 
                            congviecs.MaDuAn = ?
                            AND congviecs.MaThucHien = thuchiens.id  
                            AND congviecs.MaDuAn = duans.id  
                            AND thuchiens.MaGiaiDoan = giaidoans.id
                            AND congviecs.IsActive = true
                            AND duans.IsActive = true
                            AND thuchiens.IsActive = true
                            AND giaidoans.IsActive = true
                        ORDER BY 
                            thuchiens.ThuGiaiDoan ASC;
                        ',[$id]);
         return response()->json(['data' => $SoDo]);
     }
   public function listTienDoCongViec()
   {
       $title = "Danh Sách Dự Án";
       return view('TienDoCongViec.ListTienDoCongViec', compact('title'));
   }
   public function getTienDoCongViec()
   {
        $DuAn = duan::where('IsActive', 1)->get();
       return response()->json(['data' => $DuAn]);
   }
   public function listCongViecThanhVien(Request $request)
   {
       $title = "Danh Sách Công Việc Dự Án";
       $id = $request->input('id');
       return view('TienDoCongViec.ListCongViecThanhVien', compact('id','title'));
   }
   public function getCongViecThanhVien(Request $request)
    {
         $id = $request->input('id');
        
         $DuAn = DB::select('SELECT nguoidungs.*, capnhattiendos.TienDo ,capnhattiendos.id as idcapnhattiendo
        FROM giaoviecs
        JOIN nguoidungs ON giaoviecs.MaNguoiDung = nguoidungs.id
        LEFT JOIN capnhattiendos ON capnhattiendos.MaGiaoViec = giaoviecs.id
        WHERE giaoviecs.MaCongViec = ? 
        AND giaoviecs.IsActive = true 
        AND nguoidungs.IsActive = true;',[$id]);
        return response()->json(['data' => $DuAn]);
    }
    public function listThanhVien(Request $request)
    {
        $title = "Danh Sách Giai Đoạn Dự Án";
        $id = $request->input('id');
        return view('DuAn.ListDuAnThanhVien', compact('id','title'));
    }

    public function getDuAnThanhVien(Request $request)
    {
         $id = $request->input('id');
        
         $DuAn = DB::select('SELECT 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName AS user_name, 
            GROUP_CONCAT(DISTINCT vaitros.TenVaiTro) AS vaitro_names, 
            GROUP_CONCAT(DISTINCT donvis.TenDonVi) AS donvi_names 
        FROM 
            nguoidungs 
        LEFT JOIN 
            tacvus ON nguoidungs.id = tacvus.MaNguoiDung AND tacvus.IsActive = true 
        LEFT JOIN 
            vaitros ON vaitros.id = tacvus.MaVaiTro AND vaitros.IsActive = true 
        LEFT JOIN 
            phongbans ON nguoidungs.id = phongbans.MaNguoiDung AND phongbans.IsActive = true 
        LEFT JOIN 
            donvis ON donvis.id = phongbans.MaDonVi AND donvis.IsActive = true 
         LEFT JOIN 
            thanhviens ON thanhviens.MaNguoiDung = nguoidungs.id AND thanhviens.IsActive = true 
        WHERE 
            nguoidungs.Quyen IN (2, 3, 4) 
            AND nguoidungs.IsActive = true 
             AND thanhviens.MaDuAn = ?
        GROUP BY 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName;',[$id]);
        return response()->json(['data' => $DuAn]);
    }
    public function listGiaiDoan(Request $request)
    {
        $title = "Danh Sách Giai Đoạn Dự Án";
        $id = $request->input('id');
        return view('DuAn.ListDuAnGiaiDoan', compact('id','title'));
    }
    public function getDuAnGiaiDoan(Request $request)
    {
         $id = $request->input('id');
        
         $DuAn = DB::select('SELECT thuchiens.* , giaidoans.TenGiaiDoan 
         FROM duans , thuchiens , giaidoans 
         WHERE duans.id = ?
         AND duans.id= thuchiens.MaDuAn  
         AND thuchiens.MaGiaiDoan = giaidoans.id 
         AND giaidoans.IsActive = true
        AND duans.IsActive = true
        AND thuchiens.IsActive = true
       ',[$id]);
        return response()->json(['data' => $DuAn]);
    }
    public function listCongViecDuAnfile(Request $request)
    {
        $title = "Danh Sách File Công Việc";
        $id = $request->input('id');
        return view('TienDoCongViec.ListCongViecFile', compact('id','title'));
    }
    public function getCongViecDuAnfile(Request $request)
    {
         $id = $request->input('id');
        
         $DuAn = DB::select('SELECT * FROM files WHERE files.MaCapNhatTienDo = ? AND IsActive = true
       ',[$id]);
        return response()->json(['data' => $DuAn]);
    }
    public function listCongViecDuAn(Request $request)
    {
        $title = "Danh Sách Công Việc Dự Án";
        $id = $request->input('id');
        return view('TienDoCongViec.ListCongViecDuAn', compact('id','title'));
    }
    public function getCongViecDuAn(Request $request)
    {
         $id = $request->input('id');
        
         $DuAn = DB::select('SELECT * FROM congviecs WHERE congviecs.MaDuAn =? AND IsActive = true
       ',[$id]);
        return response()->json(['data' => $DuAn]);
    }
    //Danh sách Dự Án
   public function list()
   {
       $title = "Danh Sách Dự Án";
       return view('DuAn.ListDuAn', compact('title'));
   }
   public function getDuAn()
   {
        $DuAn = DB::select('SELECT duans.*,loaiduans.TenLoaiDuAn 
        FROM duans,loaiduans 
        WHERE duans.MaLoai = loaiduans.id
        AND duans.IsActive = true
        AND loaiduans.IsActive = true');
       return response()->json(['data' => $DuAn]);
   }

   public function updateviewSee($id)
   {
    $DuAn = DB::select('
                SELECT 
                    loaiduans.TenLoaiDuAn, 
                    giaidoans.TenGiaiDoan,  
                    thuchiens.NgayBatDau, 
                    thuchiens.NgayKetThuc, 
                    thuchiens.MaGiaiDoan, 
                    thuchiens.ThuGiaiDoan,  
                    duans.QuyMo, 
                    duans.NgayBatDau AS NgayBatDauDuAn,   
                    duans.NgayKetThuc AS NgayKetThucDuAn,   
                    duans.Mota,  
                    duans.TenMa,  
                    GROUP_CONCAT(thanhviens.MaNguoiDung SEPARATOR ", ") AS MaNguoiDung
                FROM 
                    loaiduans
                    JOIN duans ON duans.MaLoai = loaiduans.id
                    JOIN thuchiens ON thuchiens.MaDuAn = duans.id
                    JOIN giaidoans ON thuchiens.MaGiaiDoan = giaidoans.id
                    JOIN thanhviens ON thanhviens.MaDuAn = duans.id
                WHERE 
                    duans.id = ?
                GROUP BY 
                    loaiduans.TenLoaiDuAn, 
                    giaidoans.TenGiaiDoan, 
                    thuchiens.NgayBatDau, 
                    thuchiens.NgayKetThuc,
                    thuchiens.MaGiaiDoan,
                    thuchiens.ThuGiaiDoan,
                    duans.QuyMo, 
                    duans.NgayBatDau, 
                    duans.NgayKetThuc, 
                    duans.Mota, 
                    duans.TenMa
            ', [$id]);
            $NguoiDung = nguoidung::where('IsActive', 1)->get();
            
       return response()->json(['data' => $DuAn,'NguoiDung'=>$NguoiDung]);
   }
 
   public function updateviewFile($id)
   {
      // Lấy thông tin file từ CSDL
        $fileRecord = DB::table('files')->where('id', $id)->first();

        if ($fileRecord) {
            $filePath = public_path($fileRecord->DuongDanFile);

            // Chuẩn hóa dấu gạch chéo trong đường dẫn
            $filePath = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $filePath);

            if (file_exists($filePath)) {
                $mimeType = mime_content_type($filePath);

                // Nếu file là văn bản hoặc JSON, trả về nội dung file dưới dạng text
                if (str_starts_with($mimeType, 'text') || $mimeType == 'application/json') {
                    $content = file_get_contents($filePath);
                    $content = mb_convert_encoding($content, 'UTF-8', 'auto');
                    return response()->json(['content' => $content, 'type' => $mimeType]);
                }

                // Các file hình ảnh, PDF, Word, Excel, ZIP sẽ được trả về dưới dạng URL
                $supportedMimeTypes = [
                    'image' => ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
                    'pdf' => ['application/pdf'],
                    'word_excel' => [
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.ms-excel',
                    ],
                    'zip' => ['application/zip']
                ];

                // Nếu file là hình ảnh, trả về URL và header cache để cải thiện tốc độ tải
                if (in_array($mimeType, $supportedMimeTypes['image'])) {
                    return response()->json([
                        'url' => asset($fileRecord->DuongDanFile),
                        'type' => $mimeType
                    ])->header('Cache-Control', 'public, max-age=86400'); // Cache 1 ngày
                }

                // Nếu file là PDF, Word, Excel, hoặc ZIP, trả về URL và loại file
                if (in_array($mimeType, array_merge($supportedMimeTypes['pdf'], $supportedMimeTypes['word_excel'], $supportedMimeTypes['zip']))) {
                    return response()->json([
                        'url' => asset($fileRecord->DuongDanFile),
                        'type' => $mimeType
                    ]);
                }

                // Nếu không hỗ trợ, trả về liên kết tải về
                return response()->json(['url' => asset($fileRecord->DuongDanFile), 'type' => $mimeType]);
            } else {
                return response()->json(['error' => 'File not found'], 404);
            }
        } else {
            return response()->json(['error' => 'File not found in database'], 404);
        }

   }
   
   


   //Thêm Dự Án
   public function addview()
   {
       $title = "Thêm Dự Án";
    $NguoiDung = DB::select('SELECT 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName AS user_name, 
            GROUP_CONCAT(DISTINCT vaitros.TenVaiTro) AS vaitro_names, 
            GROUP_CONCAT(DISTINCT donvis.TenDonVi) AS donvi_names 
        FROM 
            nguoidungs 
        LEFT JOIN 
            tacvus ON nguoidungs.id = tacvus.MaNguoiDung AND tacvus.IsActive = true 
        LEFT JOIN 
            vaitros ON vaitros.id = tacvus.MaVaiTro AND vaitros.IsActive = true 
        LEFT JOIN 
            phongbans ON nguoidungs.id = phongbans.MaNguoiDung AND phongbans.IsActive = true 
        LEFT JOIN 
            donvis ON donvis.id = phongbans.MaDonVi AND donvis.IsActive = true 
        WHERE 
            nguoidungs.Quyen IN (2, 3, 4) 
            AND nguoidungs.IsActive = true 
        GROUP BY 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName;
        ');
            $DonVi = donvi::where('IsActive', 1)->get();
            $VaiTro = vaitro::where('IsActive', 1)->get();
            $LoaiDuAn = loaiduan::where('IsActive', 1)->get();
            $GiaiDoan = giaidoan::where('IsActive', 1)->get();
       return view('DuAn.AddDuAn', compact('VaiTro','GiaiDoan','DonVi','NguoiDung','title','LoaiDuAn'));
   }
   public function getNguoiDung($id)
   {
       $NguoiDung = DB::select('SELECT 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName AS user_name, 
            GROUP_CONCAT(DISTINCT vaitros.TenVaiTro) AS vaitro_names, 
            GROUP_CONCAT(DISTINCT donvis.TenDonVi) AS donvi_names 
        FROM 
            nguoidungs 
        LEFT JOIN 
            tacvus ON nguoidungs.id = tacvus.MaNguoiDung AND tacvus.IsActive = true 
        LEFT JOIN 
            vaitros ON vaitros.id = tacvus.MaVaiTro AND vaitros.IsActive = true 
        LEFT JOIN 
            phongbans ON nguoidungs.id = phongbans.MaNguoiDung AND phongbans.IsActive = true 
        LEFT JOIN 
            donvis ON donvis.id = phongbans.MaDonVi AND donvis.IsActive = true 
        WHERE 
            nguoidungs.Quyen IN (2, 3, 4) 
            AND nguoidungs.IsActive = true 
             AND phongbans.MaDonVi = ?
        GROUP BY 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName;
            ',[$id]);
   
       return response()->json($NguoiDung);
   }
   public function add(Request $request)
    {  
        DB::beginTransaction(); // Bắt đầu giao dịch
        try {
        $existingLopHoc = duan::where('TenDuAn', $request->TenDuAn)->count();

        // Kiểm tra trước khi lưu
        if ($existingLopHoc > 0) {
            return response()->json(['success' => false, 'message' => 'Giá trị Ten Du An đã tồn tại']);
        }
            // Tạo dự án mới
            $duAn = new duan();
            $duAn->TenDuAn = $request->TenDuAn;
            $duAn->MaLoai = $request->MaLoai;
            $duAn->QuyMo = $request->QuyMo;
          
            $duAn->Mota = $request->MoTa;
            $duAn->MaDonVi = $request->MaDonVi;
            $duAn->NgayKetThuc = $request->NgayKetThucDuAn;
            $duAn->NgayBatDau = $request->NgayBatDauDuAn;
            $duAn->TrangThai = 1;
            $sessionUserId = Session::get('sessionUserId');
            $duAn->MaNguoiTao = $sessionUserId;
            $duAn->IsActive = true;
            $duAn->save();

            $idDuAn = $duAn->id;
            $year = Carbon::now()->format('y'); // Lấy 2 số cuối của năm hiện tại
            $tenMa = 'DuAn' . $year . $idDuAn;
            $duAn->TenMa = $tenMa;
            // Lưu lại lần thứ 2 sau khi đã có TenMa
            $duAn->save();

        
            // Lấy dữ liệu từ request
            $ngayBatDaus = $request->input('NgayBatDau', []); // Ngày bắt đầu của từng giai đoạn
            $maGiaiDoans = $request->input('MaGiaiDoan', []); // Mã giai đoạn
            $ngayKetThucs = $request->input('NgayKetThuc', []); // Ngày bắt đầu của từng giai đoạn
            $thuTuGiaiDoans = $request->input('ThuTuGiaiDoan', []); // Thứ tự giai đoạn
            $MaNguoiDung = $request->input('MaNguoiDung');
            
            // Duyệt qua từng giai đoạn và lưu vào cơ sở dữ liệu
            foreach ($maGiaiDoans as $index => $maGiaiDoan) {
                $giaiDoan = new thuchien();
                $giaiDoan->MaDuAn = $duAn->id; // Liên kết với dự án vừa tạo
                $giaiDoan->MaGiaiDoan = $maGiaiDoan; // Mã giai đoạn từ form
                $giaiDoan->IsCongViec = false; // Mã giai đoạn từ form
            
                // Gán ngày bắt đầu và ngày kết thúc cho từng giai đoạn
                $ngayBatDau = $ngayBatDaus[$index]; // Ngày bắt đầu từ form của từng giai đoạn
                $giaiDoan->NgayBatDau = $ngayBatDau;
            
                $ngayKetThuc = $ngayKetThucs[$index]; // Ngày bắt đầu từ form của từng giai đoạn
                $giaiDoan->NgayKetThuc = $ngayKetThuc;
               
                $giaiDoan->ThuGiaiDoan = $thuTuGiaiDoans[$index]; // Thứ tự giai đoạn từ form
                $giaiDoan->IsActive = true;
            
                // Lưu giai đoạn vào cơ sở dữ liệu
                $giaiDoan->save();
            }
            
        
            foreach ($MaNguoiDung as $nguoiDungId) {
                // Tạo một bản ghi mới trong bảng PhongBan
                $thanhvien = new thanhvien;
                $thanhvien->MaDuAn = $duAn->id;
                $thanhvien->MaNguoiDung = $nguoiDungId; // Nếu bảng thanhvien có cột này
                $thanhvien->IsActive = true; // Nếu bảng thanhvien có cột này
                $thanhvien->save();
            }
        
            DB::commit(); // Lưu tất cả thay đổi vào cơ sở dữ liệu
        
            return response()->json(['success' => true]);
        
        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác tất cả thay đổi nếu có lỗi
        
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
     //Cập nhật Dự Án
   public function updateview($id)
   {
       $DuAn = duan::find($id);
       $title = "Cập Nhật Dự Án";
       $LoaiDuAn = loaiduan::where('IsActive', 1)->get();
       $GiaiDoan = giaidoan::where('IsActive', 1)->get();
        $CacGiaiDoan = DB::select(' SELECT *, 
                DATEDIFF(NgayKetThuc, NgayBatDau) AS SoNgayThucHienTinhToan
                FROM thuchiens
                WHERE MaDuAn = ?',[$id]);


        $ThanhVienDuAn = DB::select('SELECT 
                nguoidungs.id, 
                nguoidungs.Quyen, 
                nguoidungs.UserName AS user_name, 
                GROUP_CONCAT(DISTINCT vaitros.TenVaiTro) AS vaitro_names, 
                GROUP_CONCAT(DISTINCT donvis.TenDonVi) AS donvi_names 
            FROM 
                nguoidungs 
            LEFT JOIN 
                tacvus ON nguoidungs.id = tacvus.MaNguoiDung AND tacvus.IsActive = true 
            LEFT JOIN 
                vaitros ON vaitros.id = tacvus.MaVaiTro AND vaitros.IsActive = true 
            LEFT JOIN 
                phongbans ON nguoidungs.id = phongbans.MaNguoiDung AND phongbans.IsActive = true 
            LEFT JOIN 
                donvis ON donvis.id = phongbans.MaDonVi AND donvis.IsActive = true 
            LEFT JOIN 
                thanhviens ON nguoidungs.id = thanhviens.MaNguoiDung AND thanhviens.IsActive = true 
            WHERE 
                nguoidungs.Quyen IN (2, 3, 4) 
            AND nguoidungs.IsActive = true 
            AND thanhviens.MaDuAn = ?
            GROUP BY 
                nguoidungs.id, 
                nguoidungs.Quyen, 
                nguoidungs.UserName;
                ',[$id]);
        $idMaDonVi1= DB::select('SELECT * FROM duans WHERE id = ?;',[$id]);
        $idMaDonVi= DB::select('SELECT * FROM donvis WHERE id = ?;',[$idMaDonVi1[0]->MaDonVi]);
        $ThanhVienDonVi = DB::select('SELECT 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName AS user_name, 
            GROUP_CONCAT(DISTINCT vaitros.TenVaiTro) AS vaitro_names, 
            GROUP_CONCAT(DISTINCT donvis.TenDonVi) AS donvi_names 
        FROM 
            nguoidungs 
        LEFT JOIN 
            tacvus ON nguoidungs.id = tacvus.MaNguoiDung AND tacvus.IsActive = true 
        LEFT JOIN 
            vaitros ON vaitros.id = tacvus.MaVaiTro AND vaitros.IsActive = true 
        LEFT JOIN 
            phongbans ON nguoidungs.id = phongbans.MaNguoiDung AND phongbans.IsActive = true 
        LEFT JOIN 
            donvis ON donvis.id = phongbans.MaDonVi AND donvis.IsActive = true 
        LEFT JOIN 
            thanhviens ON nguoidungs.id = thanhviens.MaNguoiDung AND thanhviens.IsActive = true 
        WHERE 
            nguoidungs.Quyen IN (2, 3, 4) 
            AND nguoidungs.IsActive = true 
            AND donvis.id = ?
        GROUP BY 
            nguoidungs.id, 
            nguoidungs.Quyen, 
            nguoidungs.UserName;',[$idMaDonVi1[0]->MaDonVi]);
       return view('DuAn.UpdateDuAn', compact('LoaiDuAn','DuAn', 'title','GiaiDoan','CacGiaiDoan','ThanhVienDuAn','ThanhVienDonVi','idMaDonVi'));
   }
   
   public function update(Request $request, $id)
   {
    DB::beginTransaction(); // Bắt đầu giao dịch
        try {
        $DuAn = duan::where('id', '!=', $id)
        ->where('TenDuAn', $request->TenDuAn)
        ->where('IsActive', true)
        ->first();

        if ($DuAn) {
            return response()->json(['success' => false, 'message' => 'Giá trị TenDuAn đã tồn tại']);
        } else {
                $DuAn = duan::find($id);
                $DuAn->TenDuAn = $request->TenDuAn;
                $DuAn->QuyMo = $request->QuyMo;
                $DuAn->MaLoai = $request->MaLoai;
                $DuAn->NgayBatDau = $request->NgayBatDauDuAn;
                $DuAn->NgayKetThuc = $request->NgayKetThucDuAn;
                $DuAn->Mota = $request->MoTa;
                $DuAn->save();
            
            // Lấy dữ liệu từ request (đảm bảo lấy đúng giá trị ngày của từng giai đoạn)
            $ngayBatDaus = $request->input('NgayBatDau', []); // Phải là mảng các ngày bắt đầu cho từng giai đoạn
            $maGiaiDoans = $request->input('MaGiaiDoan', []); // Mảng các mã giai đoạn
            $ngayKetThucs = $request->input('NgayKetThuc', []); // Mảng các ngày kết thúc cho từng giai đoạn
            $thuTuGiaiDoans = $request->input('ThuTuGiaiDoan', []); // Mảng các thứ tự giai đoạn
            
            // Duyệt qua từng giai đoạn và kiểm tra trong CSDL
            foreach ($maGiaiDoans as $index => $maGiaiDoan) {
                // Kiểm tra giai đoạn đã tồn tại hay chưa
                $existingGiaiDoan = DB::table('thuchiens')
                    ->select('id')
                    ->where('MaDuAn', $id)
                    ->where('ThuGiaiDoan', $thuTuGiaiDoans[$index])
                    ->first();
            
                // Lấy ngày bắt đầu của từng giai đoạn
                $ngayBatDau = isset($ngayBatDaus[$index]) ? $ngayBatDaus[$index] : null;
                $ngayKetThuc = isset($ngayKetThucs[$index]) ? $ngayKetThucs[$index] : null;
            
                if ($ngayBatDau === null || $ngayKetThuc === null) {
                    // Nếu không có ngày bắt đầu hoặc ngày kết thúc, bỏ qua giai đoạn này
                    continue;
                }
            
                if ($existingGiaiDoan) {
                    // Cập nhật giai đoạn nếu đã tồn tại
                    $giaiDoan = thuchien::find($existingGiaiDoan->id);
                } else {
                    // Tạo mới giai đoạn nếu chưa tồn tại
                    $giaiDoan = new thuchien();
                    $giaiDoan->MaDuAn = $id;
                    $giaiDoan->MaGiaiDoan = $maGiaiDoan;
                    $giaiDoan->IsCongViec = false; // Đặt giá trị mặc định cho IsCongViec
                }
            
                // Gán ngày bắt đầu, ngày kết thúc và thứ tự giai đoạn
                $giaiDoan->NgayBatDau = $ngayBatDau;
                $giaiDoan->NgayKetThuc = $ngayKetThuc;
                $giaiDoan->ThuGiaiDoan = $thuTuGiaiDoans[$index];
                $giaiDoan->IsActive = true; // Đặt IsActive thành true
            
                // Lưu giai đoạn vào CSDL
                $giaiDoan->save();
            }       
                // Xử lý thông tin giao việc
                $MaNguoiDung = $request->input('MaNguoiDung');
                $MaNguoiDungListDB = thanhvien::where('MaDuAn', $id)
                    ->where('IsActive', true)
                    ->pluck('MaNguoiDung')
                    ->toArray();
                $MaNguoiDungListUI = is_array($MaNguoiDung) ? $MaNguoiDung : [$MaNguoiDung];
                
                // Kiểm tra sự thay đổi dữ liệu
                $inDBNotInUI = array_diff($MaNguoiDungListDB, $MaNguoiDungListUI);
                $inUINotInDB = array_diff($MaNguoiDungListUI, $MaNguoiDungListDB);
                
               
                foreach ($inDBNotInUI as $maNguoiDung) {
                    $GiaoViec = thanhvien::where('MaDuAn', $id)
                        ->where('MaNguoiDung', $maNguoiDung)
                        ->where('IsActive', true)
                        ->first();
                    if ($GiaoViec) {
                        $GiaoViec->IsActive = false;
                        $GiaoViec->save();
                    }
                }
                
                // Thêm những người dùng mới được chọn
                foreach ($inUINotInDB as $maNguoiDung) {
                    $GiaoViec = thanhvien::where('MaDuAn', $id)
                        ->where('MaNguoiDung', $maNguoiDung)
                        ->where('IsActive', true)
                        ->first();
                    if ($GiaoViec) {
                        $GiaoViec->IsActive = true;
                        $GiaoViec->save();
                    } else {
                        $GiaoViec = new thanhvien;
                        $GiaoViec->MaDuAn = $id;
                        $GiaoViec->MaNguoiDung = $maNguoiDung;
                        $GiaoViec->IsActive = true;
                        $GiaoViec->save();
                    }
                }    

        }
        DB::commit(); // Lưu tất cả thay đổi vào cơ sở dữ liệu
        return response()->json(['success' => true]);
    
    } catch (\Exception $e) {
        DB::rollBack(); // Hoàn tác tất cả thay đổi nếu có lỗi
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
   }
   public function remove($id)
   {
       $DuAn= duan::find($id);
       $DuAn-> IsActive= false;
       $DuAn->save();
       return response()->json(['success' => true]);

   }




   public function ExportDuAn($id) {
    // Lấy thông tin dự án
    $DuAn = DB::select('SELECT duans.TenMa, duans.TenDuAn, duans.NgayBatDau, duans.NgayKetThuc, duans.QuyMo, loaiduans.TenLoaiDuAn, duans.Mota 
                        FROM duans, loaiduans  
                        WHERE loaiduans.id = duans.MaLoai 
                        AND duans.id = ?', [$id]);
    $ThanhVienDuAn = DB::select('SELECT thanhviens.MaNguoiDung FROM thanhviens WHERE thanhviens.MaDuAn = ?', [$id]);
    $AllThanhVien = nguoidung::where('IsActive', 1)->get();
    
    // Lấy thông tin từ dự án
    $TenDuAn = $DuAn[0]->TenDuAn;
    $TenMa = $DuAn[0]->TenMa;
    $NgayBatDau = Carbon::parse($DuAn[0]->NgayBatDau)->format('d/m/Y');
    $NgayKetThuc = Carbon::parse($DuAn[0]->NgayKetThuc)->format('d/m/Y');
    $QuyMo = $DuAn[0]->QuyMo;
    $TenLoaiDuAn = $DuAn[0]->TenLoaiDuAn;
    $MoTa = $DuAn[0]->Mota;

    // Quy đổi QuyMo thành chuỗi mô tả
    $QuyMoText = '';
    switch ($QuyMo) {
        case 1: $QuyMoText = 'Nhỏ'; break;
        case 2: $QuyMoText = 'Vừa'; break;
        case 3: $QuyMoText = 'Lớn'; break;
        case 4: $QuyMoText = 'Rất lớn'; break;
    }

    // Lấy thông tin giai đoạn và công việc
    $ListLopHoc = DB::select('SELECT 
                giaidoans.TenGiaiDoan,
                    congviecs.TenCongViec,
                    congviecs.NgayBatDau,
                    congviecs.NgayKetThuc,
                    congviecs.TrangThai,
                    GROUP_CONCAT(giaoviecs.id SEPARATOR ", ") AS MaGiaoViecid,
                    thuchiens.ThuGiaiDoan
                FROM 
                    congviecs
                JOIN 
                    giaoviecs ON giaoviecs.MaCongViec = congviecs.id
                LEFT JOIN 
                    thuchiens ON congviecs.MaThucHien = thuchiens.id
                LEFT JOIN 
                giaidoans ON thuchiens.MaGiaiDoan = giaidoans.id
                WHERE 
                    congviecs.MaDuAn = ?
                GROUP BY 
                giaidoans.TenGiaiDoan,
                    congviecs.TenCongViec,
                    congviecs.NgayBatDau,
                    congviecs.NgayKetThuc,
                    congviecs.TrangThai,
                    thuchiens.ThuGiaiDoan
                ORDER BY 
                    thuchiens.ThuGiaiDoan ASC;

                ', [$id]);

    // Tạo file Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Thông tin dự án (Merge và in đậm)
    $sheet->mergeCells('A1:F1');
    $sheet->setCellValue('A1', 'Thông Tin Dự Án');
    $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Đặt thông tin dự án
    $sheet->setCellValue('A2', 'Tên Mã:');
    $sheet->setCellValue('B2', $TenMa);
    $sheet->setCellValue('A3', 'Tên Dự Án:');
    $sheet->setCellValue('B3', $TenDuAn);
    $sheet->setCellValue('A4', 'Ngày Bắt Đầu:');
    $sheet->setCellValue('B4', $NgayBatDau);
    $sheet->setCellValue('A5', 'Ngày Kết Thúc:');
    $sheet->setCellValue('B5', $NgayKetThuc);
    $sheet->setCellValue('A6', 'Quy Mô:');
    $sheet->setCellValue('B6', $QuyMoText);
    $sheet->setCellValue('A7', 'Loại Dự Án:');
    $sheet->setCellValue('B7', $TenLoaiDuAn);
    $sheet->setCellValue('A8', 'Mô Tả:');
    $sheet->setCellValue('B8', $MoTa);

    // Hợp nhất ô Mô Tả từ B8 đến F8
    $sheet->mergeCells('B8:F8');
    $sheet->getStyle('B8')->getAlignment()->setWrapText(true);
    $sheet->getRowDimension(8)->setRowHeight(50);
    $sheet->getStyle('B8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B8')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $sheet->getStyle('B8:F8')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

    // Thêm thông tin thành viên
    $thanhVienNames = [];
    foreach ($ThanhVienDuAn as $tv) {
        $user = $AllThanhVien->firstWhere('id', $tv->MaNguoiDung);
        $thanhVienNames[] = $user ? $user->UserName : 'Không xác định';
    }
    $thanhVienList = implode(', ', $thanhVienNames);
    $sheet->setCellValue('A9', 'Thành Viên:');
    $sheet->setCellValue('B9', $thanhVienList);
    $sheet->mergeCells('B9:F9');
    $sheet->getStyle('B9')->getAlignment()->setWrapText(true);
    $sheet->getRowDimension(9)->setRowHeight(50);
    $sheet->getStyle('B9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B9')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $sheet->getStyle('B9:F9')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

    // In đậm tiêu đề thông tin dự án
    $sheet->getStyle('A2:A9')->getFont()->setBold(true);

    // Thêm border cho toàn bộ phần thông tin dự án
    $sheet->getStyle('A2:B9')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

    // Căn giữa các cột thông tin dự án
    $sheet->getStyle('B2:B8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B9')->getAlignment()->setWrapText(true); // Enable wrap text for Thành Viên

   // Bảng giai đoạn và công việc
$row = 11; // Điều chỉnh dòng bắt đầu cho bảng giai đoạn
$sheet->setCellValue('A' . $row, 'Các giai đoạn');
$sheet->setCellValue('B' . $row, 'Công việc');
$sheet->setCellValue('C' . $row, 'Thời gian');
$sheet->setCellValue('D' . $row, 'Trạng thái');

// Định dạng tiêu đề bảng giai đoạn
$sheet->getStyle('A' . $row . ':D' . $row)->getFont()->setBold(true);
$sheet->getStyle('A' . $row . ':D' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A' . $row . ':D' . $row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

// Điều chỉnh độ rộng của cột
foreach (range('A', 'D') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Thêm dữ liệu cho các giai đoạn
$row++;
$currentStage = null;

foreach ($ListLopHoc as $giaiDoan) {
    $ngayBatDau = Carbon::parse($giaiDoan->NgayBatDau)->format('d/m/Y');
    $ngayKetThuc = Carbon::parse($giaiDoan->NgayKetThuc)->format('d/m/Y');
    
    if ($currentStage !== $giaiDoan->TenGiaiDoan) {
        // Nếu giai đoạn thay đổi, in tên giai đoạn
        $sheet->setCellValue('A' . $row, $giaiDoan->TenGiaiDoan);
        $currentStage = $giaiDoan->TenGiaiDoan;
        $sheet->getStyle('A' . $row)->getFont()->setSize(16)->setBold(true)->setItalic(true); // Kích thước chữ cho giai đoạn
    } else {
        // Nếu giai đoạn giống nhau, để ô trống
        $sheet->setCellValue('A' . $row, '');
    }

    // Thêm thông tin công việc
    $sheet->setCellValue('B' . $row, $giaiDoan->TenCongViec);
    $sheet->getStyle('B' . $row)->getFont()->setSize(14); // Đặt kích thước chữ cho công việc
    $sheet->setCellValue('C' . $row, "$ngayBatDau - $ngayKetThuc");

    // Quy đổi trạng thái
    switch ($giaiDoan->TrangThai) {
        case 1:
        case 2:
            $statusText = 'Đang thực hiện';
            break;
        case 3:
            $statusText = 'Hoàn thành';
            break;
        case 4:
            $statusText = 'Trễ hẹn';
            break;
        default:
            $statusText = 'Không xác định';
            break;
    }
    $sheet->setCellValue('D' . $row, $statusText);

    // Lấy thông tin người nhận việc
    $maGiaoViecid = $giaiDoan->MaGiaoViecid; // Giả sử MaGiaoViecid chứa nhiều ID
    $maGiaoViecidArray = explode(', ', $maGiaoViecid); // Tách chuỗi thành mảng nếu có nhiều ID
    
    // Tiêu đề cột
    $row++;
    $sheet->setCellValue('C' . $row, 'Người nhận việc'); // Dời qua bên phải 1 cột
    $sheet->setCellValue('D' . $row, 'Email');
    $sheet->setCellValue('E' . $row, 'SDT');
    $sheet->setCellValue('F' . $row, 'Tiến độ');
    $sheet->setCellValue('G' . $row, 'Trạng thái'); // Cột trạng thái

    // Định dạng tiêu đề bảng
    $sheet->getStyle('C' . $row . ':G' . $row)->getFont()->setBold(true);
    $sheet->getStyle('C' . $row . ':G' . $row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

    // Đặt độ rộng cho cột SDT và Trạng Thái
    $sheet->getColumnDimension('E')->setWidth(120 / 7.5); // SDT
    $sheet->getColumnDimension('G')->setWidth(120 / 7.5); // Trạng Thái

    // Thêm thông tin người nhận việc
    $row++;

    foreach ($maGiaoViecidArray as $id) {
        $assignees = DB::select('SELECT nguoidungs.UserName, nguoidungs.Email, nguoidungs.SDT, capnhattiendos.TienDo, giaoviecs.TrangThai
                                  FROM giaoviecs
                                  JOIN nguoidungs ON giaoviecs.MaNguoiDung = nguoidungs.id
                                  LEFT JOIN capnhattiendos ON capnhattiendos.MaGiaoViec = giaoviecs.id
                                  WHERE giaoviecs.id = ?
                                  AND giaoviecs.IsActive = true 
                                  AND nguoidungs.IsActive = true', [$id]);

        foreach ($assignees as $assignee) {
            // Quy đổi trạng thái
            switch ($assignee->TrangThai) {
                case 1:
                case 2:
                    $assigneeStatus = 'Đang thực hiện';
                    break;
                case 3:
                    $assigneeStatus = 'Hoàn thành';
                    break;
                case 4:
                    $assigneeStatus = 'Trễ hẹn';
                    break;
                default:
                    $assigneeStatus = 'Không xác định';
                    break;
            }
               // Đảm bảo Tiến Độ có %; nếu không có, gán là 0%
               $tienDo = $assignee->TienDo ? $assignee->TienDo . '%' : '0%';


            // In thông tin người nhận việc vào bảng
            $sheet->setCellValue('C' . $row, $assignee->UserName);
            $sheet->setCellValue('D' . $row, $assignee->Email);
            $sheet->setCellValue('E' . $row, $assignee->SDT);
            $sheet->setCellValue('F' . $row, $tienDo);
            $sheet->setCellValue('G' . $row, $assigneeStatus);

            // Căn giữa cho cột Trạng Thái
            $sheet->getStyle('G' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            // Đặt kích thước chữ cho thông tin người nhận việc
            $sheet->getStyle('C' . $row . ':G' . $row)->getFont()->setSize(12);

            $row++;
        }
    }
    
    // Thêm dòng trống sau bảng thông tin người nhận việc
    $row += 1; // Tăng dòng cho khoảng cách

    // Định dạng bảng thông tin người nhận việc
    $sheet->getStyle('C' . ($row - count($maGiaoViecidArray) - 3) . ':G' . ($row - 1))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
}

// Định dạng bảng giai đoạn
$sheet->getStyle('A11:G' . ($row))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('A11:G' . ($row))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A11:G' . ($row))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    // Tạo đối tượng writer và lưu file Excel
    $writer = new Xlsx($spreadsheet);
    $filename = 'DuAn_' . $TenMa . '.xlsx';
    $writer->save(public_path($filename));

    // Trả về file tải xuống
    return response()->download(public_path($filename));
}


public function ExportCongViec($id) {

// Lấy thông tin công việc từ bảng congviecs
$congViec = DB::select('SELECT TenCongViec, NgayBatDau, NgayKetThuc, LinkTaiLieu, MoTa FROM congviecs WHERE id = ?', [$id]);

// Lấy thông tin giao việc từ bảng giaoviecs và nguoidungs
$giaoViec = DB::select('SELECT nguoidungs.UserName, nguoidungs.Email, nguoidungs.SDT, capnhattiendos.TienDo, giaoviecs.TrangThai
                       FROM giaoviecs
                       JOIN nguoidungs ON giaoviecs.MaNguoiDung = nguoidungs.id
                       LEFT JOIN capnhattiendos ON capnhattiendos.MaGiaoViec = giaoviecs.id
                       WHERE giaoviecs.MaCongViec = ?
                       AND giaoviecs.IsActive = true 
                       AND nguoidungs.IsActive = true', [$id]);

// Tạo một đối tượng Spreadsheet mới
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Thông Tin');

// Đặt tiêu đề và tiêu đề cột cho bảng công việc
$sheet->setCellValue('B1', 'Thông Tin Công Việc');
$sheet->setCellValue('B2', 'Tên Công Việc');
$sheet->setCellValue('C2', 'Ngày Bắt Đầu');
$sheet->setCellValue('D2', 'Ngày Đến Hẹn');
$sheet->setCellValue('E2', 'Link Tài Liệu');

// Căn lề và định dạng tiêu đề
$sheet->getStyle('B1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('B2:E2')->getFont()->setBold(true);
$sheet->getStyle('B1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('B2:E2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('B2:E2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('B2:E2')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

// Điền dữ liệu công việc vào bảng
$row = 3; // Khai báo và khởi tạo biến $row
foreach ($congViec as $cv) {
    $sheet->setCellValue('B' . $row, $cv->TenCongViec);
    $sheet->setCellValue('C' . $row, \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(new \DateTime($cv->NgayBatDau)));
    $sheet->setCellValue('D' . $row, \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(new \DateTime($cv->NgayKetThuc)));
    $sheet->setCellValue('E' . $row, $cv->LinkTaiLieu);
    
    // Định dạng ngày theo kiểu ngày/tháng/năm
    $sheet->getStyle('C' . $row . ':D' . $row)->getNumberFormat()->setFormatCode('dd/mm/yyyy');
    
    $row++;
}

// Đặt căn giữa cho các ô còn lại
$sheet->getStyle('B3:E' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Tạo khoảng cách giữa hai bảng
$startRowForGiaoViec = $row + 2;

// Đặt tiêu đề và tiêu đề cột cho bảng giao việc
$sheet->setCellValue('B' . $startRowForGiaoViec, 'Thông Tin Giao Việc');
$sheet->setCellValue('B' . ($startRowForGiaoViec + 1), 'Người nhận việc');
$sheet->setCellValue('C' . ($startRowForGiaoViec + 1), 'Email');
$sheet->setCellValue('D' . ($startRowForGiaoViec + 1), 'SDT');
$sheet->setCellValue('E' . ($startRowForGiaoViec + 1), 'Tiến độ');
$sheet->setCellValue('F' . ($startRowForGiaoViec + 1), 'Trạng thái');

// Căn lề và định dạng tiêu đề
$sheet->getStyle('B' . $startRowForGiaoViec . ':F' . ($startRowForGiaoViec + 1))->getFont()->setBold(true);
$sheet->getStyle('B' . ($startRowForGiaoViec + 1) . ':F' . ($startRowForGiaoViec + 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('B' . ($startRowForGiaoViec + 1) . ':F' . ($startRowForGiaoViec + 1))->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('B' . ($startRowForGiaoViec + 1) . ':F' . ($startRowForGiaoViec + 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

// Điền dữ liệu giao việc vào bảng
$row = $startRowForGiaoViec + 2;
foreach ($giaoViec as $gv) {
    $sheet->setCellValue('B' . $row, $gv->UserName);
    $sheet->setCellValue('C' . $row, $gv->Email);
    $sheet->setCellValue('D' . $row, $gv->SDT);
    $tienDo = $gv->TienDo ?? 0;
    $sheet->setCellValue('E' . $row, $tienDo . '%'); // Thêm dấu %
    $trangThai = match($gv->TrangThai) {
        1, 2 => 'Đang thực hiện',
        3 => 'Hoàn thành',
        4 => 'Trễ hạn',
        default => 'Không xác định',
    };
    $sheet->setCellValue('F' . $row, $trangThai);
    $row++;
}

// Kẻ lề cho bảng giao việc
$sheet->getStyle('B' . ($startRowForGiaoViec + 1) . ':F' . ($row - 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

// Căn giữa nội dung cho tất cả các ô trong bảng giao việc
$sheet->getStyle('B' . ($startRowForGiaoViec + 2) . ':F' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('B' . ($startRowForGiaoViec + 2) . ':F' . ($row - 1))->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

// Đặt kích thước cột tự động cho tất cả các cột
foreach (range('B', 'F') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Tạo đối tượng writer và lưu file Excel
$writer = new Xlsx($spreadsheet);
$filename = 'CongViec_' . $congViec[0]->TenCongViec . '.xlsx';
$writer->save(public_path($filename));

// Trả về file tải xuống
return response()->download(public_path($filename));

    
}
public function ExportNguoiDung($id) {
// Truy vấn dữ liệu công việc và thông tin liên quan
$tasks = DB::select('
    SELECT duans.TenDuAn, 
           congviecs.TenCongViec, 
           congviecs.NgayBatDau, 
           congviecs.NgayKetThuc, 
           COALESCE(capnhattiendos.TienDo, 0) AS TienDo, 
           giaoviecs.TrangThai 
    FROM congviecs
    JOIN giaoviecs ON giaoviecs.MaCongViec = congviecs.id
    JOIN duans ON congviecs.MaDuAn = duans.id
    LEFT JOIN capnhattiendos ON capnhattiendos.MaGiaoViec = giaoviecs.id
    WHERE giaoviecs.MaNguoiDung = ?
', [$id]);

// Truy vấn tên người dùng
$userName = DB::select('SELECT UserName FROM nguoidungs WHERE id = ?', [$id]);
$userName = $userName ? $userName[0]->UserName : 'Người Dùng';

// Tạo một đối tượng Spreadsheet mới
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Danh sách công việc');

// Đặt tiêu đề và tiêu đề cột
$sheet->setCellValue('B1', 'Danh Sách Công Việc của ' . $userName);
$sheet->setCellValue('B2', 'Tên Dự Án');
$sheet->setCellValue('C2', 'Tên Công Việc');
$sheet->setCellValue('D2', 'Ngày Bắt Đầu');
$sheet->setCellValue('E2', 'Ngày Kết Thúc');
$sheet->setCellValue('F2', 'Tiến Độ (%)');
$sheet->setCellValue('G2', 'Trạng Thái');

// Định dạng tiêu đề bảng
$sheet->getStyle('B1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('B2:G2')->getFont()->setBold(true);
$sheet->getStyle('B2:G2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('B2:G2')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

// Khởi tạo các biến đếm
$totalTasks = 0;
$inProgressTasks = 0;
$completedTasks = 0;
$overdueTasks = 0;

// Điền dữ liệu vào bảng
$row = 3;
foreach ($tasks as $task) {
    $sheet->setCellValue('B' . $row, $task->TenDuAn);
    $sheet->setCellValue('C' . $row, $task->TenCongViec);
    $sheet->setCellValue('D' . $row, \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(new \DateTime($task->NgayBatDau)));
    $sheet->setCellValue('E' . $row, \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(new \DateTime($task->NgayKetThuc)));
    $sheet->setCellValue('F' . $row, $task->TienDo . '%');

    // Xử lý trạng thái
    $trangThai = match($task->TrangThai) {
        1, 2 => 'Đang thực hiện',
        3 => 'Hoàn thành',
        4 => 'Trễ hạn',
        default => 'Không xác định',
    };
    $sheet->setCellValue('G' . $row, $trangThai);

    // Cập nhật bộ đếm
    $totalTasks++;
    if ($task->TrangThai == 1 || $task->TrangThai == 2) {
        $inProgressTasks++;
    } elseif ($task->TrangThai == 3) {
        $completedTasks++;
    } elseif ($task->TrangThai == 4) {
        $overdueTasks++;
    }

    // Định dạng ngày
    $sheet->getStyle('D' . $row . ':E' . $row)->getNumberFormat()->setFormatCode('dd/mm/yyyy');

    $row++;
}

// Đặt kích thước cột tự động
foreach (range('B', 'G') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Định dạng căn giữa cho tất cả các ô
$sheet->getStyle('B3:G' . ($row - 1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

// Thêm thông tin tổng kết vào cuối bảng
$summaryRow = $row + 2;
$sheet->setCellValue('B' . $summaryRow, 'Tổng số công việc: ' . $totalTasks);
$sheet->setCellValue('B' . ($summaryRow + 1), 'Số công việc đang thực hiện: ' . $inProgressTasks);
$sheet->setCellValue('B' . ($summaryRow + 2), 'Số công việc hoàn thành: ' . $completedTasks);
$sheet->setCellValue('B' . ($summaryRow + 3), 'Số công việc trễ hạn: ' . $overdueTasks);

// Định dạng tổng kết
$sheet->getStyle('B' . $summaryRow . ':B' . ($summaryRow + 3))->getFont()->setBold(true);

// Kẽ đường viền cho nội dung công việc
$sheet->getStyle('B3:G' . ($row - 1))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

// Kẽ đường viền cho phần tổng kết
$sheet->getStyle('B' . $summaryRow . ':B' . ($summaryRow + 3))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

// Tạo đối tượng writer và lưu file Excel
$filename = 'DanhSachCongViec_' . $userName . '.xlsx';
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$writer->save(public_path($filename));

// Trả về file tải xuống
return response()->download(public_path($filename));
}

}
