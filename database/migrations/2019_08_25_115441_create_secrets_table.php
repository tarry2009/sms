<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecretsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secrets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('access_id')->unsigned(); 
            $table->string('secret_name')->nullable();
            $table->text('encrypted_secret')->nullable(); 
            $table->timestamps();

            $table->index(['access_id']);

            $table->foreign('access_id')
                ->references('id')->on('access')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('secrets', function ($table) {
            $table->dropForeign(['access_id']);
        });

        Schema::drop('secrets');
    }
}
