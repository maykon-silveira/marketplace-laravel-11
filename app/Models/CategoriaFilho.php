<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaFilho extends Model
{
    use HasFactory;

    //define a relação da categoria com a categoria filho
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    //define a relação da subcategoria com a categoria filho
    public function subcategoria()
    {
        return $this->belongsTo(SubCategoria::class, 'sub_categoria_id');
    }
}
