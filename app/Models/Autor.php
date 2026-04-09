<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autors';

    protected $fillable = [
        'nombre',
        'nacionalidad',
    ];

    public function libros()
    {
        //Retorna la relación de uno a muchos entre Autor y Libro, indicando que un autor puede tener varios libros asociados. El hasMany se utiliza para definir esta relación, y se especifica el modelo Libro y la clave foránea 'autor_id' que conecta ambos modelos.
        return $this->hasMany(Libro::class, 'autor_id');
    }
}
