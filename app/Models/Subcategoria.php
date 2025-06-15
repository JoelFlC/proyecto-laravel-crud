<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $table = 'subcategoria';
    protected $primaryKey = 'codigo_subcategoria';
    public $timestamps = false;
    protected $fillable = ['nombre_subcategoria', 'codigo_categoria'];

    public function categoria()
    {
        return $this->belongsTo(\App\Models\Categoria::class, 'codigo_categoria');
    }

    public function articulos()
    {
        return $this->hasMany(Articulo::class, 'codigo_subcategoria');
    }
}
