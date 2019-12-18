<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOCSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('oc_settings')) {
            Schema::create('oc_settings', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('type');
                $table->string('meta_key');
                $table->string('meta_value');
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oc_settings');
    }
}
