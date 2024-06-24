<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $fillable = ['judul', 'slug', 'sampul', 'penulis', 'stok', 'penerbit_id', 'kategori_id', 'rak_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }
    public function detail_peminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    // mutator
    protected function setJudulAttribute($value)
    {
        $this->attributes['judul'] = ucfirst($value);
    }

    // cara 1 : juga merubah data di database
    protected function setPenulisAttribute($value)
    {
        $this->attributes['penulis'] = ucfirst($value);
    }

    // cara 2 : tanpa merubah data di database
    // protected function penulis(): Attribute
    // {
    //     return Attribute::make(
    //         set: fn ($value) => ucfirst($value)
    //     );
    // }
}
