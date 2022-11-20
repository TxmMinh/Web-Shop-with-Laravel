<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    // Trong Laravel mỗi một model ứng với một bảng(table) dữ liệu trong CSDL
    // và để khai báo model sử dụng bảng dữ liệu nào trong database thì khai báo dòng sau trong class model.
    protected $table = 'menus';

    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'content',
        'active',
    ];
}
