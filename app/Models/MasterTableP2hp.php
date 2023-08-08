<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterTableP2hp extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "master_table_p2hp";
    protected $guarded = ["id"];
}
