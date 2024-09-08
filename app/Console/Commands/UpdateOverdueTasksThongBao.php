<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\congviec;
use App\Models\giaoviec;

class UpdateOverdueTasksThongBao extends Command
{
    protected $signature = 'tasks:update-overdueThongBao';

    protected $description = 'Update overdue tasks Thông Báo';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
{

    $now = now(); // Thời gian hiện tại
    $IdNguoiDung = DB::select('SELECT giaoviecs.*, congviecs.TenCongViec, congviecs.NgayKetThuc, nguoidungs.Email, nguoidungs.id AS MaNguoiDung, duans.TenDuAn
        FROM giaoviecs
        JOIN congviecs ON giaoviecs.MaCongViec = congviecs.id
        JOIN nguoidungs ON giaoviecs.MaNguoiDung = nguoidungs.id
        JOIN duans ON congviecs.MaDuAn = duans.id
        WHERE giaoviecs.TrangThai NOT IN (3, 4)
        AND giaoviecs.IsActive = true
        AND DATEDIFF(congviecs.NgayKetThuc, ?) <= 3
        AND DATEDIFF(congviecs.NgayKetThuc, ?) >= 0;', [$now, $now]);
    
    foreach ($IdNguoiDung as $item) {
        // Tính số ngày còn lại
        $daysLeft = \Carbon\Carbon::parse($item->NgayKetThuc)->diffInDays($now);
        
        // Tính tổng số giờ còn lại
        $totalHoursLeft = \Carbon\Carbon::parse($item->NgayKetThuc)->diffInHours($now);
        
        // Tính số giờ còn lại trong ngày (sau khi trừ số giờ của các ngày trước đó)
        $hoursLeftInDay = $totalHoursLeft - ($daysLeft * 24);
        
        // Tạo nội dung thông báo
        $NoiDung = 'Công việc: ' . $item->TenCongViec . ' thời gian còn lại ' . $daysLeft . ' ngày ' . $hoursLeftInDay . ' giờ của dự án ' . $item->TenDuAn;
        
        // Thêm vào bảng thongbaos
        DB::table('thongbaos')->insert([
            'NoiDung' => $NoiDung,
            'MaNguoiDung' => $item->MaNguoiDung,
            'IsActive' => true,
            'IsSee' => false,
            'ThoiGian' => now(),
        ]);
    }
    
    Log::info('Thời gian hiện tại: ' . $now);
    
    $this->info('Overdue tasks updated successfully.');
    
}

}
