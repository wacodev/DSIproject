<?php

namespace DSIproject;

use DB;
use Illuminate\Database\Eloquent\Model;

class Valor extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'valores';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'valor',
    	'estado',
    ];

    /**
     * Obtiene los alumnos a los que se les ha evaluado el valor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function alumnos()
    {
        return $this->belongsToMany('DSIproject\Alumno', 'alumno_valor')
            ->withPivot(['grado_id', 'trimestre', 'nota'])
            ->withTimestamps();
    }

    /**
     * Obtiene los grados en los que se evalua el valor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grados()
    {
        return $this->belongsToMany('DSIproject\Grado', 'alumno_valor')
            ->withPivot(['alumno_id', 'trimestre', 'nota'])
            ->withTimestamps();
    }

    /**
     * Retorna el promedio de nota de conducta de un alumno en un trimestre
     * específico.
     *
     * @param  int  $grado
     * @param  int  $valor
     * @param  int  $alumno
     * @param  int  $trimestre
     * @return int
     */
    public static function promediarTrimestreConducta($grado, $valor, $alumno, $trimestre)
    {
        $nota_c = DB::table('alumno_valor')
            ->where('alumno_id', $alumno)
            ->where('valor_id', $valor)
            ->where('grado_id', $grado)
            ->where('trimestre', $trimestre)
            ->first();

        if ($nota_c) {
            switch ($nota_c->nota) {
                case 'E':
                    $nota = 10;
                    break;

                case 'MB':
                    $nota = 8;
                    break;

                case 'B':
                    $nota = 6;
                    break;
                
                case 'R':
                    $nota = 4;
                    break;

                case 'M':
                    $nota = 2;
                    break;

                default:
                    $nota = 0;
                    break;
            }
        } else {
            $nota = 0;
        }

        return $nota;
    }

    /**
     * Retorna la nota promedio de conducta de un alumno como cadena de caracteres
     * según corresponda en la escala: E, MB, B, R, M.
     *
     * @param  float  $nota
     * @return string
     */
    public static function traducirNotaConducta($nota)
    {
        switch ($nota) {
            case $nota > 8:
                $n = 'E';
                break;

            case $nota > 6:
                $n = 'MB';
                break;

            case $nota > 4:
                $n = 'B';
                break;
            
            case $nota > 2:
                $n = 'R';
                break;

            case $nota <= 2:
                $n = 'M';
                break;
        }

        return $n;
    }
}
