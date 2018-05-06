<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioMultipleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio__portfolio_categories', function (Blueprint $table) {
            $table->integer('portfolio_id')->unsigned();
            $table->foreign('portfolio_id')->references('id')->on('portfolio__portfolios')->onDelete('cascade');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('portfolio__categories')->onDelete('cascade');
        });


        if(Schema::hasTable('portfolio__portfolio_categories')
            && Schema::hasColumn('portfolio__portfolios', 'category_id')
            && class_exists(\Modules\Portfolio\Entities\PortfolioCategory::class)) {

            $portfolios = \Modules\Portfolio\Entities\Portfolio::all();

            foreach ($portfolios as $portfolio) {
                $newData = new \Modules\Portfolio\Entities\PortfolioCategory();
                $newData->portfolio_id = $portfolio->id;
                $newData->category_id  = $portfolio->category_id;
                $newData->save();
            }

            Schema::disableForeignKeyConstraints();
            if(Schema::hasColumn('portfolio__portfolios', 'category_id')) {
                Schema::table('portfolio__portfolios', function (Blueprint $table){
                    $table->dropForeign('portfolio__portfolios_category_id_foreign');
                    $table->dropColumn('category_id');
                });
            }
            Schema::enableForeignKeyConstraints();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('portfolio__portfolio_categories');
        Schema::enableForeignKeyConstraints();
    }
}
