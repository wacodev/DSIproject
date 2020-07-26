<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCurriculumFieldsToDocentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->string('nit', 17)->nullable();
            $table->string('nup', 12)->nullable();
            $table->string('isss', 9)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('direccion', 400)->nullable();
            $table->char('telefono', 8)->nullable();
            $table->text('estudios')->nullable();
            $table->text('experiencia')->nullable();
            $table->text('referencias')->nullable();
            $table->string('idiomas', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->dropColumn('nit');
            $table->dropColumn('nup');
            $table->dropColumn('isss');
            $table->dropColumn('fecha_nacimiento');
            $table->dropColumn('direccion');
            $table->dropColumn('telefono');
            $table->dropColumn('estudios');
            $table->dropColumn('experiencia');
            $table->dropColumn('referencias');
            $table->dropColumn('idiomas');
        });
    }
}
