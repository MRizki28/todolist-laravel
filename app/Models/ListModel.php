<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListModel extends Model
{
    use HasFactory;
    protected $table = 'tb_list';
    protected $fillable = [
        'id' , 'tanggal' , 'judul' , 'deskripsi' , 'created_at' , 'updated_at'
    ];
}
