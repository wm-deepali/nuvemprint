<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumericValueToQuoteItemAttributesTable extends Migration
{
    public function up()
    {
        Schema::table('quote_item_attributes', function (Blueprint $table) {
            $table->decimal('numeric_value', 15, 4)->nullable()->after('value_id')->comment('Stores raw numeric attribute values');
        });
    }

    public function down()
    {
        Schema::table('quote_item_attributes', function (Blueprint $table) {
            $table->dropColumn('numeric_value');
        });
    }
}
