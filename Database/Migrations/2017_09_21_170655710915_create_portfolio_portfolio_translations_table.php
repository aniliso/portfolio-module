<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioPortfolioTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio__portfolio_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            // Your translatable fields
            $table->string('title', 200);
            $table->string('slug', 200);
            $table->text('description');

            $table->string('meta_title', 60)->nullable();
            $table->string('meta_description', 160)->nullable();

            $table->integer('portfolio_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['portfolio_id', 'locale']);
            $table->foreign('portfolio_id')->references('id')->on('portfolio__portfolios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portfolio__portfolio_translations', function (Blueprint $table) {
            $table->dropForeign(['portfolio_id']);
        });
        Schema::dropIfExists('portfolio__portfolio_translations');
    }
}
