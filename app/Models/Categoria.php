<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{



    protected $table = 'categoria';

    public $timestamps = false;

    protected $primaryKey = 'codigo_categoria';

    protected $fillable = ['nombre_categoria'];

    public function getRouteKeyName()
    {
        return 'codigo_categoria';
    }
    
}


