<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_product')->constrained('products')->onDelete('cascade');
            $table->double('price', 10, 2);
        });
    }

    public
    function down()
    {
        Schema::table('prices', function (Blueprint $table) {
            $table->dropForeign(['id_product']);
        });
        Schema::dropIfExists('prices');
    }
};
