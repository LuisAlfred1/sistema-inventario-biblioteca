<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    //Le indica a Laravel que este modelo se corresponde con la tabla 'libros' en la base de datos, lo que permite realizar operaciones de base de datos utilizando este modelo.
    protected $table = 'libros';

    //
    protected $fillable = [
        // Campos
        'titulo',
        'anio_publicacion',
        'stock',
        'autor_id',
    ];

    // Relación con el modelo Autor
    public function autor()
    {
        //Retorna la relación de pertenencia entre Libro y Autor, indicando que un libro pertenece a un autor específico. El belongsTo se utiliza para definir esta relación, y se especifica el modelo Autor y la clave foránea 'autor_id' que conecta ambos modelos.
        return $this->belongsTo(Autor::class, 'autor_id');
    }
}
