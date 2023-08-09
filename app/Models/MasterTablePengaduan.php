<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterTablePengaduan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "master_table_pengaduan";
    protected $guarded = ["id"];

    public function c_by_r()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function u_by_r()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
