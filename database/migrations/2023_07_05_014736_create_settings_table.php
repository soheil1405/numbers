<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('searchEngin1Pay');
            $table->bigInteger('searchEngin2Pay');
            $table->bigInteger('searchEngin3Pay');
            $table->bigInteger('searchEngin4Pay');
            
            $table->longText('searchEngin1ExportData');
            $table->longText('searchEngin2ExportData');
            $table->longText('searchEngin3ExportData');
            $table->longText('searchEngin4ExportData');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
