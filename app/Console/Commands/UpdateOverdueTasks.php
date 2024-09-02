<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\congviec;

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
    
    // Log thời gian hiện tại để kiểm tra
    Log::info('Current time: ' . $now);
    
    // Xem các công việc quá hạn để kiểm tra
    $overdueTasks = congviec::where('TrangThai', '!=', 3)
                            ->where('NgayKetThuc', '>=', $now)
                            ->get();
    
    // Log các công việc quá hạn để kiểm tra
    Log::info('Overdue tasks: ' . $overdueTasks->count());

    // Cập nhật trạng thái các công việc quá hạn
    CongViec::where('TrangThai', '!=', 3)
            ->where('NgayKetThuc', '>=', $now)
            ->update(['TrangThai' => 7]);

    $this->info('Overdue tasks updated successfully.');
}

}
