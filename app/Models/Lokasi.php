<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = 'tb_lokasi';
    protected $fillable = ['nm_gudang', 'alamat', 'no_hp'];
}
