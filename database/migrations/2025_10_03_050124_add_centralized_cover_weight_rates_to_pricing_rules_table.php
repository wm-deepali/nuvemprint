<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCentralizedCoverWeightRatesToPricingRulesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pricing_rules', function (Blueprint $table) {
            $table->boolean('centralized_cover_weight_rates')
                  ->default(false)
                  ->after('centralized_weight_rates');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('pricing_rules', function (Blueprint $table) {
            $table->dropColumn('centralized_cover_weight_rates');
        });
    }
}
