<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'inventarios';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'fecha',
        'estado',
    ];

    /**
     * Obtiene los recursos inventariados.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function recursos()
    {
        return $this->belongsToMany('DSIproject\Recurso', 'inventario_recurso')
            ->withPivot('recurso_id')
            ->withTimestamps();
    }
}
