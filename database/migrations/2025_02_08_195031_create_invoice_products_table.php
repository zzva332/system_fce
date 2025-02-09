<?php

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Invoice::class)->constrained();
            $table->foreignIdFor(Product::class)->constrained();
            $table->integer('count');
            $table->decimal('gross_value', 12); // valor bruto sin aplicar impuestos y demas
            $table->decimal('net_value', 12); // valor neto o total a pagar
            $table->integer('iva'); // porcentaje iva
            $table->integer('discount'); // porcentaje descuento
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_products');
    }
};
