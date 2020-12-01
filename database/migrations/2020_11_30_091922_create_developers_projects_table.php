<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopersProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_project', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('developer_id')->unsigned();
            $table->bigInteger('project_id')->unsigned();
            $table->timestamps();
            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->unique(['developer_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developer_project');
    }
}
