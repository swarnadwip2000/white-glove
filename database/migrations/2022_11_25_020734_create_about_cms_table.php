<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_cms', function (Blueprint $table) {
            $table->id();
            $table->string('banner_name')->nullable();
            $table->string('section_1_img')->nullable();
            $table->string('section_1_name')->nullable();
            $table->string('section_1_title')->nullable();
            $table->longText('section_1_description')->nullable();
            $table->string('section_2_banner')->nullable();
            $table->string('section_2_title')->nullable();
            $table->string('section_3_img')->nullable();
            $table->string('section_3_name')->nullable();
            $table->string('section_3_title')->nullable();
            $table->longText('section_3_description')->nullable();
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
        Schema::dropIfExists('about_cms');
    }
}
