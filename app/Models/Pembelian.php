<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $fillable = ['nama_pembeli', 'tanggal_pembelian', 'nama_barang', 'harga_satuan', 'jumlah'];
    public $timestamps = true;
}
