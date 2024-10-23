<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable=[
        'nomor_kamar',
        'id_penginapan',
        'harga',
        'status',
        'image'
    ];

    public function rPenginapan(){
        return $this->belongsTo(Penginapan::class, 'id_penginapan', 'id');
    }
}