<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulo';
    protected $fillable = [
        'nombre_articulo',
        'codigo_categoria',
        'codigo_subcategoria',
    ];
    public $timestamps = false;
    protected $primaryKey = 'codigo_articulo';

    public function categoria() 
    {
        return $this->belongsTo(Categoria::class, 'codigo_categoria');
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'codigo_subcategoria');
    }
}

