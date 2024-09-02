<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongbao extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'thongbaos';
    protected $fillable = [
        'NoiDung',
        'MaNguoiDung',
        'IsActive',
        'IsSee',
        'ThoiGian',
    ];

}
