<?php

namespace DSIproject;

use DB;
use DSIproject\Evaluacion;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'materias';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'codigo',
    	'nombre',
    	'estado',
    ];

    /**
     * Obtiene los niveles educativos donde se imparte la materia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function niveles()
    {
        return $this->belongsToMany('DSIproject\Nivel')->withTimestamps();
    }

    /**
     * Obtiene las evaluaciones de la materia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evaluaciones()
    {
        return $this->hasMany('DSIproject\Evaluacion');
    }

    /**
     * Obtiene los grados donde se imparte la materia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grados()
    {
        return $this->belongsToMany('DSIproject\Grado', 'grado_materia')
            ->withPivot('docente_id')
            ->withTimestamps();
    }

    /**
     * Obtiene los docentes que imparten la materia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function docentes()
    {
        return $this->belongsToMany('DSIproject\Docente', 'grado_materia')
            ->withPivot('grado_id')
            ->withTimestamps();
    }

    /**
     * Retorna el promedio de un alumno en una materia y trimestre específico.
     *
     * @param  int  $grado
     * @param  int  $materia
     * @param  int  $alumno
     * @param  int  $trimestre
     * @return float
     */
    public static function promediarTrimestre($grado, $materia, $alumno, $trimestre)
    {
        // Evaluaciones del trimestre.
        $evaluaciones = Evaluacion::where('tipo', 'EXA')
            ->where('grado_id', $grado)
            ->where('materia_id', $materia)
            ->where('trimestre', $trimestre)
            ->orWhere('tipo', 'ACT')
            ->where('grado_id', $grado)
            ->where('materia_id', $materia)
            ->where('trimestre', $trimestre)
            ->get();

        // Promedio del trimestre.
        $promedio = 0;

        // Si hay evaluaciones.
        if (count($evaluaciones) > 0) {
            foreach ($evaluaciones as $evaluacion) {
                $nota = DB::table('alumno_evaluacion')
                    ->where('alumno_id', $alumno)
                    ->where('evaluacion_id', $evaluacion->id)
                    ->first();

                // Si hay registro.
                if ($nota) {
                    $promedio += round($nota->nota * $evaluacion->porcentaje, 2);
                } else {
                    $promedio += 0;
                }
            }
        }

        // Evaluación de recuperación.
        $recuperacion = Evaluacion::where('tipo', 'REC')
            ->where('grado_id', $grado)
            ->where('materia_id', $materia)
            ->where('trimestre', $trimestre)
            ->first();

        // Si hay evaluación de recuperación.
        if ($recuperacion) {
            $nota_recuperacion = DB::table('alumno_evaluacion')
                ->where('alumno_id', $alumno)
                ->where('evaluacion_id', $recuperacion->id)
                ->first();

            if ($nota_recuperacion) {
                $promedio += round($nota_recuperacion->nota, 2);
            }
        } else {
            $promedio += 0;
        }

        return $promedio;
    }
}
