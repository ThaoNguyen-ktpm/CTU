<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\congviec;
use App\Models\giaoviec;

class UpdateOverdueTasks extends Command
{
    protected $signature = 'tasks:update-overdue';

    protected $description = 'Update overdue tasks';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
{
    $now = now();
        // Sử dụng Transaction trong Laravel để đảm bảo tính toàn vẹn dữ liệu
    DB::transaction(function() use ($now) {
        // Cập nhật bảng giaoviecs, cập nhật TrangThai thành 4 cho các công việc quá hạn
        $updatedGiaoviecs = DB::table('giaoviecs')
            ->join('congviecs', 'giaoviecs.MaCongViec', '=', 'congviecs.id')
            ->where('giaoviecs.TrangThai', '!=', [3, 4])
            ->where('congviecs.NgayKetThuc', '<=', $now)
            ->update(['giaoviecs.TrangThai' => 4]);

        // Lấy danh sách các id công việc quá hạn
        $overdueTasks2 = giaoviec::join('congviecs', 'giaoviecs.MaCongViec', '=', 'congviecs.id')
        ->where('giaoviecs.TrangThai', '!=', [3, 4])
        ->where('congviecs.NgayKetThuc', '<=', $now)
        ->select('congviecs.id as idcongviec')
        ->get();

        // Lấy danh sách các id congviec quá hạn
        $overdueIds = $overdueTasks2->pluck('idcongviec');

        // Cập nhật bảng congviecs, chỉ cập nhật TrangThai thành 4 cho các công việc quá hạn
        $updatedCongviecs = DB::table('congviecs')
        ->whereIn('id', $overdueIds) // Cập nhật chỉ các công việc có id nằm trong danh sách
        ->update(['TrangThai' => 4]);

        // Log thời gian hiện tại để kiểm tra
        Log::info('Thời gian hiện tại: ' . $now);
        // Log số lượng bản ghi đã cập nhật cho mỗi bảng
        Log::info('Số lượng giaoviecs cập nhật: ' . $updatedGiaoviecs);
        Log::info('Số lượng congviecs cập nhật: ' . $updatedCongviecs);
    });


   

    $this->info('Overdue tasks updated successfully.');
}

}
