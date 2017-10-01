<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioPortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('portfolio__portfolios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            // Your fields
            $table->string('website', 100)->nullable();
            $table->date('start_at');
            $table->date('end_at');
            $table->smallInteger('status')->default(1);
            $table->integer('ordering')->default(1);

            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('portfolio__brands')->onDelete('cascade');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('portfolio__categories')->onDelete('cascade');

            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('portfolio__portfolios');
        Schema::enableForeignKeyConstraints();
    }
}
