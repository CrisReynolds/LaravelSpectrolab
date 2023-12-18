<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('unidad_ref',50);
            $table->timestamps();
        });

        Schema::create('solicitantes', function (Blueprint $table) {
            $table->id();
            $table->string('solicitante_ref',80);
            $table->timestamps();
        });

        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->integer('cod_ref');
            $table->string('cat_ref',50);
            $table->timestamps();
        });

        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('ciudad',100)->nullable();
            $table->string('correo',100)->nullable();
            $table->string('direccion',100)->nullable();
            $table->string('nombre',100)->unique();
            $table->string('telefono',50)->nullable();
            $table->string('fax',50)->nullable();
            $table->bigInteger('nit')->unique();
            $table->string('persona_contacto',120)->nullable();
            $table->text('productos');
            $table->text('representante')->nullable();
            $table->timestamps();
        });

        Schema::create('compras',function(Blueprint $table){
            $table->id();
            $table->date('fecha_compra');
            $table->date('fecha_entrega')->nullable();
            //$table->double('importe',16,4);
            $table->integer('num_factura');
            $table->string('num_vale_ingreso')->unique();
            $table->foreignId('proveedor_id')->references('id')->on('proveedores')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('usuario_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('insumos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',80)->nullable();
            $table->string('detalle',200);
            $table->string('marca',50)->nullable();
            //$table->double('precio',12,4);
           // $table->double('stock',12,2);
            $table->integer('stock_minimo')->nullable();
            $table->boolean('es_narcotico')->default(false);
            // $table->string('observacion_insumo',60)->nullable();
            $table->foreignId('unidad_id')->references('id')->on('unidades')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('categoria_id')->references('id')->on('categorias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('proveedor_id')->references('id')->on('proveedores')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('consumos',function(Blueprint $table){
            $table->id();
            $table->date('fecha_consumo');
            $table->bigInteger('num_vale_salida')->unique();
            $table->string('observaciones',200)->nullable();
            $table->string('parametro',100)->nullable();
            $table->string('descripcion')->nullable();
            $table->foreignId('usuario_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('solicitante_id')->references('id')->on('solicitantes')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('detalle_consumos',function(Blueprint $table){
            $table->id();
            $table->foreignId('consumos_id')->references('id')->on('consumos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('insumo_id')->references('id')->on('insumos')->onUpdate('cascade')->onDelete('cascade');
            $table->double('cantidad', 12, 4);
            $table->double('importe', 12, 4)->nullable();
            $table->double('punit', 12, 4)->nullable();
            $table->double('detcompra_id', 12, 4)->nullable();
            $table->timestamps();
        });

        Schema::create('detalle_compras',function(Blueprint $table){
            $table->id();
            $table->foreignId('compras_id')->references('id')->on('compras')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('insumo_id')->references('id')->on('insumos')->onUpdate('cascade')->onDelete('cascade');
            $table->string('observacion_insumo', 100)->nullable();
            $table->double('cantidad', 12, 4);
            $table->double('importe', 12, 4);
            $table->double('punit', 12, 4)->nullable();
            $table->double('cantstock', 12, 4)->nullable();
            $table->double('punitstock', 12, 4)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insumos');
        Schema::dropIfExists('unidades');
        Schema::dropIfExists('solicitantes');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('proveedores');
        Schema::dropIfExists('compras');
        Schema::dropIfExists('consumos');
        Schema::dropIfExists('detalle_consumos');
        Schema::dropIfExists('detalle_compras');
    }
};
