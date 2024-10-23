<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTambahan extends Model
{
    use HasFactory;

    protected $fillable = ['id_paket_tour', 'nama_item'];

    public function rPaketTour()
    {
        return $this->belongsTo(PaketTour::class, 'id_paket_tour', 'id');
    }
}
