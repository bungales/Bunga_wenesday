<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multipleuploads extends Model
{
    use HasFactory;

    protected $table = 'multiuploads';
    protected $fillable = [
        'filename',
        'ref_table',
        'ref_id',
        'created_at',
        'updated_at'
    ];
}
