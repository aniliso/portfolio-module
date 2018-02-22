<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBrandIdColumnNullableToPortfolioPortfolios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolio__portfolios', function (Blueprint $table) {
            $table->integer('brand_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portfolio__portfolios', function (Blueprint $table) {
            $table->integer('brand_id')->unsigned()->change();
        });
    }
}
