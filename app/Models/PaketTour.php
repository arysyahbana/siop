<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketTour extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'id_objek_wisata',
        'id_penginapan',
        'id_pemilik',
        'harga',
        'image',
    ];

    public function rObjekWisata()
    {
        return $this->belongsTo(ObjekWisata::class, 'id_objek_wisata', 'id');
    }

    public function rPenginapan()
    {
        return $this->belongsTo(Penginapan::class, 'id_penginapan', 'id');
    }

    public function rPemilik()
    {
        return $this->belongsTo(User::class, 'id_pemilik', 'id');
    }

    public function rItemTambahan()
    {
        return $this->hasMany(ItemTambahan::class, 'id_paket_tour', 'id');
    }
}
