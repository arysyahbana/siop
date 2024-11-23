<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_penginapan', 'deskripsi', 'id_lokasi', 'maps', 'jenis_penginapan', 'wahana', 'outbound', 'kafe', 'id_pemilik', 'image', 'medsos', 'status'];

    public function rPemilik()
    {
        return $this->belongsTo(User::class, 'id_pemilik', 'id');
    }

    public function rKamar()
    {
        return $this->hasMany(Kamar::class, 'id_penginapan', 'id');
    }

    public function rLokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi', 'id');
    }
}
