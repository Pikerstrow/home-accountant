<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use phpDocumentor\Reflection\Types\Null_;

class AddHasCostItemsColumnToCostDirectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cost_directions', function (Blueprint $table) {
            $table->boolean('has_cost_items')->default(false);
            $table->decimal('sum')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cost_directions', function (Blueprint $table) {
            $table->dropColumn('has_cost_items');
            $table->dropColumn('sum');
        });
    }
}
