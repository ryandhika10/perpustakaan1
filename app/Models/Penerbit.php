<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penerbit extends Model
{
    use HasFactory;

    protected $table = 'penerbit';
    protected $fillable = ['nama', 'slug'];

    // relation
    public function buku()
    {
        return $this->hasMany(Buku::class);
    }

    // mutator
    protected function setNamaAttribute($value)
    {
        $this->attributes['nama'] = ucfirst($value);
    }
}
