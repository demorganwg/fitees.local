<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAssignmentResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assignment_results', function (Blueprint $table) {
            
            $table->integer('user_course_id')->unsigned()->default(1);
            $table->foreign('user_course_id')->references('id')->on('user_courses');
            
            $table->integer('assignment_id')->unsigned()->default(1);
            $table->foreign('assignment_id')->references('id')->on('assignments');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assignment_results', function (Blueprint $table) {
            //
        });
    }
}
