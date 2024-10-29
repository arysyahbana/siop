<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekWisata extends Model
{
    use HasFactory;

    protected $fillable = ['nama_wisata', 'id_kategori', 'deskripsi', 'lokasi', 'harga', 'no_hp', 'image', 'medsos'];

    public function rKategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
}
