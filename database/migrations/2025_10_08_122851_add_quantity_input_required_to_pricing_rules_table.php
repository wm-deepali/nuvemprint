<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityInputRequiredToPricingRulesTable extends Migration
{
    public function up()
    {
        Schema::table('pricing_rules', function (Blueprint $table) {
            $table->boolean('quantity_input_required')->default(true)->after('pages_dragger_required');
        });
    }

    public function down()
    {
        Schema::table('pricing_rules', function (Blueprint $table) {
            $table->dropColumn('quantity_input_required');
        });
    }
}
