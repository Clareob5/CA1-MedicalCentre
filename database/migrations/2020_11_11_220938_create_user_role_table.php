<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //creating the pivot table for the many to many relationahip between users and roles
      Schema::create('user_role', function (Blueprint $table) {
          $table->id();
          $table->bigInteger('user_id')->unsigned(); //use unsigned bug integers for foreign keys
          $table->bigInteger('role_id')->unsigned();
          $table->timestamps();

          //defining the foreign key contraints for both tables
          $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
          $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('restrict');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_role'); //drop the user role table
    }
}
